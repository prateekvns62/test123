<?php
namespace Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\Delete;

/**
 * Interceptor class for @see \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\Delete
 */
class Interceptor extends \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\ProductFeed\Model\FeedFactory $feedFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($feedFactory, $coreRegistry, $context);
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
