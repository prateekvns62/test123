<?php
namespace Amasty\ShopbyBrand\Model\UrlBuilder\Adapter;

/**
 * Interceptor class for @see \Amasty\ShopbyBrand\Model\UrlBuilder\Adapter
 */
class Interceptor extends \Amasty\ShopbyBrand\Model\UrlBuilder\Adapter implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Url $urlBuilder, \Amasty\ShopbyBrand\Helper\Data $brandHelper, \Magento\Framework\App\RequestInterface $request)
    {
        $this->___init();
        parent::__construct($urlBuilder, $brandHelper, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function getSuffix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getSuffix');
        if (!$pluginInfo) {
            return parent::getSuffix();
        } else {
            return $this->___callPlugins('getSuffix', func_get_args(), $pluginInfo);
        }
    }
}
