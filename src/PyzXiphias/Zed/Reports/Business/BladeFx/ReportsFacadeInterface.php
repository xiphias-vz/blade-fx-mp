<?php

namespace PyzXiphias\Zed\Reports\Business\BladeFx;

use Xiphias\Zed\Reports\Business\ReportsFacadeInterface as XiphiasReportsFacadeInterface;

interface ReportsFacadeInterface extends XiphiasReportsFacadeInterface
{
    public function createUserOnBladeFx(array $groupRoles);
}
