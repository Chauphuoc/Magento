<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Snaptec\CustomPayment\Model;

/**
 * Custom payment method model
 *
 * @method \Magento\Quote\Api\Data\PaymentMethodExtensionInterface getExtensionAttributes()
 *
 * @api
 * @since 100.0.2
 */
class Custompayment extends \Magento\Payment\Model\Method\AbstractMethod
{

    const PAYMENT_METHOD_CUSTOM_INVOICE_CODE = 'custompayment';

    /**
    * Payment method code
    *
    * @var string
    */
    protected $_code = self::PAYMENT_METHOD_CUSTOM_INVOICE_CODE;
}