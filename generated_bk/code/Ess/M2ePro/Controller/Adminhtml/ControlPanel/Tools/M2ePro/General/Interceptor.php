<?php
namespace Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\M2ePro\General;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\M2ePro\General
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\M2ePro\General implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Store\Model\StoreManager $storeManager, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($storeManager, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
