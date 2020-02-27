<?php

/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace SM\Diamondprice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Save extends \Magento\Backend\App\Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
    Context $context, PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute() {

        $post = $this->getRequest()->getPost();
        if ($post) {
          //  echo "<pre>";print_r($post);die;
            // Retrieve your form data
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
            $connection = $resource->getConnection();
            $tableName = $resource->getTableName('sm_diamondprice');
            $color_clarity = $post['color_clarity'];
            $add = $post['add'];
            $combination = $post['combination'];
            //$diamond_price =$post['diamond_price'];
           // $mergeArray = array_merge($combination, $diamond_price);
          // echo "<pre>";print_r($combination);die;
            
            foreach ($combination as $key => $val):
                if($add!=''):       
                    $sql = "INSERT INTO " . $tableName . "(metal_purity_id,combination,price) VALUES ('$color_clarity','$key','$val')";
                    $result = $connection->query($sql);
             else:
                 //echo "in";die;
                $sqlDelete = "DELETE FROM " . $tableName . " WHERE metal_purity_id = '$color_clarity' AND combination='$key'";
                $result = $connection->query($sqlDelete);
                if($result){
                $sql = "INSERT INTO " . $tableName . "(metal_purity_id,combination,price) VALUES ('$color_clarity','$key','$val')";
                $resultInsert = $connection->query($sql);                
                }
                endif;
            endforeach;

            if ($result == TRUE) {
                $this->messageManager->addSuccessMessage('Record inserted.');
                // mail($email_to, $subject, $message, $headers);
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
             
            }
        }
        // Render the page 
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}
