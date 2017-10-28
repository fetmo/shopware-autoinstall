// {namespace name=backend/viison_pickware_erp_supplier_management/main}
Ext.define("Shopware.apps.ViisonPickwareERPSupplierManagement.view.edit.ArticleAssignment",{ extend:"Shopware.apps.ViisonPickwareERPSupplierCommon.view.AssignmentPanel",alias:"widget.viison_pickware_erp_supplier_management-edit-article_assignment",title:'{s name=edit/article_assignment/title}{/s}',initComponent:function(){ this.callParent(arguments);this.setDisabled(this.record.phantom)},createLeftColumns:function(){ return this.createArticleColumns()},getRightPanelConfig:function(){ var i=this.callParent(arguments);i.plugins=i.plugins||[];i.plugins.push(Ext.create("Ext.grid.plugin.RowEditing",{ clicksToMoveEditor:1,autoCancel:false,listeners:{ edit:function(i,e){ e.record.set("purchasePrice",e.newValues.purchasePrice);e.record.commit();this.fireEvent("articleRowEdited",this,e.record)},scope:this}}));i.dockedItems=i.dockedItems||[];i.dockedItems.splice(0,0,this.createPagingToolbar(this.rightStore));return i},createRightColumns:function(){ var i=this.createArticleColumns();i.splice(3,0,{ xtype:"gridcolumn",header:'{s name=edit/article_assignment/column/supplierArticleNumber}{/s}',dataIndex:"supplierArticleNumber",flex:1,editor:{ xtype:"textfield"}},{ xtype:"gridcolumn",header:ViisonPickwarePurchasePriceHelper.purchasePriceLabel('{s name=edit/article_assignment/column/price}{/s}'),dataIndex:"purchasePrice",width:75,align:"right",editor:{ xtype:"numberfield",allowBlank:true,minValue:0,step:.01},renderer:ViisonCurrencyFormatter.renderer},{ xtype:"gridcolumn",header:'{s name=edit/article_assignment/column/order_amount}{/s}',dataIndex:"orderAmount",width:125,align:"right",editor:{ xtype:"numberfield",allowBlank:true,minValue:0,step:1}});return i},createArticleColumns:function(){ return[{ xtype:"gridcolumn",header:'{s name=edit/article_assignment/column/name}{/s}',dataIndex:"name",flex:1},{ xtype:"gridcolumn",header:'{s name=edit/article_assignment/column/order_number}{/s}',dataIndex:"orderNumber",width:100},{ xtype:"gridcolumn",header:'{s name=edit/article_assignment/column/fabricator_name}{/s}',dataIndex:"fabricatorName",width:100},{ xtype:"actioncolumn",width:25,items:[{ iconCls:"sprite-sticky-notes-pin",action:"showArticleDetail",tooltip:'{s name=edit/article_assignment/tooltip/show_article_details}{/s}',handler:function(i,e){ this.fireEvent("showArticleDetail",i.getStore().getAt(e))},scope:this}]}]}});