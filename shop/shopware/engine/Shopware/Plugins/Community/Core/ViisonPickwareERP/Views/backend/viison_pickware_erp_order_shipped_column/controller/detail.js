// {namespace name=backend/viison_pickware_erp_order_shipped_column/main}
Ext.define("Shopware.apps.ViisonPickwareERPOrderShippedColumn.controller.Detail",{ override:"Shopware.apps.Order.controller.Detail",skipAlert:false,onSavePosition:function(e,i,r,s){ if(!this.skipAlert&&i.newValues.shipped!==i.record.raw.shipped&&(!i.record.phantom||i.newValues.shipped>0)){ ViisonPickwareBinLocationSelectionAlert.selectWarehouse('{s name=alert/title}{/s}','{s name=alert/message}{/s}',Ext.Msg.OKCANCEL,function(t,a){ if(t!=="ok"){ e.startEdit(i.record,e.context.column);return}var l=i.record.getProxy();l.extraParams=l.extraParams||{ };l.extraParams.warehouseId=a.get("id");var o=s||{ };var I=s.callback;o.callback=function(e){ i.record.raw.shipped=i.newValues.shipped;if(Ext.isFunction(I)){ I(e)}};this.skipAlert=true;this.onSavePosition(e,i,r,o)},this)}else{ this.skipAlert=false;this.callParent(arguments)}}});
