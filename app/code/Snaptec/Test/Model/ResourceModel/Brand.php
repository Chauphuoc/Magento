<?php
namespace Snaptec\Test\Model\ResourceModel;

use Magento\Framework\Filesystem\Io\File;
class Brand extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb 
{
    private const TABLE_NAME = 'brand';
        private const PRIMARY_KEY = 'id';
    protected function _construct ()
    {
        
        // Table name+ primary column
        $this->_init(self::TABLE_NAME,self::PRIMARY_KEY);
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object){
        $image = $object->getData('image');
       
        if($image!=null){
            $imageUploader = \Magento\Framework\App\ObjectManager::getInstance()
            ->get('Snaptec\Test\BrandImageUpload');
            $imageUploader->moveFileFromTmp($image);
            // $file = new File();
            // $sourcePath = 'pub/media/brand/tmp/images/' . $image;
            // $destinationPath = 'pub/media/brand/images/' . $image;
            // $file->cp($sourcePath, $destinationPath);

        }
        // echo "<pre>"; var_dump($destinationPath); echo"</pre>";die;
        return $this;
    }
}
