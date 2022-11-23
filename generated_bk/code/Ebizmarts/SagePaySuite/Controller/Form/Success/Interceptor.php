<?php
namespace Ebizmarts\SagePaySuite\Controller\Form\Success;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Form\Success
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Form\Success implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Checkout\Model\Session $checkoutSession, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Ebizmarts\SagePaySuite\Model\Form $formModel, \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender, \Ebizmarts\SagePaySuite\Model\OrderUpdateOnCallback $updateOrderCallback, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Magento\Framework\Encryption\EncryptorInterface $encryptor, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Ebizmarts\SagePaySuite\Model\ObjectLoader\OrderLoader $orderLoader)
    {
        $this->___init();
        parent::__construct($context, $checkoutSession, $suiteLogger, $formModel, $orderSender, $updateOrderCallback, $suiteHelper, $encryptor, $quoteRepository, $orderLoader);
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
