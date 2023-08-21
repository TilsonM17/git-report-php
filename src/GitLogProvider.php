<?php

namespace Tilson\GitReportPhp;
use Illuminate\Support\ServiceProvider;
use Tilson\GitReportPhp\Console\Commands\ReportHtmlCommand;

class GitLogProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ReportHtmlCommand::class,
                // NetworkCommand::class,
            ]);
        }
    }
}
