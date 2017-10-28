Ext.define("Shopware.apps.ViisonPickwareERPWarehouseManagement.model.Warehouse",{ extend:"Ext.data.Model",fields:[{ name:"id",type:"int"},{ name:"code",type:"string"},{ name:"name",type:"string"},{ name:"stockAvailable",type:"boolean",defaultValue:true},{ name:"defaultWarehouse",type:"boolean",defaultValue:false},{ name:"contact",type:"string"},{ name:"email",type:"string"},{ name:"phone",type:"string"},{ name:"address",type:"string"},{ name:"comment",type:"string"},{ name:"displayName",convert:function(e,a){ return a.get("name")+" ("+a.get("code")+")"}}],associations:[{ type:"hasMany",model:"Shopware.apps.ViisonPickwareERPWarehouseManagement.model.BinLocation",associationKey:"binLocations",name:"binLocations",getterName:"getBinLocations",setterName:"setBinLocations"},{ type:"hasMany",model:"Shopware.apps.ViisonPickwareERPWarehouseManagement.model.BinLocationFormatComponent",associationKey:"binLocationFormatComponents",name:"binLocationFormatComponents",getterName:"getBinLocationFormatComponents",setterName:"setBinLocationFormatComponents"}]});