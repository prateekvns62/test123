<?php
namespace Ninedotmedia\ProductAttributes\Block\Product;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Catalog\Model\Product;
use Magento\Framework\Phrase;
use Magento\Catalog\Block\Product\View\Attributes as ProductAttributes;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Ninedotmedia\ProductAttributes\Helper\Config as ConfigHelper;

class Attributes extends ProductAttributes
{
    /**
     * @var Product|null
     */
    private $product = null;

    /**
     * @var ConfigHelper
     */
    private $configHelper;

    public function __construct(
        Context $context,
        Registry $registry,
        PriceCurrencyInterface $priceCurrency,
        ConfigHelper $configHelper,
        array $data = []
    ) {
        $this->configHelper = $configHelper;
        parent::__construct($context, $registry, $priceCurrency, $data);
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product|null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param array $excludeAttr
     * @return array
     */
    public function getAdditionalData(array $excludeAttr = [])
    {
        $data = [];
        $product = $this->getProduct();

        if (!$product) {
            return $data;
        }

        $counter = 0;
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            if ($counter == $this->configHelper->getAttributesQty()) {
                break;
            }
            if ($attribute->getIsVisibleOnFront() && !in_array($attribute->getAttributeCode(), $excludeAttr)) {
                $value = $attribute->getFrontend()->getValue($product);

                if ($value instanceof Phrase) {
                    $value = (string)$value;
                } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                    $value = $this->priceCurrency->convertAndFormat($value);
                }

                if (is_string($value) && strlen($value)) {
                    $data[$attribute->getAttributeCode()] = [
                        'label' => __($attribute->getStoreLabel()),
                        'value' => $value,
                        'code' => $attribute->getAttributeCode(),
                    ];
                }
                $counter++;
            }
        }
        return $data;
    }
}
