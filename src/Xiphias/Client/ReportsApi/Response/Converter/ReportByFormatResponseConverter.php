<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Psr\Http\Message\ResponseInterface;

class ReportByFormatResponseConverter extends AbstractResponseConverter
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    public function decodeFromBase64(ResponseInterface $response): BladeFxApiResponseConversionResultTransfer
    {
        $bodyContent = $response->getBody()->getContents();
        if (!$bodyContent) {
            $this->logError(
                self::ERROR_INVALID_RESPONSE_MISSING_PROPERTY,
                $response,
            );
        }

        $bladeFxApiResponseConversionResultTransfer = $this->createConversionResultTransfer();

        return $this->expandConversionResponseTransfer(
            $bladeFxApiResponseConversionResultTransfer,
            [base64_decode($bodyContent)],
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
        $bladeFxReportPreviewResponseTransfer = new BladeFxGetReportByFormatResponseTransfer();
        $bladeFxReportPreviewResponseTransfer->setReport(
            implode('', $responseData),
        );

        return $apiResponseConversionResultTransfer->setBladeFxGetReportByFormatResponse($bladeFxReportPreviewResponseTransfer);
    }
}
