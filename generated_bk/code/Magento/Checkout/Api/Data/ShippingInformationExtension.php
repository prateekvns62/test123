<?php
namespace Magento\Checkout\Api\Data;

/**
 * Extension class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
class ShippingInformationExtension extends \Magento\Framework\Api\AbstractSimpleObject implements ShippingInformationExtensionInterface
{
    /**
     * @return string|null
     */
    public function getAmdeliverydateDate()
    {
        return $this->_get('amdeliverydate_date');
    }

    /**
     * @param string $amdeliverydateDate
     * @return $this
     */
    public function setAmdeliverydateDate($amdeliverydateDate)
    {
        $this->setData('amdeliverydate_date', $amdeliverydateDate);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmdeliverydateTime()
    {
        return $this->_get('amdeliverydate_time');
    }

    /**
     * @param string $amdeliverydateTime
     * @return $this
     */
    public function setAmdeliverydateTime($amdeliverydateTime)
    {
        $this->setData('amdeliverydate_time', $amdeliverydateTime);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmdeliverydateComment()
    {
        return $this->_get('amdeliverydate_comment');
    }

    /**
     * @param string $amdeliverydateComment
     * @return $this
     */
    public function setAmdeliverydateComment($amdeliverydateComment)
    {
        $this->setData('amdeliverydate_comment', $amdeliverydateComment);
        return $this;
    }
}
