define([
    'jquery',
    'Magento_Catalog/js/product/list/columns/image',
    'Magento_Catalog/js/product/uenc-processor'
], function ($, Element,  uencProcessor) {
    "use strict";

    var ImageComponentExt = Element.extend({
        getDataLabels: function (row) {
            return uencProcessor(row['extension_attributes']['characteristic_additional'].labels);
        }
    });

    return ImageComponentExt;
});