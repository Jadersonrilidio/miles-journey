<?php

namespace App\Services;

use App\Models\Destination;
use App\ValueObjects\OpenAIConfigBag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class OpenAIService
{
    private const API_ENDPOINT_CHAT_COMPLETION = "https://api.openai.com/v1/chat/completions";

    private const MAKE_DESTINATION_DESCRIPTION_PROMPT = "Make a summary about the city {{ city }} emphasizing why this place is amazing. Use an informal language with a max of {{ characters }} characters for each paragraph. Make {{ paragraphs }} paragraphs for this summary.";

    private string $characters = '150';

    private string $paragraphs = '2';

    public function __construct(private readonly OpenAIConfigBag $config)
    {
        //
    }

    /**
     * Create a description according to destination city name.
     *
     * @param  Destination  $destination
     *
     * @return string|null Returns the description as string or NULL in any case of failure.
     */
    public function createDestinationDescription(Destination $destination): string|null
    {
        $prompt = $this->buildPrompt($destination->name);

        try {
            $clientResponse = Http::withHeaders(
                $this->prepareHeaders()
            )->post(
                self::API_ENDPOINT_CHAT_COMPLETION,
                $this->prepareData($prompt)
            );
        } catch (Throwable $exception) {
            Log::channel('single')->error($exception);

            return null;
        }

        if (!$description = Arr::get($clientResponse->json(), 'choices.0.message.content', null)) {
            return null;
        }

        return $$description;
    }

    /**
     * 
     */
    private function buildPrompt(string $cityName): string
    {
        $mapping = [
            '{{ city }}' => $cityName,
            '{{ characters }}' => $this->characters,
            '{{ paragraphs }}' => $this->paragraphs,
        ];

        $placeholders = array_keys($mapping);
        $values = array_values($mapping);

        return str_replace($placeholders, $values, self::MAKE_DESTINATION_DESCRIPTION_PROMPT);
    }

    /**
     * 
     */
    private function prepareHeaders(): array
    {
        return [
            'Content-type' => 'application/json',
            'Authorization' => $this->config->auth(),
        ];
    }

    /**
     * 
     */
    private function prepareData(string $prompt): array
    {
        return [
            'model' => $this->config->model(),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $prompt,
                ]
            ],
            'temperature' => $this->config->temperature(),
            'max_tokens' => $this->getMaxTokens(),
        ];
    }

    /**
     * 
     */
    private function getMaxTokens(): int
    {
        return (int) ($this->characters / 3) * (int) $this->paragraphs;
    }
}
