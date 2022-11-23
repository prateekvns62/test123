<?php
namespace Wyomind\Core\Block\Adminhtml\System\Config\Form\Field\ActivationKey;

/**
 * Interceptor class for @see \Wyomind\Core\Block\Adminhtml\System\Config\Form\Field\ActivationKey
 */
class Interceptor extends \Wyomind\Core\Block\Adminhtml\System\Config\Form\Field\ActivationKey implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Encryption\EncryptorInterface $encryptor, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $encryptor, $data);
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
