// {namespace name=backend/viison_pickware_erp_supplier_management/main}
Ext.define("Shopware.apps.ViisonPickwareERPSupplierManagement.view.Main",{ extend:"Enlight.app.Window",alias:"widget.viison_pickware_erp_supplier_management-main",title:'{s name=window/title}{/s}',layout:"border",autoShow:true,width:"80%",height:"80%",border:false,initComponent:function(){ this.items=[{ xtype:"viison_pickware_erp_supplier_management-main-list",region:"center",store:this.supplierStore},{ xtype:"viison_pickware_erp_supplier_management-main-details",region:"east"}];this.callParent(arguments)}});