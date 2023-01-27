<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\MerchantOms\Communication\Plugin\Oms;

/**
 * @method \Spryker\Zed\MerchantOms\Business\MerchantOmsFacadeInterface getFacade()
 * @method \Pyz\Zed\MerchantOms\MerchantOmsConfig getConfig()
 * @method \Pyz\Zed\MerchantOms\Communication\MerchantOmsCommunicationFactory getFactory()
 */
class CancelReturnMarketplaceOrderItemCommandPlugin extends AbstractTriggerOmsEventCommandPlugin
{
    /**
     * @var string
     */
    protected const PYZ_EVENT_CANCEL_RETURN = 'cancel-return';

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return static::PYZ_EVENT_CANCEL_RETURN;
    }
}
