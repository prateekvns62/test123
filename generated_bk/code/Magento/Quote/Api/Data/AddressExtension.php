<?php
namespace Magento\Quote\Api\Data;

/**
 * Extension class for @see \Magento\Quote\Api\Data\AddressInterface
 */
class AddressExtension extends \Magento\Framework\Api\AbstractSimpleObject implements AddressExtensionInterface
{
    /**
     * @return \Amasty\Conditions\Api\Data\AddressInterface|null
     */
    public function getAdvancedConditions()
    {
        return $this->_get('advanced_conditions');
    }

    /**
     * @param \Amasty\Conditions\Api\Data\AddressInterface $advancedConditions
     * @return $this
     */
    public function setAdvancedConditions(\Amasty\Conditions\Api\Data\AddressInterface $advancedConditions)
    {
        $this->setData('advanced_conditions', $advancedConditions);
        return $this;
    }
}
