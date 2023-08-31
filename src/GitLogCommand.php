<?php

namespace Tilson\GitReportPhp;

use Illuminate\Support\Collection;
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
        if (!Process::path(base_path())->run('git --version') || !file_exists(base_path() . '/.git')) {
            throw new GitNotIsInstalled();
        }
    }

    /**
     * @return @return \Illuminate\Support\Collection<TKey, TValue>
     */
    public function exec($path = null): Collection
    {
        $this->checkIfGitIsInstalled();

        $allCommits = Process::path(base_path())->run($this->command);

        !$allCommits->successful()
            ? throw new \Exception("Error tracked in reading commits", 1)
            : null;

        return collect(explode("\n", $allCommits->output()));
    }
}
