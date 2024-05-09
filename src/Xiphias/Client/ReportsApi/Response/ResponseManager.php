<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Response;

use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer;
use Psr\Http\Message\ResponseInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;
use Symfony\Component\HttpFoundation\Response;
use Xiphias\Client\ReportsApi\Exception\ReportsResponseException;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface;

class ResponseManager implements ResponseManagerInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    private const ERROR_INVALID_RESPONSE_GENERIC = '%s Invalid Response.';

    private ResponseFactoryInterface $responseFactory;

    /**
     * @param \Xiphias\Client\ReportsApi\Response\ResponseFactoryInterface $responseFactory
     */
    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function getAuthenticationUserResponseTransfer(?ResponseInterface $response): BladeFxAuthenticationResponseTransfer
    {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createAuthenticationResponseConverter()->convert($response);
        $validator = $this->responseFactory->createAuthenticationResponseValidator();
        $this->validateResponse($validator, $converterResultTransfer->getBladeFxAuthenticationResponse());

        return $converterResultTransfer->getBladeFxAuthenticationResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function getCategoriesListResponseTransfer(?ResponseInterface $response): BladeFxCategoriesListResponseTransfer
    {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createCategoriesListResponseConverter()->convert($response);
        $validator = $this->responseFactory->createCategoriesListResponseValidator();
        $this->validateResponse($validator, $converterResultTransfer->getBladeFxCategoriesListResponse());

        return $converterResultTransfer->getBladeFxCategoriesListResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsListResponseTransfer(?ResponseInterface $response): BladeFxGetReportsListResponseTransfer
    {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createReportsListResponseConverter()->convert($response);
        $validator = $this->responseFactory->createReportsListResponseValidator();
        $this->validateResponse($validator, $converterResultTransfer->getBladeFxGetReportsListResponse());

        return $converterResultTransfer->getBladeFxGetReportsListResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer
     */
    public function getSetFavoriteReportResponseTransfer(?ResponseInterface $response): BladeFxSetFavoriteReportResponseTransfer
    {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createSetFavoriteReportResponseConverter()->convert($response);
        $validator = $this->responseFactory->createSetFavoriteReportResponseValidator();

        $this->validateResponse($validator, $converterResultTransfer->getBladeFxSetFavoriteReportResponse());

        return $converterResultTransfer->getBladeFxSetFavoriteReportResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer
     */
    public function getReportParameterListResponseTransfer(?ResponseInterface $response): BladeFxGetReportParameterListResponseTransfer
    {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createReportParameterListResponseConverter()->convert($response);
        $validator = $this->responseFactory->createReportParameterListResponseValidator();
        $this->validateResponse($validator, $converterResultTransfer->getBladeFxGetReportParameterListResponse());

        return $converterResultTransfer->getBladeFxGetReportParameterListResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param string $format
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormatResponseTransfer(
        ?ResponseInterface $response,
        string $format,
    ): BladeFxGetReportByFormatResponseTransfer {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createReportByFormatResponseConverter()->decodeFromBase64($response);
        $validator = $this->responseFactory->createReportByFormatResponseValidator();
        $this->validateResponse($validator, $converterResultTransfer->getBladeFxGetReportByFormatResponse());

        return $converterResultTransfer->getBladeFxGetReportByFormatResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportPreviewResponseTransfer(?ResponseInterface $response): BladeFxGetReportPreviewResponseTransfer
    {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createReportPreviewResponseConverter()->convert($response);
        $validator = $this->responseFactory->createResponsePreviewValidator();
        $this->validateResponse($validator, $converterResultTransfer->getBladeFxGetReportPreviewResponse());

        return $converterResultTransfer->getBladeFxGetReportPreviewResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamFormResponseTransfer(?ResponseInterface $response): BladeFxGetReportParamFormResponseTransfer
    {
        $this->validateRawResponse($response);
        $converterResultTransfer = $this->responseFactory->createReportParamFormRequestConverter()->convert($response);
        $validator = $this->responseFactory->createReportParamFormResponseValidator();
        $this->validateResponse($validator, $converterResultTransfer->getBladeFxGetReportParamFormResponse());

        return $converterResultTransfer->getBladeFxGetReportParamFormResponse();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     *
     * @throws \Xiphias\Client\ReportsApi\Exception\ReportsResponseException
     *
     * @return void
     */
    protected function validateRawResponse(?ResponseInterface $response): void
    {
        if ($response === null || $response->getStatusCode() !== Response::HTTP_OK) {
            $this->logRawDataError(
                self::ERROR_INVALID_RESPONSE_GENERIC,
                $response,
            );

            throw new ReportsResponseException();
        }
    }

    /**
     * @param \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface $validator
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $response
     *
     * @throws \Xiphias\Client\ReportsApi\Exception\ReportsResponseException
     *
     * @return void
     */
    private function validateResponse(ResponseValidatorInterface $validator, AbstractTransfer $response): void
    {
        if (!$validator->isResponseValid($response)) {
            $this->logError('', $response);

            throw new ReportsResponseException();
        }
    }

    /**
     * @param string $errorMessage
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $response
     *
     * @return void
     */
    protected function logError(string $errorMessage, AbstractTransfer $response): void
    {
        $this->getLogger()->critical(
            $this->formatMessage($errorMessage),
            $this->createArrayWithResponseData($response),
        );
    }

    /**
     * @param string $errorMessage
     * @param \Psr\Http\Message\ResponseInterface $rawResponse
     *
     * @return void
     */
    protected function logRawDataError(string $errorMessage, ResponseInterface $rawResponse): void
    {
        $this->getLogger()->critical(
            $this->formatMessage($errorMessage),
            $this->createArrayWithRawResponseData($rawResponse),
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
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $response
     *
     * @return array<\Spryker\Shared\Kernel\Transfer\AbstractTransfer>
     */
    private function createArrayWithResponseData(AbstractTransfer $response): array
    {
        return [
            'response' => $response,
        ];
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $rawResponse
     *
     * @return array<\Psr\Http\Message\ResponseInterface>
     */
    private function createArrayWithRawResponseData(ResponseInterface $rawResponse): array
    {
        return [
            'rawResponse' => $rawResponse,
        ];
    }
}
