<?php
namespace Ebizmarts\SagePaySuite\Controller\PI\Callback3D;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\PI\Callback3D
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\PI\Callback3D implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\PiRequestManagement\ThreeDSecureCallbackManagement $requester, \Ebizmarts\SagePaySuite\Api\Data\PiRequestManagerFactory $piReqManagerFactory, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Ebizmarts\SagePaySuite\Model\CryptAndCodeData $cryptAndCode, \Magento\Checkout\Model\Session $checkoutSession, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Ebizmarts\SagePaySuite\Helper\CustomerLogin $customerLogin)
    {
        $this->___init();
        parent::__construct($context, $config, $requester, $piReqManagerFactory, $orderRepository, $cryptAndCode, $checkoutSession, $suiteLogger, $customerLogin);
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
