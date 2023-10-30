<?php

namespace parzival42codes\LaravelArtisanAsJob\App\Jobs;

use Artisan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use parzival42codes\LaravelArtisanAsJob\App\Models\ArtisanAsJob;
use Throwable;

class ArtisanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->data = [
            'id' => $id,
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws Throwable
     */
    public function handle()
    {
        $id = $this->data['id'];

        $artisanAsJob = ArtisanAsJob::findOrFail($id);
        $artisanAsJob->artisan_status = ArtisanAsJob::STATUS_START;
        $artisanAsJob->save();

        if (! Artisan::call($artisanAsJob->artisan_cmd)) {
            $artisanAsJob->artisan_status = ArtisanAsJob::STATUS_SUCCESS;
            $artisanAsJob->artisan_output = Artisan::output();
            $artisanAsJob->save();
        } else {
            $artisanAsJob->artisan_status = ArtisanAsJob::STATUS_FAIL;
            $artisanAsJob->save();
        }
    }
}
