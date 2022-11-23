<?php

namespace Tech9logy\ExtendWarranty\Model\Creditmemo\Total;

use Magento\Sales\Model\Order\Creditmemo\Total\AbstractTotal;

class AddServiceAmount extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Creditmemo $creditmemo)
    {
        $creditmemo->setServiceAmount(0);
        
        $amount = $creditmemo->getOrder()->getServiceAmount();
        $creditmemo->setServiceAmount($amount);

        $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $creditmemo->getServiceAmount());
        $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $creditmemo->getServiceAmount());

        return $this;
    }
}
