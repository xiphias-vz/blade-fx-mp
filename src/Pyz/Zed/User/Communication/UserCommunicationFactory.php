<?php

namespace Pyz\Zed\User\Communication;

use Pyz\Zed\User\UserDependencyProvider;
use Spryker\Zed\User\Communication\UserCommunicationFactory as SprykerUserCommunicationFactory;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;

class UserCommunicationFactory extends SprykerUserCommunicationFactory
{
    public function getBladeFxFacade(): ReportsFacadeInterface
    {
        return $this->getProvidedDependency(UserDependencyProvider::BLADE_FX_FACADE);
    }
}
