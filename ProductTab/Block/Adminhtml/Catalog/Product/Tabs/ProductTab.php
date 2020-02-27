<?php 
namespace SM\ProductTab\Block\Adminhtml\Catalog\Product\Tabs;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;

class ProductTab extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'ProductTab.phtml';

    protected $_coreRegistry = null;

    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getProduct()
    {
        return $this->_coreRegistry->registry('current_product');
    }
}