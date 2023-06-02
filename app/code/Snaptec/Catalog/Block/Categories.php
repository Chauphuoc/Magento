<?php
namespace Snaptec\Catalog\Block;

use Codeception\Lib\Di;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryFactory;
use Magento\Framework\View\Element\Template;

class Categories extends Template  {
    protected $categoryFactory;
    public function __construct(
        CategoryFactory $categoryFactory,
        Template\Context $context,
        array $data=[])
    {
        $this->categoriesCollectionFactory = $categoryFactory;
        parent::__construct(
        $context,
        $data
        );
    }

    public function getAllCategories(){
        // Create a list of data of instance from collectionFactory into array-> eav/model/category
        
        $categories = $this->categoriesCollectionFactory->create();
        $categories->addAttributeToSelect("*");
        $categories->addAttributeToFilter('include_in_menu','1');
        $categories->addAttributeToFilter('parent_id','2');
        // $categories->addFieldToFilter('is_active','0');
        $categories->setPageSize(0);
        
        return $categories;
    }

   
}