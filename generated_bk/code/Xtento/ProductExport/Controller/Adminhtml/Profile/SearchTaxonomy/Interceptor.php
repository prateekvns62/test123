<?php
namespace Xtento\ProductExport\Controller\Adminhtml\Profile\SearchTaxonomy;

/**
 * Interceptor class for @see \Xtento\ProductExport\Controller\Adminhtml\Profile\SearchTaxonomy
 */
class Interceptor extends \Xtento\ProductExport\Controller\Adminhtml\Profile\SearchTaxonomy implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Xtento\ProductExport\Helper\Module $moduleHelper, \Xtento\XtCore\Helper\Cron $cronHelper, \Xtento\ProductExport\Model\ResourceModel\Profile\CollectionFactory $profileCollectionFactory, \Magento\Framework\Registry $registry, \Magento\Framework\Escaper $escaper, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter, \Xtento\ProductExport\Helper\Entity $entityHelper, \Xtento\ProductExport\Model\ProfileFactory $profileFactory, \Magento\Framework\Module\Dir\Reader $moduleReader, \Magento\Framework\Filesystem\Directory\ReadFactory $readFactory)
    {
        $this->___init();
        parent::__construct($context, $moduleHelper, $cronHelper, $profileCollectionFactory, $registry, $escaper, $scopeConfig, $dateFilter, $entityHelper, $profileFactory, $moduleReader, $readFactory);
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
