Ext.define("Shopware.apps.ViisonCommonCompatibilityCheck.view.Menu",{ override:"Shopware.apps.Index.view.Menu",initComponent:function(){ this.on("menu-created",function(){ window.setTimeout(this.viisonCommonPerformCompatibilityCheck.bind(this),500)},this);return this.callParent(arguments)},viisonCommonPerformCompatibilityCheck:function(){ Ext.Ajax.request({ url:ViisonCommonApp.assembleBackendUrl("ViisonCommonCompatibilityCheck/getCompatibilityIssues"),scope:this,success:function(i){ var t=Ext.JSON.decode(i.responseText,true);if(!t.success){ return}var e=t.data;if(e!==null){ Ext.Array.forEach(e,function(i){ Shopware.Notification.createStickyGrowlMessage({ title:ViisonCommonApp.getSnippet("check/notification/title","backend/viison_common_compatibility_check/main"),text:i.message,btnDetail:i.detailButton?{ text:i.detailButton.title,callback:function(){ window.open(i.detailButton.link,"_blank")}}:""})},this)}}})}});