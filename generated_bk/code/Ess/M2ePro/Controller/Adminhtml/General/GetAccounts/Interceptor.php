<?php
namespace Ess\M2ePro\Controller\Adminhtml\General\GetAccounts;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\General\GetAccounts
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\General\GetAccounts implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($context);
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
