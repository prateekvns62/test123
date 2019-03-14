<?php
namespace Ninedotmedia\ProductAttributes\Block\Product;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class Label extends Additional
{
    /**
     * @var PriceCurrencyInterface
     */
    private $priceCurrency;

    /**
     * @var array
     */
    private $defaultLabelParams = [
        'label'     => '',
        'class'     => 'label',
        'type'      => ''
    ];

    /**
     * Label constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param PriceCurrencyInterface $priceCurrency
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        PriceCurrencyInterface $priceCurrency,
        array $data = []
    ) {
        $this->setLabelData($data);
        $this->priceCurrency = $priceCurrency;
        parent::__construct($context, $registry, $data);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('Ninedotmedia_ProductAttributes::product/additional/label.phtml');
        return $this;
    }

    /**
     * @param array $arguments
     */
    public function setLabelData(array $arguments)
    {
        $this->resetDefaultParams();
        $this->defaultLabelParams = array_replace($this->defaultLabelParams, $arguments);
    }

    /**
     * @return array
     */
    public function getLabelData()
    {
        $result = [];
        $params = $this->defaultLabelParams;
        $type = (isset($params['type'])) ? $params['type'] : null;
        $value = null;

        switch ($type) {
            case 'saved_money':
                $value = $this->getSavedMoneyLabel();
                break;
            case 'guarantee':
                $value = $this->getGuaranteeLabel();
                break;
        }

        if ($value) {
            $params['content'] = $value;
            $result = $params;
        }

        return $result;
    }

    /**
     * @return null|string
     */
    public function getSavedMoneyLabel()
    {
        $product = $this->getProduct();
        if (!$product) {
            return null;
        }

        $save = ($product->getPrice() - $product->getFinalPrice());
        return (((float) $save > 0)) ?
            $this->priceCurrency->convertAndFormat($save) :
            null;
    }

    /**
     * @return array|null|string
     */
    public function getGuaranteeLabel()
    {
        return ($product = $this->getProduct()) ?
            $product->getAttributeText('ndm_guarantee') : null;
    }

    /**
     * Reset default values
     */
    private function resetDefaultParams()
    {
        foreach ($this->defaultLabelParams as $k => &$defaultLabelParam) {
            if ($k == 'label' || $k == 'type') {
                $defaultLabelParam = '';
            }
        }
    }
}
