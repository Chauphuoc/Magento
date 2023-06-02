<?php
namespace Snaptec\Test\Model\Attribue\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Material extends AbstracSource
{
    public function getAllOptions (){
        if(!$this->_options){
            $this->_options = [
                ['brand'       => __('Nike'), 'value' => 'nike'],
                ['brand'       => __('Addidas'), 'value' => 'addidas'],
                ['brand'       => __('Converse'), 'value' => 'converse'],
                ['brand'       => __('Puma'), 'value' => 'puma']
            ];
        }
        return $this->_options;
    }
}