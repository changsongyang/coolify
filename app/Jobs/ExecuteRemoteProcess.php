<?php

namespace App\Jobs;

use App\Actions\RemoteProcess\RunRemoteProcess;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Activitylog\Models\Activity;

class ExecuteRemoteProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Activity $activity,
    ){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $remoteProcess = resolve(RunRemoteProcess::class, [
            'activity' => $this->activity,
        ]);

        $remoteProcess();
    }
}