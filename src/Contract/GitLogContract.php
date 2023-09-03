<?php

namespace Tilson\GitReportPhp\Contract;

use Illuminate\Support\Collection;

interface GitLogContract
{
    public function exec(): Collection;
}
