<?php

namespace Tilson\GitReportPhp\Tests;

use \Orchestra\Testbench\TestCase;

class ReportHtmlCommandTest extends TestCase{


    /**
     * @test
     */
    public function testReportHtmlCommand()
    {
        $this->artisan('git:report-html')
            ->expectsOutput('Generating report in HTML format...')
            ->assertExitCode(0);
    }

    protected function getPackageProviders($app)
    {
        return ['Tilson\GitReportPhp\GitLogProvider'];
    }
}