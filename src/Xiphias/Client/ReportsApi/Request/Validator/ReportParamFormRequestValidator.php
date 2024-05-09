<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportParamFormRequestValidator extends AbstractRequestValidator
{
    /**
     * @return string
     */
    public function getRequestTransferClass(): string
    {
        return BladeFxGetReportParamFormRequestTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return bool
     */
    public function validateRequest(AbstractTransfer $requestTransfer): bool
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $reportParamFormRequestTransfer */
        $reportParamFormRequestTransfer = $requestTransfer;

        try {
            $reportParamFormRequestTransfer
                ->requireReportId()
                ->requireToken()
                ->requireRootUrl();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
