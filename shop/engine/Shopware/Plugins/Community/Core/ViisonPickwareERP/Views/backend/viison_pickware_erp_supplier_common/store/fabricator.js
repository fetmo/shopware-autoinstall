Ext.define("Shopware.apps.ViisonPickwareERPSupplierCommon.store.Fabricator",{ extend:"Ext.data.Store",model:"Shopware.apps.ViisonPickwareERPSupplierCommon.model.Fabricator",autoLoad:false,remoteFilter:true,remoteSort:true,sorters:[{ property:"name"}],proxy:{ type:"ajax",api:{ read:'{url controller=ViisonPickwareERPSupplierCommon action=getFabricatorList}'},reader:{ type:"json",root:"data",totalProperty:"total"}}});