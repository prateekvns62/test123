<?php 
namespace Tech9logy\DD\Observer;

use \Magento\Framework\Event\Observer;
use \Magento\Framework\Event\ObserverInterface;

class Meta implements ObserverInterface {

protected $request;

protected $layoutFactory;

public function __construct(
    \Magento\Framework\App\Request\Http $request,
    \Magento\Framework\View\Page\Config $layoutFactory
) {
   $this->request = $request;
   $this->layoutFactory = $layoutFactory;
  }



public function execute(Observer $observer) {

$fullActionName = $this->request->getFullActionName();

if ($fullActionName == "catalog_product_view"){

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$current_product = $objectManager->get('Magento\Framework\Registry')->registry('current_product');

$product = $objectManager->create('Magento\Catalog\Model\Product')->load($current_product->getId());
if(!$product->isAvailable()){
$this->layoutFactory->setRobots('NOINDEX,NOFOLLOW');
}


} elseif($fullActionName == "cms_noroute_index"){
	
	$this->layoutFactory->setRobots('NOINDEX,NOFOLLOW');
}

}
}
?>