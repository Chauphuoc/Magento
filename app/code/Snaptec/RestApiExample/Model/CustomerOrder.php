<?php

namespace  Snaptec\RestApiExample\Model;


use Snaptec\RestApiExample\Api\CustomerOrderInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\ResourceModel\Order\Collection;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use Magento\Customer\Api\CustomerRepositoryInterface;


class CustomerOrder implements CustomerOrderInterface
{
    

    private $customerRepository;

    private $orderRepository;

    private $order;
    /**
     * CustomerOrder constructor.
     *
     * @param Order $order
     */
    public function __construct(
        Order $order,
        CustomerRepository $customerRepository,
        OrderRepositoryInterface $orderRepository
       
    ) {
        $this->order = $order;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Returns orders data to user
     *
     * @api
     * @param  string $id customer id.
     * @return return order array collection.
     */
    public function getList($id)
    {
        $order = $this->order->getCollection()->addAttributeToFilter('customer_id', $id);
        $data = [];
        $i = 0;

        foreach ($order as $orderDetail) {
            $data[$i]['increment_id'] = $orderDetail->getIncrementId();
            $data[$i]['created_at'] = $orderDetail->getCreatedAt();
            $data[$i]['get_shipping_mthod'] = $orderDetail->getShippingMethod();
            // $address=$orderDetail->getAddresses();
            $data[$i]['get_shipping_address'] = $orderDetail->getShippingAddress()->getData();
            $data[$i]['grand_total'] = $orderDetail->getGrandTotal();
            $data[$i]['status'] = $orderDetail->getStatus();
            $data[$i]['id'] = $orderDetail->getId();
            $i++;
        }
        return $data;
    }

    /**
     * Returns customers data
     * @param string $fromDate
     * @param string $toDate
     * @return \Magento\Customer\Api\Data\CustomerInterface[]
     */
    public function getCustomerByOrder($fromDate, $toDate)
    {
        $customers = [];
        $customerIds = [];
        $i = 0;
        $order = $this->order->getCollection()
        ->addAttributeToSelect("*")
        ->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate));
        // ->getData();
        // dd($order);
        $j=0;
        foreach ($order as $orderDetail) {
            $customerIds[$i] = $orderDetail->getCustomerId();
            $i++;
        }
      
        foreach($customerIds as $id)
        {
            $customers[$j] = $this->customerRepository->getById($id);
            $j++;
        }
        
        return $customers;
        // $orderList = $this->orderRepository->getList($searchCriteria);
        // dd($orderList->getItems());
        // foreach (($orderList->getItems()) as $order) {
        //     $customerId[] = $order->getCustomerId();
        // }
  
        // $customerId_unique = array_unique(array_filter($customerId, function ($value) {
        //     return $value !== null;
        // }));

        // foreach ($customerId_unique as $id) {
        //     $customer[] = $this->customerRepository->getById($id);
        // }
        // return $customer;
        
    }

   
}
