<?php
namespace Magedelight\Megamenu\Controller\Adminhtml\Menu\Delete;

/**
 * Interceptor class for @see \Magedelight\Megamenu\Controller\Adminhtml\Menu\Delete
 */
class Interceptor extends \Magedelight\Megamenu\Controller\Adminhtml\Menu\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magedelight\Megamenu\Model\Menu $menuModel)
    {
        $this->___init();
        parent::__construct($context, $menuModel);
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
