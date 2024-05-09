<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Controller;

use Generated\Shared\Transfer\BladeFxParameterTransfer;
use league\ReportsConstants;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    /**
     * @var string
     */
    protected const ROOT_MODULE_URL = '/reports';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $categoryTree = $this
            ->getFacade()
            ->processCategoryTreeListRequest($request);

        $reportsTable = $this->getFactory()
            ->createReportsTable();

        $config = $this->getFactory()->getConfig();

        $categoryQueryKey = $config->getCategoryQueryKey();
        $defaultCategoryIndex = $config->getDefaultCategoryIndex();

        return $this->viewResponse([
            'categoryTree' => $categoryTree,
            'reportsTable' => $reportsTable->render(),
            'currentCategoryId' => $request->query->getInt($categoryQueryKey, $defaultCategoryIndex),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function reportsTableAction(): JsonResponse
    {
        $reportsTable = $this->getFactory()->createReportsTable();

        return $this->jsonResponse(
            $reportsTable->fetchData(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function salesReportsTableAction(Request $request): JsonResponse
    {
        $reportTable = $this
            ->getFactory()
            ->createSalesReportsTable($this->formatRequestParameters($request));

        return new JsonResponse(
            $reportTable->fetchData(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    protected function formatRequestParameters(Request $request): array
    {
        return $this->getFactory()->createParameterFormatter()->formatRequestParameters($request);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function favoriteReportAction(Request $request): RedirectResponse
    {
        $this->getFacade()->processSetFavoriteReportRequest($request);

        $categoryParamKey = $this->getFactory()->getConfig()->getCategoryQueryKey();
        $categoryId = $request->query->get($categoryParamKey);

        $queryParams = [
            $categoryParamKey => $categoryId,
        ];

        return $this->redirectResponse(static::ROOT_MODULE_URL . '?' . http_build_query($queryParams));
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function previewAction(Request $request): JsonResponse
    {
        $paramTransfer = $this->getFactory()->createParameterMapper()->mapParametersToNewParameterTransfer($request);
        $responseTransfer = $this->getFacade()->getReportPreviewURL($paramTransfer);

        return $this->jsonResponse([
            'iframeUrl' => $responseTransfer->getUrl(),
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadAction(Request $request): Response
    {
        $reportId = $this->castId($request->query->get('report_id'));
        $format = $request->query->get('format');

        if (!$format) {
            $this->addErrorMessage('Please choose a format to download the report in');

            return $this->RedirectResponse($request->headers->get('referer'));
        }

        $paramName = $request->query->get(ReportsConstants::PARAMETER_NAME);
        $paramValue = $request->query->get(ReportsConstants::PARAMETER_VALUE);

        $paramTransfer = (new BladeFxParameterTransfer())->setParamName($paramName)->setParamValue($paramValue)->setSqlDbType('');
        $responseTransfer = $this->getFacade()->getReportByIdInWantedFormat($reportId, $format, $paramTransfer);
        $headers = $this->getFactory()->createDownloadHeadersBuilder()->buildDownloadHeaders($format);

        return new Response(
            $responseTransfer->getReport(),
            200,
            $headers,
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function reportIframeAction(Request $request): JsonResponse
    {
        $reportId = (int)$request->get('repId');
        $reportParamFormTransfer = $this->getFacade()->getReportParamForm($reportId);

        return $this->jsonResponse([
           'iframeUrl' => $reportParamFormTransfer->getIframeUrl(),
        ]);
    }
}
