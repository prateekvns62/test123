<?php
namespace Magento\Backend\Block\Menu;

/**
 * Interceptor class for @see \Magento\Backend\Block\Menu
 */
class Interceptor extends \Magento\Backend\Block\Menu implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Model\UrlInterface $url, \Magento\Backend\Model\Menu\Filter\IteratorFactory $iteratorFactory, \Magento\Backend\Model\Auth\Session $authSession, \Magento\Backend\Model\Menu\Config $menuConfig, \Magento\Framework\Locale\ResolverInterface $localeResolver, array $data = array(), \Magento\Backend\Block\MenuItemChecker $menuItemChecker = null, \Magento\Backend\Block\AnchorRenderer $anchorRenderer = null)
    {
        $this->___init();
        parent::__construct($context, $url, $iteratorFactory, $authSession, $menuConfig, $localeResolver, $data, $menuItemChecker, $anchorRenderer);
    }

    /**
     * {@inheritdoc}
     */
    public function renderNavigation($menu, $level = 0, $limit = 0, $colBrakes = array())
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'renderNavigation');
        if (!$pluginInfo) {
            return parent::renderNavigation($menu, $level, $limit, $colBrakes);
        } else {
            return $this->___callPlugins('renderNavigation', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toHtml');
        if (!$pluginInfo) {
            return parent::toHtml();
        } else {
            return $this->___callPlugins('toHtml', func_get_args(), $pluginInfo);
        }
    }
}
