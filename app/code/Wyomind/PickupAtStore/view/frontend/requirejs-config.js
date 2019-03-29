/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * https://www.wyomind.com
 */
var config = {
    config: {
        mixins: {

            'Magento_Checkout/js/view/shipping': {
                'Wyomind_PickupAtStore/js/view/shipping': true
            },
            'Magento_Checkout/js/model/checkout-data-resolver': {
                'Wyomind_PickupAtStore/js/model/checkout-data-resolver': true
            },
            'Magento_Checkout/js/view/shipping-information': {
                'Wyomind_PickupAtStore/js/view/shipping-information': true
            },
            'Magento_Checkout/js/view/billing-address': {
                'Wyomind_PickupAtStore/js/view/billing-address' : true
            },
            'Magento_Paypal/js/order-review': {
                'Wyomind_PickupAtStore/js/order-review' : true
            },


            // Aheadworks One Step Checkout
            'Aheadworks_OneStepCheckout/js/view/place-order/aggregate-validator': {
                'Wyomind_PickupAtStore/js/view/place-order/aw-osc-aggregate-validator' : true
            },


            // Mageplaza One Step Checkout
            'Mageplaza_Osc/js/view/shipping': {
                'Wyomind_PickupAtStore/js/view/mp-osc-shipping': true
            },
            'Mageplaza_Osc/js/view/billing-address': {
                'Wyomind_PickupAtStore/js/view/mp-osc-billing-address' : true
            }
        }
    }
};