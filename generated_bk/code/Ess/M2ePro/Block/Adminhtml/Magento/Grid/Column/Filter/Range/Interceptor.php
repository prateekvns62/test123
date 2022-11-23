<?php
namespace Ess\M2ePro\Block\Adminhtml\Magento\Grid\Column\Filter\Range;

/**
 * Interceptor class for @see \Ess\M2ePro\Block\Adminhtml\Magento\Grid\Column\Filter\Range
 */
class Interceptor extends \Ess\M2ePro\Block\Adminhtml\Magento\Grid\Column\Filter\Range implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Helper\Factory $helperFactory, \Ess\M2ePro\Model\Factory $modelFactory, \Magento\Backend\Block\Context $context, \Magento\Framework\DB\Helper $resourceHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($helperFactory, $modelFactory, $context, $resourceHelper, $data);
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
