<?php
namespace Magento\Directory\Block\Adminhtml\Frontend\Region\Updater;

/**
 * Interceptor class for @see \Magento\Directory\Block\Adminhtml\Frontend\Region\Updater
 */
class Interceptor extends \Magento\Directory\Block\Adminhtml\Frontend\Region\Updater implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Directory\Helper\Data $directoryHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $directoryHelper, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'render');
        if (!$pluginInfo) {
            return parent::render($element);
        } else {
            return $this->___callPlugins('render', func_get_args(), $pluginInfo);
        }
    }
}
