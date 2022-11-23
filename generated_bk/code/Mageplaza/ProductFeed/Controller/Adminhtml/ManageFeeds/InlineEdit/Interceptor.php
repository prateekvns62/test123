<?php
namespace Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\InlineEdit;

/**
 * Interceptor class for @see \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\InlineEdit
 */
class Interceptor extends \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\InlineEdit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Mageplaza\ProductFeed\Model\FeedFactory $feedFactory)
    {
        $this->___init();
        parent::__construct($context, $jsonFactory, $feedFactory);
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
