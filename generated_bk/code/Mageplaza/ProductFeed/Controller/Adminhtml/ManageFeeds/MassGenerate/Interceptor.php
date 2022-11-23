<?php
namespace Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\MassGenerate;

/**
 * Interceptor class for @see \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\MassGenerate
 */
class Interceptor extends \Mageplaza\ProductFeed\Controller\Adminhtml\ManageFeeds\MassGenerate implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Mageplaza\ProductFeed\Model\ResourceModel\Feed\CollectionFactory $collectionFactory, \Mageplaza\ProductFeed\Helper\Data $helperData)
    {
        $this->___init();
        parent::__construct($context, $filter, $collectionFactory, $helperData);
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
