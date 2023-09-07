define([
    'uiComponent',
    'ko',
    'mage/storage',
    'jquery',
    'mage/translate'
],function(
    Component,
    ko,
    storage,
    $,
    $t
){
    'use strict';

    return Component.extend({

        defaults:{
            sku:ko.observable('24-MB01'),
            placeholder: $t('Example: %1').replace('%1','24-MB01'),
            button:'Confirm SKU',
            messageResponse:ko.observable(''),
            isSuccess:ko.observable(false),
        },
        initialize(){
            this._super();
            console.log('skulookup component is running');
        },
        handleSubmit(){
            $('body').trigger('processStart');
            this.messageResponse('');
            this.isSuccess(false);

            storage.get(`rest/V1/products/${this.sku()}`)
                .done(res => {
                    this.messageResponse(`Product found ! <strong>${res.name}</strong>`);
                    this.messageResponse( $t('Product found! %1').replace('%1',`<strong>${res.name}</strong>`));
                    this.isSuccess(true);
                })
                .fail(()=>{
                    this.messageResponse($t('No Product found'));
                    this.isSuccess(false);
                })
                .always(()=>{
                    $('body').trigger('processStop');
                });
        }
    });
})