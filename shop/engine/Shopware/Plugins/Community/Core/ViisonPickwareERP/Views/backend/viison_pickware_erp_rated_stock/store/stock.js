Ext.define("Shopware.apps.ViisonPickwareERPRatedStock.store.Stock",{ extend:"Ext.data.Store",model:"Shopware.apps.ViisonPickwareERPRatedStock.model.Stock",autoLoad:false,remoteFilter:true,remoteSort:false,sorters:[{ property:"created",direction:"DESC"}],proxy:{ type:"ajax",batchActions:true,api:{ read:'{url controller=ViisonPickwareERPRatedStock action=getInventoryInStock}'},reader:{ type:"json",root:"data"}}});