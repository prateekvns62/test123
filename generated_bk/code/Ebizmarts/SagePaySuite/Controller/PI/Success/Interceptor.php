<?php
namespace Ebizmarts\SagePaySuite\Controller\PI\Success;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\PI\Success
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\PI\Success implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Checkout\Model\Type\Onepage $onepage, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\ObjectLoader\OrderLoader $orderLoader)
    {
        $this->___init();
        parent::__construct($context, $onepage, $config, $orderLoader);
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
