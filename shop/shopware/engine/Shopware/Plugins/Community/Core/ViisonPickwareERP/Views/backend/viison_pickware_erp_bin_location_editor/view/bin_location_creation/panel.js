// {namespace name=backend/viison_pickware_erp_bin_location_editor/main}
Ext.define("Shopware.apps.ViisonPickwareERPBinLocationEditor.view.BinLocationCreation.Panel",{ extend:"Ext.form.Panel",alias:"widget.viison_pickware_erp_bin_location_editor-bin_location_creation-panel",bodyPadding:10,defaults:{ labelWidth:120},initComponent:function(){ this.items=this.createItems();this.dockedItems=this.createDockedItems();this.callParent(arguments)},createItems:function(){ return[{ name:"code",xtype:"textfield",fieldLabel:'{s name=bin_location_creation/panel/form/code/label}{/s}',allowBlank:false}]},createDockedItems:function(){ return[{ xtype:"toolbar",dock:"bottom",ui:"shopware-ui",items:["->",{ xtype:"button",text:'{s name=bin_location_creation/panel/toolbar/cancel}{/s}',action:"cancel",cls:"secondary"},{ xtype:"button",text:'{s name=bin_location_creation/panel/toolbar/save}{/s}',action:"save",cls:"primary"}]}]}});