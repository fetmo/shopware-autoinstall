// {namespace name=backend/viison_pickware_erp_order_shipped_column/main}
Ext.define("Shopware.apps.ViisonPickwareERPOrderShippedColumn.view.detail.Position",{ override:"Shopware.apps.Order.view.detail.Position",getColumns:function(){ var i=this.callParent(arguments);i.splice(4,0,{ dataIndex:"shipped",header:'{s name=column/shipped/header}{/s}',width:60,editor:{ xtype:"numberfield",allowBlank:false,minValue:0}});return i}});
