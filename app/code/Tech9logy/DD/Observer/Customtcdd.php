<?php
namespace Tech9logy\DD\Observer;
use Psr\Log\LoggerInterface as Logger;
 use Magento\Framework\App\RequestInterface;
class Customtcdd implements \Magento\Framework\Event\ObserverInterface
{
	
	/**
     * @var Logger
     */
    protected $_logger;
    protected $scopeConfig;
    /**
     * [__construct ]
     * 
     * @param Logger $logger
     */
    public function __construct(
        Logger $logger,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Framework\App\RequestInterface $request
    ) {
        $this->_logger = $logger;
		$this->scopeConfig = $scopeConfig;
		$this->_request = $request;
    }
  public function execute(\Magento\Framework\Event\Observer $observer)
  {
     
	$quote = $observer->getQuote();
     $order = $observer->getOrder();

       $order->setData('tcdeliverydate', $quote->getData('tcdeliverydate'));
     return $this;
  }
}