<?php
namespace Magento\Backend\Model\Menu\Item;

/**
 * Interceptor class for @see \Magento\Backend\Model\Menu\Item
 */
class Interceptor extends \Magento\Backend\Model\Menu\Item implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Model\Menu\Item\Validator $validator, \Magento\Framework\AuthorizationInterface $authorization, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Backend\Model\MenuFactory $menuFactory, \Magento\Backend\Model\UrlInterface $urlModel, \Magento\Framework\Module\ModuleListInterface $moduleList, \Magento\Framework\Module\Manager $moduleManager, array $data = array())
    {
        $this->___init();
        parent::__construct($validator, $authorization, $scopeConfig, $menuFactory, $urlModel, $moduleList, $moduleManager, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getUrl');
        if (!$pluginInfo) {
            return parent::getUrl();
        } else {
            return $this->___callPlugins('getUrl', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getClickCallback()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getClickCallback');
        if (!$pluginInfo) {
            return parent::getClickCallback();
        } else {
            return $this->___callPlugins('getClickCallback', func_get_args(), $pluginInfo);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTitle');
        if (!$pluginInfo) {
            return parent::getTitle();
        } else {
            return $this->___callPlugins('getTitle', func_get_args(), $pluginInfo);
        }
    }
}
