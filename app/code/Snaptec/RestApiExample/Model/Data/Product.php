<?php 
namespace Snaptec\RestApiExample\Model\Data;
 
use Snaptec\RestApiExample\Api\Data\ProductInterface;
use Magento\Framework\DataObject;

class Product extends DataObject implements ProductInterface
{
   /**
     * Identifier getter
     *
     * @return int
     * @since 101.0.0
     */
    public function getId()
    {
        return $this->_getData('entity_id');
    }

   /**
     * Set entity Id
     *
     * @param int $value
     * @return $this
     * @since 101.0.0
     */
    public function setId($value)
    {
        return $this->setData('entity_id', $value);
    }
    
     /**
     * Retrieve sku through type instance
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

     /**
     * Set product sku
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

     /**
     * Get product name
     *
     * @return string
     * @codeCoverageIgnoreStart
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }
    /**
     * Set product name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name){
        return $this->setData('name',$name);
    }
     /**
     * Get product description
     *
     * @return string
     */
    public function getDescription(){
        return $this->getData('description');
    }
    /**
     * Set product description
     *
     * @param string $description
     * @return string
     */
    public function setDescription(string $description) 
    {
        return $this->setData('description',$description);
    }

     /**
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->getData('price');
    }

     /**
     * Set product price
     * @param string $price
     * @return $this
     */
    public function serPrice($price){
        return $this->setData('price',$price);
    }

    /**
     * 
     * @return string[]
     */
    public function getImages()
    {
        return $this->getData('image');
    }

    /**
     * 
     * @param string[] $productImagesArray
     * @return $this
     */
    public function setImages($productImagesArray)
    {
        return $this->setData('image',$productImagesArray);
    }

}