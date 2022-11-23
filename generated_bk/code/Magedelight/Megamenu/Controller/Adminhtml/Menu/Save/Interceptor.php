<?php
namespace Magedelight\Megamenu\Controller\Adminhtml\Menu\Save;

/**
 * Interceptor class for @see \Magedelight\Megamenu\Controller\Adminhtml\Menu\Save
 */
class Interceptor extends \Magedelight\Megamenu\Controller\Adminhtml\Menu\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magedelight\Megamenu\Controller\Adminhtml\Menu\PostDataProcessor $dataProcessor, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Magedelight\Megamenu\Model\Menu $menuModel, \Magedelight\Megamenu\Model\MenuItems $menuItemModel)
    {
        $this->___init();
        parent::__construct($context, $dataProcessor, $dataPersistor, $menuModel, $menuItemModel);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
