Ext.define("Shopware.apps.ViisonPickwareERPWarehouseManagement.store.Warehouse",{ extend:"Ext.data.Store",model:"Shopware.apps.ViisonPickwareERPWarehouseManagement.model.Warehouse",autoLoad:false,remoteFilter:true,remoteSort:true,sorters:[{ property:"warehouse.name"}],proxy:{ type:"ajax",batchActions:true,api:{ read:ViisonCommonApp.assembleBackendUrl("ViisonPickwareERPWarehouseManagement/getWarehouseList"),create:ViisonCommonApp.assembleBackendUrl("ViisonPickwareERPWarehouseManagement/createWarehouses"),update:ViisonCommonApp.assembleBackendUrl("ViisonPickwareERPWarehouseManagement/updateWarehouses"),destroy:ViisonCommonApp.assembleBackendUrl("ViisonPickwareERPWarehouseManagement/deleteWarehouses")},reader:{ type:"json",root:"data",totalProperty:"total"},writer:{ type:"json",root:"data",allowSingle:false}}});