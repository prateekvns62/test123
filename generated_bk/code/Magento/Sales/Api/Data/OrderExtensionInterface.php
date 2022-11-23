<?php
namespace Magento\Sales\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Sales\Api\Data\OrderInterface
 */
interface OrderExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\Sales\Api\Data\ShippingAssignmentInterface[]|null
     */
    public function getShippingAssignments();

    /**
     * @param \Magento\Sales\Api\Data\ShippingAssignmentInterface[] $shippingAssignments
     * @return $this
     */
    public function setShippingAssignments($shippingAssignments);

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

    /**
     * @return \Magento\GiftMessage\Api\Data\MessageInterface|null
     */
    public function getGiftMessage();

    /**
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return $this
     */
    public function setGiftMessage(\Magento\GiftMessage\Api\Data\MessageInterface $giftMessage);

    /**
     * @return string|null
     */
    public function getAmextrafeeFeeId();

    /**
     * @param string $amextrafeeFeeId
     * @return $this
     */
    public function setAmextrafeeFeeId($amextrafeeFeeId);

    /**
     * @return float|null
     */
    public function getAmextrafeeFeeAmount();

    /**
     * @param float $amextrafeeFeeAmount
     * @return $this
     */
    public function setAmextrafeeFeeAmount($amextrafeeFeeAmount);

    /**
     * @return float|null
     */
    public function getAmextrafeeBaseFeeAmount();

    /**
     * @param float $amextrafeeBaseFeeAmount
     * @return $this
     */
    public function setAmextrafeeBaseFeeAmount($amextrafeeBaseFeeAmount);

    /**
     * @return float|null
     */
    public function getAmextrafeeTaxAmount();

    /**
     * @param float $amextrafeeTaxAmount
     * @return $this
     */
    public function setAmextrafeeTaxAmount($amextrafeeTaxAmount);

    /**
     * @return float|null
     */
    public function getAmextrafeeBaseTaxAmount();

    /**
     * @param float $amextrafeeBaseTaxAmount
     * @return $this
     */
    public function setAmextrafeeBaseTaxAmount($amextrafeeBaseTaxAmount);

    /**
     * @return \Magento\Tax\Api\Data\OrderTaxDetailsAppliedTaxInterface[]|null
     */
    public function getAppliedTaxes();

    /**
     * @param \Magento\Tax\Api\Data\OrderTaxDetailsAppliedTaxInterface[] $appliedTaxes
     * @return $this
     */
    public function setAppliedTaxes($appliedTaxes);

    /**
     * @return \Magento\Tax\Api\Data\OrderTaxDetailsItemInterface[]|null
     */
    public function getItemAppliedTaxes();

    /**
     * @param \Magento\Tax\Api\Data\OrderTaxDetailsItemInterface[] $itemAppliedTaxes
     * @return $this
     */
    public function setItemAppliedTaxes($itemAppliedTaxes);

    /**
     * @return boolean|null
     */
    public function getConvertingFromQuote();

    /**
     * @param boolean $convertingFromQuote
     * @return $this
     */
    public function setConvertingFromQuote($convertingFromQuote);
}
