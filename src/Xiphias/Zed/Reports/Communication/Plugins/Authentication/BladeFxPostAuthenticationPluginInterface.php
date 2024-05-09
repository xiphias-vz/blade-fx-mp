<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Plugins\Authentication;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;

interface BladeFxPostAuthenticationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer
     *
     * @return void
     */
    public function execute(BladeFxAuthenticationResponseTransfer $authenticationResponseTransfer): void;
}
