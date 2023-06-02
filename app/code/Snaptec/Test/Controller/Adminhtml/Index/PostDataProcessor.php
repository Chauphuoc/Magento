<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Snaptec\Test\Controller\Adminhtml\Index;



/**
 * Controller helper for user input.
 */
class PostDataProcessor
{

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    

    /**
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     *
     */
    public function __construct(
     
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
      
        $this->messageManager = $messageManager;
     
    }

    

    /**
     * Check if required fields is not empty
     *
     * @param array $data
     * @return bool
     */
    public function validateRequireEntry(array $data)
    {
        $requiredFields = [
            'title' => __('Title'),
            'status' => __('Status'),
            'description' => __('Description'),
            'image'=>__('Image'),
            'sortOrder'=>__('SortOrder')
        ];
        $errorNo = true;
        foreach ($data as $field => $value) {
            if (in_array($field, array_keys($requiredFields)) && $value == '') {
                $errorNo = false;
                $this->messageManager->addErrorMessage(
                    __('To apply changes you should fill in hidden required "%1" field', $requiredFields[$field])
                );
            }
        }
        return $errorNo;
    }

    
}
