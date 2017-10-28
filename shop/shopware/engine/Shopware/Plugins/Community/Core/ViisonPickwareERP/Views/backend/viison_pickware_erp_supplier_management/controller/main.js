// {namespace name=backend/viison_pickware_erp_supplier_management/main}
Ext.define("Shopware.apps.ViisonPickwareERPSupplierManagement.controller.Main",{ extend:"Ext.app.Controller",mainWindow:null,refs:[{ ref:"listView",selector:"viison_pickware_erp_supplier_management-main-list"},{ ref:"detailView",selector:"viison_pickware_erp_supplier_management-main-details"}],init:function(){ this.control({ "viison_pickware_erp_supplier_management-main-list button[action=addSupplier]":{ click:this.onAddSupplier},"viison_pickware_erp_supplier_management-main-list":{ editSupplier:this.onEditSupplier,deleteSupplier:this.onDeleteSupplier,select:this.onSupplierSelected,searchFieldChanged:this.onSearchFieldChanged}});this.supplierStore=Ext.create("Shopware.apps.ViisonPickwareERPSupplierManagement.store.Supplier",{ });this.supplierStore.on("load",this.clearDetailView,this);this.supplierStore.load();this.mainView=this.getView("Main").create({ supplierStore:this.supplierStore});this.callParent(arguments)},onAddSupplier:function(){ var e=Ext.create("Shopware.apps.ViisonPickwareERPSupplierManagement.model.Supplier",{ });this.getController("Edit").createEditWindow(e)},onEditSupplier:function(e){ this.getController("Edit").createEditWindow(e)},onDeleteSupplier:function(e){ Ext.Msg.confirm('{s name=alert/title}{/s}','{s name=alert/message/delete}{/s}',function(i){ if(i!=="yes"){ return}this.supplierStore.remove(e);this.syncSuppliers('{s name=notification/error/message/delete}{/s}')},this)},onSupplierSelected:function(e,i){ this.getDetailView().dataView.update(i.data);this.getDetailView().expand()},onSearchFieldChanged:function(e){ this.supplierStore.getProxy().extraParams.query=e;this.supplierStore.loadPage(1)},syncSuppliers:function(e,i){ var t=this.supplierStore.getNewRecords().length+this.supplierStore.getModifiedRecords().length+this.supplierStore.getRemovedRecords().length;if(t===0){ if(Ext.isFunction(i)){ i(true)}return}this.selectedRow=null;this.mainView.setLoading(true);this.supplierStore.sync({ scope:this,success:function(){ this.mainView.setLoading(false);this.clearDetailView();if(Ext.isFunction(i)){ i(true)}},failure:function(){ this.mainView.setLoading(false);this.supplierStore.rejectChanges();var t=e||"";Shopware.Notification.createGrowlMessage('{s name=notification/error/title}{/s}',t,"ViisonPickwareERPSupplierManagement");if(Ext.isFunction(i)){ i(false)}}})},clearDetailView:function(){ this.getDetailView().dataView.update({ })}});