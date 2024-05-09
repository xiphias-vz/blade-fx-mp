<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportsListRequestValidator extends AbstractRequestValidator
{
    /**
     * @return string
     */
    public function getRequestTransferClass(): string
    {
        return BladeFxGetReportsListRequestTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return bool
     */
    public function validateRequest(AbstractTransfer|BladeFxGetReportsListRequestTransfer $requestTransfer): bool
    {
        try {
            /**
             * @var \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransferCasted
             */
            $requestTransferCasted = $requestTransfer;

            $requestTransferCasted
                ->requireToken()
                ->requireReturnType();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
