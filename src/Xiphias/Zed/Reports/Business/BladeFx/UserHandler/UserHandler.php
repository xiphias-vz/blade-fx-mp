<?php

namespace Xiphias\Zed\Reports\Business\BladeFx\UserHandler;

use Xiphias\Zed\Reports\Persistence\ReportsRepositoryInterface;

class UserHandler implements UserHandlerInterface
{
    public function __construct(
        protected ReportsRepositoryInterface $reportsRepository
    )
    {
    }

    public function createUserOnBladeFx(array $groupRoles)
    {
        // TODO: Implement createUserOnBladeFx() method.
        if($this->reportsRepository->findBladeFxGroupById($groupRoles)) {
            return true;
        }

        return '';
    }
}
