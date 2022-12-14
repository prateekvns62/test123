<?php
namespace Magento\MediaStorage\Block\System\Config\System\Storage\Media\Synchronize;

/**
 * Interceptor class for @see \Magento\MediaStorage\Block\System\Config\System\Storage\Media\Synchronize
 */
class Interceptor extends \Magento\MediaStorage\Block\System\Config\System\Storage\Media\Synchronize implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\MediaStorage\Model\File\Storage $fileStorage, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $fileStorage, $data);
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
