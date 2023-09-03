<?php

namespace Tilson\GitReportPhp\Report;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Tilson\GitReportPhp\Contract\ReportContract;
use Tilson\GitReportPhp\GitLogCommand;

final class ReportHtml implements ReportContract
{
    /**
     * @param array $commits
     */
    private array $commits = [];

    /**
     * @param string $pattern
     */
    private string $pattern = '/(?:\p{Emoji_Presentation})?\s*(feat|fix|chore|docs|style|refactor|perf|test|revert|build)/u';

    /**
     * @param array $matches
     */
    private array $matches = [];

    /**
     * @param int $totalCommits
     */
    private int $totalCommits = 0;

    /**
     * @param Collection $totalCommits
     * @description Set total commits
     */
    private function setTotalCommits(Collection $totalCommits)
    {
        $this->totalCommits = $totalCommits->count();
    }

    private function createFolderAndCopyStubsFiles()
    {
        // $filesystem = new Filesystem();

        // $filesystem->makeDirectory(resource_path('report'), 0755, true);

        File::get(__DIR__ . '/../../stubs/report_stub');
    
    }

    /**
     * Generate report from git log     
     */
    public function generateReport(array $options)
    {
        $allCommits = app(GitLogCommand::class)->exec();

        $allCommits->each(function ($commit) {
            if (preg_match($this->pattern, substr($commit, 0, 10), $this->matches)) {
                array_push($this->commits, $this->matches[1]);
            }
        });

        $this->setTotalCommits($allCommits);
        dd($allCommits->pluck(''));
        $this->createFolderAndCopyStubsFiles();
        


    }
}
