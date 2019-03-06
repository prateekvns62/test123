<?php
namespace Ninedotmedia\HomeCategoryTabs\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use \Magento\Catalog\Helper\Category;
use \Magento\Catalog\Model\CategoryRepository;

class CategoryList implements ArrayInterface
{
    /**
     * @var Category
     */
    protected $categoryHelper;
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;
    /**
     * @var
     */
    protected $categoryList;

    /**
     * CategoryList constructor.
     * @param Category $catalogCategory
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        Category $catalogCategory,
        CategoryRepository $categoryRepository
    ) {
        $this->categoryHelper = $catalogCategory;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param bool $sorted
     * @param bool $asCollection
     * @param bool $toLoad
     * @return \Magento\Framework\Data\Tree\Node\Collection
     */
    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->categoryHelper->getStoreCategories($sorted, $asCollection, $toLoad);
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        $categories = $this->getStoreCategories(true, false, true);
        $categoryList = $this->renderCategories($categories);
        return $categoryList;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $arr = $this->toArray();
        $result = [];

        foreach ($arr as $key => $value) {
            $result[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        return $result;
    }

    /**
     * @param $_categories
     * @return mixed
     */
    public function renderCategories($_categories)
    {
        foreach ($_categories as $category) {
            $i = 0;
            $this->categoryList[$category->getEntityId()] = __($category->getName());
            $this->renderSubCat($category, $i);
        }
        return $this->categoryList;
    }

    /**
     * @param $cat
     * @param $j
     * @return mixed
     */
    public function renderSubCat($cat, $j)
    {
        $categoryObj = $this->categoryRepository->get($cat->getId());

        $level = $categoryObj->getLevel();
        $arrow = str_repeat("......", $level-1);
        $subcategories = $categoryObj->getChildrenCategories();

        foreach ($subcategories as $subcategory) {
            $this->categoryList[$subcategory->getEntityId()] = __($arrow.$subcategory->getName());

            if ($subcategory->hasChildren()) {
                $this->renderSubCat($subcategory, $j);
            }
        }
        return $this->categoryList;
    }
}
