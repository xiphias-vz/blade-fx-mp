<?php

declare(strict_types=1);

namespace Pyz\Zed\BfxReportsMerchantPortalGui\Communication;

use Pyz\Zed\BfxReportsMerchantPortalGui\BfxReportsMerchantPortalGuiDependencyProvider;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\MerchantUser\Business\MerchantUserFacadeInterface;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;
use Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Provider\BfxReportsMerchantPortalGuiTableConfigurationProvider;
use Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Provider\BfxReportsMerchantPortalGuiTableDataProvider;

class BfxReportsMerchantPortalGuiCommunicationFactory extends AbstractCommunicationFactory

{
    /**
     * @return BfxReportsMerchantPortalGuiTableConfigurationProvider
     */
    public function createBfxReportsMerchantPortalGuiTableConfigurationProvider(): BfxReportsMerchantPortalGuiTableConfigurationProvider
    {
        return new BfxReportsMerchantPortalGuiTableConfigurationProvider(
            $this->getGuiTableFactory(),
            $this->getMerchantUserFacade(),
        );
    }

    /**
     * @param array $params
     *
     * @return BfxReportsMerchantPortalGuiTableDataProvider
     */
    public function createBfxReportsMerchantPortalGuiTableDataProvider(array $params): BfxReportsMerchantPortalGuiTableDataProvider
    {
        return new BfxReportsMerchantPortalGuiTableDataProvider(
            $this->getReportsFacade(),
            $params,
        );
    }
    /**
     * @return ReportsFacadeInterface
     */
    public function getReportsFacade(): ReportsFacadeInterface
    {
        return $this->getProvidedDependency(BfxReportsMerchantPortalGuiDependencyProvider::REPORTS_FACADE);
    }

    /**
     * @return \Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface
     */
    public function getGuiTableHttpDataRequestExecutor(): GuiTableDataRequestExecutorInterface
    {
        return $this->getProvidedDependency(BfxReportsMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR);
    }

    /**
     * @return \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    public function getGuiTableFactory(): GuiTableFactoryInterface
    {
        return $this->getProvidedDependency(BfxReportsMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_FACTORY);
    }

    /**
     * @return MerchantUserFacadeInterface
     */
    public function getMerchantUserFacade(): MerchantUserFacadeInterface
    {
        return $this->getProvidedDependency(BfxReportsMerchantPortalGuiDependencyProvider::MERCHANT_USER_FACADE);
    }
}
