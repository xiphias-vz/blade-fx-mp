<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportsReader;

use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\ReportsReaderRequestTransfer;

interface ReportsReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReportsReaderRequestTransfer $readerRequestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsList(ReportsReaderRequestTransfer $readerRequestTransfer): BladeFxGetReportsListResponseTransfer;

    /**
     * @param int $reportId
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer;
}
