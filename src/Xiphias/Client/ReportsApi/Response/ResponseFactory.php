<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response;

use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Xiphias\Client\ReportsApi\Response\Converter\AuthenticationResponseConverter;
use Xiphias\Client\ReportsApi\Response\Converter\CategoriesListResponseConverter;
use Xiphias\Client\ReportsApi\Response\Converter\ReportByFormatResponseConverter;
use Xiphias\Client\ReportsApi\Response\Converter\ReportParameterListResponseConverter;
use Xiphias\Client\ReportsApi\Response\Converter\ReportParamFormResponseConverter;
use Xiphias\Client\ReportsApi\Response\Converter\ReportPreviewResponseConverter;
use Xiphias\Client\ReportsApi\Response\Converter\ReportsListResponseConverter;
use Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface;
use Xiphias\Client\ReportsApi\Response\Converter\SetFavoriteReportResponseConverter;
use Xiphias\Client\ReportsApi\Response\Validator\AuthenticationResponseValidator;
use Xiphias\Client\ReportsApi\Response\Validator\CategoriesListResponseValidator;
use Xiphias\Client\ReportsApi\Response\Validator\ReportByFormatResponseValidator;
use Xiphias\Client\ReportsApi\Response\Validator\ReportParameterListResponseValidator;
use Xiphias\Client\ReportsApi\Response\Validator\ReportParamFormResponseValidator;
use Xiphias\Client\ReportsApi\Response\Validator\ReportPreviewResponseValidator;
use Xiphias\Client\ReportsApi\Response\Validator\ReportsListResponseValidator;
use Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface;
use Xiphias\Client\ReportsApi\Response\Validator\SetFavoriteReportResponseValidator;

class ResponseFactory implements ResponseFactoryInterface
{
    private UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(UtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createAuthenticationResponseConverter(): ResponseConverterInterface
    {
        return new AuthenticationResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createCategoriesListResponseConverter(): ResponseConverterInterface
    {
        return new CategoriesListResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportsListResponseConverter(): ResponseConverterInterface
    {
        return new ReportsListResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createSetFavoriteReportResponseConverter(): ResponseConverterInterface
    {
        return new SetFavoriteReportResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportParameterListResponseConverter(): ResponseConverterInterface
    {
        return new ReportParameterListResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ReportByFormatResponseConverter
     */
    public function createReportByFormatResponseConverter(): ResponseConverterInterface
    {
        return new ReportByFormatResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportPreviewResponseConverter(): ResponseConverterInterface
    {
        return new ReportPreviewResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createAuthenticationResponseValidator(): ResponseValidatorInterface
    {
        return new AuthenticationResponseValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createCategoriesListResponseValidator(): ResponseValidatorInterface
    {
        return new CategoriesListResponseValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportsListResponseValidator(): ResponseValidatorInterface
    {
        return new ReportsListResponseValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createSetFavoriteReportResponseValidator(): ResponseValidatorInterface
    {
        return new SetFavoriteReportResponseValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportParameterListResponseValidator(): ResponseValidatorInterface
    {
        return new ReportParameterListResponseValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportByFormatResponseValidator(): ResponseValidatorInterface
    {
        return new ReportByFormatResponseValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ReportParamFormResponseConverter
     */
    public function createReportParamFormRequestConverter(): ResponseConverterInterface
    {
        return new ReportParamFormResponseConverter($this->utilEncodingService);
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportParamFormResponseValidator(): ResponseValidatorInterface
    {
        return new ReportParamFormResponseValidator();
    }

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createResponsePreviewValidator(): ResponseValidatorInterface
    {
        return new ReportPreviewResponseValidator();
    }
}
