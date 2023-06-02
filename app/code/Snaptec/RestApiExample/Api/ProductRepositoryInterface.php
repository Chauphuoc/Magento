<?php
namespace Snaptec\RestApiExample\Api;
 
interface ProductRepositoryInterface
{
    /**
     * GET for Post api
     * @param int $id
     * @return \Snaptec\RestApiExample\Api\Data\ProductInterface
     */
 
    public function getProductById($id);

     
  /**
     * Set descriptions for the products.
     *
     * @param \Snaptec\RestApiExample\Api\Data\ProductInterface[] $products
     * @return void
     */
    public function setDescription(array $products);
}