<?php
namespace Amasty\ShippingTableRates\Controller\Adminhtml\Methods\Save;

/**
 * Interceptor class for @see \Amasty\ShippingTableRates\Controller\Adminhtml\Methods\Save
 */
class Interceptor extends \Amasty\ShippingTableRates\Controller\Adminhtml\Methods\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Amasty\ShippingTableRates\Model\LabelFactory $labelFactory, \Amasty\ShippingTableRates\Model\ResourceModel\Label\CollectionFactory $collectionFactory, \Amasty\ShippingTableRates\Model\ResourceModel\Label $resourceLabel, \Amasty\Base\Model\Serializer $serializerBase)
    {
        $this->___init();
        parent::__construct($context, $labelFactory, $collectionFactory, $resourceLabel, $serializerBase);
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
