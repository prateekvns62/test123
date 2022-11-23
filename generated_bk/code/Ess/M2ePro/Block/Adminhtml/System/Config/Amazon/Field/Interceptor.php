<?php
namespace Ess\M2ePro\Block\Adminhtml\System\Config\Amazon\Field;

/**
 * Interceptor class for @see \Ess\M2ePro\Block\Adminhtml\System\Config\Amazon\Field
 */
class Interceptor extends \Ess\M2ePro\Block\Adminhtml\System\Config\Amazon\Field implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Ess\M2ePro\Helper\Module $moduleHelper, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $moduleHelper, $data);
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
