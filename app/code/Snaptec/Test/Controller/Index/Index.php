<?php
namespace Snaptec\Test\Controller\Index ;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
   protected $pageFactory;

   public function __construct (Context $context,PageFactory $pageFactory){
      $this->pageFactory = $pageFactory;
      parent::__construct($context);
   }

   public function execute (){
      $brand = $this->_objectManager->create('Snaptec\Test\Model\Brand');
      $brand->addData([
         
         'Title'=>'Balo',
         'Status'=>1,
         'Description'=>'Balo is the best',
         'Image'=>'image5.jpg',
         'SortOrder'=>0
         
      ])->save();
      echo 'Done';



   //  return $this->pageFactory->create();
   }

   
 
} 