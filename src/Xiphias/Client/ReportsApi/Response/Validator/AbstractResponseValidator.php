<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Response\Validator;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;
use Xiphias\Client\ReportsApi\Exception\ReportsResponseException;
use Xiphias\Client\ReportsApi\ReportsApiConfig;

abstract class AbstractResponseValidator implements ResponseValidatorInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    private const ERROR_INVALID_RESPONSE_PARAMETERS = '%s Incorrect response transfer provided for request validator.';

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @throws \Xiphias\Client\ReportsApi\Exception\ReportsResponseException
     *
     * @return bool
     */
    public function isResponseValid(AbstractTransfer $responseTransfer): bool
    {
        $responseTransferClass = $this->getResponseTransferClass();
        if (!$this->isResponseTransferClassCorrect($responseTransfer, $responseTransferClass)) {
            $this->logError($responseTransfer);

            throw new ReportsResponseException();
        }

        return $this->validateResponse($responseTransfer);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return bool
     */
    abstract protected function validateResponse(AbstractTransfer $responseTransfer): bool;

    /**
     * @return string
     */
    abstract protected function getResponseTransferClass(): string;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     * @param string $className
     *
     * @return bool
     */
    private function isResponseTransferClassCorrect(AbstractTransfer $responseTransfer, string $className): bool
    {
        return $className === get_class($responseTransfer);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return void
     */
    private function logError(AbstractTransfer $responseTransfer): void
    {
        $this->getLogger()->critical(
            $this->formatMessage(),
            $this->createTransferLogger($responseTransfer),
        );
    }

    /**
     * @return string
     */
    private function formatMessage(): string
    {
        return sprintf(
            self::ERROR_INVALID_RESPONSE_PARAMETERS,
            ReportsApiConfig::LOG_MESSAGE_PREFIX,
        );
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $responseTransfer
     *
     * @return array<\Spryker\Shared\Kernel\Transfer\AbstractTransfer>
     */
    private function createTransferLogger(AbstractTransfer $responseTransfer): array
    {
        return [
            'transfer' => $responseTransfer,
        ];
    }
}
