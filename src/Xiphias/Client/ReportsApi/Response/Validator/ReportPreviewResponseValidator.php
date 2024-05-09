<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Validator;

use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportPreviewResponseValidator extends AbstractResponseValidator implements ResponseValidatorInterface
{
    /**
     * @return string
     */
    protected function getResponseTransferClass(): string
    {
        return BladeFxGetReportPreviewResponseTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return bool
     */
    protected function validateResponse(AbstractTransfer $responseTransfer): bool
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer $responseTransferCasted */
        $responseTransferCasted = $responseTransfer;

        try {
            $responseTransferCasted->requireUrl();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
