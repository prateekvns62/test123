<?php
namespace Ninedotmedia\HomeCategoryTabs\Controller\Index;

use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Controller\Result\JsonFactory;
use \Magento\Framework\View\Result\PageFactory;
use Ninedotmedia\HomeCategoryTabs\Helper\Category;

class Index extends \Magento\Framework\App\Action\Action
{
    /*****
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /*****
     * @var PageFactory
     */
    protected $resultPageFactory;

    /*****
     * @var Category
     */
    protected $categoryHelper;

    /*****
     * Index constructor.
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param PageFactory $resultPageFactory
     * @param Category $categoryHelper
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        PageFactory $resultPageFactory,
        Category $categoryHelper

    ){
        $this->categoryHelper = $categoryHelper;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    /*****
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $post = $this->getRequest()->getPostValue();
        $resultHtml = __('Data Not found');

        if ($post && isset($post['category'])){
            $resultPage = $this->resultPageFactory->create();
            if ($categoryProducts = $this->categoryHelper->getProductsByCategory($post['category'])){
                $layout = $resultPage->getLayout();
                $layout->getUpdate()->addHandle('catalog_category_view');
                $layout->unsetElement('product_list_toolbar');

                $blockName = 'category.products.list';
                $resultHtml = ($block = $layout->getBlock($blockName)) ?
                    $block->setCollection($categoryProducts)->toHtml() :
                    $layout->createBlock('Magento\Catalog\Block\Product\ListProduct',
                        $blockName,
                            [
                                'data' => [
                                    'collection' => $categoryProducts
                                ]
                            ]
                        )
                        ->setData('area', 'frontend')
                        ->setTemplate('Magento_Catalog::product/list.phtml')
                        ->toHtml();
            }
        }
        $resultJson->setData(['output' => $resultHtml]);
        return $resultJson;
    }
}
