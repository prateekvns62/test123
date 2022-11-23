<?php
namespace Trustpilot\Reviews\Block\System\Config\Admin;

/**
 * Interceptor class for @see \Trustpilot\Reviews\Block\System\Config\Admin
 */
class Interceptor extends \Trustpilot\Reviews\Block\System\Config\Admin implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Trustpilot\Reviews\Helper\Data $helper, \Trustpilot\Reviews\Helper\PastOrders $pastOrders, \Trustpilot\Reviews\Helper\TrustpilotLog $trustpilotLog, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $helper, $pastOrders, $trustpilotLog, $data);
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
