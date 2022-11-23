<?php
namespace Magento\Checkout\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
interface ShippingInformationExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return string|null
     */
    public function getAmdeliverydateDate();

    /**
     * @param string $amdeliverydateDate
     * @return $this
     */
    public function setAmdeliverydateDate($amdeliverydateDate);

    /**
     * @return string|null
     */
    public function getAmdeliverydateTime();

    /**
     * @param string $amdeliverydateTime
     * @return $this
     */
    public function setAmdeliverydateTime($amdeliverydateTime);

    /**
     * @return string|null
     */
    public function getAmdeliverydateComment();

    /**
     * @param string $amdeliverydateComment
     * @return $this
     */
    public function setAmdeliverydateComment($amdeliverydateComment);
}
