Ext.define("Shopware.apps.ViisonPickwareERPArticleStockFieldSet.view.detail.Window",{ override:"Shopware.apps.Article.view.detail.Window",onStoresLoaded:function(){ this.callParent(arguments);var e=this.down("viison_pickware_erp_article_stock_field_set-stock_field_set");e.reloadData(this.article.getMainDetail().first())},createBaseTab:function(){ var e=this.callParent(arguments);var i=-1;Ext.Array.each(this.detailForm.items.items,function(e,t){ if(Ext.getClassName(e)==="Shopware.apps.Article.view.detail.Prices"){ i=t;return false}return undefined});this.detailForm.insert(i+1,Ext.create("Shopware.apps.ViisonPickwareERPArticleStockFieldSet.view.StockFieldSet",{ fieldNames:{ physicalStock:"mainDetail[viisonPhysicalStockForSale]",reservedStock:"mainDetail[viisonReservedStock]",notStockManaged:"mainDetail[viisonNotRelevantForStockManager]",availableStock:"mainDetail[inStock]",minStock:"mainDetail[stockMin]",onSale:"lastStock"}}));return e}});