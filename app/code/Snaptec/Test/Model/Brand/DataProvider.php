<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * 
 */

 //Dung de hien thi du lieu trong form
namespace Snaptec\Test\Model\Brand;

use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Snaptec\Test\Model\BrandFactory;
use Snaptec\Test\Model\ResourceModel\Brand\CollectionFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
use Psr\Log\LoggerInterface;

/**
 * Cms Page DataProvider
 */
class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var BrandFactory
     */
    private $brandFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    protected $storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $brandCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     * @param AuthorizationInterface|null $auth
     * @param RequestInterface|null $request
     * 
     * @param PageRepositoryInterface|null $pageRepository
     * @param BrandFactory|null $brandFactory
     * @param LoggerInterface|null $logger
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $brandCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null,
        ?AuthorizationInterface $auth = null,
        ?RequestInterface $request = null,
        
        ?PageRepositoryInterface $pageRepository = null,
        ?brandFactory $brandFactory = null,
        ?LoggerInterface $logger = null,

        \Magento\Store\Model\StoreManagerInterface $storeManager

        
    ) {
        $this->storeManager = $storeManager;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->collection = $brandCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->auth = $auth ?? ObjectManager::getInstance()->get(AuthorizationInterface::class);
        $this->meta = $this->prepareMeta($this->meta);
        $this->request = $request ?? ObjectManager::getInstance()->get(RequestInterface::class);
        
        $this->pageRepository = $pageRepository ?? ObjectManager::getInstance()->get(PageRepositoryInterface::class);
        $this->brandFactory = $brandFactory ?: ObjectManager::getInstance()->get(brandFactory::class);
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        
        $items = $this->collection->getItems();
        
        foreach ($items as $brand) {
            $data = $brand->getData();
            $image = $data['image'];
            
            //tao anh preview
            $data['images'][0]['url']=$this->storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ) . 'brand/images' . $image;//De lay duong dan phai inject class storemanager o ham construct
            $data['images'][0]['name']= $image;

            $this->loadedData[$brand->getId()] = $data;
        }

        $data = $this->dataPersistor->get('brand');
        if (!empty($data)) {
            $brand = $this->collection->getNewEmptyItem();
            $brand->setData($data);
            $this->loadedData[$brand->getId()] = $brand->getData();
            $this->dataPersistor->clear('brand');
        }

        return $this->loadedData;
    }

    
}
