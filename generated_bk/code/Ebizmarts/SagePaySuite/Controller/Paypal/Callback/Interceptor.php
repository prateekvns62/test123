<?php
namespace Ebizmarts\SagePaySuite\Controller\Paypal\Callback;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Paypal\Callback
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Paypal\Callback implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Checkout\Model\Session $checkoutSession, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Ebizmarts\SagePaySuite\Model\Api\Post $postApi, \Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Ebizmarts\SagePaySuite\Model\OrderUpdateOnCallback $updateOrderCallback, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Magento\Framework\Encryption\EncryptorInterface $encryptor, \Ebizmarts\SagePaySuite\Model\RecoverCart $recoverCart, \Ebizmarts\SagePaySuite\Model\ObjectLoader\OrderLoader $orderLoader, \Ebizmarts\SagePaySuite\Helper\CustomerLogin $customerLogin)
    {
        $this->___init();
        parent::__construct($context, $checkoutSession, $config, $suiteLogger, $postApi, $quote, $quoteRepository, $updateOrderCallback, $suiteHelper, $encryptor, $recoverCart, $orderLoader, $customerLogin);
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
