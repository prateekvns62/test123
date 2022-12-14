<?php
namespace Vertex\Tax\Block\Adminhtml\Config\Form\Field\VertexStatus;

/**
 * Interceptor class for @see \Vertex\Tax\Block\Adminhtml\Config\Form\Field\VertexStatus
 */
class Interceptor extends \Vertex\Tax\Block\Adminhtml\Config\Form\Field\VertexStatus implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Vertex\Tax\Model\Config $config, \Vertex\Tax\Model\ConfigurationValidator $configurationValidator, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $config, $configurationValidator, $data);
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
