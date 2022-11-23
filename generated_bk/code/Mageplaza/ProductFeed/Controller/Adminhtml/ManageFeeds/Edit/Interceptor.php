<?php
namespace Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\Edit;

/**
 * Interceptor class for @see \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\Edit
 */
class Interceptor extends \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\ProductFeed\Model\FeedFactory $feedFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->___init();
        parent::__construct($feedFactory, $coreRegistry, $context, $resultPageFactory);
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
