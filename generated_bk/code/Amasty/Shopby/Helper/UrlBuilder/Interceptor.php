<?php
namespace Amasty\Shopby\Helper\UrlBuilder;

/**
 * Interceptor class for @see \Amasty\Shopby\Helper\UrlBuilder
 */
class Interceptor extends \Amasty\Shopby\Helper\UrlBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Magento\Framework\Registry $registry, \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository, \Amasty\Shopby\Helper\FilterSetting $filterSettingHelper, \Magento\Framework\Url\QueryParamsResolverInterface $queryParamsResolver, \Amasty\Shopby\Helper\Category $categoryHelper, \Amasty\ShopbyBase\Api\UrlBuilderInterface $urlBuilder)
    {
        $this->___init();
        parent::__construct($context, $registry, $categoryRepository, $filterSettingHelper, $queryParamsResolver, $categoryHelper, $urlBuilder);
    }

    /**
     * {@inheritdoc}
     */
    public function isGetDefaultUrl($filter)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isGetDefaultUrl');
        if (!$pluginInfo) {
            return parent::isGetDefaultUrl($filter);
        } else {
            return $this->___callPlugins('isGetDefaultUrl', func_get_args(), $pluginInfo);
        }
    }
}
