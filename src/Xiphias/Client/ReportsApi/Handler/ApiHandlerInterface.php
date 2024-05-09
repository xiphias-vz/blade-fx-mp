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

interface ApiHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxAuthenticationRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    public function authenticateUser(BladeFxAuthenticationRequestTransfer $requestTransfer): BladeFxAuthenticationResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetCategoriesListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxCategoriesListResponseTransfer
     */
    public function getCategoriesList(BladeFxGetCategoriesListRequestTransfer $requestTransfer): BladeFxCategoriesListResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsList(BladeFxGetReportsListRequestTransfer $requestTransfer): BladeFxGetReportsListResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxSetFavoriteReportResponseTransfer
     */
    public function setFavoriteReport(BladeFxSetFavoriteReportRequestTransfer $requestTransfer): BladeFxSetFavoriteReportResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportParameterListRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParameterListResponseTransfer
     */
    public function getParameterList(
        BladeFxGetReportParameterListRequestTransfer $requestTransfer,
    ): BladeFxGetReportParameterListResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormat(
        BladeFxGetReportByFormatRequestTransfer $requestTransfer,
    ): BladeFxGetReportByFormatResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportPreview(
        BladeFxGetReportPreviewRequestTransfer $requestTransfer,
    ): BladeFxGetReportPreviewResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(
        BladeFxGetReportParamFormRequestTransfer $requestTransfer,
    ): BladeFxGetReportParamFormResponseTransfer;
}
