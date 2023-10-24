<?php

namespace parzival42codes\LaravelArtisanAsJob\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Bus;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use parzival42codes\LaravelArtisanAsJob\App\Jobs\ArtisanJob;
use parzival42codes\LaravelArtisanAsJob\App\Models\ArtisanAsJob;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): Renderable
    {
        $startQueue = Job::where([])
            ->first();

        $artisanQueue = ArtisanAsJob::with('job')
            ->orderByDesc(ArtisanAsJob::DBNAME.'.created_at')
            ->get();

        return view('artisan-as-job::dashboard', compact([
            'startQueue',
            'artisanQueue',
        ]));
    }

    public function cmd(Request $request): RedirectResponse
    {
        $artisanCmd = $request->post('artisan_cmd');

        $artisanAsJob = ArtisanAsJob::create([
            'artisan_cmd' => $artisanCmd,
            'artisan_output' => '',
            'artisan_status' => ArtisanAsJob::STATUS_QUEUE,
        ]);

        $artisanJob = new ArtisanJob($artisanAsJob->id);
        $artisanJob->onQueue(null);

        $artisanAsJob->job_id = Bus::dispatch($artisanJob);
        $artisanAsJob->save();

        return redirect(route('artisan-as-job.dashboard'));
    }
}
