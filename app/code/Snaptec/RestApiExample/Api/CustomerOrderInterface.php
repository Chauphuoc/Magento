<?php
namespace Snaptec\RestApiExample\Api;


interface CustomerOrderInterface
{
    /**
     * Returns orders data to user
     *
     * @api
     * @param  string $id customer id.
     * @return return order array collection.
     */
    public function getList($id);

  /**
     * Returns customers data
     * @param string $fromDate;
     * @param string $toDate;
     * @return \Magento\Customer\Api\Data\CustomerInterface[]
     */
    public function getCustomerByOrder($fromDate, $toDate);
}