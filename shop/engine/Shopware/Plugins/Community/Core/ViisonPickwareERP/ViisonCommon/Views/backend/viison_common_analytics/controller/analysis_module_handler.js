Ext.define("Shopware.apps.ViisonCommonAnalytics.controller.AnalysisModuleHandler",{ nextModuleHandler:null,constructor:function(e){ this.nextModuleHandler=e.nextModuleHandler||null;this.callParent(arguments)},onLeaveAnalysis:function(){ if(this.nextModuleHandler!==null){ return this.nextModuleHandler.onLeaveAnalysis.apply(this.nextModuleHandler,arguments)}return undefined},onBeforeRenderDataOutput:function(){ if(this.nextModuleHandler!==null){ return this.nextModuleHandler.onBeforeRenderDataOutput.apply(this.nextModuleHandler,arguments)}return undefined},onBuildRequestParamMap:function(e,n,l){ if(this.nextModuleHandler!==null){ return this.nextModuleHandler.onBuildRequestParamMap.apply(this.nextModuleHandler,arguments)}return l}});