<?php
namespace Ebizmarts\SagePaySuite\Controller\Token\Delete;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Token\Delete
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Token\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Psr\Log\LoggerInterface $logger, \Ebizmarts\SagePaySuite\Model\Token $tokenModel, \Magento\Customer\Model\Session $customerSession)
    {
        $this->___init();
        parent::__construct($context, $suiteLogger, $logger, $tokenModel, $customerSession);
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
