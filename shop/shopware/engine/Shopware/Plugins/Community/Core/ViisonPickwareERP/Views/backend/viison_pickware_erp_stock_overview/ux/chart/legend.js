Ext.define("Shopware.apps.ViisonPickwareERPStockOverview.ux.chart.Legend",{ override:"Ext.chart.Legend",updatePosition:function(){ if(typeof this.isViisonPositionTopRight!=="undefined"&&this.position==="right"){ var i=this.width||0;this.position="float";this.origX=Math.floor(this.chart.surface.width-i)-this.chart.insetPadding;this.origY=0}this.callParent();this.position="right"}});
