<?php
namespace Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\LoadTemplate;

/**
 * Interceptor class for @see \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\LoadTemplate
 */
class Interceptor extends \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\LoadTemplate implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mageplaza\ProductFeed\Model\FeedFactory $feedFactory, \Magento\Framework\Registry $coreRegistry, \Magento\Backend\App\Action\Context $context, \Mageplaza\ProductFeed\Model\DefaultTemplateFactory $defaultTemplate, \Mageplaza\ProductFeed\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($feedFactory, $coreRegistry, $context, $defaultTemplate, $helperData);
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
