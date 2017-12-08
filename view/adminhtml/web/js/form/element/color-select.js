define([
    'Magento_Ui/js/form/element/abstract',
    'mageUtils',
    'jquery',
    'jquery/colorpicker/js/colorpicker'
], function (Element, utils, $) {
    'use strict';

    return Element.extend({
        defaults: {
            visible: true,
            label: '',
            error: '',
            uid: utils.uniqueid(),
            disabled: false,
            links: {
                value: '${ $.provider }:${ $.dataScope }'
            }
        },

        initialize: function (element) {
            this._super();
            //console.log('init');
            console.log($("primary_link_hover_color").val());

        },

        initColorPickerCallback: function (element) {
            var self = this;

            $(element).ColorPicker({
                onSubmit: function(hsb, hex, rgb, el) {
                    console.log('onClick');
                    self.value('#'+hex);
                    $(el).css('background-color','#'+hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                     $(this).ColorPickerSetColor(this.value);
                }
            }).bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });
        }
    });
});