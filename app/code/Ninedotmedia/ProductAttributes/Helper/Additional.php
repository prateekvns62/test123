<?php
namespace Ninedotmedia\ProductAttributes\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\View\LayoutInterface;
use Ninedotmedia\ProductAttributes\Block\Product\Label;
use Magento\Catalog\Model\Product;

class Additional extends AbstractHelper
{
    /**
     * @var LayoutInterface
     */
    private $layout;

    /**
     * @var array
     */
    private $allowType = ['saved_money', 'guarantee'];

    /**
     * Additional constructor.
     * @param Context $context
     * @param LayoutInterface $layout
     */
    public function __construct(
        Context $context,
        LayoutInterface $layout
    ) {
        $this->layout = $layout;
        parent::__construct($context);
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * @param string $type
     * @param array $arguments
     * @return string
     */
    public function getLabel(Product $product, $type, array $arguments = [])
    {
        $result = '';
        if (in_array($type, $this->allowType)) {
            if (!isset($arguments['type'])) {
                $arguments['type'] = $type;
            }
            $block = $this->getBlock('product.label', Label::class, $arguments);
            if ($block) {
                $block->setProduct($product);
                $result = $block->toHtml();
            }
        }
        return $result;
    }

    /**
     * @param string $name
     * @param $blockClass
     * @param array $arguments
     * @return bool|\Magento\Framework\View\Element\BlockInterface
     */
    private function getBlock($name, $blockClass, array $arguments = [])
    {
        $block = $this->layout->getBlock($name);
        if ($block) {
            $block->setLabelData($arguments);
        } else {
            $block = $this->layout->createBlock(
                $blockClass,
                $name,
                ['data' => $arguments]
            );
        }
        return $block;
    }
}
