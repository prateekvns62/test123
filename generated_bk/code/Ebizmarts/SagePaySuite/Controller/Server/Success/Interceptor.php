<?php
namespace Ebizmarts\SagePaySuite\Controller\Server\Success;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Server\Success
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Server\Success implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Psr\Log\LoggerInterface $logger, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Magento\Framework\Encryption\EncryptorInterface $encryptor, \Ebizmarts\SagePaySuite\Model\ObjectLoader\OrderLoader $orderLoader, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory)
    {
        $this->___init();
        parent::__construct($context, $suiteLogger, $logger, $checkoutSession, $quoteRepository, $encryptor, $orderLoader, $resultRedirectFactory);
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
