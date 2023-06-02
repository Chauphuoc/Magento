<?php
namespace Snaptec\Catalog\Block;

use Magento\Catalog\Model\ResourceModel\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductFactory;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class NewProduct extends Template  {
    protected $_categoryFactory;
    protected $_productCollectionFactory;

    public function __construct(
        Template\Context $context,
        CategoryFactory $categoryFactory,
        CollectionFactory $productCollectionFactory,
        array $data = []
    ) {
        $this->_categoryFactory = $categoryFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getAllProducts()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $category = $objectManager->create('Magento\Catalog\Model\Category')->load(13);
        $productCollection = $this->_productCollectionFactory->create();
        $productCollection->addAttributeToSelect('*')
                          ->addCategoryFilter($category)
                          ->load();
        // dd($productCollection);
        return $productCollection;
    }
}

