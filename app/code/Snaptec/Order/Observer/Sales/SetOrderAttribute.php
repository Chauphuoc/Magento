<?php
namespace Snaptec\Order\Observer\Sales;

class SetOrderAttribute implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $order= $observer->getEvent()->getOrder();
        // convintion cua magento tuong ung file upgradeData (custom_order)
        ///home/admin01/Desktop/docker-compose/composer/appdata/vendor/magento/module-sales/Model/Order/Creditmemo.php getGrandTotal()
        $customAttributeValue = $order->getGrandTotal() > 200 ? 'Yes' : 'No';
        //Co 2 cach set data:
        $order->setCustomOrderAttribute($customAttributeValue); 

        //Cach 2: $order->setData('status_grand_total_custom', $customAttributeValue);
        $order->save();
    }
}