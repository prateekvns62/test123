<?php
namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Request;

/**
 * Interceptor class for @see \Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Request
 */
class Interceptor extends \Ebizmarts\SagePaySuite\Controller\Adminhtml\Form\Request implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Ebizmarts\SagePaySuite\Model\Config $config, \Ebizmarts\SagePaySuite\Model\Logger\Logger $suiteLogger, \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper, \Ebizmarts\SagePaySuite\Helper\Request $requestHelper, \Magento\Backend\Model\Session\Quote $quoteSession, \Ebizmarts\SagePaySuite\Model\FormCrypt $formCrypt)
    {
        $this->___init();
        parent::__construct($context, $config, $suiteLogger, $suiteHelper, $requestHelper, $quoteSession, $formCrypt);
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
