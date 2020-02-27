<?php

namespace SM\Diamondprice\Block;

class Diamondprice extends \Magento\Framework\View\Element\Template {

    public function _prepareLayout() {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Add Diamond Price (All Prices are in Rupees/ Per Karat)'));
        return $this;
    }

    public function getAdminUrl() {
        $route = "admin/dashboard/index/";
        $params = [];
        return $this->getUrl($route, $params);
    }

    public function getFormAction() {
        return $this->getUrl('sm_diamondprice/index/save', ['_secure' => true]);
    }

}
