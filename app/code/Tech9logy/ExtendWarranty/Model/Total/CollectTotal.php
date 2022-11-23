<?php
namespace Tech9logy\ExtendWarranty\Model\Total;
/**
* Class Custom
* @package Mageplaza\HelloWorld\Model\Total\Quote
*/
class CollectTotal extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
   /**
    * @var \Magento\Framework\Pricing\PriceCurrencyInterface
    */
   protected $_priceCurrency;
   private $_serviceshelper;
   protected $quoterepository;
   
   
   /**
    * Custom constructor.
    * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    */
   public function __construct(
	   \Magento\Quote\Api\CartRepositoryInterface $quoterepository,
       \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
	   \Tech9logy\ExtendWarranty\Helper\Services $_serviceshelper,
	   \Magento\Checkout\Model\Session $checkoutSession
   ){
	   $this->quoterepository = $quoterepository;
       $this->_priceCurrency = $priceCurrency;
	   $this->_checkoutSession = $checkoutSession;
	   $this->_serviceshelper = $_serviceshelper;
   }
   /**
    * @param \Magento\Quote\Model\Quote $quote
    * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
    * @param \Magento\Quote\Model\Quote\Address\Total $total
    * @return $this|bool
    */
   public function collect(
       \Magento\Quote\Model\Quote $quote,
       \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
       \Magento\Quote\Model\Quote\Address\Total $total
   )
   {
       parent::collect($quote, $shippingAssignment, $total);
	   
			if(!$quote->getId()){
				return;
			}
            
			if (!count($shippingAssignment->getItems())) {
				return $this;
			}
			
			$quoteModel = $this->quoterepository->get($quote->getEntityId());
			
			if($quote && $quote->getGrandTotal() < -1 ){
				if($quote->getVoucherAmount() < $quoteModel->getSubtotal()){
					$this->_checkoutSession->unsVoucherAmount();
					$this->_checkoutSession->unsVouchers();
					$quote->setVoucherAmount(0);
					$quote->setVoucherApplied("");	
				}
			}

            $fee =  $this->_serviceshelper->getServiceAmount();
			$fee = $fee;
			
            //Try to test with sample value
            
            $total->setTotalAmount('service_amount', $fee);
            $total->setBaseTotalAmount('service_amount', $fee);
            $total->setServiceAmount($fee);
            $quote->setServiceAmount($fee);
			$quote->setServiceApplied($this->_checkoutSession->getServiceApplied());		
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$productMetadata = $objectManager->get('Magento\Framework\App\ProductMetadataInterface');
			$version = (float)$productMetadata->getVersion();
			
			
			if($version > 2.1)
			{
				//$total->setGrandTotal($total->getGrandTotal() + $fee);
			}
			else
			{
				$total->setGrandTotal($total->getGrandTotal() + $fee);
			}
			
        return $this;
   }
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
		$result = null;
        $amount = $total->getServiceAmount();
        if ($amount != 0) {
           
            $result = [
                'code' => 'service_amount',
                'title' => __('Add-on Services'),
                'value' => $amount
            ];
        }
        return $result;
	}
   
   
  
     /**
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     */
    protected function clearValues(\Magento\Quote\Model\Quote\Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
        $total->setServiceAmount(0);
        $total->setServiceApplied("");
    }
}