<?php
namespace Snaptec\Test\Model\ResourceModel\Brand;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        
        //ham init co 2 tham so(model, resource model)
        $this->_init('Snaptec\Test\Model\Brand','Snaptec\Test\Model\ResourceModel\Brand');
    }
}