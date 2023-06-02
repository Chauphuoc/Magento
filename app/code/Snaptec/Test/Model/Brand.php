<?php
namespace Snaptec\Test\Model;
class Brand extends \Magento\Framework\Model\AbstractModel 
{
    const STATUS_ENABLED=1;
    const STATUS_DISABLED = 0;
    protected function _construct ()
    {
        $this->_init('Snaptec\Test\Model\ResourceModel\Brand');
    }
}
