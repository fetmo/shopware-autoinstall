// {namespace name=backend/viison_pickware_erp_analytics/sales_ratio}
Ext.define("Shopware.apps.ViisonPickwareERPAnalyticsSalesRatio.view.table.SalesRatio",{ extend:"Shopware.apps.Analytics.view.main.Table",alias:"widget.analytics-table-sales-ratio",mixins:["Shopware.apps.ViisonCommonAnalytics.view.main.TableHelpers"],initComponent:function(){ this.columns={ items:this.getColumns(),defaults:{ flex:1,sortable:true}};this.callParent(arguments)},getColumns:function(){ return[{ dataIndex:"article_number",text:'{s name=table/article_number}Article Number{/s}',align:"right",sortable:false},{ dataIndex:"name",text:'{s name=table/items_sales/article_name namespace=backend/analytics/view/main}Article name{/s}'},{ xtype:"numbercolumn",dataIndex:"sales",text:'{s name=table/items_sales/sells namespace=backend/analytics/view/main}Sales{/s}',format:"0",align:"right"},{ xtype:"numbercolumn",dataIndex:"stocked",text:'{s name=table/stock}Stock{/s}',format:"0",align:"right"},{ xtype:"numbercolumn",dataIndex:"sales_ratio",align:"right",text:'{s name=table/sales_ratio}Sales Ratio{/s}',renderer:this.percentageRenderer}]}});