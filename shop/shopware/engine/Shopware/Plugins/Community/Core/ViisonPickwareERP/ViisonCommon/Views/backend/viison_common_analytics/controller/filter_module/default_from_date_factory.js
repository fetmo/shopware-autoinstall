Ext.define("Shopware.apps.ViisonCommonAnalytics.controller.FilterModule.DefaultFromDateFactory",{ getToolbarComponentValueRetriever:function(){ return function(e){ var t=e.child("[name=from_date]").getValue();return Ext.Date.format(t,"Y-m-d")}},getToolbarFilterConfig:function(){ return{ componentConfig:{ name:"from_date",isDefault:true}}}});
