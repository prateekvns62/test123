<?php
namespace Amasty\ShippingTableRates\Controller\Adminhtml\Rates\Save;

/**
 * Interceptor class for @see \Amasty\ShippingTableRates\Controller\Adminhtml\Rates\Save
 */
class Interceptor extends \Amasty\ShippingTableRates\Controller\Adminhtml\Rates\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context, \Amasty\ShippingTableRates\Helper\Data $helperSTR, \Amasty\ShippingTableRates\Model\RateFactory $rateFactory)
    {
        $this->___init();
        parent::__construct($coreRegistry, $context, $helperSTR, $rateFactory);
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
