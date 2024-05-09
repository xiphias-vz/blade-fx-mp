<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader;

use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;

interface BladeFxReportByFormatReaderInterface
{
    /**
     * @param int $reportId
     * @param string $format
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterTransfer $parameterTransfer,
    ): BladeFxGetReportByFormatResponseTransfer;
}
