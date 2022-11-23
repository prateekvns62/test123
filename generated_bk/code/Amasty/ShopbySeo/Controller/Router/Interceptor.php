<?php
namespace Amasty\ShopbySeo\Controller\Router;

/**
 * Interceptor class for @see \Amasty\ShopbySeo\Controller\Router
 */
class Interceptor extends \Amasty\ShopbySeo\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Amasty\ShopbySeo\Helper\UrlParser $urlParser, \Amasty\ShopbySeo\Helper\Url $urlHelper, \Magento\UrlRewrite\Model\UrlFinderInterface $urlFinder, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Amasty\ShopbySeo\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($actionFactory, $urlParser, $urlHelper, $urlFinder, $scopeConfig, $helper);
    }

    /**
     * {@inheritdoc}
     */
    public function modifyRequest(\Magento\Framework\App\RequestInterface $request, $identifier, $params = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'modifyRequest');
        if (!$pluginInfo) {
            return parent::modifyRequest($request, $identifier, $params);
        } else {
            return $this->___callPlugins('modifyRequest', func_get_args(), $pluginInfo);
        }
    }
}
