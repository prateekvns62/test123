<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Order\SyncFromApi;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\Order\SyncFromApi
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\Order\SyncFromApi implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Api\Reporting $reportingApi, \Magento\Sales\Model\OrderRepository $orderRepository, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Ebizmarts\SagePaySuite\Helper\Fraud $fraudHelper, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Magento\Sales\Model\Order\Payment\Transaction\Repository $transactionRepository)
    {
        $this->___init();
        parent::__construct($context, $reportingApi, $orderRepository, $suiteLogger, $fraudHelper, $suiteHelper, $transactionRepository);
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
