<?php
namespace Ninedotmedia\RecentlyViewedExt\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface TopAttributesInterface extends ExtensibleDataInterface
{
    /**
     * @param string $params
     * @return mixed
     */
    public function setTopAttributes($params);

    /**
     * @return mixed
     */
    public function getTopAttributes();

    /**
     * @param $condition
     * @return mixed
     */
    public function setCondition($condition);

    /**
     * @return mixed
     */
    public function getCondition();

    /**
     * @param string $advantages
     * @return mixed
     */
    public function setAdvantages($advantages);

    /**
     * @return mixed
     */
    public function getAdvantages();

    /**
     * @param string $labels
     * @return mixed
     */
    public function setLabels($labels);

    /**
     * @return mixed
     */
    public function getLabels();

    /**
     * @param $savePrice
     * @return mixed
     */
    public function setSavePrice($savePrice);

    /**
     * @return mixed
     */
    public function getSavePrice();
}
