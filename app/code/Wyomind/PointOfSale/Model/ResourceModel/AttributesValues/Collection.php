<?php


namespace Wyomind\PointOfSale\Model\ResourceModel\AttributesValues;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Wyomind\PointOfSale\Model\AttributesValues', 'Wyomind\PointOfSale\Model\ResourceModel\AttributesValues');
    }

    public function getByPointOfSaleId($posId)
    {
        $this->addFieldToFilter("pointofsale_id", ["eq" => $posId]);
        $pointofsaleAttributes = $this->getTable("pointofsale_attributes");
        $this->join($pointofsaleAttributes, $pointofsaleAttributes . ".attribute_id = main_table.attribute_id", ["code"]);
        return $this;
    }

}
