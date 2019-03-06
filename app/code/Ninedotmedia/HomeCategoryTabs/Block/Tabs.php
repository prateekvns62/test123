<?php
namespace Ninedotmedia\HomeCategoryTabs\Block;

use Magento\Framework\View\Element\Template;
use Ninedotmedia\HomeCategoryTabs\Helper\Category;

class Tabs extends Template
{
    /**
     * @var Category
     */
    private $categoryHelper;
    /**
     * @var \Magento\Catalog\Api\Data\CategoryInterface|null
     */
    private $category = null;

    /**
     * @param Template\Context $context
     * @param Category $categoryHelper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Category $categoryHelper,
        array $data = []
    ) {
        $this->categoryHelper = $categoryHelper;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Catalog\Api\Data\CategoryInterface|null
     */
    private function getCategory()
    {
        if (!$this->category) {
            $this->category = $this->categoryHelper->getCategoryOfTabs();
        }
        return $this->category;
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection|null
     */
    public function getCategoryTabs()
    {
        $categoryObj = $this->getCategory();
        return ($categoryObj) ? $categoryObj->getChildrenCategories() : null;
    }

    /**
     * @return string
     */
    public function getActionUrl()
    {
        return $this->getUrl('categorytab/index/index', ['_secure' => true]);
    }
}
