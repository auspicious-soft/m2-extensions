<?php
namespace Engraving\HelloWorld\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\Product;
use Magento\Framework\Controller\ResultFactory;
class Post extends Action
    {
        protected $formKey;   
        protected $cart;
        protected $product;
        public function __construct(
            Context $context,
            FormKey $formKey,
            Cart $cart,
            Product $product) {
                $this->formKey = $formKey;
                $this->cart = $cart;
                $this->product = $product;      
                parent::__construct($context);
        }
        public function execute()
         { 
		  $post = $this->getRequest()->getParams();  
 if(!isset($_GET['option_id'])){
   $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
 return $resultRedirect->setPath('checkout/');
}
		 $option_id = $post['option_id']; 
		 $options = $post['options']; 
		  $productId = $post['pro_id']; 
		   $quoteId = $post['quoteId']; 
		   
$result = array_combine($option_id, $options);
//print_r($result);
			

 


$params = array(
                    'form_key' => $this->formKey->getFormKey(),
                    'product' => $productId, //product Id
                    'qty'   =>1, //quantity of product                
                    'options' => $result
                    );

$product = $this->product->load($productId);       
            $this->cart->addProduct($product, $params);
            $this->cart->save();

$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
 return $resultRedirect->setPath('checkout/');

         }
    }