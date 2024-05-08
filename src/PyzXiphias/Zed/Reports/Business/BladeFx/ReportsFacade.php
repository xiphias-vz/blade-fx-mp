<?php

namespace PyzXiphias\Zed\Reports\Business\BladeFx;

use PyzXiphias\Zed\Reports\Business\BladeFx\UserHandler\UserHandlerInterface;
use Xiphias\Zed\Reports\Business\ReportsFacade as XiphiasReportsFacade;

/**
 * @method \PyzXiphias\Zed\Reports\Business\ReportsBusinessFactory getFactory()
 */
class ReportsFacade extends XiphiasReportsFacade implements ReportsFacadeInterface
{
    public function createUserOnBladeFx(array $groupRoles): UserHandlerInterface
    {
        // TODO: Implement createUserOnBladeFx() method.
        return $this->getFactory()->createUserHandler()->createUserOnBladeFx($groupRoles);
    }
}
