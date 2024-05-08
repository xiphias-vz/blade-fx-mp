<?php

namespace PyzXiphias\Zed\Reports\Business;

use PyzXiphias\Zed\Reports\Business\BladeFx\UserHandler\UserHandler;
use PyzXiphias\Zed\Reports\Business\BladeFx\UserHandler\UserHandlerInterface;
use Xiphias\Zed\Reports\Business\ReportsBusinessFactory as XiphiasReportsBusinessFactory;

/**
 * @method \PyzXiphias\Zed\Reports\Persistence\ReportsRepositoryInterface getRepository()()
 */
class ReportsBusinessFactory extends XiphiasReportsBusinessFactory
{
    public function createUserHandler(): UserHandlerInterface
    {
        return new UserHandler(
            $this->getRepository()
        );
    }
}
