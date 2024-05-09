<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Request;

use Xiphias\Client\ReportsApi\ReportsApiDependencyProvider;
use Xiphias\Client\ReportsApi\ReportsApiFactory;
use Xiphias\Client\ReportsApi\Request\Builder\AuthenticationRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Builder\CategoriesListRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Builder\ReportByFormatRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Builder\ReportParameterListRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Builder\ReportParamFormRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Builder\ReportPreviewRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Builder\ReportsListRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface;
use Xiphias\Client\ReportsApi\Request\Builder\SetFavoriteReportRequestBuilder;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatter;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use Xiphias\Client\ReportsApi\Request\Validator\AuthenticationRequestValidator;
use Xiphias\Client\ReportsApi\Request\Validator\CategoriesListRequestValidator;
use Xiphias\Client\ReportsApi\Request\Validator\ReportByFormatRequestValidator;
use Xiphias\Client\ReportsApi\Request\Validator\ReportParameterListRequestValidator;
use Xiphias\Client\ReportsApi\Request\Validator\ReportParamFormRequestValidator;
use Xiphias\Client\ReportsApi\Request\Validator\ReportPreviewRequestValidator;
use Xiphias\Client\ReportsApi\Request\Validator\ReportsListRequestValidator;
use Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface;
use Xiphias\Client\ReportsApi\Request\Validator\SetFavoriteReportRequestValidator;

class RequestFactory extends ReportsApiFactory implements RequestFactoryInterface
{
    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createAuthenticationRequestValidator(): RequestValidatorInterface
    {
        return new AuthenticationRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createCategoriesListRequestValidator(): RequestValidatorInterface
    {
        return new CategoriesListRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createSetFavoriteReportRequestValidator(): RequestValidatorInterface
    {
        return new SetFavoriteReportRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportsListRequestValidator(): RequestValidatorInterface
    {
        return new ReportsListRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportParameterListRequestValidator(): RequestValidatorInterface
    {
        return new ReportParameterListRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportByFormatRequestValidator(): RequestValidatorInterface
    {
        return new ReportByFormatRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportPreviewRequestValidator(): RequestValidatorInterface
    {
        return new ReportPreviewRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createAuthenticationRequestBuilder(): RequestBuilderInterface
    {
        return new AuthenticationRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
            $this->getAuthenticationRequestFormatterPlugins(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createCategoriesListRequestBuilder(): RequestBuilderInterface
    {
        return new CategoriesListRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportsListRequestBuilder(): RequestBuilderInterface
    {
        return new ReportsListRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportParameterListRequestBuilder(): RequestBuilderInterface
    {
        return new ReportParameterListRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportByFormatRequestBuilder(): RequestBuilderInterface
    {
        return new ReportByFormatRequestBuilder(
            $this->createRequestBodyFormatter(),
            $this->getUtilEncodingService(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createSetFavoriteReportRequestBuilder(): RequestBuilderInterface
    {
        return new SetFavoriteReportRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportParamFormRequestValidator(): RequestValidatorInterface
    {
        return new ReportParamFormRequestValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportParamFormRequestBuilder(): RequestBuilderInterface
    {
        return new ReportParamFormRequestBuilder(
            $this->getConfig(),
            $this->getUtilEncodingService(),
            $this->createRequestBodyFormatter(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportPreviewRequestBuilder(): RequestBuilderInterface
    {
        return new ReportPreviewRequestBuilder(
            $this->createRequestBodyFormatter(),
            $this->getUtilEncodingService(),
            $this->getConfig(),
        );
    }

    /**
     * @return array<\Xiphias\Client\ReportsApi\Plugins\Formatter\AuthenticationRequestFormatterPluginInterface>
     */
    protected function getAuthenticationRequestFormatterPlugins(): array
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::AUTHENTICATION_REQUEST_FORMATTER_PLUGINS);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface
     */
    public function createRequestBodyFormatter(): RequestBodyFormatterInterface
    {
        return new RequestBodyFormatter();
    }
}
