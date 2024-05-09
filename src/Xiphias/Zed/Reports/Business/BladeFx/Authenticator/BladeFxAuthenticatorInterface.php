<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\Authenticator;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;

interface BladeFxAuthenticatorInterface
{
    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function authenticate(): BladeFxAuthenticationResponseTransfer;
}
