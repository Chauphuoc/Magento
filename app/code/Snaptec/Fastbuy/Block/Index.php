<?php
namespace Snaptec\Fastbuy\Block;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    private $productCollection;

    public function __construct(
        CollectionFactory $productCollection,
        Template\Context $context,
        array $data=[])
    {
        $this->productCollection = $productCollection;
        parent::__construct(
            $context,
            $data
            );
    }

    public function getAllProduct()
    {
        $product = $this->productCollection->create();
        $product->addAttributeToSelect("name");
        return $product;
    } 
}