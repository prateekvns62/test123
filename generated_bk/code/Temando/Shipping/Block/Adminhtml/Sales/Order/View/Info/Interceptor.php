<?php
namespace Temando\Shipping\Block\Adminhtml\Sales\Order\View\Info;

/**
 * Interceptor class for @see \Temando\Shipping\Block\Adminhtml\Sales\Order\View\Info
 */
class Interceptor extends \Temando\Shipping\Block\Adminhtml\Sales\Order\View\Info implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Sales\Helper\Admin $adminHelper, \Magento\Customer\Api\GroupRepositoryInterface $groupRepository, \Magento\Customer\Api\CustomerMetadataInterface $metadata, \Magento\Customer\Model\Metadata\ElementFactory $elementFactory, \Magento\Sales\Model\Order\Address\Renderer $addressRenderer, \Temando\Shipping\Model\Shipment\ShipmentProviderInterface $shipmentProvider, \Magento\Sales\Api\Data\OrderAddressInterfaceFactory $addressFactory, \Temando\Shipping\Model\ResourceModel\Order\OrderRepository $orderRepository, array $data = array())
    {
        $this->___init();
        parent::__construct($context, $registry, $adminHelper, $groupRepository, $metadata, $elementFactory, $addressRenderer, $shipmentProvider, $addressFactory, $orderRepository, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getAddressEditLink($address, $label = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAddressEditLink');
        if (!$pluginInfo) {
            return parent::getAddressEditLink($address, $label);
        } else {
            return $this->___callPlugins('getAddressEditLink', func_get_args(), $pluginInfo);
        }
    }
}
