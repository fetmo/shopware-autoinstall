Ext.define("Shopware.apps.ViisonCommonAnalytics.controller.ModuleWithImprovedToolbar",{ extend:"Shopware.apps.ViisonCommonAnalytics.controller.AnalysisModuleHandler",onLeaveAnalysis:function(o,n,i,a,e){ if(e===null){ var r=o.viisonCommonAnalyticsGetToolbar();var l=o.viisonCommonAnalyticsOnToolbarRefreshed.bind(o);r.viisonCommonAnalyticsRestoreToolbar(l)}return this.callParent(arguments)},onBeforeRenderDataOutput:function(o){ var n=o.viisonCommonAnalyticsGetToolbar();var i=o.viisonCommonAnalyticsOnToolbarRefreshed.bind(o);n.viisonCommonAnalyticsImproveToolbar(i);return this.callParent(arguments)}});