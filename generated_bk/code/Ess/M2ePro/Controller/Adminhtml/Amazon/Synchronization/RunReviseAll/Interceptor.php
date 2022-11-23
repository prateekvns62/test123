<?php
namespace Ess\M2ePro\Controller\Adminhtml\Amazon\Synchronization\RunReviseAll;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\Amazon\Synchronization\RunReviseAll
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\Amazon\Synchronization\RunReviseAll implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Ess\M2ePro\Model\ActiveRecord\Component\Parent\Amazon\Factory $amazonFactory, \Ess\M2ePro\Controller\Adminhtml\Context $context)
    {
        $this->___init();
        parent::__construct($localeDate, $amazonFactory, $context);
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
