<?php
namespace Magedelight\Megamenu\Controller\Adminhtml\Menu\Edit;

/**
 * Interceptor class for @see \Magedelight\Megamenu\Controller\Adminhtml\Menu\Edit
 */
class Interceptor extends \Magedelight\Megamenu\Controller\Adminhtml\Menu\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Registry $registry, \Magedelight\Megamenu\Model\Menu $menuModel)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $registry, $menuModel);
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
