<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business;

use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticator;
use Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use Xiphias\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReader;
use Xiphias\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface;
use Xiphias\Zed\Reports\Business\BladeFx\PreviewReader\BladeFxPreviewReader;
use Xiphias\Zed\Reports\Business\BladeFx\PreviewReader\BladeFxPreviewReaderInterface;
use Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader\BladeFxReportByFormatReader;
use Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader\BladeFxReportByFormatReaderInterface;
use Xiphias\Zed\Reports\Business\BladeFx\ReportListReader\BladeFxReportListReader;
use Xiphias\Zed\Reports\Business\BladeFx\ReportListReader\BladeFxReportListReaderInterface;
use Xiphias\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReader;
use Xiphias\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface;
use Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdater;
use Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface;
use Xiphias\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessor;
use Xiphias\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessorInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolver;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\Business\BladeFx\UserHandler\UserHandlerInterface;
use Xiphias\Zed\Reports\Business\BladeFx\UserHandler\UserHandler;
use Xiphias\Zed\Reports\ReportsDependencyProvider;

/**
 * @method \Xiphias\Zed\Reports\ReportsConfig getConfig()
 * @method \Xiphias\Zed\Reports\Business\ReportsFacade getFacade();
 * @method \Xiphias\Zed\Reports\Persistence\ReportsRepositoryInterface getRepository();
 */
class ReportsBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\RequestProcessor\RequestProcessorInterface
     */
    public function createRequestProcessor(): RequestProcessorInterface
    {
        return new RequestProcessor(
            $this->createBladeFxCategoryReader(),
            $this->createBladeFxReportsReader(),
            $this->createReportsUpdater(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface
     */
    public function createBladeFxAuthenticator(): BladeFxAuthenticatorInterface
    {
        return new BladeFxAuthenticator(
            $this->getBladeFxClient(),
            $this->getConfig(),
            $this->getSessionClient(),
            $this->getBladeFxPostAuthenticationPlugins(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\CategoryReader\BladeFxCategoryReaderInterface
     */
    public function createBladeFxCategoryReader(): BladeFxCategoryReaderInterface
    {
        return new BladeFxCategoryReader(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\ReportsReader\ReportsReaderInterface
     */
    public function createBladeFxReportsReader(): ReportsReaderInterface
    {
        return new ReportsReader(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    public function createTokenResolver(): TokenResolverInterface
    {
        return new TokenResolver(
            $this->createBladeFxAuthenticator(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater\ReportsUpdaterInterface
     */
    public function createReportsUpdater(): ReportsUpdaterInterface
    {
        return new ReportsUpdater(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getMessengerFacade(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    public function getBladeFxClient(): ReportsApiClientInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::BLADE_FX_CLIENT);
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return array<\Xiphias\Zed\Reports\Communication\Plugins\Authentication\BladeFxPostAuthenticationPluginInterface>
     */
    public function getBladeFxPostAuthenticationPlugins(): array
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::BLADE_FX_POST_AUTHENTICATION_PLUGINS);
    }

    /**
     * @return \Spryker\Zed\Messenger\Business\MessengerFacadeInterface
     */
    public function getMessengerFacade(): MessengerFacadeInterface
    {
        return $this->getProvidedDependency(ReportsDependencyProvider::MESSENGER_FACADE);
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\ReportListReader\BladeFxReportListReaderInterface
     */
    public function createBladeFxReportListReader(): BladeFxReportListReaderInterface
    {
        return new BladeFxReportListReader(
            $this->createBladeFxAuthenticator(),
            $this->getBladeFxClient(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader\BladeFxReportByFormatReaderInterface
     */
    public function createBladeFxReportByFormatReader(): BladeFxReportByFormatReaderInterface
    {
        return new BladeFxReportByFormatReader(
            $this->createBladeFxAuthenticator(),
            $this->getBladeFxClient(),
            $this->getSessionClient(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Xiphias\Zed\Reports\Business\BladeFx\PreviewReader\BladeFxPreviewReaderInterface
     */
    public function createBladeFxPreviewReader(): BladeFxPreviewReaderInterface
    {
        return new BladeFxPreviewReader(
            $this->getBladeFxClient(),
            $this->createTokenResolver(),
            $this->getConfig(),
        );
    }

    public function createUserHandler(): UserHandlerInterface
    {
        return new UserHandler(
            $this->getRepository()
        );
    }
}
