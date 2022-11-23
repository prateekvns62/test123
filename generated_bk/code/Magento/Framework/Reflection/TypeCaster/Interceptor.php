<?php
namespace Magento\Framework\Reflection\TypeCaster;

/**
 * Interceptor class for @see \Magento\Framework\Reflection\TypeCaster
 */
class Interceptor extends \Magento\Framework\Reflection\TypeCaster implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Serialize\Serializer\Json $serializer)
    {
        $this->___init();
        parent::__construct($serializer);
    }

    /**
     * {@inheritdoc}
     */
    public function castValueToType($value, $type)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'castValueToType');
        if (!$pluginInfo) {
            return parent::castValueToType($value, $type);
        } else {
            return $this->___callPlugins('castValueToType', func_get_args(), $pluginInfo);
        }
    }
}
