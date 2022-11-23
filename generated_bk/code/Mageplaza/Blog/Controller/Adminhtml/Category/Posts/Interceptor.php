<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Category\Posts;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Category\Posts
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Category\Posts implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Mageplaza\Blog\Model\CategoryFactory $categoryFactory, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $categoryFactory, $resultLayoutFactory);
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
