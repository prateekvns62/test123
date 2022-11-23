<?php
namespace Ebizmarts\SagePaySuite\Controller\Server\Notify;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Server\Notify
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Server\Notify implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\Token $tokenModel, \Ebizmarts\SagePaySuite\Model\OrderUpdateOnCallback $updateOrderCallback, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Magento\Quote\Model\QuoteRepository $cartRepository, \Magento\Framework\Encryption\EncryptorInterface $encryptor, \Ebizmarts\SagePaySuite\Model\ObjectLoader\OrderLoader $orderLoader)
    {
        $this->___init();
        parent::__construct($context, $suiteLogger, $orderSender, $config, $tokenModel, $updateOrderCallback, $suiteHelper, $cartRepository, $encryptor, $orderLoader);
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
