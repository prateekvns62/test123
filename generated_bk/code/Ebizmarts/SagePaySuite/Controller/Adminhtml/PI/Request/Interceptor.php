<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\PI\Request;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\PI\Request
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\PI\Request implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Config $config, \Magento\Backend\Model\Session\Quote $quoteSession, \Ebizmarts\SagePaySuite\Model\PiRequestManagement\MotoManagement $requester, \Ebizmarts\SagePaySuite\Api\Data\PiRequestManagerFactory $piReqManagerFactory)
    {
        $this->___init();
        parent::__construct($context, $config, $quoteSession, $requester, $piReqManagerFactory);
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
