<?php
namespace Tech9logy\ExtendWarranty\Observer;

use Magento\Framework\Event\ObserverInterface;

class ClearCheckoutSession implements ObserverInterface
{
	protected $_checkoutSession;

	public function __construct(
		\Magento\Checkout\Model\Session $checkoutSession
	){
		$this->_checkoutSession = $checkoutSession;
	}
	
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$this->_checkoutSession->setServiceAmount(0);
		$this->_checkoutSession->setServiceApplied("");
		return ;
	}
}