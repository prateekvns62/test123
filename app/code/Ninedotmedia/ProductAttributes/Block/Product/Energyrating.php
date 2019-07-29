<?php

namespace Ninedotmedia\ProductAttributes\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Catalog\Model\Product;

class Energyrating extends Template
{
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
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
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
    public function getEnergyRatingText()
    {
        return ($product = $this->getProduct()) ?
            $product->getAttributeText('energyrating') : null;
    }

    /**
     * @return array|null|string
     */
    public function hasEnergyRatingText()
    {
	if ($product = $this->getProduct()) {
	    if ($product->getData('energyrating')) {
		return true;
	    }
	}
	return false;
    }

}
