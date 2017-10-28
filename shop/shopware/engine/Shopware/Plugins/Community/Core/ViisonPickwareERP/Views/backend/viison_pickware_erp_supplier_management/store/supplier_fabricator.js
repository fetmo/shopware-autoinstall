Ext.define("Shopware.apps.ViisonPickwareERPSupplierManagement.store.SupplierFabricator",{ extend:"Ext.data.Store",model:"Shopware.apps.ViisonPickwareERPSupplierManagement.model.SupplierFabricator",autoLoad:false,remoteFilter:true,remoteSort:true,sorters:[{ property:"fabricator.name"}],proxy:{ type:"ajax",batchActions:true,api:{ read:'{url controller=ViisonPickwareERPSupplierManagement action=getSupplierFabricatorList}',create:'{url controller=ViisonPickwareERPSupplierManagement action=createSupplierFabricators}',update:'{url controller=ViisonPickwareERPSupplierManagement action=updateSupplierFabricators}',destroy:'{url controller=ViisonPickwareERPSupplierManagement action=deleteSupplierFabricators}'},reader:{ type:"json",root:"data",totalProperty:"total"},writer:{ type:"json",root:"data",allowSingle:false}}});
