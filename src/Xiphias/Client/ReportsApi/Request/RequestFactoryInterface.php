<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request;

use Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface;

interface RequestFactoryInterface
{
    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createAuthenticationRequestValidator(): RequestValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createCategoriesListRequestValidator(): RequestValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createSetFavoriteReportRequestValidator(): RequestValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportsListRequestValidator(): RequestValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createAuthenticationRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createCategoriesListRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportsListRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createSetFavoriteReportRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportParameterListRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportParameterListRequestValidator(): RequestValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportByFormatRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportPreviewRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportByFormatRequestValidator(): RequestValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface
     */
    public function createRequestBodyFormatter(): RequestBodyFormatterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Builder\RequestBuilderInterface
     */
    public function createReportParamFormRequestBuilder(): RequestBuilderInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportParamFormRequestValidator(): RequestValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Request\Validator\RequestValidatorInterface
     */
    public function createReportPreviewRequestValidator(): RequestValidatorInterface;
}
