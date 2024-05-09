<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Handler;

use Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer;
use Xiphias\Client\ReportsApi\Http\Client\HttpApiClientInterface;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\RequestFactoryInterface;
use Xiphias\Client\ReportsApi\Request\RequestManagerInterface;
use Xiphias\Client\ReportsApi\Response\ResponseManagerInterface;

class ApiHandler implements ApiHandlerInterface
{
    private RequestManagerInterface $requestManager;

    private ResponseManagerInterface $responseManager;

    private HttpApiClientInterface $httpClient;

    private ReportsApiConfig $apiClientConfig;

    private RequestFactoryInterface $requestFactory;

    /**
     * @param \Xiphias\Client\ReportsApi\Request\RequestManagerInterface $requestManager
     * @param \Xiphias\Client\ReportsApi\Response\ResponseManagerInterface $responseManager
     * @param \Xiphias\Client\ReportsApi\Http\Client\HttpApiClientInterface $httpClient
     * @param \Xiphias\Client\ReportsApi\ReportsApiConfig $apiClientConfig
     * @param \Xiphias\Client\ReportsApi\Request\RequestFactoryInterface $requestFactory
     */
    public function __construct(
        RequestManagerInterface $requestManager,
        ResponseManagerInterface $responseManager,
        HttpApiClientInterface $httpClient,
        ReportsApiConfig $apiClientConfig,
        RequestFactoryInterface $requestFactory,
    ) {
        $this->requestManager = $requestManager;
        $this->responseManager = $responseManager;
        $this->httpClient = $httpClient;
        $this->apiClientConfig = $apiClientConfig;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function authenticateUser(BladeFxAuthenticationRequestTransfer $requestTransfer): BladeFxAuthenticationResponseTransfer
    {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createAuthenticationRequestBuilder(),
        );

        $request = $this->requestManager->getAuthenticateUserRequest(
            $this->apiClientConfig->getAuthenticationUserResourceParameter(),
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getAuthenticationUserResponseTransfer($response);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function getCategoriesList(BladeFxGetCategoriesListRequestTransfer $requestTransfer): BladeFxCategoriesListResponseTransfer
    {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createCategoriesListRequestBuilder(),
        );

        $request = $this->requestManager->getCategoriesListRequest(
            $this->apiClientConfig->getCategoriesListResourceParameter(),
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getCategoriesListResponseTransfer($response);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsList(
        BladeFxGetReportsListRequestTransfer $requestTransfer,
    ): BladeFxGetReportsListResponseTransfer {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createReportsListRequestBuilder(),
        );

        $request = $this->requestManager->getReportsListRequest(
            $this->apiClientConfig->getReportsListResourceParameter(),
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getReportsListResponseTransfer($response);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer
     */
    public function setFavoriteReport(BladeFxSetFavoriteReportRequestTransfer $requestTransfer): BladeFxSetFavoriteReportResponseTransfer
    {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createSetFavoriteReportRequestBuilder(),
        );

        $request = $this->requestManager->getSetFavoriteReportRequest(
            $this->apiClientConfig->getSetFavoriteReportResourceParameter(),
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getSetFavoriteReportResponseTransfer($response);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer
     */
    public function getParameterList(
        BladeFxGetReportParameterListRequestTransfer $requestTransfer,
    ): BladeFxGetReportParameterListResponseTransfer {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createReportParameterListRequestBuilder(),
        );

        $request = $this->requestManager->getReportParametersRequest(
            $this->apiClientConfig->getReportParameterListResourceParameter(),
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getReportParameterListResponseTransfer($response);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormat(
        BladeFxGetReportByFormatRequestTransfer $requestTransfer,
    ): BladeFxGetReportByFormatResponseTransfer {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createReportByFormatRequestBuilder(),
        );

        $fileFormat = $requestTransfer->getFileFormat();
        $resource = $this->getResourceParameterByFileFormat($fileFormat);

        $request = $this->requestManager->getReportByFormatRequest(
            $resource,
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getReportByFormatResponseTransfer($response, $fileFormat);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(
        BladeFxGetReportParamFormRequestTransfer $requestTransfer,
    ): BladeFxGetReportParamFormResponseTransfer {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createReportParamFormRequestBuilder(),
        );

        $request = $this->requestManager->getReportParamFormRequest(
            $this->apiClientConfig->getReportParamFormResourceParameter(),
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getReportParamFormResponseTransfer($response);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportPreview(
        BladeFxGetReportPreviewRequestTransfer $requestTransfer,
    ): BladeFxGetReportPreviewResponseTransfer {
        $this->requestManager->setRequestBuilder(
            $this->requestFactory->createReportPreviewRequestBuilder(),
        );

        $request = $this->requestManager->getReportPreview(
            $this->apiClientConfig->getReportPreviewResourceParameter(),
            $requestTransfer,
        );

        $response = $this->httpClient->sendRequest($request);

        return $this->responseManager->getReportPreviewResponseTransfer($response);
    }

    /**
     * @param string $format
     *
     * @return string
     */
    protected function getResourceParameterByFileFormat(string $format): string
    {
        return match ($format) {
            'html' => $this->apiClientConfig->getReportHTMLResourceParameter(),
            'pdf' => $this->apiClientConfig->getReportPDFResourceParameter(),
            'csv' => $this->apiClientConfig->getReportCSVResourceParameter(),
            'pptx' => $this->apiClientConfig->getReportPPTXResourceParameter(),
            'docx' => $this->apiClientConfig->getReportDOCXResourceParameter(),
            'xlsx' => $this->apiClientConfig->getReportXLSXResourceParameter(),
            'mht' => $this->apiClientConfig->getReportMHTResourceParameter(),
            'rtf' => $this->apiClientConfig->getReportRTFResourceParameter(),
            'jpg' => $this->apiClientConfig->getReportIMGResourceParameter(),
            default => 'error',
        };
    }
}
