<?php

namespace Tilson\GitReportPhp;

use Tilson\GitReportPhp\Contract\GitLogContract;
use Tilson\GitReportPhp\Report\ReportHtml;


class GitLogCommand implements GitLogContract
{
    /**
     * @param array $arguments
     */
    public array $arguments = [];

    /**
     * @param string $command
     */
    private string $command = "git log --pretty='%s'";

    public function exec($path = null): array
    {
        $path ?? chdir($path);
        exec('cd ' . $path);
        exec('pwd', $output);
        print_r($output);
        die('');

        exec($this->command, $allCommits);

        empty($allCommits) ? $allCommits = (new ReportHtml)->generateReport($allCommits) : throw new \Exception("Error Processing Request", 1);
        
        return [$allCommits];
    }
}
