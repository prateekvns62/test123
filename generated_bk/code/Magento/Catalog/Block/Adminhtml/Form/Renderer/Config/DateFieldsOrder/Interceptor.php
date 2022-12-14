<?php
namespace Magento\Catalog\Block\Adminhtml\Form\Renderer\Config\DateFieldsOrder;

/**
 * Interceptor class for @see \Magento\Catalog\Block\Adminhtml\Form\Renderer\Config\DateFieldsOrder
 */
class Interceptor extends \Magento\Catalog\Block\Adminhtml\Form\Renderer\Config\DateFieldsOrder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $data);
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
