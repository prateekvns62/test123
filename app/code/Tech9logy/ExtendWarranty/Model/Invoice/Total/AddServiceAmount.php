<?php

namespace Tech9logy\ExtendWarranty\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;

class AddServiceAmount extends AbstractTotal
{
    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this
     */
    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {
        $invoice->setServiceAmount(0);
        
        $amount = $invoice->getOrder()->getServiceAmount();
        $invoice->setServiceAmount($amount);
       

        $invoice->setGrandTotal($invoice->getGrandTotal() + $invoice->getServiceAmount());
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $invoice->getServiceAmount());

        return $this;
    }
}
