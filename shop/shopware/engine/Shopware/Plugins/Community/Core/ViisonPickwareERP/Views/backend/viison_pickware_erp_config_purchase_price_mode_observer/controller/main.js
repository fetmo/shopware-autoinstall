Ext.define("Shopware.apps.ViisonPickwareERPConfigPurchasePriceModeObserver.controller.Main",{ override:"Shopware.apps.Config.controller.Main",init:function(){ this.callParent(arguments);ViisonPickwarePurchasePriceConverter.observeFormStore(this.formStore)}});
