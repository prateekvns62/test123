<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tech9logy\SmartSearch\Controller\Category;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\CategoryFactory;
 
 
class Index extends Action
{
 
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
 
    /**
     * @var JsonFactory
     */
    protected $_resultJsonFactory;
	
	
	/**
     * @var CategoryFactory
     */
    protected $_categoryFactory;
 
 
    /**
     * View constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, JsonFactory $resultJsonFactory, CategoryFactory $categoryFactory)
    {
 
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
		$this->_categoryFactory = $categoryFactory;
 
        parent::__construct($context);
    }
 
 
    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
		
	

$catId = $this->getRequest()->getParam('catId');
$subCatId = $this->getRequest()->getParam('subCatId');

$id=($catId) ? $catId : $subCatId;
$category = $this->_categoryFactory->create()->load($id);
$childrenCategories = $category->getChildrenCategories();
$productTotal=$category->getProductCollection()->count();

$productCollection=$category->getProductCollection()
						->addAttributeToSelect('*');

$ProductFactory = $productCollection->addAttributeToSelect('price')->setOrder('price', 'DESC')->addCategoryFilter($category); 

        $maxPrice = $ProductFactory->getMaxPrice();
		$minPrice = ($ProductFactory->getMinPrice()==$maxPrice) ? 0 : $ProductFactory->getMinPrice();
        //$minPrice = $ProductFactory->getMinPrice();       
        //$minPrice = 0;
		
		//echo "<pre>"; print_r($filterprice); die;


$result = $this->_resultJsonFactory->create();
$html='';
if($childrenCategories && $catId) {
	$html.='<div class="list-range-content sub-cat-dropdown"><div class="list-top-row second-dropdown col-'.ceil(count($childrenCategories)/6).'">';
	$count = 1;  foreach ($childrenCategories as $child) {
		  if ($count%6 == 1) { 
		  $html.='<div class="list-top-col"><div class="inner-side-box"><div class="list-button-row">'; 
		  }
		   $html.='<div class="list-box-inner"><button type="button" class="child_cat" data-child-cat-url="'.$child->getRequestPath().'" data-id="'.$child->getId().'">'.$child->getName().'</button></div>';
		   if ($count%6 == 0) {
			 $html.='</div></div></div>';  
		   }
		 $count++; }
		 
		 if ($count%6 != 1) $html.="</div></div></div>"; 
		  $html.='</div></div>';
 }

 
 
						
	
$totalBrand=[];
	$totalProduct=[];
$brandCount1 = 1; foreach ($productCollection as $_item) {
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   $product = $objectManager->create('Magento\Catalog\Model\Product')->load($_item->getId());
   
	
 
	if(!in_array($product->getData('manufacturer'), $totalBrand)){
	$totalProduct[$product->getData('manufacturer')]=1;
	$totalBrand[]=$product->getData('manufacturer');
	$brandCount1++;
	} else {
		
		$totalProduct[$product->getData('manufacturer')] +=1;
	}



}
						
 $brandHtml='';
  if($subCatId && $productCollection && $totalBrand) {	
$brandHtml.='<div class="list-range-content brand-dropdown"><div class="list-top-row third-dropdown col-'.ceil(count($totalBrand)/6).'">';  
	$arr=[];
	$brandCount = 1;  foreach ($productCollection as $_item) {
		 $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   $product = $objectManager->create('Magento\Catalog\Model\Product')->load($_item->getId());
   
   
   
		if(!in_array($product->getData('manufacturer'), $arr)){ 
			
		$arr[]=$product->getData('manufacturer');
		  if ($brandCount%6 == 1) { 
		  $brandHtml.='<div class="list-top-col"><div class="inner-side-box"><div class="list-button-row">'; 
		  }
		   $brandHtml.='<div class="list-box-inner"><button type="button" class="manufacturer_id" data-product-total="'.$totalProduct[$product->getData('manufacturer')].'" data-id="'.$product->getData('manufacturer').'">'.$product->getAttributeText('manufacturer').'</button></div>';
		   if ($brandCount%6 == 0) {
			 $brandHtml.='</div></div></div>';  
		   }
		   
		
		$brandCount++;  } 
		
		}
		 
		 if ($brandCount%6 != 1) $brandHtml.="</div></div></div>";
		 $brandHtml.='</div></div>';
 }
 
 return $result->setData(['success' => true, 'min' => $minPrice, 'max' => round($maxPrice), 'value'=>$html,'totalProduct'=>$productTotal,'brandHtml'=>$brandHtml]);
 
}

}