Ext.define("Shopware.apps.ViisonPickwareERPStockOverview.model.Sales",{ extend:"Ext.data.Model",fields:[{ name:"date",type:"date"},{ name:"sales",type:"int"},{ name:"salesAverage",type:"float"},{ name:"stock",type:"int"},{ name:"highlightFilterRangeHack",type:"int"}]});