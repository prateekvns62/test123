<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\PI\GenerateMerchantKey;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\PI\GenerateMerchantKey
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\PI\GenerateMerchantKey implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\PiMsk $piMsk)
    {
        $this->___init();
        parent::__construct($context, $piMsk);
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
