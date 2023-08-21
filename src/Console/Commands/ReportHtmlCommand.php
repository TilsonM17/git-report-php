<?php

namespace Tilson\GitReportPhp\Console\Commands;

use Illuminate\Console\Command;
use Tilson\GitReportPhp\Report\ReportHtml;

class ReportHtmlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git-report:html {--author=} {--date-min=} {--date-max=} {--type=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a report in HTML format';

    /**
     * Get options from command
     * 
     * @return array
     */
    private function getCommandOptions(): array
    {
        $option = [];

        if ($this->option('author') != null)
            $option['author'] = $this->option('author');

        if ($this->option('date-max') != null)
            $option['date-max'] = $this->option('date-max');

        if ($this->option('date-min') != null)
            $option['date-min'] = $this->option('date-min');

        $option['type'] = $this->option('type');

        return $option;
    }
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(ReportHtml $reportHtml): void
    {
        $option = $this->getCommandOptions();

        $reportHtml->generateReport($option);

        $this->info('Generating report in HTML format...');
    }
}
