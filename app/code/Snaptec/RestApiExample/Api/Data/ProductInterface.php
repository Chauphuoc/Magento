<?php
namespace Snaptec\RestApiExample\Api\Data;

interface ProductInterface
{
    const SKU = 'sku';

    const NAME = 'name';

    
    /**
     * Product id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set product id
     *
     * @param int $id
     * @return $this
     */
    public function setId(int $id);

    /**
     * Product sku
     *
     * @return string
     */
    public function getSku();

    /**
     * Set product sku
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * Product name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set product name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

     /**
     * Get product description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set product description
     *
     * @param string $description
     * @return string
     */
    public function setDescription(string $description);

    /**
     *
     * @return string
     */
    public function getPrice();

    /**
     * Set product price
     * @param string $price
     * @return $this
     */
    public function serPrice($price);

    /**
     * 
     * @return string[]
     */
    public function getImages();

    /**
     * 
     * @param string[] $productImagesArray
     * @return $this
     */
    public function setImages($productImagesArray);
}