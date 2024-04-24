<?php

namespace App\Jobs;

use App\Models\Destiny;
use App\Services\OpenAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateDestinyDescriptionsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     * 
     * @param $openai
     * 
     * @return void
     */
    public function handle(OpenAIService $openai): void
    {
        $destinies = Destiny::where('description', null)->get();

        $destinies->each(function (Destiny $destiny) use ($openai) {
            if ($description = $openai->createDestinyDescription($destiny)) {
                $destiny->update([
                    'description' => $description
                ]);
            }
        });
    }
}
