<?php

namespace Snaptec\Test\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    //Lay giao dien o module backend phan dashboard

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Snaptec_Test::Brand_Manager');//id menu can active
        
        $resultPage->getConfig()->getTitle()->prepend(__('Brand Manager'));

        return $resultPage;
    }

    

}