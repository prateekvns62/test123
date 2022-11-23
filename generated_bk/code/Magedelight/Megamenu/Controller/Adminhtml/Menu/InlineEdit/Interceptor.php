<?php
namespace Magedelight\Megamenu\Controller\Adminhtml\Menu\InlineEdit;

/**
 * Interceptor class for @see \Magedelight\Megamenu\Controller\Adminhtml\Menu\InlineEdit
 */
class Interceptor extends \Magedelight\Megamenu\Controller\Adminhtml\Menu\InlineEdit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $pageFactory, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Magedelight\Megamenu\Model\Menu $menuModel)
    {
        $this->___init();
        parent::__construct($context, $pageFactory, $jsonFactory, $menuModel);
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
