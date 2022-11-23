<?php
namespace Amasty\ShopbyBase\Controller\Adminhtml\Option\Save;

/**
 * Interceptor class for @see \Amasty\ShopbyBase\Controller\Adminhtml\Option\Save
 */
class Interceptor extends \Amasty\ShopbyBase\Controller\Adminhtml\Option\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Cache\TypeListInterface $typeList)
    {
        $this->___init();
        parent::__construct($context, $typeList);
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
