Ext.define("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.edit.BinLocations.BinLocationCreation",{ extend:"Ext.window.Window",alias:"widget.viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_creation",mixins:["Shopware.apps.ViisonCommonApp.Mixin"],viisonSnippetNamespace:"backend/viison_pickware_erp_warehouse_management/main",layout:"fit",modal:true,width:300,height:120,initComponent:function(){ this.title=this.getViisonSnippet("edit/bin_location_creation/title");this.items=[{ xtype:"form",bodyPadding:10,defaults:{ labelWidth:120},items:this.createFormItems()}];this.dockedItems=this.createDockedItems();this.callParent(arguments)},createFormItems:function(){ return[{ name:"code",xtype:"textfield",fieldLabel:this.getViisonSnippet("edit/bin_location_creation/form/field/code"),allowBlank:false}]},createDockedItems:function(){ return[{ xtype:"toolbar",dock:"bottom",ui:"shopware-ui",items:["->",{ xtype:"button",text:this.getViisonSnippet("edit/bin_location_creation/toolbar/button/cancel"),action:"cancel",cls:"secondary"},{ xtype:"button",text:this.getViisonSnippet("edit/bin_location_creation/toolbar/button/save"),action:"save",cls:"primary"}]}]}});