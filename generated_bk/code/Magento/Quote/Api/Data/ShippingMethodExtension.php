<?php
namespace Magento\Quote\Api\Data;

/**
 * Extension class for @see \Magento\Quote\Api\Data\ShippingMethodInterface
 */
class ShippingMethodExtension extends \Magento\Framework\Api\AbstractSimpleObject implements ShippingMethodExtensionInterface
{
    /**
     * @return string|null
     */
    public function getAmstartesComment()
    {
        return $this->_get('amstartes_comment');
    }

    /**
     * @param string $amstartesComment
     * @return $this
     */
    public function setAmstartesComment($amstartesComment)
    {
        $this->setData('amstartes_comment', $amstartesComment);
        return $this;
    }
}
