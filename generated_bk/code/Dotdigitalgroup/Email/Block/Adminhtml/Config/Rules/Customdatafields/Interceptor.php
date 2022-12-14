<?php
namespace Dotdigitalgroup\Email\Block\Adminhtml\Config\Rules\Customdatafields;

/**
 * Interceptor class for @see \Dotdigitalgroup\Email\Block\Adminhtml\Config\Rules\Customdatafields
 */
class Interceptor extends \Dotdigitalgroup\Email\Block\Adminhtml\Config\Rules\Customdatafields implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Dotdigitalgroup\Email\Model\Adminhtml\Source\Rules\Condition $condition, \Dotdigitalgroup\Email\Model\Adminhtml\Source\Rules\Value $value, $data = array())
    {
        $this->___init();
        parent::__construct($context, $condition, $value, $data);
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
