Ext.define("Shopware.apps.ViisonCommonConfigDocument.view.form.Document",{ override:"Shopware.apps.Config.view.form.Document",constructor:function(){ this.viisonRelevantDocumentNames=ViisonCommonApp.getConfig("relevantDocumentNames","ViisonCommonConfigDocument",[]);this.callParent(arguments)},afterRender:function(){ var e=this.getDetail();var n=e.loadRecord;var o=this.viisonCommonDisableTakeOverButton.bind(this);e.loadRecord=function(e){ o(e);return n.apply(this,arguments)};return this.callParent(arguments)},viisonCommonDisableTakeOverButton:function(e){ if(!e){ return}var n=this.down("fieldset[name=elementFieldSet] config-element-button");if(n!==null&&this.viisonCommonIsRelevantDocument(e.get("name"))){ n.setVisible(false)}else{ n.setVisible(true)}},viisonCommonIsRelevantDocument:function(e){ var n=this.viisonRelevantDocumentNames;var o=false;for(var t=0;t<n.length;t+=1){ o=o||e===n[t]}return o},viisonAddProtectedDocument:function(e){ this.viisonRelevantDocumentNames.push(e)}});