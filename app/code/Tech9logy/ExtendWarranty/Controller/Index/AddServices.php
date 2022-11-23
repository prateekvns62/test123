<?php

namespace Tech9logy\ExtendWarranty\Controller\Index;

use Magento\Checkout\Model\Session as CheckoutSession;

class AddServices extends \Magento\Framework\App\Action\Action
{
	protected $resultJsonFactory;
	/**
     * @var CheckoutSession
     */
    private $checkoutSession;
	protected $quoteFactory;

	public function __construct(
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
		\Magento\Framework\App\Action\Context $context,
		\Magento\Quote\Model\QuoteFactory $quoteFactory,
		CheckoutSession $checkoutSession
	) {
		$this->resultJsonFactory = $resultJsonFactory;
		$this->checkoutSession = $checkoutSession;
		$this->quoteFactory = $quoteFactory;
		parent::__construct($context);
	}
 	public function execute()
  	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$priceHelper = $objectManager->create('Magento\Framework\Pricing\Helper\Data');
		$serviceApplied = [];
		$oldServiceAmount = 0;
		$data = $this->getRequest()->getParams();
		
		$this->checkoutSession->getQuote()->collectTotals()->save();
		$oldServiceAmount = $this->checkoutSession->getServiceAmount();
		if(isset($data['price'])){
			$this->checkoutSession->setServiceAmount($data['price']);
		}
		$responceHtml = "";
		if(isset($data['data'])){
			$this->checkoutSession->setServiceApplied(json_encode($data['data']));
				$responceHtml .= '<tr class="totals-warranty-summary expanded" data-bind="mageInit: {\'toggleAdvanced\':{\'selectorsToggleClass\': \'shown\', \'baseToggleClass\': \'expanded\', \'toggleContainers\': \'.totals-warranty-details\'}}">
            		<th class="mark" scope="row"><strong>Add-on Services</strong></th>
            		<td class="amount" data-th="Warranty"><strong>'.$priceHelper->currency($data['price']).'</strong></td></tr>';
					foreach ($data['data'] as $servicesData){
							$servicesData = json_decode($servicesData); 
							$price = $servicesData->price * $servicesData->qty;
							$product = $objectManager->get('\Magento\Catalog\Api\ProductRepositoryInterface')->getById($servicesData->product_id);
							$responceHtml .= '<tr class="totals-warranty-details shown">
							<th class="mark" scope="row">
								<span class="label">'.$servicesData->name.'</span></br>
								<span class="value">SKU : '.$product->getSku().'</span>
							</th>
							<td class="amount">
								<span class="price">'.$priceHelper->currency($price).'</span>
							</td>
							</tr>';
					}
		}else{
			$responceHtml .= '<tr class="totals-warranty-summary expanded" data-bind="mageInit: {\'toggleAdvanced\':{\'selectorsToggleClass\': \'shown\', \'baseToggleClass\': \'expanded\', \'toggleContainers\': \'.totals-warranty-details\'}}"></tr>';
			$this->checkoutSession->setServiceApplied("");
		}
		
		$newArray['status'] = "success";
		$newArray['amount'] = $this->checkoutSession->getServiceAmount();
		$newArray['baseGrandTotal'] = $this->checkoutSession->getQuote()->getGrandTotal() - $oldServiceAmount + $newArray['amount'];
		return  $this->resultJsonFactory->create()->setData(['success' => true,'baseGrandTotal'=> $priceHelper->currency($newArray['baseGrandTotal']),'htmlResponse' =>$responceHtml]);
	}

	/**
     * Checkout quote id
     *
     * @return int
     */
    public function getQouteId()
    {
        return (int)$this->checkoutSession->getQuote()->getId();
    }
}
