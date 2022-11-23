<?php
/**
 * @author Prateek Kumar Singh
 * @copyright Copyright (c) 2022 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_AreaPriceCalculator
 */

namespace Tech9logy\ExtendWarranty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    /**
     * @var Context
     */
    protected $context;

    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $messageManager;
    protected $storeManager;
    protected $orderCollectionFactory;

    public function __construct(
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        StoreManagerInterface $storeManager,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        Context $context
        
    )
    {
        $this->messageManager = $messageManager;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->context = $context;
        $this->storeManager = $storeManager;
        $this->orderCollectionFactory = $orderCollectionFactory;
        parent::__construct($context);
    }

    public function isExtendWarrantyEnabled()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_extendWarranty/general/enable', ScopeInterface::SCOPE_STORE);
    }

    public function isWarrantyEnable()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_extendWarranty/warranty/enable_warranty', ScopeInterface::SCOPE_STORE);
    }
	public function getWarrantyTime()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/warranty/warranty_time', ScopeInterface::SCOPE_STORE);
    }
	public function getWarrantyCharges()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/warranty/warranty_charges', ScopeInterface::SCOPE_STORE);
    }
	public function getWarrantyMsg()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/warranty/warranty_msg', ScopeInterface::SCOPE_STORE);
    }
	public function getWarrantyLogo()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/warranty/warranty_logo', ScopeInterface::SCOPE_STORE);
    }
	public function isWarrantyVisibleforAll()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_extendWarranty/warranty/warranty_visible_for_all', ScopeInterface::SCOPE_STORE);
    }
	public function getWarrantyEnabledCategory()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/warranty/warranty_selected_category', ScopeInterface::SCOPE_STORE);
    }


    public function isRecycleEnable()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_extendWarranty/recycle/enable_recycle_option', ScopeInterface::SCOPE_STORE);
    }
	public function getRecycleCharges()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/recycle/recycle_charges', ScopeInterface::SCOPE_STORE);
    }
	public function getRecycleMsg()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/recycle/recycle_msg', ScopeInterface::SCOPE_STORE);
    }
	public function getRecycleLogo()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/recycle/recycle_logo', ScopeInterface::SCOPE_STORE);
    }
	public function isRecycleVisibleforAll()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_extendWarranty/recycle/recycle_visible_for_all', ScopeInterface::SCOPE_STORE);
    }
	public function getRecycleEnabledCategory()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/recycle/recycle_selected_category', ScopeInterface::SCOPE_STORE);
    }
	
	
    public function isUnwrapRecycleEnable()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_extendWarranty/unwrap/enable_unwrap_recycle', ScopeInterface::SCOPE_STORE);
    }
	public function getUnwrapRecycleCharges()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/unwrap/unwrap_recycle_charges', ScopeInterface::SCOPE_STORE);
    }
	public function getUnwrapRecycleMsg()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/unwrap/unwrap_msg', ScopeInterface::SCOPE_STORE);
    }
	public function getUnwrapRecycleLogo()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/unwrap/unwrap_logo', ScopeInterface::SCOPE_STORE);
    }
	public function isUnwrapRecycleVisibleforAll()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_extendWarranty/unwrap/unwrap_recycle_visible_for_all', ScopeInterface::SCOPE_STORE);
    }
	public function getUnwrapRecycleEnabledCategory()
    {
        return $this->scopeConfig->getValue('tech9logy_extendWarranty/unwrap/unwrap_recycle_selected_category', ScopeInterface::SCOPE_STORE);
    }
}
