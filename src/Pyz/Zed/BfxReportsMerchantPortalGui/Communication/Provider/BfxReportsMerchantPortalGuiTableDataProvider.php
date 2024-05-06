<?php

declare(strict_types=1);

namespace Pyz\Zed\BfxReportsMerchantPortalGui\Communication\Provider;

use Generated\Shared\Transfer\BladeFxCriteriaTransfer;
use Generated\Shared\Transfer\BladeFxReportTransfer;
use Generated\Shared\Transfer\GuiTableDataRequestTransfer;
use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\GuiTableRowDataResponseTransfer;
use Spryker\Service\UtilSanitize\UtilSanitizeService;
use Spryker\Shared\GuiTable\DataProvider\AbstractGuiTableDataProvider;
use Spryker\Shared\GuiTable\DataProvider\GuiTableDataProviderInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Xiphias\Shared\Reports\ReportsConstants;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;
use function PHPUnit\Framework\stringContains;

class BfxReportsMerchantPortalGuiTableDataProvider extends AbstractGuiTableDataProvider implements GuiTableDataProviderInterface
{
    /**
     * @param ReportsFacadeInterface $facade
     * @param array $params
     */
    public function __construct(
       protected ReportsFacadeInterface $facade,
       protected array $params,
    ){}

    /**
     * @param AbstractTransfer $criteriaTransfer
     *
     * @return GuiTableDataResponseTransfer
     */
    protected function fetchData(AbstractTransfer $criteriaTransfer): GuiTableDataResponseTransfer
    {
        $guiTableDataResponseTransfer = new GuiTableDataResponseTransfer();
        $reportList = $this
            ->facade
            ->getAllReports()
            ->getReportsList()
            ->getArrayCopy();

        if ($criteriaTransfer->getSearchTerm()) {
            $reportList = $this->search($reportList, $criteriaTransfer->getSearchTerm());
        }

        $paginatedReports = $this->pagination($reportList, $criteriaTransfer);

//        $reportList = $this->facade->getAllReports($this->params[ReportsConstants::ATTRIBUTE]);

        /**
         * @var \Generated\Shared\Transfer\BladeFxReportTransfer $reportListItem
         */
        foreach ($paginatedReports as $reportListItem) {
            $responseData = [
                BladeFxReportTransfer::IS_FAVORITE => $this->formatIsFavorite($reportListItem->getIsFavorite()),
                BladeFxReportTransfer::REP_ID => $reportListItem->getRepId(),
                BladeFxReportTransfer::REP_NAME => $reportListItem->getRepName(),
                BladeFxReportTransfer::REP_DESC => $reportListItem->getRepDesc(),
                BladeFxReportTransfer::CAT_NAME => $reportListItem->getCatName(),
                BladeFxReportTransfer::IS_ACTIVE => $reportListItem->getIsActive(),
                BladeFxReportTransfer::IS_DRILLDOWN => $reportListItem->getIsDrillDown(),
            ];

            $guiTableDataResponseTransfer->addRow((new GuiTableRowDataResponseTransfer())->setResponseData($responseData));
        }

        return $guiTableDataResponseTransfer
            ->setTotal(count($reportList))
            ->setPageSize($criteriaTransfer->getPageSize())
            ->setPage($criteriaTransfer->getPage());
    }

    /**
     * @param GuiTableDataRequestTransfer $guiTableDataRequestTransfer
     *
     * @return AbstractTransfer
     */
    protected function createCriteria(GuiTableDataRequestTransfer $guiTableDataRequestTransfer): AbstractTransfer
    {
        return (new BladeFxCriteriaTransfer());
    }

    /**
     * @param array $rows
     * @param AbstractTransfer $criteriaTransfer
     *
     * @return array
     */
    protected function pagination(array $rows, AbstractTransfer $criteriaTransfer): array
    {
        $perPage = $criteriaTransfer->getPageSize();
        $offset = ($criteriaTransfer->getPage() - 1) * $perPage;

        return array_slice($rows, $offset, $perPage);
    }

    /**
     * @param array $rows
     * @param string $searchTerm
     *
     * @return array
     */

    protected function search(array $rows, string $searchTerm): array
    {
        $searchRows = [];
        foreach ($rows as $row) {
            if (str_contains($row->getRepName(),$searchTerm)) {
                $searchRows[] = $row;
            }
        }

        return $searchRows;
    }

    protected function formatIsFavorite(bool $isFavorite): string
    {
        if ($isFavorite) {
            return htmlspecialchars(utf8_decode('<i class="fa fa-star toggle-icon"></i>'));
        }

        return '<i class="fa fa-star toggle-icon"></i>';
    }
}
