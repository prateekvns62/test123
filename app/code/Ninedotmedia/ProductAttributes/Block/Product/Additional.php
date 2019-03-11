<?php
namespace Ninedotmedia\ProductAttributes\Block\Product;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\Catalog\Model\Product;

class Additional extends Template
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
     * @return array
     */
    public function getAdvantages()
    {
        $result = [];
        $product = $this->getProduct();

        if (!$product) {
            return $result;
        }

        $attribute = $product->getResource()->getAttribute('ndm_advantages');

        if ($attribute && $attribute->usesSource()) {
            if ($advantages = $product->getNdmAdvantages()) {
                $ids = $this->explodeData($advantages);
                foreach ($ids as $id) {
                    $result[$id] = $attribute->getSource()->getOptionText($id);
                }
            }
        }

        return $result;
    }

    /**
     * @param string $data
     * @return array
     */
    private function explodeData($data)
    {
        return array_map('trim', array_filter(explode(',', $data)));
    }
}
