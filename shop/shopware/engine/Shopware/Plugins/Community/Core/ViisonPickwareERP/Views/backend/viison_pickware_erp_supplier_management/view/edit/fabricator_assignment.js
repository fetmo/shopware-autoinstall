// {namespace name=backend/viison_pickware_erp_supplier_management/main}
Ext.define("Shopware.apps.ViisonPickwareERPSupplierManagement.view.edit.FabricatorAssignment",{ extend:"Shopware.apps.ViisonPickwareERPSupplierCommon.view.AssignmentPanel",alias:"widget.viison_pickware_erp_supplier_management-edit-fabricator_assignment",title:'{s name=edit/fabricator_assignment/title}{/s}',initComponent:function(){ this.dockedItems=[{ xtype:"toolbar",dock:"bottom",ui:"shopware-ui",items:["->",{ text:'{s name=edit/fabricator_assignment/toolbar/button/assign_all_fabricator_articles}{/s}',cls:"primary",action:"assignAllFabricatorArticles"}]}];this.callParent(arguments);this.setDisabled(this.record.phantom)},createLeftColumns:function(){ return this.createFabricatorColumns()},getRightPanelConfig:function(){ var i=this.callParent(arguments);i.dockedItems=i.dockedItems||[];i.dockedItems.splice(0,0,this.createPagingToolbar(this.rightStore));return i},createRightColumns:function(){ return this.createFabricatorColumns()},createFabricatorColumns:function(){ return[{ xtype:"gridcolumn",header:'{s name=edit/fabricator_assignment/column/fabricator}{/s}',dataIndex:"name",flex:1},{ xtype:"gridcolumn",header:'{s name=edit/fabricator_assignment/column/link}{/s}',dataIndex:"link",flex:1}]}});
