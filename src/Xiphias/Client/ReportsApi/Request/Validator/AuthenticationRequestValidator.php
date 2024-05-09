<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class AuthenticationRequestValidator extends AbstractRequestValidator
{
    /**
     * @return string
     */
    protected function getRequestTransferClass(): string
    {
        return BladeFxAuthenticationRequestTransfer::class;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return bool
     */
    protected function validateRequest(AbstractTransfer $requestTransfer): bool
    {
        try {
            $requestTransfer
                ->requireUsername()
                ->requirePassword();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
