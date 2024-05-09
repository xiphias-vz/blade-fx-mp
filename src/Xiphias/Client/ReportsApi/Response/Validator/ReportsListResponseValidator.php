<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportsListResponseValidator extends AbstractResponseValidator
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxGetReportsListResponseTransfer::class;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer $responseTransfer): bool
    {
        try {
            foreach ($responseTransfer->getReportsList() as $report) {
                $report
                    ->requireRepId()
                    ->requireRepName()
                    ->requireRepDesc()
                    ->requireRepHashCode();
            }
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
