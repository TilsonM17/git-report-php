<?php

namespace Tilson\GitReportPhp\Support;

use Tilson\GitReportPhp\GitLogCommand;

final class Kernel
{
    /**
     * @param array $validArgs<string>
     */
    private static array $validArgs = [
        'dir',

    ];

    public static function iniApplication($arguments)
    {
        foreach (self::$validArgs as $key => $value) {
            if (str_starts_with($arguments[1], $value)) {
                $pathForGit = substr($arguments[1], strpos($arguments[1], "=") + 1);
                self::run($pathForGit);
            } else
                echo "não";
        }
    }

    private static function run(string $path)
    {
        (new GitLogCommand)->exec(path: $path);
    }

    private static function help()
    {
        echo "Usage: php index.php [dir|owner] [path|name]\n";
    }
}
