<?php
namespace Amasty\ShopbySeo\Helper\Meta;

/**
 * Interceptor class for @see \Amasty\ShopbySeo\Helper\Meta
 */
class Interceptor extends \Amasty\ShopbySeo\Helper\Meta implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Helper\Context $context, \Amasty\Shopby\Helper\Data $dataHelper, \Magento\Framework\View\LayoutInterface\Proxy $layout, \Magento\Framework\Registry $registry, \Magento\Framework\App\Request\Http $request, \Magento\Catalog\Model\Layer\Resolver $layerResolver)
    {
        $this->___init();
        parent::__construct($context, $dataHelper, $layout, $registry, $request, $layerResolver);
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexTagByData($indexTag, \Magento\Framework\DataObject $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIndexTagByData');
        if (!$pluginInfo) {
            return parent::getIndexTagByData($indexTag, $data);
        } else {
            return $this->___callPlugins('getIndexTagByData', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFollowTagByData($followTag, \Magento\Framework\DataObject $data)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFollowTagByData');
        if (!$pluginInfo) {
            return parent::getFollowTagByData($followTag, $data);
        } else {
            return $this->___callPlugins('getFollowTagByData', func_get_args(), $pluginInfo);
        }
    }
}
