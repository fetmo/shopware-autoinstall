Ext.define("Shopware.apps.ViisonPickwareERPArticleWarehouseFieldSet.model.BinLocation",{ extend:"Ext.data.Model",fields:[{ name:"binLocationId",type:"int",useNull:true},{ name:"binLocationCode",type:"string",useNull:true},{ name:"warehouseId",type:"int"},{ name:"warehouseName",type:"string"},{ name:"warehouseCode",type:"string"},{ name:"defaultBinLocation",type:"auto"},{ name:"stock",type:"int"},{ name:"stockAvailable",type:"boolean",defaultValue:true}]});