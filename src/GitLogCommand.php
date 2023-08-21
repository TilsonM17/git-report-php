<?php

namespace Tilson\GitReportPhp;

use Tilson\GitReportPhp\Contract\GitLogContract;
use Tilson\GitReportPhp\Exception\GitNotIsInstalled;
use Tilson\GitReportPhp\Report\ReportHtml;
use Illuminate\Support\Facades\Process;
use PHPUnit\TextUI\Configuration\File;
use Symfony\Component\Filesystem\Filesystem;

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

    public function checkIfGitIsInstalled()
    {   
        dd(base_path());
        if (!Process::run('git --version') || !file_exists( base_path().'/.git')) {
            throw new GitNotIsInstalled();
        }
        
    }

    public function exec($path = null): array
    {
        $this->checkIfGitIsInstalled();
        
        Process::run();
        exec($this->command, $allCommits);

        empty($allCommits) ? $allCommits = (new ReportHtml)->generateReport($allCommits) : throw new \Exception("Error Processing Request", 1);
        
        return [$allCommits];
    }
}
