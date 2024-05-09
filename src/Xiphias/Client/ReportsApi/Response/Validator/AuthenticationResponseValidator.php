<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class AuthenticationResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxAuthenticationResponseTransfer::class;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer $responseTransfer): bool
    {
        try {
            $responseTransfer
                ->requireToken()
                ->requireUsername()
                ->requireEmail()
                ->requireFullname()
                ->requireIdCompany()
                ->requireIdLanguage();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
