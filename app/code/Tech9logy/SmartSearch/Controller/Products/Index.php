<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tech9logy\SmartSearch\Controller\Products;

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
		$result = $this->_resultJsonFactory->create();
		$priceFilter = $this->getRequest()->getParam('priceFilter');
		if($priceFilter=='true'){
			
			$totalProduct=$this->totalProduct($this->getRequest()->getParams());
			return $result->setData(['success' => true, 'totalProduct' => $totalProduct]);
		} else {	

$brandId = $this->getRequest()->getParam('brandId');
$catId = $this->getRequest()->getParam('catId');

$id=$catId;
$category = $this->_categoryFactory->create()->load($id);
$childrenCategories = $category->getChildrenCategories();

$productCollection=$category->getProductCollection()
						->addFieldToFilter('manufacturer',['eq'=>$brandId]);
$ProductFactory = $productCollection->addAttributeToSelect('price')->setOrder('price', 'DESC')->addCategoryFilter($category); 

        $maxPrice = $ProductFactory->getMaxPrice();
        $minPrice = ($ProductFactory->getMinPrice()==$maxPrice) ? 0 : $ProductFactory->getMinPrice(); 


return $result->setData(['success' => true, 'min' => $minPrice, 'max' => round($maxPrice)]);

		}					
 
}
    public function totalProduct($data=array())
    {
		
		$catId = $data['catId'];
		$brand = @$data['brand'];
		$price=explode('-',$data['price']);		
		$minPrice=$price[0];
		$maxPrice=$price[1];		
		$category = $this->_categoryFactory->create()->load($catId);
		$productCollection=$category->getProductCollection()->addAttributeToSelect('*')
		 ->addCategoriesFilter(['in' => array($catId)])
	->addPriceDataFieldFilter('%s >= %s', ['min_price', $minPrice])
    ->addPriceDataFieldFilter('%s <= %s', ['max_price', $maxPrice])
    ->addFinalPrice();		
		if($brand){			
			$productCollection->addFieldToFilter('manufacturer',['eq'=>$brand]);
		}		
		return ($productCollection->count() > 1) ? $productCollection->count() : 1;
	}
}