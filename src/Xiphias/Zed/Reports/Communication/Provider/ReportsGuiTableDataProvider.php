<?php

namespace Xiphias\Zed\Reports\Communication\Provider;

use Generated\Shared\Transfer\BladeFxCriteriaTransfer;
use Generated\Shared\Transfer\BladeFxReportTransfer;
use Generated\Shared\Transfer\GuiTableDataRequestTransfer;
use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\GuiTableRowDataResponseTransfer;
use Spryker\Shared\GuiTable\DataProvider\AbstractGuiTableDataProvider;
use Spryker\Shared\GuiTable\DataProvider\GuiTableDataProviderInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Shared\Reports\ReportsConstants;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;

class ReportsGuiTableDataProvider extends AbstractGuiTableDataProvider implements GuiTableDataProviderInterface
{
    public function __construct(
       protected ReportsFacadeInterface $facade,
       protected array $params,
    ){}
    protected function fetchData(AbstractTransfer $criteriaTransfer): GuiTableDataResponseTransfer
    {
        $guiTableDataResponseTransfer = new GuiTableDataResponseTransfer();
        $reportList = $this->facade->getAllReports($this->params[ReportsConstants::ATTRIBUTE]);

        /**
         * @var \Generated\Shared\Transfer\BladeFxReportTransfer $reportListItem
         */
        foreach ($reportList as $reportListItem) {
            $responseData = [
                BladeFxReportTransfer::IS_FAVORITE => $reportListItem->getIsFavorite(),
                BladeFxReportTransfer::REP_ID => $reportListItem->getRepId(),
                BladeFxReportTransfer::REP_NAME => $reportListItem->getRepName(),
                BladeFxReportTransfer::REP_DESC => $reportListItem->getRepDesc(),
                BladeFxReportTransfer::CAT_NAME => $reportListItem->getCatName(),
                BladeFxReportTransfer::IS_ACTIVE => $reportListItem->getIsActive(),
                BladeFxReportTransfer::IS_DRILLDOWN => $reportListItem->getIsDrillDown(),
            ];

            $guiTableDataResponseTransfer->addRow((new GuiTableRowDataResponseTransfer())->setResponseData($responseData));
        }

        return $guiTableDataResponseTransfer;
    }

    protected function createCriteria(GuiTableDataRequestTransfer $guiTableDataRequestTransfer): AbstractTransfer
    {
        return (new BladeFxCriteriaTransfer());
    }
}
