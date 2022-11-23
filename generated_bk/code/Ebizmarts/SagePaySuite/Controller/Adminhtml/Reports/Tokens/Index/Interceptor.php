<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Reports\Tokens\Index;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\Reports\Tokens\Index
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\Reports\Tokens\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Psr\Log\LoggerInterface $logger, \Ebizmarts\SagePaySuite\Model\Api\Reporting $reportingApi)
    {
        $this->___init();
        parent::__construct($context, $logger, $reportingApi);
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
