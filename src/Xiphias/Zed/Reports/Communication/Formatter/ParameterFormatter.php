<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Formatter;

use league\ReportsConstants;
use Spryker\Shared\Customer\CustomerConstants;
use Spryker\Zed\Sales\SalesConfig;
use Symfony\Component\HttpFoundation\Request;

class ParameterFormatter implements ParameterFormatterInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function formatRequestParameters(Request $request): array
    {
        return [
            ReportsConstants::ATTRIBUTE => $this->getAttributeValue($request),
            ReportsConstants::PARAMETER_NAME => $this->getParamName($request),
            ReportsConstants::PARAMETER_VALUE => $this->getParamValue($request),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getAttributeValue(Request $request): string
    {
        if ($request->query->has(SalesConfig::PARAM_ID_SALES_ORDER)) {
            return ReportsConstants::BLADE_FX_ORDER_ATTRIBUTE;
        }

        return ReportsConstants::BLADE_FX_CUSTOMER_ATTRIBUTE;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getParamName(Request $request): string
    {
        if ($request->query->has(SalesConfig::PARAM_ID_SALES_ORDER)) {
            return ReportsConstants::BLADE_FX_ORDER_PARAM_NAME;
        }

        return ReportsConstants::BLADE_FX_CUSTOMER_PARAM_NAME;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return int
     */
    protected function getParamValue(Request $request): int
    {
        if ($request->query->has(SalesConfig::PARAM_ID_SALES_ORDER)) {
            return (int)$request->query->getInt(SalesConfig::PARAM_ID_SALES_ORDER);
        }

        return (int)$request->query->getInt(CustomerConstants::PARAM_ID_CUSTOMER);
    }
}
