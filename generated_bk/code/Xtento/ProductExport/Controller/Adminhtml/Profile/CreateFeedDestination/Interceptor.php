<?php
namespace Xtento\ProductExport\Controller\Adminhtml\Profile\CreateFeedDestination;

/**
 * Interceptor class for @see \Xtento\ProductExport\Controller\Adminhtml\Profile\CreateFeedDestination
 */
class Interceptor extends \Xtento\ProductExport\Controller\Adminhtml\Profile\CreateFeedDestination implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Xtento\ProductExport\Helper\Module $moduleHelper, \Xtento\XtCore\Helper\Cron $cronHelper, \Xtento\ProductExport\Model\ResourceModel\Profile\CollectionFactory $profileCollectionFactory, \Magento\Framework\Registry $registry, \Magento\Framework\Escaper $escaper, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter, \Xtento\ProductExport\Helper\Entity $entityHelper, \Xtento\ProductExport\Model\ProfileFactory $profileFactory, \Xtento\ProductExport\Model\ResourceModel\Destination\CollectionFactory $destinationCollectionFactory, \Xtento\ProductExport\Model\DestinationFactory $destinationFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Filesystem\DirectoryList $directoryList)
    {
        $this->___init();
        parent::__construct($context, $moduleHelper, $cronHelper, $profileCollectionFactory, $registry, $escaper, $scopeConfig, $dateFilter, $entityHelper, $profileFactory, $destinationCollectionFactory, $destinationFactory, $storeManager, $directoryList);
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
