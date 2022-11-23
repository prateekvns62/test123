<?php
namespace Ebizmarts\SagePaySuite\Controller\PI\Callback3Dv2;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\PI\Callback3Dv2
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\PI\Callback3Dv2 implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\PiRequestManagement\ThreeDSecureCallbackManagement $requester, \Ebizmarts\SagePaySuite\Api\Data\PiRequestManagerFactory $piReqManagerFactory, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Ebizmarts\SagePaySuite\Model\CryptAndCodeData $cryptAndCode, \Ebizmarts\SagePaySuite\Model\ObjectLoader\OrderLoader $orderLoader, \Magento\Customer\Model\Session $customerSession, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Ebizmarts\SagePaySuite\Helper\CustomerLogin $customerLogin, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger)
    {
        $this->___init();
        parent::__construct($context, $config, $requester, $piReqManagerFactory, $quoteRepository, $cryptAndCode, $orderLoader, $customerSession, $customerRepository, $customerLogin, $suiteLogger);
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
