<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Psr\Http\Message\ResponseInterface;

class ReportParamFormResponseConverter extends AbstractResponseConverter
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    protected function expandConversionResponseTransfer(
        BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer,
        array $responseData,
    ): BladeFxApiResponseConversionResultTransfer {
        return $apiResponseConversionResultTransfer;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    public function convert(ResponseInterface $response): BladeFxApiResponseConversionResultTransfer
    {
        $paramFormIframeUrl = $response->getBody()->getContents();

        if (!$paramFormIframeUrl) {
            $this->logError(
                self::ERROR_INVALID_RESPONSE_MISSING_PROPERTY,
                $response,
            );
        }

        $bladeFxApiResponseConversionResultTransfer = $this->createConversionResultTransfer();

        return $bladeFxApiResponseConversionResultTransfer
            ->setBladeFxGetReportParamFormResponse(
                (new BladeFxGetReportParamFormResponseTransfer())
                    ->setIframeUrl($paramFormIframeUrl),
            );
    }
}
