<?php

namespace App\Console\Commands;

use App\Actions\ProcessDatabaseNotionAction;
use Illuminate\Console\Command;

class SyncNotionPagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-notion-pages-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(ProcessDatabaseNotionAction::class)->execute(ENV('NOTION_DATABASE_ID'));
    }
}
