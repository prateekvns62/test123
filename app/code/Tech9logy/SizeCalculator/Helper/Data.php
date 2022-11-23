<?php
/**
 * @author Prateek Kumar Singh
 * @copyright Copyright (c) 2022 Tech9logy (https://www.tech9logy.com/)
 * @package Tech9logy_GuestToCustomer
 */

namespace Tech9logy\SizeCalculator\Helper;

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

    public function isSizeCalculatorEnabled()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_sizeCalculator/general/enable', ScopeInterface::SCOPE_STORE);
    }

    public function getPackagePerUnitValue()
    {
        return $this->scopeConfig->getValue('tech9logy_sizeCalculator/general/package_unit_value', ScopeInterface::SCOPE_STORE);
    }

    public function getPackageDefaultUnit()
    {
        return $this->scopeConfig->getValue('tech9logy_sizeCalculator/general/package_default_unit', ScopeInterface::SCOPE_STORE);
    }

    public function isVisibleforAll()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_sizeCalculator/general/visible_for_all', ScopeInterface::SCOPE_STORE);
    }

    public function getSelectedCategory()
    {
        return $this->scopeConfig->getValue('tech9logy_sizeCalculator/general/selected_category', ScopeInterface::SCOPE_STORE);
    }

    public function isWastageEnable()
    {
        return (boolean) $this->scopeConfig->getValue('tech9logy_sizeCalculator/general/enable_wastage', ScopeInterface::SCOPE_STORE);
    }

    public function getWastagePercentage()
    {
        return $this->scopeConfig->getValue('tech9logy_sizeCalculator/general/wastage_percentage', ScopeInterface::SCOPE_STORE);
    }
}
