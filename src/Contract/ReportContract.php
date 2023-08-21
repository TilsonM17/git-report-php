<?php

namespace Tilson\GitReportPhp\Contract;

interface ReportContract{
    
    /**
     * Generate report from git log     
     * */
    public function generateReport(array $commits);
}