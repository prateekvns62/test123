<?php
namespace Ess\M2ePro\Helper\Module\Translation;

/**
 * Interceptor class for @see \Ess\M2ePro\Helper\Module\Translation
 */
class Interceptor extends \Ess\M2ePro\Helper\Module\Translation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Helper\Factory $helperFactory, \Magento\Framework\App\Helper\Context $context)
    {
        $this->___init();
        parent::__construct($helperFactory, $context);
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
