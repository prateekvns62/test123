<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Failure;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Failure
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Failure implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Ebizmarts\SagePaySuite\Model\Form $formModel)
    {
        $this->___init();
        parent::__construct($context, $suiteLogger, $formModel);
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
