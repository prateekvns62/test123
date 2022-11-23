<?php
namespace Tech9logy\ExtendWarranty\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Quote\Model\Quote;

class ServicesConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    protected $taxHelper;

    /**
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $ExtrafeeConfig = [];
       
        $ExtrafeeConfig['service_label'] = "Add-on Services";
     
        $ExtrafeeConfig['service_amount'] = 0;
		if($this->checkoutSession->getServiceAmount() && $this->checkoutSession->getServiceAmount() > 0){
            $ExtrafeeConfig['service_amount'] = $this->checkoutSession->getServiceAmount();
        }

		if( $this->checkoutSession->getServiceApplied()){
			$ExtrafeeConfig['service_applied'] = $this->checkoutSession->getServiceApplied();
		}else{
            $ExtrafeeConfig['service_applied'] = "";
        }
		
		$ExtrafeeConfig['show_hide_service_block'] = ($this->checkoutSession->getServiceAmount() && $this->checkoutSession->getServiceApplied()) ? true : false;

        return $ExtrafeeConfig;
    }

  
}
