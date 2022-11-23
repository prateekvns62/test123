<?php
namespace Magedelight\Megamenu\Block\ShortcodeMenu;

/**
 * Interceptor class for @see \Magedelight\Megamenu\Block\ShortcodeMenu
 */
class Interceptor extends \Magedelight\Megamenu\Block\ShortcodeMenu implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Data\Tree\NodeFactory $nodeFactory, \Magento\Framework\Data\TreeFactory $treeFactory, \Magedelight\Megamenu\Model\MenuFactory $menuFactory, \Magedelight\Megamenu\Model\MenuItemsFactory $menuItemsFactory, \Magento\Cms\Model\BlockFactory $blockFactory, \Magento\Cms\Model\Page $page, \Magento\Customer\Model\Session $session, \Magento\Framework\Registry $registry, \Magento\Catalog\Model\CategoryRepository $categoryRepository, \Magento\Cms\Helper\Page $pageHelper, \Magento\Cms\Model\Page $pageModel, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $nodeFactory, $treeFactory, $menuFactory, $menuItemsFactory, $blockFactory, $page, $session, $registry, $categoryRepository, $pageHelper, $pageModel, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getHtml($outermostClass = '', $childrenWrapClass = '', $limit = 0)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getHtml');
        if (!$pluginInfo) {
            return parent::getHtml($outermostClass, $childrenWrapClass, $limit);
        } else {
            return $this->___callPlugins('getHtml', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentities()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIdentities');
        if (!$pluginInfo) {
            return parent::getIdentities();
        } else {
            return $this->___callPlugins('getIdentities', func_get_args(), $pluginInfo);
        }
    }
}
