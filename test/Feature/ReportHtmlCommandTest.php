<?php

namespace Tilson\GitReportPhp\Tests\Feature;

use \Orchestra\Testbench\TestCase;

class ReportHtmlCommandTest extends TestCase{


    /**
     * @test
     */
    public function testReportHtmlCommand()
    {
        $this->artisan('report:html');
    }

    protected function getPackageProviders($app)
    {
        return ['Tilson\GitReportPhp\GitLogProvider'];
    }
}