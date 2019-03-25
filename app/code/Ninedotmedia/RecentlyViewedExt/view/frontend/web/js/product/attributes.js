/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/grid/columns/column',
    'Magento_Catalog/js/product/uenc-processor',
    'Magento_Catalog/js/product/list/column-status-validator'
], function (Column,uencProcessor, columnStatusValidator) {
    'use strict';

    return Column.extend({

        getDataTop: function (row) {
            return uencProcessor(row['extension_attributes']['characteristic_additional'].top_attributes);
        },

        getDataCondition: function (row) {
            return uencProcessor(row['extension_attributes']['characteristic_additional'].condition);
        },

        getDataAdvantages: function (row) {
            return uencProcessor(row['extension_attributes']['characteristic_additional'].advantages);
        },

        getDataLabels: function (row) {
            return uencProcessor(row['extension_attributes']['characteristic_additional'].labels);
        },

        getDataSavePrice: function (row) {
            return uencProcessor(row['extension_attributes']['characteristic_additional'].save_price);
        },

        /**
         * Depends on this option, product name can be shown or hide. Depends on  backend configuration
         *
         * @returns {Boolean}
         */
        isAllowed: function () {
            return columnStatusValidator.isValid(this.source(), 'top_attributes', 'show_attributes');
        }
    });
});
