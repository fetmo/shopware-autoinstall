Ext.define("Shopware.apps.ViisonPickwareERPArticleStock.controller.Article.Detail",{ override:"Shopware.apps.Article.controller.Detail",onSaveArticle:function(i,t,e){ var a=i||this.getMainWindow();var c=Ext.isObject(e)&&Ext.isFunction(e.callback)?e.callback:Ext.emptyFn;e.callback=function(i,t){ if(i&&t){ a.updateViisonPickwareERPArticleStockTab()}c(i,t)};this.callParent([i,t,e])}});