<?php

namespace App\Jobs;

use App\Models\Presentation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchPresentationDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Presentation $presentation;

    /**
     * Create a new job instance.
     */
    public function __construct(Presentation $presentation)
    {

        $this->presentation = $presentation;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = \OpenAI::client(env('OPEN_API_KEY'));
        $description = $this->presentation->description;
        $prompt = "Generate content for slides presentation on topic {$description}. Use your knowledge to fill the slides with information. Do not output anything else except the content of the slides. Make at least 10 slides";
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ]
        ]);

        $out = $result['choices'][0]['message']['content'];

        $this->presentation->update([
           'content' => $out
        ]);
    }
}
