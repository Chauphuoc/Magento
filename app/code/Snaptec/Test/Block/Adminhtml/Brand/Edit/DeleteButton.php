<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Snaptec\Test\Block\Adminhtml\Brand\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

use Snaptec\Test\Block\Adminhtml\Brand\AbstractBrand;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getPageId()) {
            
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    // public function getButtonData()
    // {
    //     $brand = $this->getBrand();
    //     $brandId = (int)$brand->getId();
    //     if ($brandId && !in_array($brandId, $this->getRootIds()) && $brand->isDeleteable()) {
    //         return [
    //             'id' => 'delete',
    //             'label' => __('Delete'),
    //             'on_click' => "deleteConfirm('" .__('Are you sure you want to delete this category?') ."', '"
    //                 . $this->getDeleteUrl() . "', {data: {}})",
    //             'class' => 'delete',
    //             'sort_order' => 10
    //         ];
    //     }

    //     return [];
    // }

    /**
     * Url to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        $params = array_merge($this->getDefaultUrlParams(), $args);
        
        return $this->getUrl('brand/*/delete', $params);
    }

    /**
     * @return array
     */
    protected function getDefaultUrlParams()
    {
        return ['_current' => true, '_query' => ['isAjax' => null]];
    }
}
