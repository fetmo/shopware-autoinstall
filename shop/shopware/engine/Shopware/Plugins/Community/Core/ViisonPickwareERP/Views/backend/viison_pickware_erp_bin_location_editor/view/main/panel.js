// {namespace name=backend/viison_pickware_erp_bin_location_editor/main}
Ext.define("Shopware.apps.ViisonPickwareERPBinLocationEditor.view.main.Panel",{ extend:"Ext.form.Panel",alias:"widget.viison_pickware_erp_bin_location_editor-main-panel",layout:"anchor",border:0,bodyPadding:20,defaults:{ anchor:"100%"},initComponent:function(){ var i=null;if(this.binLocation.get("binLocationId")!==this.binLocation.get("defaultBinLocation").id){ i={ id:this.binLocation.get("binLocationId"),code:this.binLocation.get("binLocationCode"),warehouseId:this.binLocation.get("warehouseId")}}this.items=[{ xtype:"viison_pickware_erp_bin_location_editor-main-bin_location_field",name:"binLocation",value:i,labelWidth:150,flex:1,padding:"0 0 20 0",listeners:{ scope:this,change:function(){ this.syncFormElements()}}},{ xtype:"fieldset",layout:"hbox",flex:1,border:0,padding:"0 0 20 0",margin:0,defaults:{ labelWidth:150},items:[{ xtype:"numberfield",name:"stock",fieldLabel:'{s name=main/panel/field/new_stock/label}{/s}',value:this.binLocation.get("stock"),flex:1,allowBlank:false,listeners:{ scope:this,change:function(){ this.syncFormElements()}}},{ xtype:"numberfield",name:"purchasePrice",fieldLabel:ViisonPickwarePurchasePriceHelper.purchasePriceLabel(),helpText:'{s name=main/panel/field/purchase_price/help_text}{/s}',value:this.articleDetail.get("purchasePrice"),flex:1,margin:"0 0 0 10",minValue:0,disabled:true,allowBlank:false}]},{ xtype:"combo",name:"comment",fieldLabel:'{s name=main/panel/field/comment/label}{/s}',queryMode:"local",store:this.commentStore,displayField:"value",valueField:"value",labelWidth:150,flex:1,padding:0,editable:true,validator:function(i){ var e=parseInt(this.getForm().getValues().stock,10);var t=this.binLocation.get("stock");var a=e===t||i!=="";return a?true:'{s name=main/panel/field/comment/invalid_text}{/s}'}.bind(this)}];this.dockedItems=[{ xtype:"toolbar",dock:"bottom",ui:"shopware",items:["->",{ text:'{s name=main/panel/button/cancel}{/s}',cls:"secondary",scope:this,handler:function(){ this.fireEvent("cancel",this)}},this.createSaveButton()]}];this.callParent(arguments)},createSaveButton:function(){ this.saveButton=Ext.create("Ext.button.Button",{ text:this.binLocation.get("binLocationId")?'{s name=main/panel/button/save_stock}{/s}':'{s name=main/panel/button/save_all}{/s}',cls:"primary",disabled:true,scope:this,handler:function(){ this.fireEvent("save",this)}});return this.saveButton},updateSaveButton:function(){ var i=this.getForm().getValues();var e=parseInt(i.stock,10);var t=this.binLocation.get("stock");var a=e!==t;var o=i.binLocation?i.binLocation.id:null;var n=this.binLocation.get("binLocationId")!==this.binLocation.get("defaultBinLocation").id?this.binLocation.get("binLocationId"):null;var s=o!==n;this.saveButton.setDisabled(!a&&!s);if(a&&s){ this.saveButton.setText('{s name=main/panel/button/save_all}{/s}')}else if(a){ this.saveButton.setText('{s name=main/panel/button/save_stock}{/s}')}else if(s){ this.saveButton.setText('{s name=main/panel/button/save_bin_location}{/s}')}},syncFormElements:function(){ this.updateSaveButton();this.getForm().isValid();var i=this.getForm().findField("stock");var e=this.getForm().findField("purchasePrice");var t=i.getValue();var a=this.binLocation.get("stock");e.setDisabled(t<=a)}});
