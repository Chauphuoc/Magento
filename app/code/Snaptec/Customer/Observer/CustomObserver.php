<?php

namespace Snaptec\Customer\Observer;

use Magento\Customer\Model\Customer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomObserver implements ObserverInterface
{
    protected $_customerRepositoryInterface;

    public const CUSTOM_MIDDLENAME_ATTRIBUTE='CHAU PHUOC';
  

    public function __construct(\Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface
    )
    {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        
    }

  

    public function execute(Observer $observer)
    {
    
        $customer = $observer->getEvent()->getCustomer();
        $customerData = $customer->getDataModel();//Return ve 1 instance cua customer(Model\Customer)
        $customerData->setMiddlename(self::CUSTOM_MIDDLENAME_ATTRIBUTE);//Magento\Customer\Api\Data\CustomerInterface.php
        // $customerData->setCustomAttribute('custom_cust_attribute',self::CUSTOM_MIDDLENAME_ATTRIBUTE);Use Magento\Framework\Api\CustomAttributesDataInterface
        $customer->updateData($customerData);
        $customer->save();

    }
}