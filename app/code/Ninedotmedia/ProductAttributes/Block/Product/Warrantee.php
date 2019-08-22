<?php

namespace Ninedotmedia\ProductAttributes\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Catalog\Model\Product;
use Magento\Swatches\Helper\Data as SwatchHelper;

class Warrantee extends Template
{
    private $_swatchHelper;

    /**
     * @var Product|null
     */
    private $product = null;

    /**
     * @var Registry
     */
    private $coreRegistry;

    public function __construct(
        Template\Context $context,
        SwatchHelper $swatchHelper,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_swatchHelper = $swatchHelper;
        parent::__construct($context, $data);
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->product) {
            $this->product = $this->coreRegistry->registry('product');
        }
        return $this->product;
    }

    /**
     * @return array|null|string
     */
    public function getWarranteeText()
    {
        return ($product = $this->getProduct()) ?
            $product->getAttributeText('ndm_guarantee') : null;
    }

    /**
     * @return array|null|string
     */
    public function getWarranteeImage()
    {
        $optionid = $this->getProduct()->getData('ndm_banners');
        $swatchData = $this->_swatchHelper->getSwatchesByOptionsId([$optionid]);
        if (!file_exists('pub') && !is_dir('pub'))
        {
            return "/media/attribute/swatch". $swatchData[$optionid]['value'];
        }
        else {
            return "/pub/media/attribute/swatch". $swatchData[$optionid]['value'];
        }

    }

    /**
     * @return array|null|string
     */
    public function hasWarranteeImage()
    {
        if ($optionid = $this->getProduct()->getData('ndm_banners')) {
            $swatchData = $this->_swatchHelper->getSwatchesByOptionsId([$optionid]);
            if (isset($swatchData[$optionid]) && !empty($swatchData[$optionid]['value'])) {
                return true;
            }
        }
        return false;
    }
}
