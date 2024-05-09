<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Converter;

use ArrayObject;
use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxReportTransfer;

class ReportsListResponseConverter extends AbstractResponseConverter
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    public function expandConversionResponseTransfer(
        BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer,
        array $responseData,
    ): BladeFxApiResponseConversionResultTransfer {
        $bladeFxReportsListResponseTransfer = new BladeFxGetReportsListResponseTransfer();
        $bladeFxReportsList = [];
        foreach ($responseData as $report) {
            $bladeFxReport = new BladeFxReportTransfer();
            $bladeFxReport->fromArray($report, true);
            $bladeFxReportsList[] = $bladeFxReport;
        }

        $bladeFxReportsListResponseTransfer->setReportsList(new ArrayObject($bladeFxReportsList));

        return $apiResponseConversionResultTransfer->setBladeFxGetReportsListResponse($bladeFxReportsListResponseTransfer);
    }
}
