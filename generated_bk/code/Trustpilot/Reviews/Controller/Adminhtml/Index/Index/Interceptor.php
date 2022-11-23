<?php
namespace Trustpilot\Reviews\Controller\Adminhtml\Index\Index;

/**
 * Interceptor class for @see \Trustpilot\Reviews\Controller\Adminhtml\Index\Index
 */
class Interceptor extends \Trustpilot\Reviews\Controller\Adminhtml\Index\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Trustpilot\Reviews\Helper\Data $helper, \Trustpilot\Reviews\Helper\PastOrders $pastOrders, \Trustpilot\Reviews\Helper\Products $products)
    {
        $this->___init();
        parent::__construct($context, $helper, $pastOrders, $products);
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
