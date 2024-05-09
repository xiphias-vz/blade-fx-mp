<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class SetFavoriteReportResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxSetFavoriteReportResponseTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer|BladeFxSetFavoriteReportResponseTransfer $responseTransfer): bool
    {
        try {
            /**
             * @var \Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer $responseTransferCasted
             */
            $responseTransferCasted = $responseTransfer;

            $responseTransferCasted->requireRMessage();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
