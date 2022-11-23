<?php
namespace Ebizmarts\SagePaySuite\Controller\Cart\Recover;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Cart\Recover
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Cart\Recover implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\RecoverCart $recoverCart)
    {
        $this->___init();
        parent::__construct($context, $recoverCart);
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
