<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Post\Delete;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Post\Delete
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Post\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\Blog\Model\PostFactory $postFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($postFactory, $coreRegistry, $context);
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
