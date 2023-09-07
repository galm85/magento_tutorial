define([
    'uiComponent',
    'ko'
],function(
    Component,
    ko
){
    'use strict';

    const boxConfiguration = ()=>{
        return{
            length: ko.observable(),
            width: ko.observable(),
            height: ko.observable(),
            weight: ko.observable(),
            unitesPerBox: ko.observable(),
            numberOfBoxes: ko.observable()
        }
    }

    return Component.extend({
        defaults:{
            boxConfigurations:ko.observableArray([boxConfiguration()]),
        },
        initialize(){
            this._super();
            console.log('box configuration component is loaded');
        },
        handleAdd(){
            this.boxConfigurations.push(boxConfiguration());
        },
        handleDelete(index){
           this.boxConfigurations.splice(index,1);
        },
        handleSubmit(){
            console.log('submit')
        }
    })

});