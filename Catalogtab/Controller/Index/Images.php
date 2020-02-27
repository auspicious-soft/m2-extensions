<?php 
namespace SM\Catalogtab\Controller\Index; 

class Images extends \Magento\Framework\App\Action\Action {
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultJsonFactory;
    /**      * @param \Magento\Framework\App\Action\Context $context      */
    public function __construct(\Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        \Magento\Catalog\Helper\Image $helperImage)    
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_storeManager = $storeManager;
        $this->_productloader = $_productloader;
        $this->helperImage = $helperImage;
        parent::__construct($context);
    }
    
    public function execute()
    {     
        try {
            $data      = $this->getRequest()->getPostValue();
            //die(print_r($data));
            $metal     = $data['metal'];
            // echo $data['metal']; 
            if(strpos($metal,'yellow')!==false){
                $metal_attribute = 'yellow_gold';
                //echo $metal_attribute;
            } elseif(strpos($metal,'rose')!==false){
                $metal_attribute = 'rose_gold';
            } elseif(strpos($metal,'white')!==false){
                $metal_attribute = 'white_gold';
            } elseif(strpos($metal,'platinum')!==false){
                $metal_attribute = 'platinum';
            }

            // die;
            $productId = $data['product'];
            $product   = $this->_productloader->create()->load($productId);
            $images    = $product->getMediaGalleryImages();

            // if(strpos($metal,'yellow')!==false){
            //     $metal_attribute = 'yellow_gold';
            // } elseif(strpos($metal,'rose')!==false){
            //     $metal_attribute = 'rose_gold';
            // } elseif(strpos($metal,'white')!==false){
            //     $metal_attribute = 'white_gold';
            // } elseif(strpos($metal,'platinum')!==false){
            //     $metal_attribute = 'platinum';
            // }


             $productImageAttr = $product->getCustomAttribute($metal_attribute);
             $productImage = $this->helperImage->init($product,$metal_attribute)->setImageFile($productImageAttr->getValue());
            $image_to_change = $productImage->getUrl();
            $productImage = $this->helperImage->init($product,'product_page_image_small')->setImageFile($productImageAttr->getValue());
            $image_to_change_thumb = $productImage->getUrl();

            $result     = $this->resultJsonFactory->create();
            $baseUrl    = $this->_storeManager->getStore()->getBaseUrl();
            $json_data  = array(["thumb"=>$image_to_change_thumb,
                          "img"=>$image_to_change,
                          "full"=>$image_to_change,
                          "caption"=>null,
                          "position"=>"1",
                          "isMain"=>true,
                          "type"=>"image",
                          "videoUrl"=>null,
                          "i"=>1
                        ]);

            $result->setData($json_data);
            return $result;  
        } catch(Exception $e) {
            $result->setData(array('status'=>$e));
            return $result;  
        }
    }
}
?>