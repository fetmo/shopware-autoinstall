Ext.override(Shopware.form.PluginPanel,{ initComponent:function(){ ViisonPickwarePurchasePriceConverter.observeFormStore(this.formStore);this.callParent(arguments)}});
