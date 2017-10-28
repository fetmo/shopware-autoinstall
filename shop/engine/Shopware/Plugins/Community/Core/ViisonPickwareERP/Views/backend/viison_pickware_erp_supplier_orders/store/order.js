Ext.define("Shopware.apps.ViisonPickwareERPSupplierOrders.reader.OrderJson",{ extend:"Ext.data.reader.Json",type:"json",root:"data",totalProperty:"total",readRecords:function(e){ if(e&&e.data){ Ext.each(e.data,function(e){ if(e.supplier){ e.supplier=[e.supplier]}})}return this.callParent([e])}});Ext.define("Shopware.apps.ViisonPickwareERPSupplierOrders.writer.OrderJson",{ extend:"Ext.data.writer.Json",type:"json",root:"data",allowSingle:false,getRecordData:function(){ var e=this.callParent(arguments);if(Ext.isArray(e.supplier)&&e.supplier.length===1){ e.supplier=e.supplier[0]}return e}});Ext.define("Shopware.apps.ViisonPickwareERPSupplierOrders.store.Order",{ extend:"Ext.data.Store",model:"Shopware.apps.ViisonPickwareERPSupplierOrders.model.Order",autoLoad:false,remoteFilter:true,remoteSort:true,sorters:[{ property:"created",direction:"DESC"}],proxy:{ type:"ajax",batchActions:true,api:{ read:'{url controller=ViisonPickwareERPSupplierOrders action=getOrderList}',create:'{url controller=ViisonPickwareERPSupplierOrders action=createOrders}',update:'{url controller=ViisonPickwareERPSupplierOrders action=updateOrders}',destroy:'{url controller=ViisonPickwareERPSupplierOrders action=deleteOrders}'},reader:Ext.create("Shopware.apps.ViisonPickwareERPSupplierOrders.reader.OrderJson",{ }),writer:Ext.create("Shopware.apps.ViisonPickwareERPSupplierOrders.writer.OrderJson",{ }),encodeSorters:function(e){ e.forEach(function(e){ if(e.property==="warehouseId"){ e.property="warehouse.name"}});var r=Ext.create("Ext.data.proxy.Ajax",{ });var a=r.encodeSorters(e);return a}}});