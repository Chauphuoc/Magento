<?php
namespace Snaptec\Test\Model\Attribue\Backend;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class Material extends AbstractBackend 
{
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if(($object->getAttributeSetId()== 10) && ($value=='nike')){
            throw new LocalizedException(__('Bottom cannot be nike'));
        }
    }
}