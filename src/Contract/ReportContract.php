<?php

namespace Tilson\GitReportPhp\Contract;

use Illuminate\Support\Collection;

interface ReportContract{
    
    /**
     * Generate report from git log     
     * */
    public function generateReport(array $commits);
}