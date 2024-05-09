<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class SetFavoriteReportRequestValidator extends AbstractRequestValidator
{
    /**
     * @return string
     */
    protected function getRequestTransferClass(): string
    {
        return BladeFxSetFavoriteReportRequestTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return bool
     */
    protected function validateRequest(AbstractTransfer|BladeFxSetFavoriteReportRequestTransfer $requestTransfer): bool
    {
        try {
            /**
             * @var \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransferCasted
             */
            $requestTransferCasted = $requestTransfer;

            $requestTransferCasted
                ->requireToken()
                ->requireRepId()
                ->requireUserId();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
