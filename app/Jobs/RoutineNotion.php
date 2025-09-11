<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Actions\OrchestrateNotionPagesAction;

class RoutineNotion implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        app(OrchestrateNotionPagesAction::class)->execute(ENV('NOTION_DATABASE_ID'));
    }
}
