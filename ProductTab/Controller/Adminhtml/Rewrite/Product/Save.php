<?php

namespace SM\ProductTab\Controller\Adminhtml\Rewrite\Product;

class Save extends \Magento\Catalog\Controller\Adminhtml\Product\save {

    public function execute() {
    	
         return parent::execute();
        
       /* $obj = \Magento\Framework\App\ObjectManager::getInstance()
                ->get('Magento\Framework\App\ResourceConnection');
        $connection = $obj->getConnection();
 $post = $this->getRequest()->getPost();
//        echo "<pre>";
//        print_r($post);
//        exit;        
        //echo "<pre>";print_r($_POST);die;
        if (!empty($_POST['product_tab_id'])) {
            $product_id = $_POST['product_tab_id'];
            $allMetalData = array(
                array('metal' => $_POST['metal']),
                array('grossw' => $_POST['gw'])
            );
            $defaultMetal = $_POST['metal_default'];
            $defaultDia = $_POST['dimonddefault'];
            $shape = $_POST['diamond']['shape'][0];
            $Shapesize = $_POST['diamond']['size'][0];
            $carat = $_POST['diamond']['carat'][0];
            $no_of_diamond = $_POST['diamond']['no_of_diamond'][0];
            $setting = $_POST['diamond']['setting'][0];
            $RingSize = $_POST['itemSize'];
            $defaultShapeSize = $shape . 'X' . $Shapesize;
            $themeTable = $obj->getTableName('sm_productprice');
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $productFactory = $objectManager->create('\Magento\Catalog\Model\ProductFactory');
            $product = $productFactory->create()->load($product_id);
            $product->setMetalDefault($defaultMetal);
            $product->setDiamondDefault($defaultDia);
            $product->save(); 
            //die;
            $sql1 = "DELETE FROM " . $themeTable . " WHERE product_id='" . $product_id . "'";
            $connection->query($sql1);
            $sql = "INSERT INTO " . $themeTable . "(product_id,combination,default_metal) VALUES ('" . $product_id . "','" . serialize($allMetalData) . "','" . $defaultMetal . "')";
            $connection->query($sql);

            $deleteColorClarity = "DELETE FROM sm_diamond_color_size_data WHERE product_id='" . $product_id . "'";
            $connection->query($deleteColorClarity);
            $sqlColorClarity = "INSERT INTO sm_diamond_color_size_data(product_id,color_clarity_id,diamond_shape_id,diamond_size_id,weight_in_carat,no_of_diamond,diamond_setting,ring_size,default_diamond_shape_size)"
                    . "VALUES ('" . $product_id . "','" . $defaultDia . "','" . $shape . "','" . $Shapesize . "','" . $carat . "','" . $no_of_diamond . "','" . $setting . "','" . $RingSize . "','" . $defaultShapeSize . "')";
            $connection->query($sqlColorClarity);
            return parent::execute();
        } else {
            return parent::execute();
        } */
    }

}
