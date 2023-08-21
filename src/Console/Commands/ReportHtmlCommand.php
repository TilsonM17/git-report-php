<?php

namespace Tilson\GitReportPhp\Console\Commands;

use Illuminate\Console\Command;

class ReportHtmlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:report-html';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a report in HTML format';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle():void
    {
        $this->info('Generating report in HTML format...');
    }
}
