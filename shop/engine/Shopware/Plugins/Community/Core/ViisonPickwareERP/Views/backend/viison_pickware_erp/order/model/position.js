//{block name="backend/order/model/position/fields" append}
{ name:"shipped",type:"int"},{ name:"viisonCanceledQuantity",type:"int",defaultValue:0},{ name:"viisonCanceledTotal",type:"float",convert:function(e,I){ if(!Ext.isNumeric(I.get("price"))){ return I.get("price")}return I.get("price")*I.get("viisonCanceledQuantity")}},
//{/block}

