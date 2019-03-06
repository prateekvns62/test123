define([
    "jquery",
    "jquery/ui"
], function($){
    'use strict';

    $.widget('homepage.categorytab', {

        _create: function() {
            this._initialize();
            this._bind();
        },

        _bind: function(){
            var self = this;
            $(this.tabLinkItemClass).on('click', function(e){
                e.preventDefault();
                self._switchTab($(this));
            });
        },

        _initialize: function () {
            this.tabLinkItemClass = 'li.tab-item';
            this.tabContentClass = '.tab-content';
            this.categoryDataProp = 'config';
            this._getUrl = this.options.url || '';
            this._switchTab();
        },

        _switchTab: function(element){
            var tab =  $(this.tabLinkItemClass);
            if (tab !== 'undefined'){
                element = typeof element !== 'undefined' ?  element : tab.first();
                tab.removeClass('active');
                element.addClass('active');
                this._switchContent(element.data(this.categoryDataProp));
            }
        },

        _switchContent: function(categoryId){
            if (this._getUrl !== '' && categoryId !== 'undefined'){
                var self = this;
                $.ajax({
                    showLoader: true,
                    url: this._getUrl,
                    data: {category:categoryId},
                    type: "POST",
                    cache: false
                }).done(function (data) {
                    $(self.tabContentClass).html(data.output);
                    $('body').trigger('contentUpdated');
                    return true;
                });
            }
        }
    });

    return $.homepage.categorytab;
});