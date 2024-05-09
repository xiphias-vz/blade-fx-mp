<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Converter;

use Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer;
use Psr\Http\Message\ResponseInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Log\LoggerTrait;
use Xiphias\Client\ReportsApi\ReportsApiConfig;

abstract class AbstractResponseConverter implements ResponseConverterInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    protected const ERROR_INVALID_RESPONSE_MISSING_PROPERTY = '%s Invalid Response: Missing response property values.';

    private UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    public function convert(ResponseInterface $response): BladeFxApiResponseConversionResultTransfer
    {
        $responseData = $this->decodeResponse($response);
        $bladeFxApiResponseConversionResultTransfer = $this->createConversionResultTransfer();

        return $this->expandConversionResponseTransfer(
            $bladeFxApiResponseConversionResultTransfer,
            $responseData,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    abstract protected function expandConversionResponseTransfer(
        BladeFxApiResponseConversionResultTransfer $apiResponseConversionResultTransfer,
        array $responseData,
    ): BladeFxApiResponseConversionResultTransfer;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array
     */
    private function decodeResponse(ResponseInterface $response): array
    {
        $bodyContent = $response->getBody()->getContents();
        if (!$bodyContent) {
            $this->logError(
                self::ERROR_INVALID_RESPONSE_MISSING_PROPERTY,
                $response,
            );

            return [];
        }

        return $this->utilEncodingService->decodeJson($bodyContent, true);
    }

    /**
     * @param string $errorMessage
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return void
     */
    protected function logError(string $errorMessage, ResponseInterface $response): void
    {
        $this->getLogger()->critical(
            $this->formatMessage($errorMessage),
            $this->createArrayWithResponseData($response),
        );
    }

    /**
     * @param string $message
     *
     * @return string
     */
    private function formatMessage(string $message): string
    {
        return sprintf(
            $message,
            ReportsApiConfig::LOG_MESSAGE_PREFIX,
        );
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return array<\Psr\Http\Message\ResponseInterface>
     */
    private function createArrayWithResponseData(ResponseInterface $response): array
    {
        return [
            'response' => $response,
        ];
    }

    /**
     * @return \Generated\Shared\Transfer\BladeFxApiResponseConversionResultTransfer
     */
    protected function createConversionResultTransfer(): BladeFxApiResponseConversionResultTransfer
    {
        return new BladeFxApiResponseConversionResultTransfer();
    }
}
