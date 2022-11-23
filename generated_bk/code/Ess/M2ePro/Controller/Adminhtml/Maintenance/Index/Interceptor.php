<?php
namespace Ess\M2ePro\Controller\Adminhtml\Maintenance\Index;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\Maintenance\Index
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\Maintenance\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Result\PageFactory $pageFactory, \Ess\M2ePro\Helper\Module\Maintenance\General $maintenanceHelper, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($pageFactory, $maintenanceHelper, $context);
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
