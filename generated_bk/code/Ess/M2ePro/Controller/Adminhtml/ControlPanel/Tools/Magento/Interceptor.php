<?php
namespace Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\Magento;

/**
 * Interceptor class for @see \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\Magento
 */
class Interceptor extends \Ess\M2ePro\Controller\Adminhtml\ControlPanel\Tools\Magento implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Ess\M2ePro\Controller\Adminhtml\Context $context, \Magento\Framework\Module\FullModuleList $fullModuleList, \Magento\Framework\Module\ModuleList $moduleList, \Magento\Framework\Module\PackageInfo $packageInfo, \Magento\Framework\Interception\PluginListInterface $pluginList)
    {
        $this->___init();
        parent::__construct($context, $fullModuleList, $moduleList, $packageInfo, $pluginList);
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
