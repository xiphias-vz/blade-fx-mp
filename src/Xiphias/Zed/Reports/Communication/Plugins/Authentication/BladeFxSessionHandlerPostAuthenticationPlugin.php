<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Plugins\Authentication;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class BladeFxSessionHandlerPostAuthenticationPlugin extends AbstractPlugin implements BladeFxPostAuthenticationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer
     *
     * @return void
     */
    public function execute(BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer): void
    {
        $sessionClient = $this->getFactory()->getSessionClient();

        $sessionClient->set(
            $this->getFactory()->getConfig()->getBfxTokenSessionKey(),
            $authenticationResponseTransfer->getToken(),
        );

        $sessionClient->set(
            $this->getFactory()->getConfig()->getBfxUserIdSessionKey(),
            $authenticationResponseTransfer->getIdUser(),
        );
    }
}
