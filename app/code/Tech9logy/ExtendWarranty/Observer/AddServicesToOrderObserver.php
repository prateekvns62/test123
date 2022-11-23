<?php
namespace Tech9logy\ExtendWarranty\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddServicesToOrderObserver implements ObserverInterface
{
    /**
     * Set payment fee to order
     *
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $checkoutSession = $objectManager->get('\Magento\Checkout\Model\Session');
        $serviceAmount = $checkoutSession->getServiceAmount();
		$appliedServices = $checkoutSession->getServiceApplied();

        if (!$serviceAmount ) {
            return $this;
        }
        //Set voucher data to order
        $order = $observer->getOrder();
        $order->setData('service_amount', $serviceAmount);
        $order->setServiceApplied($appliedServices);
		return $this;
    }
}
