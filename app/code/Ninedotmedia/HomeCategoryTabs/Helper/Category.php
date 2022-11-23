<?php
namespace Ninedotmedia\HomeCategoryTabs\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Ninedotmedia\ThemeConfiguration\Helper\Configuration;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Category extends Configuration
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
	
	protected $_productCollectionFactory;

    /**
     * @param Context $context
     * @param CategoryRepositoryInterface $categoryRepository
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        CategoryRepositoryInterface $categoryRepository,
        StoreManagerInterface $storeManager,
		CollectionFactory $productCollectionFactory
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->storeManager = $storeManager;
		$this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Catalog\Api\Data\CategoryInterface|null
     */
    public function getCategoryOfTabs()
    {
        return ($configCategory  = $this->getHomepageCategoryTab()) ?
            $this->getCategoryById($configCategory) :
            null;
    }

    /**
     * @param int|string $categoryId
     * @return null
     */
    public function getProductsByCategory($categoryId)
    {
        $result = null;
        $category = $this->categoryRepository->get($categoryId);
        if ($category && $category->getId()) {
            $result = $category->getProductCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToSort('position', 'ASC')
                ->setPageSize($this->getProductPerTab());
        }
        return $result;
    }
	
	
	/**
     * @param int|string $categoryId
     * @return null
     */
    public function getProductsByCategories($categoryIds)
    {
        $result = null;
		
		$categoryIds=explode(',',$categoryIds);
		if ($categoryIds) {
		$result = $this->_productCollectionFactory->create();
        $result->addAttributeToSelect('*');
        $result->addCategoriesFilter(['in' => $categoryIds]);
		//$result->addAttributeToSort('position', 'ASC');
        $result->setPageSize($this->getProductPerTab());
		}
		
       
        return $result;
    }
	
	
	
	
	 public function getMultiCategories()
    {
		
		$catIds=explode(',',$this->getHomepageCategoryTab());
		
		$catData=[];
		foreach($catIds as $catId){
			
			$catData[]=$this->getCategoryById($catId);
		}
		
		return $catData;
    }
	
	

    /**
     * @param int|string $categoryId
     * @return \Magento\Catalog\Api\Data\CategoryInterface|null
     */
    private function getCategoryById($categoryId)
    {
        try {
            return  $this->categoryRepository->get($categoryId, $this->storeManager->getStore()->getId());
        } catch (\Exception $e) {
            return null;
        }
    }
}
