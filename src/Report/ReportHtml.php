<?php

namespace Tilson\GitReportPhp\Report;

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
    private string $pattern = '/^(feat|fix|chore|docs|style|refactor|perf|test|revert|build)/';

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

        // foreach ($commits as  $value) {
        //     if (preg_match($this->pattern, substr($value, 0, 10), $this->matches)) {
        //         $this->matches[$this->matches[1]];
        //     }
        // }

        // print_r($this->matches);
    }
}
