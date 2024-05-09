<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class SalesController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function listAction(Request $request): array
    {
        $salesReportsTable = $this->getFactory()
            ->createSalesReportsTable($this->formatRequestParameters($request));

        return $this->viewResponse([
            'salesReportsTable' => $salesReportsTable->render(),
        ]);
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
}
