// {namespace name=backend/viison_pickware_erp_analytics/gross_profit}
Ext.define("Shopware.apps.ViisonPickwareERPAnalyticsGrossProfit.view.table.GrossProfit",{ extend:"Shopware.apps.Analytics.view.main.Table",alias:"widget.analytics-table-gross-profit",mixins:["Shopware.apps.ViisonCommonAnalytics.view.main.TableHelpers"],features:[{ ftype:"summary"}],initComponent:function(){ this.columns={ items:this.getColumns(),defaults:{ flex:1,sortable:true}};this.callParent(arguments)},getColumns:function(){ function e(e){ return function(){ return this.store.getProxy().getReader().rawData.summary[e]}}return[{ dataIndex:"article_number",text:'{s name=table/article_number}Article Number{/s}',align:"right"},{ dataIndex:"name",text:'{s name=table/items_sales/article_name namespace=backend/analytics/view/main}Article name{/s}'},{ dataIndex:"gross_profit",text:'{s name=table/gross_profit}Gross Profit{/s}',align:"right",renderer:ViisonCurrencyFormatter.renderer,summaryType:e("gross_profit").bind(this),summaryRenderer:ViisonCurrencyFormatter.renderer,tooltip:'{s name=tooltip/gross_profit_column}{/s}'},{ xtype:"numbercolumn",dataIndex:"gross_profit_percentage",text:'{s name=table/gross_profit_percentage}Gross Profit (%){/s}',align:"right",renderer:this.percentageRenderer,summaryType:e("gross_profit_percentage").bind(this),summaryRenderer:this.percentageRenderer,tooltip:'{s name=tooltip/gross_profit_percentage_column}{/s}'},{ dataIndex:"sales_value_net",text:'{s name=table/sales_net}Net Turnover{/s}',align:"right",renderer:ViisonCurrencyFormatter.renderer,summaryType:e("sales_value_net").bind(this),summaryRenderer:ViisonCurrencyFormatter.renderer,tooltip:'{s name=tooltip/sales_net_column}{/s}'},{ dataIndex:"sales_value",text:'{s name=table/sales}Turnover{/s}',align:"right",renderer:ViisonCurrencyFormatter.renderer,summaryType:e("sales_value").bind(this),summaryRenderer:ViisonCurrencyFormatter.renderer,tooltip:'{s name=tooltip/sales_column}{/s}'},{ dataIndex:"purchase_value_net",text:'{s name=table/purchase_value_net}Purchase Net{/s}',align:"right",renderer:ViisonCurrencyFormatter.renderer,summaryType:e("purchase_value_net").bind(this),summaryRenderer:ViisonCurrencyFormatter.renderer,tooltip:'{s name=tooltip/purchase_net_column}{/s}'},{ dataIndex:"purchase_value",text:'{s name=table/purchase_value}Purchase{/s}',align:"right",renderer:ViisonCurrencyFormatter.renderer,summaryType:e("purchase_value").bind(this),summaryRenderer:ViisonCurrencyFormatter.renderer,tooltip:'{s name=tooltip/purchase_column}{/s}'}]}});
