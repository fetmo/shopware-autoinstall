// {namespace name=backend/viison_pickware_erp_article_profit_margin/main}
Ext.define("Shopware.apps.ViisonPickwareERPArticleProfitMargin.view.variant.Detail",{ override:"Shopware.apps.Article.view.variant.Detail",createBaseFieldSet:function(){ var i=this.callParent(arguments);Ext.Array.each(i.items.items,function(i){ if(i.name==="purchasePrice"){ i.on({ scope:this,change:function(i,e){ this.subApp.articleWindow.fireEvent("viisonPurchasePriceChanged",i,e)}})}},this);return i},createPriceFieldSet:function(){ var i=function(i){ i.mainArticle=this.subApp.articleWindow.article;i.taxStore=this.subApp.articleWindow.taxStore};this.subApp.articleWindow.on("didCreateElements",i,this);this.on("beforedestroy",function(){ this.subApp.articleWindow.un("didCreateElements",i,this)},this);return this.callParent(arguments)}});
