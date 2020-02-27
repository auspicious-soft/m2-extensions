<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SM\Catalogtab\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context,\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
   public function execute() { 
//        echo "hii";
   $result = $this->resultJsonFactory->create();
   echo $product_id=$_REQUEST['productId'];
   return $result->setData(['success' => false]);
   } 

}
