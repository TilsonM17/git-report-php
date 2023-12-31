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
     * @param string $label
     */
    private $label;

    private $labelData;

    private function createFolderAndCopyStubsFiles(): string
    {
        $newFile =  resource_path(
            'report/report_html_' . date('Y_M_d_G_s_i') . '.html'
        );

        $reportFolder = resource_path('report/');

        if (!File::exists($reportFolder)) {
            File::makeDirectory($reportFolder, 0775, true);
        }

        $fileHasCoped = File::copy(
            __DIR__ . '/../../stubs/report_stub',
            $newFile
        );

        if (!$fileHasCoped) {
            throw new \Exception('Error to copy file');
        }

        $replacedLabel = str_replace(
            '{{label}}',
            "[{$this->label}]",
            File::get($newFile)
        );

        $replacedCommits = str_replace(
            '{{commits}}',
            "[{$this->labelData}]",
            $replacedLabel
        );

        File::put($newFile, $replacedCommits);

        return $newFile;
    }

    public function setTotalCommits(Collection $totalCommits)
    {
        $this->totalCommits = $totalCommits->count();
    }

    public function setLabel()
    {
        $uniqueCommits = collect($this->commits)->unique();

        $this->label = implode(',', $uniqueCommits->map(function ($value) {
            return  "'$value'";
        })->toArray());
    }

    public function setLabelData()
    {
        $uniqueCommits = collect($this->commits)->unique();

        $this->labelData = implode(',', $uniqueCommits->map(function ($value) {
            return collect($this->commits)->filter(function ($commit) use ($value) {
                return $commit === $value;
            })->count();
        })->toArray());
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

        $this->setLabel();

        $this->setLabelData();

        $pathForFile = $this->createFolderAndCopyStubsFiles();

        return [
            $this->totalCommits,
            $pathForFile
        ];
    }
}
