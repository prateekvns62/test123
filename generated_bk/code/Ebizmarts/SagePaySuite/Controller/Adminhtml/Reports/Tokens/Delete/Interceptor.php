<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Reports\Tokens\Delete;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\Reports\Tokens\Delete
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\Reports\Tokens\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Psr\Log\LoggerInterface $logger, \Ebizmarts\SagePaySuite\Model\Token $tokenModel)
    {
        $this->___init();
        parent::__construct($context, $suiteLogger, $logger, $tokenModel);
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
