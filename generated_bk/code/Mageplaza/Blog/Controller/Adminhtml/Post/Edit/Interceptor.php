<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Post\Edit;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Post\Edit
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Post\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $registry, \Mageplaza\Blog\Model\PostFactory $postFactory, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->___init();
        parent::__construct($context, $registry, $postFactory, $resultPageFactory);
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
