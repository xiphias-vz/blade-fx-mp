<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SalesMerchantPortalGui\Communication;

use Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Provider\BfxReportsSalesOrderTabTableConfigurationProvider;
use Spryker\Shared\GuiTable\GuiTableFactory;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacade;
use Spryker\Zed\SalesMerchantPortalGui\Communication\SalesMerchantPortalGuiCommunicationFactory as SprykerSalesMerchantPortalGuiCommunicationFactory;

/**
 * @method \Spryker\Zed\SalesMerchantPortalGui\SalesMerchantPortalGuiConfig getConfig()
 * @method \Spryker\Zed\SalesMerchantPortalGui\Persistence\SalesMerchantPortalGuiRepositoryInterface getRepository()
 */
class SalesMerchantPortalGuiCommunicationFactory extends SprykerSalesMerchantPortalGuiCommunicationFactory
{
    /**
     * @return \Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Provider\BfxReportsSalesOrderTabTableConfigurationProvider
     */
    public function getBladeFxReportsTableConfiguration(): BfxReportsSalesOrderTabTableConfigurationProvider
    {
        return new BfxReportsSalesOrderTabTableConfigurationProvider(
            new GuiTableFactory(),
            new MerchantUserFacade(),
        );
    }
}
