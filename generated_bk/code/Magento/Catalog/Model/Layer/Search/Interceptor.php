<?php
namespace Magento\Catalog\Model\Layer\Search;

/**
 * Interceptor class for @see \Magento\Catalog\Model\Layer\Search
 */
class Interceptor extends \Magento\Catalog\Model\Layer\Search implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Model\Layer\ContextInterface $context, \Magento\Catalog\Model\Layer\StateFactory $layerStateFactory, \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $attributeCollectionFactory, \Magento\Catalog\Model\ResourceModel\Product $catalogProduct, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Registry $registry, \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $layerStateFactory, $attributeCollectionFactory, $catalogProduct, $storeManager, $registry, $categoryRepository, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductCollection()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getProductCollection');
        if (!$pluginInfo) {
            return parent::getProductCollection();
        } else {
            return $this->___callPlugins('getProductCollection', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function prepareProductCollection($collection)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepareProductCollection');
        if (!$pluginInfo) {
            return parent::prepareProductCollection($collection);
        } else {
            return $this->___callPlugins('prepareProductCollection', func_get_args(), $pluginInfo);
        }
    }
}
