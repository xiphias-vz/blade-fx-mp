<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Psr\Http\Message\ResponseInterface;

class ReportPreviewResponseConverter extends AbstractResponseConverter implements ResponseConverterInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    public function convert(ResponseInterface $response): BladeFxApiResponseConversionResultTransfer
    {
        $bodyContent = $response->getBody()->getContents();
        if (!$bodyContent) {
            $this->logError(
                self::ERROR_INVALID_RESPONSE_MISSING_PROPERTY,
                $response,
            );
        }

        return $this->expandConversionResponseTransfer(
            new BladeFxApiResponseConversionResultTransfer(),
            [$bodyContent],
        );
    }

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
        $bladeFxReportPreviewResponseTransfer = new BladeFxGetReportPreviewResponseTransfer();
        $bladeFxReportPreviewResponseTransfer->setUrl(
            implode('', $responseData),
        );

        return $apiResponseConversionResultTransfer->SetBladeFxGetReportPreviewResponse($bladeFxReportPreviewResponseTransfer);
    }
}
