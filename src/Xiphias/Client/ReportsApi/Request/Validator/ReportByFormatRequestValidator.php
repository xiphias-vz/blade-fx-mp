<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class ReportByFormatRequestValidator extends AbstractRequestValidator
{
    /**
     * @return string
     */
    public function getRequestTransferClass(): string
    {
        return BladeFxGetReportByFormatRequestTransfer::class;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return bool
     */
    public function validateRequest(AbstractTransfer $requestTransfer): bool
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransferCasted */
        $requestTransferCasted = $requestTransfer;

        try {
            $requestTransferCasted
                ->requireToken()
                ->requireRepId()
                ->requireReturnType();
        } catch (RequiredTransferPropertyException) {
            return false;
        }

        return true;
    }
}
