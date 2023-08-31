<?php

namespace Tilson\GitReportPhp\Report;

use Illuminate\Support\Collection;
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
     * Generate report from git log     
     * 
     * */
    public function generateReport(array $options)
    {
        $allCommits = app(GitLogCommand::class)->exec();
        
        $allCommits->each(function ($commit) {
            if (preg_match($this->pattern, substr($commit, 0, 10), $this->matches)) {
                array_push($this->commits, $this->matches[1]);
            }
        });


         dd($this->commits, $allCommits);
    }
}
