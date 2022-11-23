<?php
namespace Mageplaza\Blog\Controller\Adminhtml\Topic\InlineEdit;

/**
 * Interceptor class for @see \Mageplaza\Blog\Controller\Adminhtml\Topic\InlineEdit
 */
class Interceptor extends \Mageplaza\Blog\Controller\Adminhtml\Topic\InlineEdit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Mageplaza\Blog\Model\TopicFactory $topicFactory)
    {
        $this->___init();
        parent::__construct($context, $jsonFactory, $topicFactory);
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
