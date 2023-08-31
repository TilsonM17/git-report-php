<?php

namespace Tilson\GitReportPhp\Tests\Unit;

use Illuminate\Support\Facades\Process;
use \Orchestra\Testbench\TestCase;
use Tilson\GitReportPhp\GitLogCommand;

class ExceptionTest extends TestCase
{

    /**
     * @test
     * @description simulate the i am im root directory and with .git no exists
     */
    public function test_if_a_im_im_root_folder_and_with_git_folder_no_exists()
    {
        if (!base_path() . '/.git' && str_contains(base_path(), 'vendor/orchestra/testbench-core')) {
            $this->expectException(\Tilson\GitReportPhp\Exception\GitNotIsInstalled::class);
            $gitLog = new GitLogCommand();
            $gitLog->exec();
        }

        $this->assertDirectoryDoesNotExist(base_path() . '/.git');
    }

    /**
     * @test
     * @description simulate the i am im root directory and with .git exists
     */
    public function test_if_a_im_im_root_folder_and_with_git_folder_exists()
    {
        //@breakpoint -> Criar pastas ocultas no vendor/orchestra/testbench-core
        if (!base_path() . '/.git' && str_contains(base_path(), 'vendor/orchestra/testbench-core')) {
            //Simulate a .git folder
            Process::path(base_path())->run('mkdir .git');
        }

        $this->assertDirectoryExists('.git');

        str_contains(base_path(), 'vendor/orchestra/testbench-core') ? Process::path(base_path())->run('rm -rf .git') : null;
    }

    protected function getPackageProviders($app)
    {
        return ['Tilson\GitReportPhp\GitLogProvider'];
    }
}
