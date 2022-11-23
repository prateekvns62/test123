/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    "Magento_Checkout/js/view/summary/abstract-total",
    "Magento_Checkout/js/model/quote",
    "Magento_Catalog/js/price-utils",
    "Magento_Checkout/js/model/totals",
    "ko",
    "jquery",
], function(Component, quote, priceUtils, totals, ko, $) {
    "use strict";

    return Component.extend({
        defaults: {
            template: "Tech9logy_ExtendWarranty/summary/services",
        },
        totals: quote.getTotals(),
        isTaxDisplayedInGrandTotal: window.checkoutConfig.includeTaxInGrandTotal || false,
        isDisplayed: function() {
            return this.isFullMode();
        },
        appliedServices: "",

        showExtendedServices: function() {
            return window.checkoutConfig.show_hide_service_block;
        },

        getServicesApplied: function() {
            if (
                window.checkoutConfig.service_applied &&
                window.checkoutConfig.service_amount != null
            ) {
                var data = $.parseJSON(window.checkoutConfig.service_applied);
                //console.log(data);
                var self = this;
                var appliedSrc = [];
                $.each(data, function(key, val) {
                    val = $.parseJSON(val);
                    console.log(val);
                    var amt = self.frmtPrice(val.price * val.qty);
                    var item = {
                        name: val.name,
                        skutitle: "SKU : " + val.sku,
                        amount: amt,
                        qty: val.qty,
                    };
                    appliedSrc.push(item);
                });

                return appliedSrc;
            } else {
                return false;
            }
        },
        getValue: function() {
            var price = window.checkoutConfig.service_amount;
            if (this.totals()) {
                price = price;
            }
            return this.getFormattedPrice(price);
        },

        frmtPrice: function(price) {
            return this.getFormattedPrice(price);
        },
    });
});