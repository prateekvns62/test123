<?php
namespace Amasty\ShippingTableRates\Controller\Adminhtml\Rates\Grid;

/**
 * Interceptor class for @see \Amasty\ShippingTableRates\Controller\Adminhtml\Rates\Grid
 */
class Interceptor extends \Amasty\ShippingTableRates\Controller\Adminhtml\Rates\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($context);
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
