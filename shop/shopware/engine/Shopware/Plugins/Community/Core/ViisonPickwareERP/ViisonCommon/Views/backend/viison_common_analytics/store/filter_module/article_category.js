Ext.define("Shopware.apps.ViisonCommonAnalytics.store.FilterModule.ArticleCategory",{ extend:"Ext.data.Store",alias:"widget.analytics-store-category",fields:["id","name"],storeId:"Shopware.apps.ViisonCommonAnalytics.store.FilterModule.ArticleCategory",proxy:{ type:"ajax",url:ViisonCommonApp.assembleBackendUrl("Category/getPathByQuery",{ parents:1}),reader:{ type:"json",root:"data"}}});