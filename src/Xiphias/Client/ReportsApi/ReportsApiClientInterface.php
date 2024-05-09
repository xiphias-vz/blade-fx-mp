<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi;

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

interface ReportsApiClientInterface
{
    /**
     * Specification:
     * - Used for authenticating users in bfx service
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function sendAuthenticateUserRequest(BladeFxAuthenticationRequestTransfer $requestTransfer): BladeFxAuthenticationResponseTransfer;

    /**
     * Specification:
     * - Used for retrieving category list from bfx service
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function sendGetCategoriesListRequest(BladeFxGetCategoriesListRequestTransfer $requestTransfer): BladeFxCategoriesListResponseTransfer;

    /**
     * Specification:
     * - Used for retrieving report list from bfx service
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function sendGetReportsListRequest(BladeFxGetReportsListRequestTransfer $requestTransfer): BladeFxGetReportsListResponseTransfer;

    /**
     * Specification:
     * - Sets report as favorite
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return void
     */
    public function sendSetFavoriteReportRequest(BladeFxSetFavoriteReportRequestTransfer $requestTransfer): void;

    /**
     * Specification:
     * - gets report based on format
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function sendGetReportByFormatRequest(
        BladeFxGetReportByFormatRequestTransfer $requestTransfer,
    ): BladeFxGetReportByFormatResponseTransfer;

    /**
     * Specification:
     * - Retrieves the iframe url for parameter form
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function sendGetReportParamFormRequest(
        BladeFxGetReportParamFormRequestTransfer $requestTransfer,
    ): BladeFxGetReportParamFormResponseTransfer;

    /**
     * Specification:
     * - gets iframe url for report preview
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function sendGetReportPreviewRequest(
        BladeFxGetReportPreviewRequestTransfer $requestTransfer,
    ): BladeFxGetReportPreviewResponseTransfer;

    /**
     * Specification:
     * - gets list of parameters for report
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer
     */
    public function sendGetReportParameterListRequest(
        BladeFxGetReportParameterListRequestTransfer $requestTransfer,
    ): BladeFxGetReportParameterListResponseTransfer;
}
