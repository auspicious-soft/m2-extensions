<?php 
    /**
    * Simple Hello World Module 
    *
    * @category    Engraving
    * @package     Engraving_HelloWorld
    * @author      Muhammad Qaisar Satti
    * @Email       qaisarssatti@gmail.com
    *
    */

namespace Engraving\HelloWorld\Block;
class Post extends \Magento\Framework\View\Element\Template
{
	public function _prepareLayout()
	{  
		parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('test'));
        return $this;
	}
}
