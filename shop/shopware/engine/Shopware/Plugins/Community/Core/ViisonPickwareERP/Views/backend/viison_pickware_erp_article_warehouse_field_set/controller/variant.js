Ext.define("Shopware.apps.ViisonPickwareERPArticleWarehouseFieldSet.controller.Variant",{ override:"Shopware.apps.Article.controller.Variant",init:function(){ this.callParent(arguments);this.control({ "article-variant-detail-window viison_pickware_erp_article_warehouse_field_set-warehouse_field_set-list":{ editRow:this.onEditRow}})},onEditRow:function(e,i){ var r=e.up("article-variant-detail-window");var t=r.subApplication.article;var a=r.record;var o=function(){ e.getView().refreshNode(i.store.indexOf(i));r.down("viison_pickware_erp_article_stock_field_set-stock_field_set").reloadData(a);r.down("numberfield[name=purchasePrice]").setValue(a.get("purchasePrice"))};this.getController("Shopware.apps.ViisonPickwareERPBinLocationEditor.controller.Main").createEditor(t,a,i,o)}});
