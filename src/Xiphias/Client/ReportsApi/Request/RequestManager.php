<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request;

use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use Psr\Http\Message\RequestInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;
use Xiphias\Client\ReportsApi\Exception\ReportsRequestException;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface;
use Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface;

class RequestManager implements RequestManagerInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    private const ERROR_INVALID_REQUEST_PARAMETERS = '%s Blade Fx request has invalid data.';

    /**
     * @var string
     */
    protected const LOGGER_TYPE_TRANSFER = 'transfer';

    private RequestBuilderInterface $requestBuilder;

    private RequestFactoryInterface $requestFactory;

    /**
     * @param \Xiphias\Client\ReportsApi\Request\RequestFactoryInterface $requestFactory
     */
    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getAuthenticateUserRequest(
        string $resource,
        BladeFxAuthenticationRequestTransfer $requestTransfer,
    ): RequestInterface {
        $validator = $this->requestFactory->createAuthenticationRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getCategoriesListRequest(
        string $resource,
        BladeFxGetCategoriesListRequestTransfer $requestTransfer,
    ): RequestInterface {
        $validator = $this->requestFactory->createCategoriesListRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getSetFavoriteReportRequest(string $resource, AbstractTransfer|BladeFxSetFavoriteReportRequestTransfer $requestTransfer): RequestInterface
    {
        $validator = $this->requestFactory->createSetFavoriteReportRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportsListRequest(
        string $resource,
        BladeFxGetReportsListRequestTransfer $requestTransfer,
    ): RequestInterface {
        $validator = $this->requestFactory->createReportsListRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportParametersRequest(
        string $resource,
        BladeFxGetReportParameterListRequestTransfer $requestTransfer,
    ): RequestInterface {
        $validator = $this->requestFactory->createReportParameterListRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportByFormatRequest(
        string $resource,
        BladeFxGetReportByFormatRequestTransfer $requestTransfer,
    ): RequestInterface {
        $validator = $this->requestFactory->createReportByFormatRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportParamFormRequest(
        string $resource,
        BladeFxGetReportParamFormRequestTransfer $requestTransfer,
    ): RequestInterface {
        $validator = $this->requestFactory->createReportParamFormRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getReportPreview(
        string $resource,
        BladeFxGetReportPreviewRequestTransfer $requestTransfer,
    ): RequestInterface {
        $validator = $this->requestFactory->createReportPreviewRequestValidator();
        $this->validateRequest($validator, $requestTransfer);

        return $this->requestBuilder->buildRequest($resource, $requestTransfer);
    }

    /**
     * @param \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface $validator
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $request
     *
     * @throws \Xiphias\Client\ReportsApi\Exception\ReportsRequestException
     *
     * @return void
     */
    private function validateRequest(RequestValidatorInterface $validator, AbstractTransfer $request): void
    {
        if (!$validator->isRequestValid($request)) {
            $this->logError($request);

            throw new ReportsRequestException();
        }
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return void
     */
    private function logError(AbstractTransfer $requestTransfer): void
    {
        $this->getLogger()->critical(
            $this->formatErrorMessage(),
            $this->createArrayWithTransferData($requestTransfer),
        );
    }

    /**
     * @return string
     */
    private function formatErrorMessage(): string
    {
        return sprintf(
            self::ERROR_INVALID_REQUEST_PARAMETERS,
            ReportsApiConfig::LOG_MESSAGE_PREFIX,
        );
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array<\Spryker\Shared\Kernel\Transfer\AbstractTransfer>
     */
    private function createArrayWithTransferData(AbstractTransfer $requestTransfer): array
    {
        return [
            static::LOGGER_TYPE_TRANSFER => $requestTransfer,
        ];
    }

    /**
     * @param \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface $requestBuilder
     *
     * @return void
     */
    public function setRequestBuilder(RequestBuilderInterface $requestBuilder): void
    {
        $this->requestBuilder = $requestBuilder;
    }
}
