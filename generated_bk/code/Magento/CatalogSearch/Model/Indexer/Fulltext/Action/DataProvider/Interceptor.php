<?php
namespace Magento\CatalogSearch\Model\Indexer\Fulltext\Action\DataProvider;

/**
 * Interceptor class for @see \Magento\CatalogSearch\Model\Indexer\Fulltext\Action\DataProvider
 */
class Interceptor extends \Magento\CatalogSearch\Model\Indexer\Fulltext\Action\DataProvider implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ResourceConnection $resource, \Magento\Catalog\Model\Product\Type $catalogProductType, \Magento\Eav\Model\Config $eavConfig, \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $prodAttributeCollectionFactory, \Magento\CatalogSearch\Model\ResourceModel\EngineProvider $engineProvider, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\EntityManager\MetadataPool $metadataPool, int $antiGapMultiplier = 5)
    {
        $this->___init();
        parent::__construct($resource, $catalogProductType, $eavConfig, $prodAttributeCollectionFactory, $engineProvider, $eventManager, $storeManager, $metadataPool, $antiGapMultiplier);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductAttributes($storeId, array $productIds, array $attributeTypes)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductAttributes');
        if (!$pluginInfo) {
            return parent::getProductAttributes($storeId, $productIds, $attributeTypes);
        } else {
            return $this->___callPlugins('getProductAttributes', func_get_args(), $pluginInfo);
        }
    }
}
