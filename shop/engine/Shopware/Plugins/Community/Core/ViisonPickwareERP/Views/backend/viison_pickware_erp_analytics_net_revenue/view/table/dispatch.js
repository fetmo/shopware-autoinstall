// {namespace name=backend/viison_pickware_erp_analytics/net_revenue}
Ext.define("Shopware.apps.ViisonPickwareERPAnalyticsNetRevenue.view.table.Dispatch",{ override:"Shopware.apps.Analytics.view.table.Dispatch",getColumns:function(){ var e=this.callParent(arguments);e.push({ dataIndex:"turnoverNet",text:'{s name=general/turnoverNet}Turnover net{/s}',renderer:this.currencyRenderer});return e}});
