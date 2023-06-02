<?php
namespace Snaptec\RestApiExample\Model;

use Snaptec\RestApiExample\Api\ProductRepositoryInterface;
use Snaptec\RestApiExample\Api\ConfigurableProductRepositoryInterface;
use Snaptec\RestApiExample\Api\Data\ProductInterfaceFactory;
use Snaptec\RestApiExample\Helper\ProductHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Catalog\Model\ResourceModel\Product\Action;
use Magento\Store\Model\StoreManagerInterface;

class ProductRepository implements ProductRepositoryInterface
{

     /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Action
     */
    private $productAction;


     /**
     * @var ProductInterfaceFactory
     */
    protected $productInterfaceFactory;

    /**
     * @var ProductHelper
     */
    protected $productHelper;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    public function __construct(
       \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
       ProductInterfaceFactory $productInterfaceFactory,
       ProductHelper $productHelper
    )
    {
        $this->productHelper = $productHelper;
        $this->productRepository = $productRepository;
        $this->productInterfaceFactory = $productInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getProductById($id)
    {
        $productInterface = $this->productInterfaceFactory->create();
        try{
            $product = $this->productRepository->getById($id);
            
            $productInterface->setSku($product->getSku()?$product->getSku():"");
            $productInterface->setId($product->getId());
            $productInterface->setName($product->getName());
            $productInterface->setDescription($product->getDescription()?$product->getDescription():"");
            $productInterface->setPrice($this->productHelper->formatPrice($product->getPrice()));
            $productInterface->setImages($this->productHelper->getProductImagesArray($product));
            return $productInterface;
        }
        catch (NoSuchEntityException $e) {
            throw NoSuchEntityException::singleField("id",$id);
        }
    //   return $this->productRepository->getById($id);
    }

    /**
     * @inheritDoc
     *
     * @param ProductInterfaceFactory[] $products
     * @return void
     */
    public function setDescription(array $products) : void
    {
        foreach ($products as $product) {
            $this->setDescriptionForProduct(
                $product->getId(),
                $product->getDescription()
            );
        }
    }

    /**
     * Set the description for the product.
     *
     * @param int $id
     * @param string $description
     * @return void
     */
    private function setDescriptionForProduct(int $id, string $description) : void
    {
        $product = $this->productRepository->getById($id);


        $this->productAction->updateAttributes(
            [$id],
            ['description' => $description],
            $this->storeManager->getStore()->getId()
        );
    }

   
}