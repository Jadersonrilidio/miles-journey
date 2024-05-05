<?php

namespace App\Jobs;

use App\Models\Destination;
use App\Services\OpenAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateDestinationDescriptionsJob implements ShouldQueue
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
        $destinations = Destination::where('description', null)->get();

        $destinations->each(function (Destination $destination) use ($openai) {
            if ($description = $openai->createDestinationDescription($destination)) {
                $destination->update([
                    'description' => $description
                ]);
            }
        });
    }
}
