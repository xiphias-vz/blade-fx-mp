<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response;

use Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface;
use Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface;

interface ResponseFactoryInterface
{
    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createAuthenticationResponseConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createAuthenticationResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createCategoriesListResponseConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createCategoriesListResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportsListResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportsListResponseConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createSetFavoriteReportResponseConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createSetFavoriteReportResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportParameterListResponseConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ReportByFormatResponseConverter
     */
    public function createReportByFormatResponseConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ResponseConverterInterface
     */
    public function createReportPreviewResponseConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportByFormatResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Converter\ReportParamFormResponseConverter
     */
    public function createReportParamFormRequestConverter(): ResponseConverterInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createReportParamFormResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ReportParameterListResponseValidator
     */
    public function createReportParameterListResponseValidator(): ResponseValidatorInterface;

    /**
     * @return \Xiphias\Client\ReportsApi\Response\Validator\ResponseValidatorInterface
     */
    public function createResponsePreviewValidator(): ResponseValidatorInterface;
}
