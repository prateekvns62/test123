<?php
namespace Ess\M2ePro\Block\Adminhtml\Magento\Product\Rule\Chooser\Sku;

/**
 * Interceptor class for @see \Ess\M2ePro\Block\Adminhtml\Magento\Product\Rule\Chooser\Sku
 */
class Interceptor extends \Ess\M2ePro\Block\Adminhtml\Magento\Product\Rule\Chooser\Sku implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory $eavAttSetCollection, \Magento\Catalog\Model\Product\Type $catalogType, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $cpCollection, \Ess\M2ePro\Block\Adminhtml\Magento\Context\Template $context, \Magento\Backend\Helper\Data $backendHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($eavAttSetCollection, $catalogType, $cpCollection, $context, $backendHelper, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function __()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, '__');
        if (!$pluginInfo) {
            return parent::__();
        } else {
            return $this->___callPlugins('__', func_get_args(), $pluginInfo);
        }
    }
}
