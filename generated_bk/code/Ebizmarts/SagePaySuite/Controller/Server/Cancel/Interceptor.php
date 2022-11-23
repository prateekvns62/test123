<?php
namespace Ebizmarts\SagePaySuite\Controller\Server\Cancel;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Server\Cancel
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Server\Cancel implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Ebizmarts\SagePaySuite\Model\Config $config, \Psr\Log\LoggerInterface $logger, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory, \Magento\Framework\Encryption\EncryptorInterface $encryptor, \Ebizmarts\SagePaySuite\Model\RecoverCart $recoverCart)
    {
        $this->___init();
        parent::__construct($context, $suiteLogger, $config, $logger, $checkoutSession, $quote, $quoteIdMaskFactory, $encryptor, $recoverCart);
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
