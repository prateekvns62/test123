<?php
namespace Ebizmarts\SagePaySuite\Controller\PI\Failure;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\PI\Failure
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\PI\Failure implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Checkout\Model\Type\Onepage $onepage, \Ebizmarts\SagePaySuite\Model\Config $config, \Magento\Quote\Api\CartRepositoryInterface $quoteRepository, \Ebizmarts\SagePaySuite\Model\RecoverCart $recoverCart)
    {
        $this->___init();
        parent::__construct($context, $onepage, $config, $quoteRepository, $recoverCart);
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
