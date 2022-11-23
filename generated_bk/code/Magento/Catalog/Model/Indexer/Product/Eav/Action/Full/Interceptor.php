<?php
namespace Magento\Catalog\Model\Indexer\Product\Eav\Action\Full;

/**
 * Interceptor class for @see \Magento\Catalog\Model\Indexer\Product\Eav\Action\Full
 */
class Interceptor extends \Magento\Catalog\Model\Indexer\Product\Eav\Action\Full implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Model\ResourceModel\Product\Indexer\Eav\DecimalFactory $eavDecimalFactory, \Magento\Catalog\Model\ResourceModel\Product\Indexer\Eav\SourceFactory $eavSourceFactory, \Magento\Framework\EntityManager\MetadataPool $metadataPool = null, \Magento\Framework\Indexer\BatchProviderInterface $batchProvider = null, \Magento\Catalog\Model\ResourceModel\Product\Indexer\Eav\BatchSizeCalculator $batchSizeCalculator = null, \Magento\Catalog\Model\ResourceModel\Indexer\ActiveTableSwitcher $activeTableSwitcher = null, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig = null)
    {
        $this->___init();
        parent::__construct($eavDecimalFactory, $eavSourceFactory, $metadataPool, $batchProvider, $batchSizeCalculator, $activeTableSwitcher, $scopeConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($ids = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        if (!$pluginInfo) {
            return parent::execute($ids);
        } else {
            return $this->___callPlugins('execute', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexers()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexers');
        if (!$pluginInfo) {
            return parent::getIndexers();
        } else {
            return $this->___callPlugins('getIndexers', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexer($type)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexer');
        if (!$pluginInfo) {
            return parent::getIndexer($type);
        } else {
            return $this->___callPlugins('getIndexer', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function reindex($ids = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'reindex');
        if (!$pluginInfo) {
            return parent::reindex($ids);
        } else {
            return $this->___callPlugins('reindex', func_get_args(), $pluginInfo);
        }
    }
}
