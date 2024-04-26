<?php

declare(strict_types=1);

namespace Pyz\Zed\BfxReportsMerchantPortalGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class BfxReportsMerchantPortalGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const REPORTS_FACADE = 'REPORTS_FACADE';
    /**
     * @var string
     */
    public const MERCHANT_USER_FACADE = 'MERCHANT_USER_FACADE';
    /**
     * @var string
     */
    public const SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR = 'gui_table_http_data_request_executor';

    /**
     * @var string
     */
    public const SERVICE_GUI_TABLE_FACTORY = 'gui_table_factory';

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addReportsFacade($container);
        $container = $this->addMerchantUserFacade($container);
        $container = $this->addGuiTableFactory($container);
        $container = $this->addGuiTableHttpDataRequestHandler($container);


        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addReportsFacade(Container $container): Container
    {
        $container->set(static::REPORTS_FACADE, function (Container $container) {
            return $container->getLocator()->reports()->facade();
        });

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addMerchantUserFacade(Container $container): Container
    {
        $container->set(static::MERCHANT_USER_FACADE, function (Container $container) {
            return $container->getLocator()->merchantUser()->facade();
        });

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addGuiTableHttpDataRequestHandler(Container $container): Container
    {
        $container->set(static::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR, function (Container $container) {
            return $container->getApplicationService(static::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR);
        });

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addGuiTableFactory(Container $container): Container
    {
        $container->set(static::SERVICE_GUI_TABLE_FACTORY, function (Container $container) {
            return $container->getApplicationService(static::SERVICE_GUI_TABLE_FACTORY);
        });

        return $container;
    }
}
