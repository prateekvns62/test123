<?php
namespace Amasty\ShopbySeo\Helper\Url;

/**
 * Interceptor class for @see \Amasty\ShopbySeo\Helper\Url
 */
class Interceptor extends \Amasty\ShopbySeo\Helper\Url implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Amasty\ShopbySeo\Helper\Data $helper, \Amasty\Shopby\Model\ResourceModel\Catalog\Category\CollectionFactory $categoryCollectionFactory, \Magento\Framework\Registry $coreRegistry, \Amasty\Shopby\Model\Layer\Cms\Manager $cmsManager, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\ResourceConnection $resource, \Amasty\ShopbyBase\Helper\Data $baseHelper, \Amasty\ShopbyBase\Helper\FilterSetting $settingHelper, \Amasty\Shopby\Model\Request $shopbyRequest, \Magento\UrlRewrite\Model\UrlFinderInterface $urlFinder, array $intoCategoryModules = array('catalog', 'amshopby', 'cms'))
    {
        $this->___init();
        parent::__construct($context, $helper, $categoryCollectionFactory, $coreRegistry, $cmsManager, $storeManager, $resource, $baseHelper, $settingHelper, $shopbyRequest, $urlFinder, $intoCategoryModules);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryRouteUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCategoryRouteUrl');
        if (!$pluginInfo) {
            return parent::getCategoryRouteUrl();
        } else {
            return $this->___callPlugins('getCategoryRouteUrl', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isSeoUrlEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isSeoUrlEnabled');
        if (!$pluginInfo) {
            return parent::isSeoUrlEnabled();
        } else {
            return $this->___callPlugins('isSeoUrlEnabled', func_get_args(), $pluginInfo);
        }
    }
}
