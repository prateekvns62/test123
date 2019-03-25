<?php
namespace Ninedotmedia\RecentlyViewedExt\Model;

use Ninedotmedia\RecentlyViewedExt\Api\Data\TopAttributesInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class TopAttributes extends AbstractExtensibleModel implements TopAttributesInterface
{
    /**
     * @return string
     */
    public function getTopAttributes()
    {
        return $this->getData('top_attributes');
    }

    /**
     * @param string $params
     * @inheritdoc
     */
    public function setTopAttributes($params)
    {
        $this->setData('top_attributes', ($params));
    }

    /**
     * @param string $condition
     * @inheritdoc
     */
    public function setCondition($condition)
    {
        $this->setData('condition', trim($condition));
    }

    /**
     * @return mixed
     */
    public function getCondition()
    {
        return $this->getData('condition');
    }

    /**
     * @param string $advantages
     * @inheritdoc
     */
    public function setAdvantages($advantages)
    {
        $this->setData('advantages', trim($advantages));
    }

    /**
     * @return mixed
     */
    public function getAdvantages()
    {
        return $this->getData('advantages');
    }

    public function setLabels($labels)
    {
        $this->setData('labels', trim($labels));
    }

    /**
     * @return mixed
     */
    public function getLabels()
    {
        return $this->getData('labels');
    }

    /**
     * @param $savePrice
     * @inheritdoc
     */
    public function setSavePrice($savePrice)
    {
        $this->setData('save_price', trim($savePrice));
    }

    /**
     * @return mixed
     */
    public function getSavePrice()
    {
        return $this->getData('save_price');
    }
}
