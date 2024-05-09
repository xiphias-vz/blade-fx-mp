<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Validator;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;
use Xiphias\Client\ReportsApi\Exception\ReportsRequestException;
use Xiphias\Client\ReportsApi\ReportsApiConfig;

abstract class AbstractRequestValidator implements RequestValidatorInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    private const ERROR_INVALID_REQUEST_PARAMETERS = '%s Incorrect request transfer provided for request validator.';

    /**
     * @var string
     */
    protected const LOGGER_TYPE_TRANSFER = 'transfer';

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @throws \Xiphias\Client\ReportsApi\Exception\ReportsRequestException
     *
     * @return bool
     */
    public function isRequestValid(AbstractTransfer $requestTransfer): bool
    {
        $requestTransferClass = $this->getRequestTransferClass();
        if (!$this->isRequestTransferClassCorrect($requestTransfer, $requestTransferClass)) {
            $this->logError($requestTransfer);

            throw new ReportsRequestException();
        }

        return $this->validateRequest($requestTransfer);
    }

    /**
     * @return string
     */
    abstract protected function getRequestTransferClass(): string;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return bool
     */
    abstract protected function validateRequest(AbstractTransfer $requestTransfer): bool;

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     * @param string $className
     *
     * @return bool
     */
    private function isRequestTransferClassCorrect(AbstractTransfer $requestTransfer, string $className): bool
    {
        return $className === get_class($requestTransfer);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return void
     */
    private function logError(AbstractTransfer $requestTransfer): void
    {
        $this->getLogger()->critical(
            $this->formatMessage(),
            $this->createTransferLogger($requestTransfer),
        );
    }

    /**
     * @return string
     */
    private function formatMessage(): string
    {
        return sprintf(
            self::ERROR_INVALID_REQUEST_PARAMETERS,
            ReportsApiConfig::LOG_MESSAGE_PREFIX,
        );
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array<\Spryker\Shared\Kernel\Transfer\AbstractTransfer>
     */
    private function createTransferLogger(AbstractTransfer $requestTransfer): array
    {
        return [
            static::LOGGER_TYPE_TRANSFER => $requestTransfer,
        ];
    }
}
