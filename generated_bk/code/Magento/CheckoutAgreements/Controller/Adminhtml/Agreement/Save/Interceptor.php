<?php
namespace Magento\CheckoutAgreements\Controller\Adminhtml\Agreement\Save;

/**
 * Interceptor class for @see \Magento\CheckoutAgreements\Controller\Adminhtml\Agreement\Save
 */
class Interceptor extends \Magento\CheckoutAgreements\Controller\Adminhtml\Agreement\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\CheckoutAgreements\Model\AgreementFactory $agreementFactory = null)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $agreementFactory);
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
