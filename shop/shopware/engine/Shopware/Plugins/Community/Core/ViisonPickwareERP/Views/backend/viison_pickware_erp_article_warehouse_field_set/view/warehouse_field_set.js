// {namespace name=backend/viison_pickware_erp_article_warehouse_field_set/main}
Ext.define("Shopware.apps.ViisonPickwareERPArticleWarehouseFieldSet.view.WarehouseFieldSet",{ extend:"Ext.form.FieldSet",alias:"widget.viison_pickware_erp_article_warehouse_field_set-warehouse_field_set",title:'{s name=title}{/s}',layout:"fit",articleDetail:null,initComponent:function(){ this.items=this.createItems();this.callParent(arguments)},reloadData:function(i){ this.articleDetail=i;if(i.get("viisonNotRelevantForStockManager")){ this.gridPanel.hide();this.stockNotManagedLabel.show()}else{ this.gridPanel.show();this.stockNotManagedLabel.hide()}this.gridPanel.articleDetail=this.articleDetail;var e=this.articleDetail&&this.articleDetail.get("viisonBinLocations")?this.articleDetail.get("viisonBinLocations"):[];this.gridPanel.store.loadData(e)},createItems:function(){ this.gridPanel=Ext.create("Shopware.apps.ViisonPickwareERPArticleWarehouseFieldSet.view.WarehouseFieldSet.List",{ articleDetail:this.articleDetail});this.stockNotManagedLabel=Ext.create("Ext.form.Label",{ text:'{s name=not_relevant_for_stock_manager/label/text}{/s}',hidden:true});return[this.gridPanel,this.stockNotManagedLabel]}});
