<?php

namespace Xiphias\Zed\Reports\Communication\Provider;

use Generated\Shared\Transfer\BladeFxReportTransfer;
use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Zed\ProductOfferMerchantPortalGui\Dependency\Facade\ProductOfferMerchantPortalGuiToMerchantUserFacadeInterface;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsGuiTableConfigurationProvider
{
    public const COL_KEY_SKU = 'sku';
    public const COL_KEY_IMAGE = 'image';
    public const COL_KEY_NAME = 'name';
    public const COL_KEY_SUPER_ATTRIBUTES = 'superAttributes';
    public const COL_KEY_VARIANTS = 'variants';
    public const COL_KEY_CATEGORIES = 'categories';
    public const COL_KEY_STORES = 'stores';
    public const COL_KEY_VISIBILITY = 'visibility';
    /**
     * @var \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    protected $guiTableFactory;
    private ReportsFacadeInterface $reportsFacade;
    private ReportsConfig $config;
    private ProductOfferMerchantPortalGuiToMerchantUserFacadeInterface $merchantUserFacade;

    /**
     * @param \Spryker\Shared\GuiTable\GuiTableFactoryInterface $guiTableFactory
     */
    public function __construct(
        GuiTableFactoryInterface $guiTableFactory,
        ProductOfferMerchantPortalGuiToMerchantUserFacadeInterface $merchantUserFacade,
        ReportsFacadeInterface $reportsFacade,
        ReportsConfig $config,
    ) {
        $this->guiTableFactory = $guiTableFactory;
        $this->merchantUserFacade = $merchantUserFacade;
        $this->reportsFacade = $reportsFacade;
        $this->config = $config;
    }
    /**
     * @return \Generated\Shared\Transfer\GuiTableConfigurationTransfer
     */
    public function getConfiguration(): GuiTableConfigurationTransfer
    {
        $idMerchant = $this->merchantUserFacade
            ->getCurrentMerchantUser()
            ->getIdMerchantOrFail();

        $guiTableConfigurationBuilder = $this->guiTableFactory->createConfigurationBuilder();

        $guiTableConfigurationBuilder = $this->addColumns($guiTableConfigurationBuilder);
        $guiTableConfigurationBuilder = $this->addFilters($guiTableConfigurationBuilder);
        $guiTableConfigurationBuilder = $this->addRowActions($guiTableConfigurationBuilder, $idMerchant);

        $guiTableConfigurationBuilder
            ->setDataSourceUrl('/bfx-report-merchant-portal-gui/(?)/table-data')
            ->setSearchPlaceholder('Search by report name')
            ->setDefaultPageSize(25);

        return $guiTableConfigurationBuilder->createConfiguration();
    }
    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addColumns(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder): GuiTableConfigurationBuilderInterface
    {
        $guiTableConfigurationBuilder
            ->addColumnChip(BladeFxReportTransfer::IS_FAVORITE, 'Favorite', true, false, 'gray', [
                'Favorite' => 'green',
            ])
            ->addColumnText(BladeFxReportTransfer::REP_ID, 'Report ID', true, false)
            ->addColumnText(BladeFxReportTransfer::REP_NAME, 'Report name', true, false)
            ->addColumnText(BladeFxReportTransfer::REP_DESC, 'Description', false, true)
            ->addColumnText(BladeFxReportTransfer::CAT_NAME, 'Category', true, true)
            ->addColumnChip(BladeFxReportTransfer::IS_ACTIVE, 'Active', true, false, 'gray')
            ->addColumnChip(BladeFxReportTransfer::IS_DRILLDOWN, 'Drilldown', true, false, 'gray');

        return $guiTableConfigurationBuilder;
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addFilters(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder): GuiTableConfigurationBuilderInterface
    {
        $guiTableConfigurationBuilder->addFilterSelect(BladeFxReportTransfer::IS_FAVORITE, 'Favorite', false, [
            '1' => 'Favorite',
            '0' => 'Not favorite',
        ]);
        $guiTableConfigurationBuilder->addFilterSelect(BladeFxReportTransfer::IS_ACTIVE, 'Active', false, [
            '1' => 'Active',
            '0' => 'Not active',
        ]);
        $guiTableConfigurationBuilder->addFilterSelect(BladeFxReportTransfer::IS_DRILLDOWN, 'Drilldown', false, [
            '1' => 'Drilldown',
            '0' => 'Not drilldown',
        ]);

        return $guiTableConfigurationBuilder;
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addRowActions(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder, int $idMerchant): GuiTableConfigurationBuilderInterface
    {
        $guiTableConfigurationBuilder->addRowActionDrawerAjaxForm(
            'show-iframe',
            'Edit',
            sprintf(
                '/bfx-reports-merchant-portal-gui/report-iframe?repId=${row.%s}&merchId=${row.%s}',
                BladeFxReportTransfer::REP_ID,
                $idMerchant
            )
        )->setRowClickAction('show-iframe');

        return $guiTableConfigurationBuilder;
    }
}
