<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Converter;

use ArrayObject;
use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;

class ReportParameterListResponseConverter extends AbstractResponseConverter
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
        $bladeFxReportParameterListResponseTransfer = new BladeFxGetReportParameterListResponseTransfer();
        $bladeFxReportParameterList = [];
        foreach ($responseData as $parameter) {
            $bladeFxParameter = new BladeFxParameterTransfer();
            $bladeFxParameter->fromArray($parameter);
            $bladeFxReportParameterList[] = $bladeFxParameter;
        }

        $bladeFxReportParameterListResponseTransfer->setParameterList(new ArrayObject($bladeFxReportParameterList));

        return $apiResponseConversionResultTransfer->setBladeFxGetReportParameterListResponse($bladeFxReportParameterListResponseTransfer);
    }
}
