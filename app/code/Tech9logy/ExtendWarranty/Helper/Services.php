<?php

namespace Tech9logy\ExtendWarranty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Services extends AbstractHelper
{
 

	 public function __construct(
		 \Magento\Checkout\Model\Session $checkoutSession
      
    ) {
		$this->_checkoutSession = $checkoutSession;
    }


   
    /**
     * Get custom voucher
     *
     * @return mixed
     */
    public function getServiceAmount()
    {
       $amount = $this->_checkoutSession->getServiceAmount();
	   if($amount){
			return $amount;
		}else{
			return;
		}
 
    }

    /**
     * Get custom Service
     *
     * @return mixed
     */
    public function getServiceLabel()
    {
		return 'Add-on Services';
    }

   
}
