<?php

namespace Tilson\GitReportPhp\Tests;

use \Orchestra\Testbench\TestCase;
use Tilson\GitReportPhp\GitLogCommand;

class ExceptionTest extends TestCase
{

    /**
     * @test
     */
    public function testGitNotIsInstalled()
    {
        // Aqui simulamos o cenário em que o Git não está instalado e o diretório .git não existe
        $gitLogCommandMock = $this->getMockBuilder(GitLogCommand::class)
            ->onlyMethods(['exec'])
            ->getMock();

        $gitLogCommandMock->expects($this->once())
            ->method('exec')
            ->with($this->equalTo('git --version'))
            ->willReturn(null);

        $this->expectException(GitNotIsInstalled::class);
        $gitLogCommandMock->checkIfGitIsInstalled();
    }


    protected function getPackageProviders($app)
    {
        return ['Tilson\GitReportPhp\GitLogProvider'];
    }
}
