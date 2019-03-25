<?php
namespace Ninedotmedia\RecentlyViewedExt\Ui\DataProvider\Product\Collector;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductRenderInterface;
use Magento\Catalog\Ui\DataProvider\Product\ProductRenderCollectorInterface;
use Magento\Catalog\Api\Data\ProductRenderExtensionFactory;
use Ninedotmedia\RecentlyViewedExt\Model\TopAttributesFactory;
use Magento\Framework\View\LayoutInterface;
use Ninedotmedia\ProductAttributes\Block\Product\Attributes as TopCharacteristicAttributes;
use Ninedotmedia\ProductAttributes\Block\Product\Additional;
use Ninedotmedia\ProductAttributes\Block\Product\Label;

class Attributes implements ProductRenderCollectorInterface
{
    /**
     * @var ProductRenderExtensionFactory
     */
    private $productRenderExtensionFactory;
    /**
     * @var TopAttributesFactory
     */
    private $topAttributesFactory;

    /**
     * @var LayoutInterface
     */
    protected $layout;

    /**
     * Attributes constructor.
     * @param ProductRenderExtensionFactory $productRenderExtensionFactory
     * @param TopAttributesFactory $topAttributesFactory
     * @param LayoutInterface $layout
     */
    public function __construct(
        ProductRenderExtensionFactory $productRenderExtensionFactory,
        TopAttributesFactory $topAttributesFactory,
        LayoutInterface $layout
    ) {
        $this->productRenderExtensionFactory = $productRenderExtensionFactory;
        $this->topAttributesFactory = $topAttributesFactory;
        $this->layout = $layout;
    }

    /**
     * @param ProductInterface $product
     * @param ProductRenderInterface $productRender
     */
    public function collect(ProductInterface $product, ProductRenderInterface $productRender)
    {
        /** @var \Magento\Catalog\Api\Data\ProductRenderExtensionInterface $extensionAttributes */
        $extensionAttributes = $productRender->getExtensionAttributes();

        if (!$extensionAttributes) {
            $extensionAttributes = $this->productRenderExtensionFactory->create();
        }

        $topAttr = $this->topAttributesFactory->create();
        $topAttr->setTopAttributes($this->getTopAttributesHtml($product));
        $topAttr->setCondition($this->getConditionAttributeHtml($product));
        $topAttr->setAdvantages($this->getAdvantagesAttributeHtml($product));
        $labels = $this->getLabelsHtml($product);
        $topAttr->setLabels(implode('', $labels));
        $save = (isset($labels['product.label.save'])) ? $labels['product.label.save'] : '';
        $topAttr->setSavePrice($save);

        $extensionAttributes->setCharacteristicAdditional($topAttr);
        $productRender->setExtensionAttributes($extensionAttributes);
    }

    /**
     * @param ProductInterface $product
     * @return string
     */
    private function getTopAttributesHtml(ProductInterface $product)
    {
        $block = $this->checkBlockOrCreate(
            'category.product.attributes',
            TopCharacteristicAttributes::class,
            'Magento_Catalog::product/view/attributes.phtml',
            $product
        );

        return ($block) ? $block->toHtml() : '';
    }

    /**
     * @param ProductInterface $product
     * @return string
     */
    private function getConditionAttributeHtml(ProductInterface $product)
    {
        $block = $this->checkBlockOrCreate(
            'additional.condition',
            Additional::class,
            'Ninedotmedia_ProductAttributes::product/additional/condition.phtml',
            $product
        );

        return ($block) ? $block->toHtml() : '';
    }

    /**
     * @param ProductInterface $product
     * @return string
     */
    private function getAdvantagesAttributeHtml(ProductInterface $product)
    {
        $block = $this->checkBlockOrCreate(
            'additional.advantages',
            Additional::class,
            'Ninedotmedia_ProductAttributes::product/additional/advantages.phtml',
            $product
        );

        return ($block) ? $block->toHtml() : '';
    }

    /**
     * @param ProductInterface $product
     * @return array
     */
    private function getLabelsHtml(ProductInterface $product)
    {
        $result = [];
        $labels = [
            'product.label.save'=> [
                'type' => 'saved_money',
                'label' => __('Save'),
                'class' => 'promo-saved-money',
            ],
            'product.label.guarantee' => [
                'type' => 'guarantee',
                'class' => 'promo-guarantee',
            ]
        ];

        foreach ($labels as $key => $arguments) {
            $block = $this->layout->getBlock($key);
            if ($block) {
                $block->setLabelData($arguments);
            } else {
                $block = $this->layout->createBlock(
                    Label::class,
                    $key,
                    ['data' => $arguments]
                );
            }
            if ($block) {
                $block->setProduct($product);
                $result[$key] = $block->toHtml();
            }
        }
        return $result;
    }

    /**
     * @param $blockName
     * @param $blockClass
     * @param $template
     * @param ProductInterface $product
     * @return bool|\Magento\Framework\View\Element\BlockInterface
     */
    private function checkBlockOrCreate($blockName, $blockClass, $template, ProductInterface $product)
    {
        $block = $this->layout->getBlock($blockName);
        if ($block) {
            $block->setProduct($product);
        } else {
            $block = $this->layout->createBlock(
                $blockClass,
                $blockName
            )->setTemplate($template)
                ->setProduct($product);
        }
        return $block;
    }
}
