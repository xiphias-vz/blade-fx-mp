<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Pyz\Zed\BfxReportsMerchantPortalGui\Communication\BfxReportsMerchantPortalGuiCommunicationFactory getFactory();
 */
class BfxReportsController extends AbstractController
{
    /**
     * @return mixed[]
     */
    public function indexAction(): array
    {
        return $this->viewResponse([
            'bfxReportsTableConfiguration' => $this->getFactory()
                ->createBfxReportsMerchantPortalGuiTableConfigurationProvider()
                ->getConfiguration(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function tableDataAction(Request $request): Response
    {
        return $this->getFactory()->getGuiTableHttpDataRequestExecutor()->execute(
            $request,
            $this->getFactory()->createBfxReportsMerchantPortalGuiTableDataProvider([]),
            $this->getFactory()->createBfxReportsMerchantPortalGuiTableConfigurationProvider()->getConfiguration(),
        );
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function reportIframeAction(Request $request): JsonResponse
    {
        $reportId = (int)$request->get('repId');
        $reportParamFormTransfer = $this
            ->getFactory()
            ->getReportsFacade()
            ->getReportParamForm($reportId);

        $responseData = [
            'form' =>
                $this->renderView('@BfxReportsMerchantPortalGui/Partials/report-iframe.twig',
                    [
                        'url' => $reportParamFormTransfer->getIframeUrl(),
                    ]
                )->getContent(),
        ];

        return new JsonResponse($responseData);

//        return $this->renderView('@BfxReportsMerchantPortalGui/Partials/iframe.twig',[
//            'url' => $reportParamFormTransfer->getIframeUrl(),
//        ]);

//        return $this->redirectResponse($reportParamFormTransfer->getIframeUrl());

//        return $this->jsonResponse([
//            'iframeUrl' => $reportParamFormTransfer->getIframeUrl(),
//        ]);
    }
}
