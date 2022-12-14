<?php
namespace Magento\Cms\Controller\Index\Index;

/**
 * Interceptor class for @see \Magento\Cms\Controller\Index\Index
 */
class Interceptor extends \Magento\Cms\Controller\Index\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig = null, \Magento\Cms\Helper\Page $page = null)
    {
        $this->___init();
        parent::__construct($context, $resultForwardFactory, $scopeConfig, $page);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($coreRoute = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        if (!$pluginInfo) {
            return parent::execute($coreRoute);
        } else {
            return $this->___callPlugins('execute', func_get_args(), $pluginInfo);
        }
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
