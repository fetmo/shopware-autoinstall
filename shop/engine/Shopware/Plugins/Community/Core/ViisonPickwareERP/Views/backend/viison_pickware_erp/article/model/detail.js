//{block name="backend/article/model/detail/fields" append}
{ name:"viisonBinLocations",type:"auto",defaultValue:[]},{ name:"viisonPhysicalStockForSale",type:"int"},{ name:"viisonNotRelevantForStockManager",type:"boolean"},{ name:"viisonReservedStock",convert:function(n,e){ return e.get("viisonNotRelevantForStockManager")?null:e.get("viisonPhysicalStockForSale")-e.get("inStock")}},
//{/block}

