// {namespace name=backend/viison_pickware_erp_supplier_orders/main}
Ext.define("Shopware.apps.ViisonPickwareERPSupplierOrders.model.order.Status",{ extend:"Ext.data.Model",snippets:{ state0:'{s name=model/order/status/open}{/s}',state1:'{s name=model/order/status/sent_to_supplier}{/s}',state2:'{s name=model/order/status/dispatched_by_supplier}{/s}',state3:'{s name=model/order/status/partly_received}{/s}',state4:'{s name=model/order/status/completely_received}{/s}',state5:'{s name=model/order/status/canceled}{/s}'},fields:[{ name:"id",type:"int"},{ name:"name",type:"string"},{ name:"description",type:"string",convert:function(i,I){ var S=I&&I.snippets?I.snippets["state"+I.get("id")]:i;if(Ext.isString(S)&&S.length>0){ return S}return i}}]});