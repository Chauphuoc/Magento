<?php
namespace Snaptec\Customer\Plugin;

use Magento\Customer\Model\Customer;
use Magento\Customer\Api\CustomerRepositoryInterface as CustomerRepository;
use Magento\Customer\Api\Data\CustomerInterface;

class CustomerAttribute {

    const CUSTOMER_MOBILE = '070319962';
    const CUSTOMER_EMAIL = 'chauvanphuoc1996@gmail.com';

    public function afterSave(CustomerRepository $customerRepository, CustomerInterface $customer)
    {
        //convention
        $currentEmail = $customer->getEmail();
        if($currentEmail!==null){
            $currentEmail = $customer->getEmail();
            if($currentEmail !== self::CUSTOMER_EMAIL){
                $customer->setEmail(self::CUSTOMER_EMAIL);
                return $customerRepository->save($customer);
            }    
        }
       
        $currentcustom = $customer->getCustomAttribute('custom_cust_attribute');
        if($currentcustom !== null){
            $getCurrentcustom = $customer->getCustomAttribute('custom_cust_attribute')->getValue();
            if($getCurrentcustom !== self::CUSTOMER_MOBILE){
                $customer->setCustomAttribute('custom_cust_attribute',self::CUSTOMER_MOBILE);
                return $customerRepository->save($customer);
            }
        }
        
        
        return $customer;
        
    }
}