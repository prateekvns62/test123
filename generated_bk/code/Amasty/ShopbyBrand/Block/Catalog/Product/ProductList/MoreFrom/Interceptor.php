<?php
namespace Amasty\ShopbyBrand\Block\Catalog\Product\ProductList\MoreFrom;

/**
 * Interceptor class for @see \Amasty\ShopbyBrand\Block\Catalog\Product\ProductList\MoreFrom
 */
class Interceptor extends \Amasty\ShopbyBrand\Block\Catalog\Product\ProductList\MoreFrom implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Amasty\ShopbyBrand\Helper\Data $helper, \Magento\CatalogInventory\Helper\Stock $stockHelper, \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus, \Magento\Catalog\Model\Product\Visibility $productVisibility, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $productCollectionFactory, $helper, $stockHelper, $productStatus, $productVisibility, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getImage($product, $imageId, $attributes = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getImage');
        if (!$pluginInfo) {
            return parent::getImage($product, $imageId, $attributes);
        } else {
            return $this->___callPlugins('getImage', func_get_args(), $pluginInfo);
        }
    }
}
