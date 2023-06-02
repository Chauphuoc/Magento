<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Snaptec\Test\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Backend\App\Action;
use Snaptec\Test\Model\BrandFactory;
use Snaptec\Test\Model\Brand;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Save CMS page action.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action {
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Snaptec_Test::save';

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

 
    protected $brandFactory;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor,
        BrandFactory $brandFactory
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->brandFactory = $brandFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Brand::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            if (empty($data['image'])){
                $data['image']=null;
            }

            /** @var Page $model */
            // $model = $this->_objectManager->create('Snaptec\Test\Model\Brand');
            $model = $this->brandFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
            // test du lieu truyen vao cua nguoi dung
            // echo "<pre>"; var_dump($data['images']); echo "</pre>"; die;


            // Luu anh vao databaseresultRe
            if(!empty($data['images'][0]['name']) && $data != null){
                $data['image'] = $data['images'][0]['name'];
            }
            

            // Validate data
            if (!$this->dataProcessor->validateRequireEntry($data)) {
            //     Redirect to Edit page if has error
                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
            }
            
            $model->setData($data);
            
            
            try {
                // $rsBrand=$this->_objectManager->create('Snaptec\Test\Model\ResourceModel\Brand');
                // $rsBrand->save($model);
                // echo "<pre>"; var_dump($model->getData()); echo "</pre>";die;
                $model->save();
                $this->messageManager->addSuccess(__('You saved the image.'));
                $this->dataPersistor->clear('brand');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the image.'));
            }

            $this->dataPersistor->set('brand', $data);
            $this->dataPersistor->clear('brand');
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
            
        }
        return $resultRedirect->setPath('*/*/');
    }

    
}
