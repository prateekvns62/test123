<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Repeat\Request;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\Repeat\Request
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\Repeat\Request implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Magento\Backend\Model\Session\Quote $quoteSession, \Ebizmarts\SagePaySuite\Helper\Checkout $checkoutHelper, \Magento\Quote\Model\QuoteManagement $quoteManagement, \Ebizmarts\SagePaySuite\Helper\Request $requestHelper, \Ebizmarts\SagePaySuite\Model\Api\Shared $sharedApi, \Magento\Sales\Model\Order\Payment\TransactionFactory $transactionFactory, \Ebizmarts\SagePaySuite\Model\Config\ClosedForActionFactory $actionFactory)
    {
        $this->___init();
        parent::__construct($context, $config, $suiteHelper, $suiteLogger, $quoteSession, $checkoutHelper, $quoteManagement, $requestHelper, $sharedApi, $transactionFactory, $actionFactory);
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
