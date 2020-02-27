<?php
namespace SM\Catalogtab\Block\Product\View;
//use Magento\Catalogtab\Block\Product\AbstractProduct;

class Calculation extends \Magento\Framework\View\Element\Template  //AbstractProduct
{
    protected $_registry;
    
    const METAL_TYPE = 'metal_type';
    const ENTITY_TYPE = 'catalog_product';
    const METAL_PURITY = 'metal_purity';
    const DIAMOND_COLOR_CLARITY = 'diamond_colour_clarity';
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {        
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }
   public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }    
    
    public function getProductAttrValue($attr_code){
        $product = $this->getCurrentProduct();
        return $attributeValue = $product->getAttributeText($attr_code);
    }
    
    public function getProductMetalOptions(){
        $product = $this->getCurrentProduct();
        return explode(',', $product->getMetalType());
    }
    
    public function getMetalOptions(){
        $objectManager         = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeInfo = $objectManager->create(\Magento\Eav\Model\Entity\Attribute::class)->loadByCode(Calculation::ENTITY_TYPE, Calculation::METAL_TYPE);
        $metalId       = $attributeInfo->getAttributeId();

        $metalData = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                ->setPositionOrder('asc')
                ->setAttributeFilter($metalId)
                ->setStoreFilter()
                ->load();

        $metalOptionLabels = array();
        
        foreach ($metalData as $keyMetal => $valMetal) {
            $metalOptionLabels[$valMetal->getOptionId()] = $valMetal->getValue();
        }
        
        return $metalOptionLabels;
    }
    
    public function getProductPurityOptions(){
        $product = $this->getCurrentProduct();
        return explode(',', $product->getMetalPurity());
    }
    
    public function getPurityOptions(){
        $objectManager         = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeInfo = $objectManager->create(\Magento\Eav\Model\Entity\Attribute::class)->loadByCode(Calculation::ENTITY_TYPE, Calculation::METAL_PURITY);

        $purityId = $attributeInfo->getAttributeId();

        $purityData = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                ->setPositionOrder('asc')
                ->setAttributeFilter($purityId)
                ->setStoreFilter()
                ->load();

        $purityOptionLabels = array();
        foreach ($purityData as $keyPurity => $valPurity) {
            $purityOptionLabels[$valPurity->getOptionId()] = $valPurity->getValue();
        }
        
        return $purityOptionLabels;
    }
    
    public function getDiamondColourClarity(){
        $product = $this->getCurrentProduct();
        return explode(',', $product->getDiamondColourClarity());
    }
    
    public function getDiamondClarityOptions(){
        $objectManager         = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeInfo = $objectManager->create(\Magento\Eav\Model\Entity\Attribute::class)->loadByCode(Calculation::ENTITY_TYPE, Calculation::DIAMOND_COLOR_CLARITY);
        $ccId = $attributeInfo->getAttributeId();

        $ccData = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                ->setPositionOrder('asc')
                ->setAttributeFilter($ccId)
                ->setStoreFilter()
                ->load();
        $ccOptLabelSelected = array();
        foreach ($ccData as $keyCC => $valCC) {
            $ccOptLabelSelected[$valCC->getOptionId()] = $valCC->getValue();
        }
        return $ccOptLabelSelected;
    }
}