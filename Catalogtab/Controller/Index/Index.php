<?php

namespace SM\Catalogtab\Controller\Index;

use Magento\Framework\App\Action\Action;
//use agento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
// \Magento\Framework\App\Action\Context  to \M
/**
 * Class Index
 *
 * @package SM\Catalogtab\Controller\Index
 * @author  Swapnil Mulay <swapnilmulay.1104@gmail.com>
 */
class Index extends Action {

    /**
     * The PageFactory to render with.
     *
     * @var PageFactory
     */
    protected $_resultsPageFactory;

    /**
     * Set the Context and Result Page Factory from DI.
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
    Context $context, PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultsPageFactory = $resultPageFactory;        
    }

    /**
     * Show the Hello Wholesaler Index Page.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute() {
 
        $product_id = $_REQUEST['productId'];
        $metal_option_id = $_REQUEST['metal'];
       
         if (isset($_REQUEST['purity'])) {
             $purity_option_id = $_REQUEST['purity'];
        }
        if (isset($_REQUEST['diamond'])) {
            $diamond_clarity_id = $_REQUEST['diamond'];
        }
        $fancyStonePrice = $_REQUEST['fancyStonePrice'];
        $isLoad = $_REQUEST['isLoad'];
        if($fancyStonePrice!=''){
            $fancyStonePrice;
        }
        else{
            $fancyStonePrice = 0;
        }
        /* Offer calculation */
       
        $obj = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
        $connection = $obj->getConnection();
        $flat_discount = 0;
        $diamond_discount = 0;
        $stone_discount = 0;
        $making_charge_discount = 0;
        // $priceFirstCheck = $_REQUEST['priceFirstCheck'];

        if (isset($_REQUEST['itemSize'])) {
            $RingSize = $_REQUEST['itemSize'];
        }
        if (isset($_REQUEST['itemSize1'])) {
            $RingSize1 = $_REQUEST['itemSize1'];
        }

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeSet = $objectManager->create('Magento\Eav\Api\AttributeSetRepositoryInterface');
        $current_product = $objectManager->create('\Magento\Catalog\Model\ProductRepository')->getById($product_id);

        $attributeSetRepository = $attributeSet->get($current_product->getAttributeSetId());
        $attribute_set_name = $attributeSetRepository->getAttributeSetName();
        $attribute_set_id = $attributeSetRepository->getAttributeSetId();

 if ($attribute_set_name == 'Chain'){

        $combinationMP = '69x76'; // Ex 7x4

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager

        $currentProduct = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');

        $connection = $resource->getConnection();

        $sqlMetal = "SELECT * FROM sm_metalprice WHERE metal_type='" . $metal_option_id . "'";
        $resultMetal = $connection->fetchAll($sqlMetal);
        $tableName = $resource->getTableName('sm_productprice'); //gives table name with prefix

        $sql = "Select * FROM " . $tableName . " WHERE product_id='" . $product_id . "'";
        $result = $connection->fetchAll($sql);

        $combinationAll = unserialize($result[0]['combination']);

        $cnt = count($combinationAll);
      
 }else{

    $combinationMP = $metal_option_id . 'x' . $purity_option_id; // Ex 7x4

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager

        $currentProduct = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);

        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');

        $connection = $resource->getConnection();

        $sqlMetal = "SELECT * FROM sm_metalprice WHERE metal_type='" . $metal_option_id . "' AND metal_purity='" . $purity_option_id . "'";
        $resultMetal = $connection->fetchAll($sqlMetal);
        $tableName = $resource->getTableName('sm_productprice'); //gives table name with prefix

        $sql = "Select * FROM " . $tableName . " WHERE product_id='" . $product_id . "'";
        $result = $connection->fetchAll($sql);

        $combinationAll = unserialize($result[0]['combination']);

        $cnt = count($combinationAll);

 }
        


$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $config = $objectManager->get('\Magento\Framework\App\Config\ScopeConfigInterface');
/*diamond discount*/
    $bangel_size = $config->getValue('sm_catalogtab/general/bangel_size',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $chain = $config->getValue('sm_catalogtab/general/chain',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $defualt = $config->getValue('sm_catalogtab/general/defualt',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $earring = $config->getValue('sm_catalogtab/general/earring',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $mangalsutra = $config->getValue('sm_catalogtab/general/mangalsutra',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $necklace = $config->getValue('sm_catalogtab/general/necklace',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $nose_pin = $config->getValue('sm_catalogtab/general/nose_pin',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $pendants = $config->getValue('sm_catalogtab/general/pendants',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    $ring = $config->getValue('sm_catalogtab/general/ring',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
/*making charge discount*/

$bangel_size1 = $config->getValue('sm_catalogtab/general/bangel_size1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $chain1 = $config->getValue('sm_catalogtab/general1/chain1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $defualt1 = $config->getValue('sm_catalogtab/general1/defualt1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $earring1 = $config->getValue('sm_catalogtab/general1/earring1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $mangalsutra1 = $config->getValue('sm_catalogtab/general1/mangalsutra1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $necklace1 = $config->getValue('sm_catalogtab/general1/necklace1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $nose_pin1 = $config->getValue('sm_catalogtab/general1/nose_pin1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $pendants1 = $config->getValue('sm_catalogtab/general1/pendants1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $ring1 = $config->getValue('sm_catalogtab/general1/ring1',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);


        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeSet = $objectManager->create('Magento\Eav\Api\AttributeSetRepositoryInterface');
        $current_product = $objectManager->create('\Magento\Catalog\Model\ProductRepository')->getById($product_id);

        $attributeSetRepository = $attributeSet->get($current_product->getAttributeSetId());
        $attribute_set_name = $attributeSetRepository->getAttributeSetName();
        $attribute_set_id = $attributeSetRepository->getAttributeSetId();

        $finalMetalWeigth = $combinationAll[0]['metal'][$combinationMP];
        $finalMetalGrossWeight = $combinationAll[1]['grossw'][$combinationMP];



        $sqlsetName = "SELECT * FROM sm_makingcharge WHERE makingcharge_category='" . $attribute_set_id . "'";
        $resultSetName = $connection->fetchAll($sqlsetName);
        if ($attribute_set_name != 'Necklace' && $attribute_set_name != 'Bangel Size' && $attribute_set_name != 'Chain') {
            $sqlDiamond = "SELECT * FROM sm_diamond_color_size_data WHERE  product_id='" . $product_id . "'"; // color_clarity_id='".$diamond_clarity_id."' AND
            $resultDiamondClarity = $connection->fetchRow($sqlDiamond);


            $diamondData = unserialize($resultDiamondClarity['diamond_data']);
            $ShapeSizeArray = array();
            $shapeArray = $diamondData['shape'];
            // $WeightArray = $diamondData['weight_in_carat'];
            //$ShapeSizeArray = array_combine($shapeArray, $sizeArray);

            foreach ($shapeArray as $k => $v) {
                $combination[] = $v;
            }
            $comCnt = count($combination);
        }
        $metalTotalPrice = 0;
        $diamondTotalPrice = 0;
        $makingChargeTotal = 0;        
        if ($attribute_set_name == 'Ring' || $attribute_set_name == 'Bangel Size' || $attribute_set_name == 'Chain') {
            /* RING SIZE CALCULATION */
                    if($attribute_set_name == 'Bangel Size'){ $discount_diamond = $bangel_size; }
                    if($attribute_set_name == 'Chain'){ $discount_diamond = $chain; }
                    if($attribute_set_name == 'Default'){ $discount_diamond = $default; }
                    if($attribute_set_name == 'Earring'){ $discount_diamond = $earring; }
                    if($attribute_set_name == 'Mangalsutra'){ $discount_diamond = $mangalsutra; }
                    if($attribute_set_name == 'Necklace'){ $discount_diamond = $necklace; }
                    if($attribute_set_name == 'Nose Pin'){ $discount_diamond = $nose_pin; }
                    if($attribute_set_name == 'Pendants'){ $discount_diamond = $pendants;}
                    if($attribute_set_name == 'Ring'){ $discount_diamond = $ring;}
                    /*making charge*/
                    if($attribute_set_name == 'Bangel Size'){ $discount_making = $bangel_size1; }
                    if($attribute_set_name == 'Chain'){ $discount_making = $chain1; }
                    if($attribute_set_name == 'Default'){ $discount_making = $default1; }
                    if($attribute_set_name == 'Earring'){ $discount_making = $earring1; }
                    if($attribute_set_name == 'Mangalsutra'){ $discount_making = $mangalsutra1; }
                    if($attribute_set_name == 'Necklace'){ $discount_making = $necklace1; }
                    if($attribute_set_name == 'Nose Pin'){ $discount_making = $nose_pin1; }
                    if($attribute_set_name == 'Pendants'){ $discount_making = $pendants1;}
                    if($attribute_set_name == 'Ring'){ $discount_making = $ring1;}

                if($attribute_set_name=='Bangel Size'){
                $attributeCode = 'bangel_size';
                } if($attribute_set_name=='Chain'){
                $attributeCode = 'length_chain';
                } if($attribute_set_name=='Ring'){
                 $attributeCode = 'ring_size';   
                }
                    $entityType = 'catalog_product';
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                    $attributeInfo = $objectManager->create(\Magento\Eav\Model\Entity\Attribute::class)->loadByCode($entityType, $attributeCode);
                    $attributeId = $attributeInfo->getAttributeId();
                    $optionsRingSize = $attributeInfo->getSource()->getAllOptions();

                foreach ($optionsRingSize as $optlabel => $optvalue) {
                    if ($optlabel != '' && !is_null($optlabel) && $optlabel != ' ') {
                        $AllRingSize[] = $optvalue;
                    }
                }

                $AllRingSize = array_column($AllRingSize, 'label');
                if ($attribute_set_name == 'Bangel Size') {
                    $ringSizeIds = explode(',', $currentProduct->getBangelSize());
                }
                if($attribute_set_name=='Chain'){
                 $ringSizeIds = explode(',', $currentProduct->getLengthChain());
                } 
                if($attribute_set_name=='Ring') {
                    $ringSizeIds = explode(',', $currentProduct->getRingSize());
                }
                $RingSizecnt = count($ringSizeIds);
                    for ($i = 0; $i < $RingSizecnt; $i++) {
                        $optionId = $ringSizeIds[$i];
                        $attributeRigSize = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                                ->setPositionOrder('asc')
                                ->setAttributeFilter($attributeId)
                                ->setIdFilter($optionId)
                                ->setStoreFilter()
                                ->load();
                        if (!empty($attributeRigSize->getData()))
                            foreach ($attributeRigSize as $ringSize => $val) {
                                $rSize[] = [
                                    // 'value' => $val->getOptionId(),
                                    'label' => $val->getValue()
                                ];
                            }
                    }

                    


            //$AllRingSize = array_column($rSize, 'label');

                $ring_min = min($AllRingSize);
                $ring_max = max($AllRingSize);
                //$defaultRingOptionId = $resultDiamondClarity[0]['ring_size'];
                $optionId = $RingSize;
                $attributeOptionSingle = $objectManager->get(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                        ->setPositionOrder('asc')
                        ->setAttributeFilter($attributeId)
                        ->setIdFilter($optionId)
                        ->setStoreFilter()
                        ->load()
                        ->getFirstItem();
                $ring_size_default = $attributeOptionSingle->getValue();

                $sqlRingSize = "SELECT * FROM sm_sizecharge WHERE sizecharge_category='" . $attribute_set_id . "'";
                $resultRingSize = $connection->fetchRow($sqlRingSize);


            /* Metal Price Calulation */
            /* New logic here */
            if ($resultSetName[0]['type_makingcharge'] == 0) { // Making Charge In Per Gram
                if ($resultRingSize['size_price'] == 1) {  // Ring Size charge in Percent
                            if ($ring_min <= $ring_size_default) {
                                $makingChargeInPercent = $resultSetName[0]['makingcharge_price'];
                                $ringdiffMin = array_search($ring_size_default, $AllRingSize);
                                //$ringdiffMin = $ring_size_default - $ring_min;  
                                if ($ringdiffMin == 0) {
                                    $makingChargeTotal = ($makingChargeInPercent * $finalMetalWeigth);
                                    $metalTotalPrice = $resultMetal[0]['price'] * $finalMetalWeigth;
                                } else {
                                    //echo $ringdiffMin;
                                    $makingChargeCal = (($resultRingSize['change_size_price'] * $makingChargeInPercent * $finalMetalWeigth) / 100);
                                    $makingChargeTotal = ($makingChargeCal + $makingChargeInPercent * $finalMetalWeigth);
                                    $metalTotalPrice = $resultMetal[0]['price'] * $finalMetalWeigth;
                                }
                                if ($attribute_set_name != 'Bangel Size' && $attribute_set_name != 'Chain') {

                                for ($s = 0; $s < $comCnt; $s++) {
                                    $sqlDiamond1 = "SELECT * FROM sm_diamondprice WHERE metal_purity_id='" . $diamond_clarity_id . "' AND combination ='" . $combination[$s] . "'";
                                    $resultDiamondClarityFinal = $connection->fetchRow($sqlDiamond1);
                                    $diamondTotalPriceArr[] = $diamondData['carat'][$s] * $resultDiamondClarityFinal['price'];
                                }
                                $diamondTotalPrice = array_sum($diamondTotalPriceArr);
                                }
                                /* Making Charges In Per Gram */
                            } elseif ($ring_max >= $ring_size_default) {

                        $ringdiffMax = array_search($ring_size_default, $AllRingSize);
                        // $ringdiffMax = abs($ring_max - $ring_size_default);
                        $makingChargeInPercent = $resultRingSize['change_size_price'];
                        if ($ringdiffMax == 0) {
                            $makingChargeTotal = $makingChargeInPercent * $finalMetalWeigth;
                        } else {
                            $makingChargeTotal = ($makingChargeInPercent * $finalMetalWeigth + $makingChargeInPercent);
                        }
                        $metalTotalPrice = $resultMetal[0]['price'] * $finalMetalWeigth;
                        if ($attribute_set_name != 'Bangel Size' && $attribute_set_name != 'Chain') {
                        for ($s = 0; $s < $comCnt; $s++) {
                            $sqlDiamond1 = "SELECT * FROM sm_diamondprice WHERE metal_purity_id='" . $diamond_clarity_id . "' AND combination ='" . $combination[$s] . "'";
                            $resultDiamondClarityFinal = $connection->fetchRow($sqlDiamond1);
                            $diamondTotalPriceArr[] = $diamondData['carat'][$s] * $resultDiamondClarityFinal['price'];
                        }
                        $diamondTotalPrice = array_sum($diamondTotalPriceArr);
                        }
                        /* Making Charges In Per Gram */
                    }
                } else {
                    // Ring Size charge Fixed
                    $ringSizeFixed = $resultRingSize['change_size_price'];
                    $makingChargeTotal = $ringSizeFixed; //($ringdiffMin * $ringSizeFixed);
                    $metalTotalPrice = $resultMetal[0]['price'] * $finalMetalWeigth;
                    if ($attribute_set_name != 'Bangel Size' && $attribute_set_name != 'Chain') {
                    for ($s = 0; $s < $comCnt; $s++) {
                        $sqlDiamond1 = "SELECT * FROM sm_diamondprice WHERE metal_purity_id='" . $diamond_clarity_id . "' AND combination ='" . $combination[$s] . "'";
                        $resultDiamondClarityFinal = $connection->fetchRow($sqlDiamond1);
                        $diamondTotalPriceArr[] = $diamondData['carat'][$s] * $resultDiamondClarityFinal['price'];
                    }
                    $diamondTotalPrice = array_sum($diamondTotalPriceArr);
                    }
                }
            } else { // Making Charge Fixed
                $makingChargePrice = $resultSetName[0]['makingcharge_price'];
                if ($resultSetName[0]['type_makingcharge'] == 1) { //Making Charge Fixed
                    $makingChargeTotal = $makingChargePrice + $RingSize;
                    $metalTotalPrice = ($resultMetal[0]['price'] * $finalMetalWeigth + $RingSize);
                } else { //Making Charge In Per Gram
                    $makingChargeTotal = ($resultSetName[0]['makingcharge_price'] * $finalMetalWeigth)+ $RingSize;
                    $metalTotalPrice = $resultMetal[0]['price'] * $finalMetalWeigth + $RingSize;
                }
                if ($attribute_set_name != 'Bangel Size' && $attribute_set_name != 'Chain') {
                for ($s = 0; $s < $comCnt; $s++) {
                    $sqlDiamond1 = "SELECT * FROM sm_diamondprice WHERE metal_purity_id='" . $diamond_clarity_id . "' AND combination ='" . $combination[$s] . "'";
                    $resultDiamondClarityFinal = $connection->fetchRow($sqlDiamond1);
                    $diamondTotalPriceArr[] = $diamondData['carat'][$s] * $resultDiamondClarityFinal['price'];
                    // $diamondTotalPrice = $resultDiamondClarityFinal['weight_in_carat'] * $resultDiamondClarityFinal['price'];
                }
                $diamondTotalPrice = array_sum($diamondTotalPriceArr);
                }


            }
            /* New logic End here */
        } else {  // If Attribute set not a Rings
            $makingChargePrice = $resultSetName[0]['makingcharge_price'];
            if ($resultSetName[0]['type_makingcharge'] == 1) { //Making Charge Fixed
                $makingChargeTotal = $makingChargePrice;
                $metalTotalPrice = ($resultMetal[0]['price'] * $finalMetalWeigth);
            } else { //Making Charge In Per Gram
                $makingChargeTotal = ($resultSetName[0]['makingcharge_price'] * $finalMetalWeigth);
                $metalTotalPrice = $resultMetal[0]['price'] * $finalMetalWeigth;
            }

                    /*diamond discount*/
                    if($attribute_set_name == 'Bangel Size'){ $discount_diamond = $bangel_size; }
                    if($attribute_set_name == 'Chain'){ $discount_diamond = $chain; }
                    if($attribute_set_name == 'Default'){ $discount_diamond = $default; }
                    if($attribute_set_name == 'Earring'){ $discount_diamond = $earring; }
                    if($attribute_set_name == 'Mangalsutra'){ $discount_diamond = $mangalsutra; }
                    if($attribute_set_name == 'Necklace'){ $discount_diamond = $necklace; }
                    if($attribute_set_name == 'Nose Pin'){ $discount_diamond = $nose_pin; }
                    if($attribute_set_name == 'Pendants'){ $discount_diamond = $pendants;}
                    if($attribute_set_name == 'Ring'){ $discount_diamond = $ring;}
                    /*making charge*/
                    if($attribute_set_name == 'Bangel Size'){ $discount_making = $bangel_size1; }
                    if($attribute_set_name == 'Chain'){ $discount_making = $chain1; }
                    if($attribute_set_name == 'Default'){ $discount_making = $default1; }
                    if($attribute_set_name == 'Earring'){ $discount_making = $earring1; }
                    if($attribute_set_name == 'Mangalsutra'){ $discount_making = $mangalsutra1; }
                    if($attribute_set_name == 'Necklace'){ $discount_making = $necklace1; }
                    if($attribute_set_name == 'Nose Pin'){ $discount_making = $nose_pin1; }
                    if($attribute_set_name == 'Pendants'){ $discount_making = $pendants1;}
                    if($attribute_set_name == 'Ring'){ $discount_making = $ring1;}


            if ($attribute_set_name != 'Necklace' && $attribute_set_name != 'Bangel Size' && $attribute_set_name != 'Chain') {
            for ($s = 0; $s < $comCnt; $s++) {
                $sqlDiamond1 = "SELECT * FROM sm_diamondprice WHERE metal_purity_id='" . $diamond_clarity_id . "' AND combination ='" . $combination[$s] . "'";
                $resultDiamondClarityFinal = $connection->fetchRow($sqlDiamond1);
                $diamondTotalPriceArr[] = $diamondData['carat'][$s] * $resultDiamondClarityFinal['price'];
                // $diamondTotalPrice = $resultDiamondClarityFinal['weight_in_carat'] * $resultDiamondClarityFinal['price'];
            }

            $diamondTotalPrice = array_sum($diamondTotalPriceArr);
            }
        }
        /* Metal Growss Weight */
        $grossweight = $finalMetalGrossWeight . ' Gms';

        /* Metal Weight */
        $metalWeight = $finalMetalWeigth . ' Gms';

        /* Metal Type */
        $attributeCode = 'metal_type';
        $entityType = 'catalog_product';
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeInfo = $objectManager->create(\Magento\Eav\Model\Entity\Attribute::class)
                ->loadByCode($entityType, $attributeCode);
        $attributeId = $attributeInfo->getAttributeId();
        $attributeOptionSingle = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                ->setPositionOrder('asc')
                ->setAttributeFilter($attributeId)
                ->setIdFilter($metal_option_id)
                ->setStoreFilter()
                ->load()
                ->getFirstItem();
        $selectedMetalType = $attributeOptionSingle->getData();
        $metalType = $selectedMetalType['default_value'];

        /* Metal Purity */
        if ($attribute_set_name != 'Chain') {
        $attributeCode = 'metal_purity';
        $entityType = 'catalog_product';
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $attributeInfo = $objectManager->create(\Magento\Eav\Model\Entity\Attribute::class)
                ->loadByCode($entityType, $attributeCode);
        $attributeId = $attributeInfo->getAttributeId();
        $attributeOptionSingle = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                ->setPositionOrder('asc')
                ->setAttributeFilter($attributeId)
                ->setIdFilter($purity_option_id)
                ->setStoreFilter()
                ->load()
                ->getFirstItem();
        $selectedMetalPurity = $attributeOptionSingle->getData();
        $metalPurity = $selectedMetalPurity['default_value'];
    }
        
        if ($attribute_set_name != 'Necklace' && $attribute_set_name != 'Bangel Size' && $attribute_set_name != 'Chain') {
            /* Diamond Clarity + Diamond Color */
            $attributeCode = 'diamond_colour_clarity';
            $entityType = 'catalog_product';
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $attributeInfo = $objectManager->create(\Magento\Eav\Model\Entity\Attribute::class)
                    ->loadByCode($entityType, $attributeCode);
            $attributeId = $attributeInfo->getAttributeId();
            $attributeOptionSingle = $objectManager->create(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\Collection::class)
                    ->setPositionOrder('asc')
                    ->setAttributeFilter($attributeId)
                    ->setIdFilter($diamond_clarity_id)
                    ->setStoreFilter()
                    ->load()
                    ->getFirstItem();
            $selectedDiamondColorClarity = $attributeOptionSingle->getData();
            /* For Color And Clarity */
           // $diamondweight = $selectedDiamondColorClarity['weight_in_carat'];
            $diamondColorSelec = $selectedDiamondColorClarity['default_value'];
            $allVariablePrice = round($metalTotalPrice + $diamondTotalPrice + $makingChargeTotal, 2);
            $vatTotal = ($allVariablePrice * 3) / 100;
            $FinalProductTotal = $allVariablePrice + $vatTotal;


                        /*diamond discount*/
                        if($attribute_set_name == 'Bangel Size'){ $discount_diamond = $bangel_size; }
                        if($attribute_set_name == 'Chain'){ $discount_diamond = $chain; }
                        if($attribute_set_name == 'Default'){ $discount_diamond = $default; }
                        if($attribute_set_name == 'Earring'){ $discount_diamond = $earring; }
                        if($attribute_set_name == 'Mangalsutra'){ $discount_diamond = $mangalsutra; }
                        if($attribute_set_name == 'Necklace'){ $discount_diamond = $necklace; }
                        if($attribute_set_name == 'Nose Pin'){ $discount_diamond = $nose_pin; }
                        if($attribute_set_name == 'Pendants'){ $discount_diamond = $pendants;}
                        if($attribute_set_name == 'Ring'){ $discount_diamond = $ring;}
                        /*making charge*/
                        if($attribute_set_name == 'Bangel Size'){ $discount_making = $bangel_size1; }
                        if($attribute_set_name == 'Chain'){ $discount_making = $chain1; }
                        if($attribute_set_name == 'Default'){ $discount_making = $default1; }
                        if($attribute_set_name == 'Earring'){ $discount_making = $earring1; }
                        if($attribute_set_name == 'Mangalsutra'){ $discount_making = $mangalsutra1; }
                        if($attribute_set_name == 'Necklace'){ $discount_making = $necklace1; }
                        if($attribute_set_name == 'Nose Pin'){ $discount_making = $nose_pin1; }
                        if($attribute_set_name == 'Pendants'){ $discount_making = $pendants1;}
                        if($attribute_set_name == 'Ring'){ $discount_making = $ring1;}



            // $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
            // $_product = $objectManager->create('Magento\Catalog\Model\Product')->load($product_id);
            // $discount_diamond = $_product->getResource()->getAttribute('diamond_discount')->getFrontend()->getValue($_product);
            // $discount_making = $_product->getResource()->getAttribute('discount_making')->getFrontend()->getValue($_product);
            
            $price_total = $discount_diamond-$discount_making;
            $diamondTotalPrice1 = $diamondTotalPrice*$discount_diamond/100;
            $makingChargeTotal1 = $makingChargeTotal*$discount_making/100;
            $ddiscount = $diamondTotalPrice-$diamondTotalPrice1;
            $dataReturn = array(
                'metalTotalPrice' => ($metalTotalPrice),
                'special' => ($diamondTotalPrice),
                'diamondTotalPrice' => (round($ddiscount, 2)),
                'specialMaking' => (round($makingChargeTotal, 2)),
                'makingChargeTotal' => (round($makingChargeTotal, 2)-$makingChargeTotal1),
                'vatTotal' => round($vatTotal, 2),
                'metalWeight' => $metalWeight,
                'grossweight' => $grossweight,
                'metalType' => $metalType,
                'metalPurity' => $metalPurity,
                'diamondcolor' => $diamondColorSelec,
                'finalProductTotal1' => round($FinalProductTotal, 2),
                'diamondclarity' => '',
                // 'diamondweight' => $diamondweight,
                'finalProductTotal' => round($FinalProductTotal-$diamondTotalPrice1-$makingChargeTotal1, 2));
            $jsomReturn = json_encode($dataReturn);
            echo $jsomReturn;
        } else {
            if ($attribute_set_name == 'Chain'){
                $metalPurity = '';
                if ($RingSize !='') {
                    $makingChargeTotal1 = $makingChargeTotal*$discount_making/100+$RingSize;
                    $metalTotalPrice = $metalTotalPrice+$RingSize;
                }if ($RingSize1 !='') {
                    $makingChargeTotal1 = $makingChargeTotal*$discount_making/100+$RingSize1;
                    $metalTotalPrice = $metalTotalPrice+$RingSize1;
                }else{
                    $makingChargeTotal1 = $makingChargeTotal*$discount_making/100;
                }
                
            }else{$makingChargeTotal1 = $makingChargeTotal*$discount_making/100;}
            
            $allVariablePrice = round($metalTotalPrice + $makingChargeTotal + $fancyStonePrice, 2);
            $vatTotal = ($allVariablePrice * 3) / 100;
            $FinalProductTotal = $allVariablePrice + $vatTotal;
            $price_total = $discount_diamond-$discount_making;
            $diamondTotalPrice1 = $diamondTotalPrice*$discount_diamond/100;
            
            $dataReturn = array(
                'metalTotalPrice' => ($metalTotalPrice),
                'special' => ($diamondTotalPrice),
                'diamondTotalPrice' => ($diamondTotalPrice-$diamondTotalPrice1),
                'fancyStonePrice' => $fancyStonePrice,
                'specialMaking' => (round($makingChargeTotal, 2)),
                'makingChargeTotal' => (round($makingChargeTotal, 2)-$makingChargeTotal1),
                'vatTotal' => round($vatTotal, 2),
                'metalWeight' => $metalWeight,
                'grossweight' => $grossweight,
                'metalType' => $metalType,
                'metalPurity' => $metalPurity,
                'diamondcolor' => '',
                'finalProductTotal1' => round($FinalProductTotal, 2),
                'diamondclarity' => '',
                // 'diamondweight' => $diamondweight,
                'finalProductTotal' => round($FinalProductTotal, 2)-$diamondTotalPrice1-$makingChargeTotal1);
            $jsomReturn = json_encode($dataReturn);
            echo $jsomReturn;
        }
        //return $this->_resultsPageFactory->create();
    }

}
