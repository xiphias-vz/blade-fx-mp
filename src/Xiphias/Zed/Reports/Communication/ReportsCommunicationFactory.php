<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication;

use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilder;
use Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilderInterface;
use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatter;
use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface;
use Xiphias\Zed\Reports\Communication\Mapper\ParameterMapper;
use Xiphias\Zed\Reports\Communication\Table\ReportsTable;
use Xiphias\Zed\Reports\Communication\Table\SalesReportsTable;
use Xiphias\Zed\Reports\ReportsDependencyProvider;

/**
 * @method \Xiphias\Zed\Reports\ReportsConfig getConfig()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacadeInterface getFacade()
 */
class ReportsCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\Table\ReportsTable
     */
    public function createReportsTable(): ReportsTable
    {
        return new ReportsTable(
            $this->getFacade(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\Builder\DownloadHeadersBuilderInterface
     */
    public function createDownloadHeadersBuilder(): DownloadHeadersBuilderInterface
    {
        return new DownloadHeadersBuilder();
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\Mapper\ParameterMapper
     */
    public function createParameterMapper(): ParameterMapper
    {
        return new ParameterMapper();
    }

    /**
     * @param array $params
     *
     * @return \Xiphias\Zed\Reports\Communication\Table\SalesReportsTable
     */
    public function createSalesReportsTable(array $params = []): SalesReportsTable
    {
        return new SalesReportsTable(
            $this->getFacade(),
            $this->getConfig(),
            $params,
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface
     */
    public function createParameterFormatter(): ParameterFormatterInterface
    {
        return new ParameterFormatter();
    }
}
