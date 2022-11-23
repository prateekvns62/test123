<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Success;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Success
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Success implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Magento\Sales\Model\Order\Payment\TransactionFactory $transactionFactory, \Ebizmarts\SagePaySuite\Helper\Checkout $checkoutHelper, \Ebizmarts\SagePaySuite\Model\Form $formModel, \Magento\Backend\Model\Session\Quote $quoteSession, \Magento\Quote\Model\QuoteManagement $quoteManagement, \Ebizmarts\SagePaySuite\Model\Config\ClosedForActionFactory $actionFactory)
    {
        $this->___init();
        parent::__construct($context, $config, $suiteLogger, $transactionFactory, $checkoutHelper, $formModel, $quoteSession, $quoteManagement, $actionFactory);
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
