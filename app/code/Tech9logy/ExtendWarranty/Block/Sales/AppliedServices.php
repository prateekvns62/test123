<?php

namespace Tech9logy\ExtendWarranty\Block\Sales;
class AppliedServices extends \Magento\Framework\View\Element\Template
{
    public function getServices()
    {
		$orderId = $this->getRequest()->getParam('order_id');
		//echo '<pre>'; print_r($orderId); exit;
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$order = $objectManager->create('\Magento\Sales\Model\Order')
								   ->load($orderId);
		
		$serilised = $objectManager->create('\Magento\Framework\Serialize\Serializer\Json');
		if($order->getServiceAmount()){
			//echo '<pre>'; print_r($order->getData()); exit;
			$appliedServices = json_decode($order->getServiceApplied());
			return $appliedServices;
		}
    }
	
	public function getFormatedPrice($price){
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of Object Manager
		$priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data'); // Instance of Pricing Helper
		$formattedPrice = $priceHelper->currency($price, true, false);
		return $formattedPrice;
	}
}