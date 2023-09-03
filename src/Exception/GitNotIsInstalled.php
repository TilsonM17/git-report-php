<?php

namespace Tilson\GitReportPhp\Exception;

use Exception;

use function Termwind\{render};

class GitNotIsInstalled extends Exception
{
    public function __construct()
    {

        render(<<<'HTML'
<div>
    <div class="px-2 bg-red-600">Error</div>
    <em class="ml-1 text-sky-400">
        Git is not installed or not init in this project, please install it to use this package.
    </em>
</div>
HTML);
    }
}
