<?php
namespace Ebizmarts\SagePaySuite\Controller\Form\Failure;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Form\Failure
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Form\Failure implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Psr\Log\LoggerInterface $logger, \Ebizmarts\SagePaySuite\Model\Form $formModel, \Magento\Sales\Model\OrderFactory $orderFactory, \Magento\Quote\Model\QuoteFactory $quoteFactory, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Framework\Encryption\EncryptorInterface $encryptor, \Ebizmarts\SagePaySuite\Model\RecoverCart $recoverCart)
    {
        $this->___init();
        parent::__construct($context, $suiteLogger, $logger, $formModel, $orderFactory, $quoteFactory, $checkoutSession, $encryptor, $recoverCart);
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
