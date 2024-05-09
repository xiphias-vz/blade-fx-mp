<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportsUpdater;

use Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\ReportsUpdaterRequestTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Spryker\Zed\Messenger\Business\MessengerFacadeInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsUpdater implements ReportsUpdaterInterface
{
    /**
     * @var string
     */
    protected const MESSAGE_ADD_TO_FAVORITES_SUCCESS = 'bfx.reports.add_to_favorites.success';

    /**
     * @var string
     */
    protected const MESSAGE_REMOVE_FROM_FAVORITES_SUCCESS = 'bfx.reports.remove_from_favorites.success';

    /**
     * @var string
     */
    protected const MESSAGE_PARAM_ID = 'id';

    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    protected TokenResolverInterface $tokenResolver;

    /**
     * @var \Spryker\Zed\Messenger\Business\MessengerFacadeInterface
     */
    protected MessengerFacadeInterface $messengerFacade;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface $tokenResolver
     * @param \Spryker\Zed\Messenger\Business\MessengerFacadeInterface $messengerFacade
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        ReportsApiClientInterface $apiClient,
        TokenResolverInterface $tokenResolver,
        MessengerFacadeInterface $messengerFacade,
        SessionClientInterface $sessionClient,
        ReportsConfig $config,
    ) {
        $this->apiClient = $apiClient;
        $this->tokenResolver = $tokenResolver;
        $this->messengerFacade = $messengerFacade;
        $this->sessionClient = $sessionClient;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ReportsUpdaterRequestTransfer $updaterRequestTransfer
     *
     * @return void
     */
    public function updateFavorite(ReportsUpdaterRequestTransfer $updaterRequestTransfer): void
    {
        $requestTransfer = $this->generateAuthenticatedSetFavoriteReportRequestTransfer(
            $updaterRequestTransfer->getRepId(),
        );

        $this->apiClient->sendSetFavoriteReportRequest($requestTransfer);

        $this->generateSuccessMessage($updaterRequestTransfer);
    }

    /**
     * @param int $repId
     *
     * @return \Generated\Shared\Transfer\BladeFxSetFavoriteReportRequestTransfer
     */
    protected function generateAuthenticatedSetFavoriteReportRequestTransfer(int $repId): BladeFxSetFavoriteReportRequestTransfer
    {
        $token = $this->tokenResolver->resolveToken();
        $userId = $this->sessionClient->get(
            $this->config->getBfxUserIdSessionKey(),
        );

        return (new BladeFxSetFavoriteReportRequestTransfer())
            ->setToken((new BladeFxTokenTransfer())->setToken($token))
            ->setUserId($userId)
            ->setRepId($repId);
    }

    /**
     * @param \Generated\Shared\Transfer\ReportsUpdaterRequestTransfer $updaterRequestTransfer
     *
     * @return void
     */
    protected function generateSuccessMessage(ReportsUpdaterRequestTransfer $updaterRequestTransfer): void
    {
        $message = $updaterRequestTransfer->getIsFavorite()
            ? static::MESSAGE_REMOVE_FROM_FAVORITES_SUCCESS : static::MESSAGE_ADD_TO_FAVORITES_SUCCESS;

        $this->messengerFacade->addSuccessMessage(
            $this->createMessengerMessageTransfer($message, [
                $this->buildMessageParam(static::MESSAGE_PARAM_ID) => $updaterRequestTransfer->getRepId(),
            ]),
        );
    }

    /**
     * @param string $paramName
     *
     * @return string
     */
    protected function buildMessageParam(string $paramName): string
    {
        return '%' . $paramName . '%';
    }

    /**
     * @param string $message
     * @param array $parameters
     *
     * @return \Generated\Shared\Transfer\MessageTransfer
     */
    protected function createMessengerMessageTransfer(string $message, array $parameters = []): MessageTransfer
    {
        $messageTransfer = new MessageTransfer();
        $messageTransfer
            ->setValue($message)
            ->setParameters($parameters);

        return $messageTransfer;
    }
}
