<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi;

use Spryker\Client\Kernel\AbstractBundleConfig;
use Xiphias\Shared\Reports\ReportsConstants;

class ReportsApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const LOG_MESSAGE_PREFIX = 'BladeFxAPIClient: ';

    /**
     * Specification:
     * - Timeout in seconds for every BladeFx API request.
     *
     * @var int
     */
    public const API_REQUEST_TIMEOUT = 5;

    /**
     * Specification:
     * - List of headers used in all BladeFx requests.
     *
     * @var array
     */
    private const COMMON_API_REQUEST_HEADERS = [
        'Content-Type' => 'application/json',
    ];

    /**
     * @var string
     */
    public const AUTHENTICATE_USER_API_RESOURCE = '/api/Users/authenticate';

    /**
     * @var string
     */
    public const GET_CATEGORIES_LIST_API_RESOURCE = '/api/ReportData/GetCategoryList';

    /**
     * @var string
     */
    public const GET_REPORTS_LIST_API_RESOURCE = '/api/ReportData/GetReportList';

    /**
     * @var string
     */
    public const GET_REPORT_PARAMETER_LIST_API_RESOURCE = '/api/ReportData/GetReportParams';

    /**
     * @var string
     */
    public const GET_REPORT_PREVIEW_API_RESOURCE = '/api/ReportData/GetReportPreviewURL';

    /**
     * @var string
     */
    public const GET_REPORT_HTML_API_RESOURCE = '/api/ReportData/GetReportHTML';

    /**
     * @var string
     */
    public const GET_REPORT_PDF_API_RESOURCE = '/api/ReportData/GetReportPDF';

    /**
     * @var string
     */
    public const GET_REPORT_CSV_API_RESOURCE = '/api/ReportData/GetReportCSV';

    /**
     * @var string
     */
    public const GET_REPORT_PPTX_API_RESOURCE = '/api/ReportData/GetReportPPTX';

    /**
     * @var string
     */
    public const GET_REPORT_DOCX_API_RESOURCE = '/api/ReportData/GetReportDOCX';

    /**
     * @var string
     */
    public const GET_REPORT_XLSX_API_RESOURCE = '/api/ReportData/GetReportXLSX';

    /**
     * @var string
     */
    public const GET_REPORT_MHT_API_RESOURCE = '/api/ReportData/GetReportMHT';

    /**
     * @var string
     */
    public const GET_REPORT_RTF_API_RESOURCE = '/api/ReportData/GetReportRTF';

    /**
     * @var string
     */
    public const GET_REPORT_IMG_API_RESOURCE = '/api/ReportData/GetReportIMG';

    /**
     * @var string
     */
    public const SET_FAVORITE_REPORT_API_RESOURCE = '/api/ReportData/SetFavoriteReport';

    /**
     * @var string
     */
    public const GER_REPORT_PARAMETER_FORM_API_RESOURCE = '/api/ReportData/GetReportURL';

    /**
     * @return float|int
     */
    public function getTimeout(): int|float
    {
        return static::API_REQUEST_TIMEOUT;
    }

    /**
     * @return array
     */
    public function getCommonHttpClientConfig(): array
    {
        return $this->get(ReportsConstants::EXTERNAL_API_HTTP_CLIENT_PARAMS);
    }

    /**
     * @return string
     */
    public function getApiBaseUri(): string
    {
        return $this->get(ReportsConstants::BLADE_FX_REPORTS_HOST);
    }

    /**
     * @return array<string>
     */
    public function getCommonApiRequestHeaders(): array
    {
        return self::COMMON_API_REQUEST_HEADERS;
    }

    /**
     * @return string
     */
    public function getAuthenticationUserResourceParameter(): string
    {
        return static::AUTHENTICATE_USER_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getCategoriesListResourceParameter(): string
    {
        return static::GET_CATEGORIES_LIST_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportsListResourceParameter(): string
    {
        return static::GET_REPORTS_LIST_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getSetFavoriteReportResourceParameter(): string
    {
        return static::SET_FAVORITE_REPORT_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportParameterListResourceParameter(): string
    {
        return static::GET_REPORT_PARAMETER_LIST_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportPreviewResourceParameter(): string
    {
        return static::GET_REPORT_PREVIEW_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportHTMLResourceParameter(): string
    {
        return static::GET_REPORT_HTML_API_RESOURCE;
    }

    /**
     * @return String
     */
    public function getReportPDFResourceParameter(): string
    {
        return static::GET_REPORT_PDF_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportCSVResourceParameter(): string
    {
        return static::GET_REPORT_CSV_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportPPTXResourceParameter(): string
    {
        return static::GET_REPORT_PPTX_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportDOCXResourceParameter(): string
    {
        return static::GET_REPORT_DOCX_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportXLSXResourceParameter(): string
    {
        return static::GET_REPORT_XLSX_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportMHTResourceParameter(): string
    {
        return static::GET_REPORT_MHT_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportRTFResourceParameter(): string
    {
        return static::GET_REPORT_RTF_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportIMGResourceParameter(): string
    {
        return static::GET_REPORT_IMG_API_RESOURCE;
    }

    /**
     * @return string
     */
    public function getReportParamFormResourceParameter(): string
    {
        return static::GER_REPORT_PARAMETER_FORM_API_RESOURCE;
    }
}
