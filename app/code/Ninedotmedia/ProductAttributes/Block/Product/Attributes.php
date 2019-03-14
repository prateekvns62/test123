<?php
namespace Ninedotmedia\ProductAttributes\Block\Product;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Catalog\Model\Product;
use Magento\Framework\Phrase;
use Magento\Catalog\Block\Product\View\Attributes as ProductAttributes;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Ninedotmedia\ThemeConfiguration\Helper\Configuration as ConfigHelper;
use Magento\Catalog\Model\Config;

class Attributes extends ProductAttributes
{
    /**
     * @var Product|null
     */
    private $product = null;

    /**
     * @var Config
     */
    private $configModel;

    /**
     * @var ConfigHelper
     */
    private $configHelper;

    /**
     * Group name
     */
    const CHARACTERISTIC_GROUP = 'Characteristics';

    public function __construct(
        Context $context,
        Registry $registry,
        PriceCurrencyInterface $priceCurrency,
        ConfigHelper $configHelper,
        Config $configModel,
        array $data = []
    ) {
        $this->configHelper = $configHelper;
        $this->configModel = $configModel;
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
        return ($this->product) ? $this->product : parent::getProduct();
    }

    /**
     * @param array $excludeAttr
     * @return array
     */
    public function getAdditionalData(array $excludeAttr = [])
    {
        $data = [];
        $product = $this->getProduct();
        $attributeSetId = $product->getAttributeSetId();
        $characteristicGroup =  ($attributeSetId) ? $this->getCharacteristicsGroup($attributeSetId) : null;

        if (!$product || !$attributeSetId || !$characteristicGroup) {
            return $data;
        }

        $counter = 0;
        $attributes = $product->getAttributes();
        $productQtyConfig = $this->configHelper->getAttributesQty();
        foreach ($attributes as $attribute) {
            if ($counter == $productQtyConfig) {
                break;
            }
            if ($attribute->getIsVisibleOnFront() &&
                !in_array($attribute->getAttributeCode(), $excludeAttr) &&
                $attribute->isInGroup($attributeSetId, $characteristicGroup)
            ) {
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

    /**
     * @param int|string $attributeSetId
     * @return bool|float|int|string
     */
    private function getCharacteristicsGroup($attributeSetId)
    {
        return $this->configModel->getAttributeGroupId($attributeSetId, self::CHARACTERISTIC_GROUP);
    }

    /**
     * @return mixed
     */
    private function getAttributesQty()
    {
        return ;
    }
}
