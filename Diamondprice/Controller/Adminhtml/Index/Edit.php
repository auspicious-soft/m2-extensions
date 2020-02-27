<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SM\Diamondprice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SM_Diamondprice::sm_diamondprice');
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
       
        
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SM_Diamondprice::sm_diamondprice')
            ->addBreadcrumb(__('Diamond Price'), __('Diamond Price'))
            ->addBreadcrumb(__('Manage Diamond Price'), __('Add Diamond Price (All Prices are in Dollar/ Per Karat)'));
        return $resultPage;
    }

    /**
     * Edit CMS page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
//        $resultPage->addBreadcrumb(
//            $id ? __('Edit Diamond Price') : __('New Diamond Price'),
//            $id ? __('Edit Diamond Price') : __('New Diamond Price')
//        );
        $resultPage->getConfig()->getTitle()->prepend(__('Add Diamond Price (All Prices are in dollar/ Per Karat)'));
//        $resultPage->getConfig()->getTitle()
//            ->prepend($model->getId() ? __('Edit "%1"', $model->getTitle()) : __('New Diamond Price'));
        
        return $resultPage;
    }
}
