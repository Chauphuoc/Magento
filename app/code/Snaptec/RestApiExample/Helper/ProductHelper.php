<?php
namespace Snaptec\RestApiExample\Helper;

use Magento\Framework\Pricing\Helper\Data;
use Magento\Framework\Exception\NoSuchEntityException;

class ProductHelper
{
     /**
     * @var Data
     */
    private $priceHelper;

    public function __construct(Data $priceHelper)
    {
        $this->priceHelper = $priceHelper;
    }

    public function formatPrice($price)
    {
        return $this->priceHelper->currency($price,true,false);
    }

    public function getProductImagesArray($product){
         /**
         * @var \Magento\Catalog\Model\Product $product
         */
        $images = $product->getMediaGalleryImages();
        $imageArray = array();
        foreach ($images as $image){
            /**
         * @var $i \Magento\Catalog\Model\Product\Image
         */
            $imageArray[] = $image->getUrl();
        }
        return $imageArray;
    }
}