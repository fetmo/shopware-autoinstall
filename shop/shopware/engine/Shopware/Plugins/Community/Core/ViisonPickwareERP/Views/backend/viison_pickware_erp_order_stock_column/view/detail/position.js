// {namespace name=backend/viison_pickware_erp_stock_column/main}
Ext.define("Shopware.apps.ViisonPickwareERPOrderStockColumn.view.detail.Position",{ override:"Shopware.apps.Order.view.detail.Position",getColumns:function(){ var i=this.callParent(arguments);Ext.each(i,function(i){ if(i.dataIndex==="inStock"){ i.header='{s name=column/in_stock/header}{/s}';i.tooltip='{s name=column/in_stock/tooltip}{/s}'}});return i}});