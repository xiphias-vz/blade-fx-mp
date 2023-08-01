<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\CheckoutRestApi;

use Spryker\Glue\CheckoutRestApi\CheckoutRestApiConfig as SprykerCheckoutRestApiConfig;

class CheckoutRestApiConfig extends SprykerCheckoutRestApiConfig
{
    /**
     * @var array<string, array<string>>
     */
    protected const PAYMENT_METHOD_REQUIRED_FIELDS = [
        'dummyPaymentInvoice' => ['dummyPaymentInvoice.dateOfBirth'],
        'dummyPaymentCreditCard' => [
            'dummyPaymentCreditCard.cardType',
            'dummyPaymentCreditCard.cardNumber',
            'dummyPaymentCreditCard.nameOnCard',
            'dummyPaymentCreditCard.cardExpiresMonth',
            'dummyPaymentCreditCard.cardExpiresYear',
            'dummyPaymentCreditCard.cardSecurityCode',
        ],
    ];

    /**
     * @uses \Spryker\Shared\DummyPayment\DummyPaymentConfig::PROVIDER_NAME
     *
     * @var string
     */
    protected const PYZ_DUMMY_PAYMENT_PROVIDER_NAME = 'DummyPayment';

    /**
     * @uses \Spryker\Shared\DummyPayment\DummyPaymentConfig::PAYMENT_METHOD_NAME_CREDIT_CARD
     *
     * @var string
     */
    protected const PYZ_DUMMY_PAYMENT_PAYMENT_METHOD_NAME_CREDIT_CARD = 'Credit Card';

    /**
     * @uses \Spryker\Shared\DummyPayment\DummyPaymentConfig::PAYMENT_METHOD_CREDIT_CARD
     *
     * @var string
     */
    protected const PYZ_PAYMENT_METHOD_CREDIT_CARD = 'dummyPaymentCreditCard';

    /**
     * @var bool
     */
    protected const IS_PAYMENT_PROVIDER_METHOD_TO_STATE_MACHINE_MAPPING_ENABLED = false;

    /**
     * @return array<array<string>>
     */
    public function getPaymentProviderMethodToStateMachineMapping(): array
    {
        return [
            static::PYZ_DUMMY_PAYMENT_PROVIDER_NAME => [
                static::PYZ_DUMMY_PAYMENT_PAYMENT_METHOD_NAME_CREDIT_CARD => static::PYZ_PAYMENT_METHOD_CREDIT_CARD,
            ],
        ];
    }

    /**
     * @return bool
     */
    public function isShipmentMethodsMappedToAttributes(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPaymentProvidersMappedToAttributes(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isAddressesMappedToAttributes(): bool
    {
        return false;
    }
}
