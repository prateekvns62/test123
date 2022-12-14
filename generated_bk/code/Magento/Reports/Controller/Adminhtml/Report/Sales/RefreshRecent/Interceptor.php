<?php
namespace Magento\Reports\Controller\Adminhtml\Report\Sales\RefreshRecent;

/**
 * Interceptor class for @see \Magento\Reports\Controller\Adminhtml\Report\Sales\RefreshRecent
 */
class Interceptor extends \Magento\Reports\Controller\Adminhtml\Report\Sales\RefreshRecent implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone, \Magento\Backend\Helper\Data $backendHelperData = null)
    {
        $this->___init();
        parent::__construct($context, $fileFactory, $dateFilter, $timezone, $backendHelperData);
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
