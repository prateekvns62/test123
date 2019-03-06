<?php
namespace Ninedotmedia\HomeCategoryTabs\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;

class Category extends Config
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param CategoryRepositoryInterface $categoryRepository
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        CategoryRepositoryInterface $categoryRepository,
        StoreManagerInterface $storeManager
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->storeManager = $storeManager;
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
                ->setPageSize($this->getPerProduct());
        }
        return $result;
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
