<?php
namespace Ebizmarts\SagePaySuite\Controller\Server\RedirectToSuccess;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Server\RedirectToSuccess
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Server\RedirectToSuccess implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Psr\Log\LoggerInterface $logger)
    {
        $this->___init();
        parent::__construct($context, $logger);
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
