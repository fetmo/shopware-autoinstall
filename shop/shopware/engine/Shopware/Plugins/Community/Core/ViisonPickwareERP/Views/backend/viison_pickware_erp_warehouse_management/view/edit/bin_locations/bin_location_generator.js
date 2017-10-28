Ext.define("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.edit.BinLocations.BinLocationGenerator",{ extend:"Ext.window.Window",alias:"widget.viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator",mixins:["Shopware.apps.ViisonCommonApp.Mixin"],viisonSnippetNamespace:"backend/viison_pickware_erp_warehouse_management/main",layout:"fit",modal:true,width:"90%",height:"80%",initComponent:function(){ this.title=this.getViisonSnippet("edit/bin_location_generator/title");this.rowForms={ };this.items=this.createItems();this.dockedItems=this.createDockedItems();this.gridPanel.on("viewready",function(){ this.fireEvent("formChanged",this);this.store.each(function(e){ this.renderRow(e)},this)},this);this.callParent(arguments)},createItems:function(){ this.gridPanel=Ext.create("Ext.grid.Panel",{ split:true,border:true,autoScroll:true,viewConfig:{ enableTextSelection:true,markDirty:false},columns:this.createColumns(),store:this.store});return[this.gridPanel]},createColumns:function(){ return[{ xtype:"gridcolumn",dataIndex:"fixed",header:this.getViisonSnippet("edit/bin_location_generator/list/column/component"),sortable:false,flex:1,renderer:function(e,t){ t.tdCls+=" component-form";return""}},{ xtype:"actioncolumn",width:50,items:[{ iconCls:"sprite-plus-circle",action:"deleteComponent",tooltip:this.getViisonSnippet("edit/bin_location_generator/list/tooltip/add"),scope:this,handler:function(e,t){ this.fireEvent("addComponent",this,t+1)}},{ iconCls:"sprite-minus-circle",action:"deleteComponent",tooltip:this.getViisonSnippet("edit/bin_location_generator/list/tooltip/delete"),scope:this,handler:function(e,t){ this.fireEvent("deleteComponent",this,e.getStore().getAt(t))}}]}]},createDockedItems:function(){ this.exampleBinLocationLabel=Ext.create("Ext.Component",{ padding:"0 20 0 10",data:{ binLocation:""},tpl:"<b>"+this.getViisonSnippet("edit/bin_location_generator/toolbar/label/example")+':</b> {binLocation}'});this.numberOfPossibleBinLocationsLabel=Ext.create("Ext.Component",{ padding:"0 20 0 10",data:{ numPossibleLocations:""},tpl:"<b>"+this.getViisonSnippet("edit/bin_location_generator/toolbar/label/number_of_possible_locations")+':</b> {numPossibleLocations}'});this.binLocationFormatValidationErrorLabel=Ext.create("Ext.Component",{ hidden:true,padding:"0 20 0 10",style:{ color:"#FF0000"},data:{ message:this.getViisonSnippet("edit/bin_location_generator/format_validation/default_error_message")},tpl:"<b>"+this.getViisonSnippet("edit/bin_location_generator/toolbar/label/format_validation_error")+':</b> {message}'});return[{ xtype:"toolbar",dock:"top",ui:"shopware-ui",items:[{ xtype:"button",text:this.getViisonSnippet("edit/bin_location_generator/toolbar/button/add"),iconCls:"sprite-plus-circle-frame",action:"addComponent",scope:this,handler:function(){ this.fireEvent("addComponent",this,this.store.count())}},{ xtype:"button",text:this.getViisonSnippet("edit/bin_location_generator/toolbar/button/save"),iconCls:"sprite-sd-memory-card",action:"save"},{ xtype:"tbspacer",width:15},this.exampleBinLocationLabel,this.binLocationFormatValidationErrorLabel,"->",this.numberOfPossibleBinLocationsLabel]},{ xtype:"toolbar",dock:"bottom",ui:"shopware-ui",items:["->",{ xtype:"button",text:this.getViisonSnippet("edit/bin_location_generator/toolbar/button/cancel"),cls:"secondary",action:"cancel"},{ xtype:"button",text:this.getViisonSnippet("edit/bin_location_generator/toolbar/button/generate"),cls:"primary",action:"generateBinLocations"}]}]},renderRow:function(e){ var t=this.store.indexOf(e);var i=Ext.DomQuery.select(".component-form",this.gridPanel.view.getNode(t));if(i.length===0){ return}var n=[{ xtype:"combobox",name:"type",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/type"),store:Ext.create("Ext.data.Store",{ fields:[{ name:"value",type:"string"},{ name:"label",type:"string"}],data:[{ value:"letters",label:this.getViisonSnippet("edit/bin_location_generator/form/field/type/letters")},{ value:"digits",label:this.getViisonSnippet("edit/bin_location_generator/form/field/type/digits")},{ value:"fixed",label:this.getViisonSnippet("edit/bin_location_generator/form/field/type/fixed")}]}),queryMode:"local",displayField:"label",valueField:"value",forceSelection:true,editable:false,value:e.get("type"),labelWidth:50,listeners:{ scope:this,change:function(t,i){ e.raw.start="";e.raw.end="";this.createRowUpdateListener(e,this)(t,i);this.fireEvent("formChanged",this)}}}];switch(e.get("type")){ case"letters":n=n.concat(this.createLettersComponentFields(e));break;case"digits":n=n.concat(this.createDigitsComponentFields(e));break;case"fixed":n=n.concat(this.createFixedComponentFields(e));break;default:break}var o=i[0];o.innerHTML="";this.rowForms[e.internalId]=Ext.create("Ext.form.Panel",{ width:"100%",border:false,bodyStyle:"background: transparent;",padding:3,renderTo:o,layout:{ type:"hbox",align:"middle",pack:"start"},defaults:{ anchor:"100%",labelWidth:75,width:175,margin:"0 15 0 0"},items:n});this.rowForms[e.internalId].getForm().isValid()},createLettersComponentFields:function(e){ return[{ xtype:"numberfield",name:"length",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/length"),value:e.get("length"),minValue:1,editable:false,listeners:{ change:this.createRowUpdateListener(e,this)}},{ xtype:"textfield",name:"start",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/start/label"),emptyText:this.getViisonSnippet("warehouse/bin_location_format_component/field/start/empty_text/prefix")+" A",value:e.get("start"),allowBlank:false,regex:/^[A-Z]+$/,regexText:this.getViisonSnippet("warehouse/bin_location_format_component/field/text_validation_error"),minLength:e.get("length"),maxLength:e.get("length"),listeners:{ scope:this,change:function(t,i){ t.setRawValue(i.toUpperCase());e.raw.start=t.getRawValue();this.fireEvent("formChanged",this)}}},{ xtype:"textfield",name:"end",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/end/label"),emptyText:this.getViisonSnippet("warehouse/bin_location_format_component/field/end/empty_text/prefix")+" Z",value:e.get("end"),allowBlank:false,regex:/^[A-Z]+$/,regexText:this.getViisonSnippet("warehouse/bin_location_format_component/field/text_validation_error"),minLength:e.get("length"),maxLength:e.get("length"),listeners:{ scope:this,change:function(t,i){ t.setRawValue(i.toUpperCase());e.raw.end=t.getRawValue();this.fireEvent("formChanged",this)}}}]},createDigitsComponentFields:function(e){ var t=0;for(var i=0;i<e.get("length");i+=1){ t+=9*Math.pow(10,i)}return[{ xtype:"numberfield",name:"length",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/length"),value:e.get("length"),minValue:1,editable:false,listeners:{ change:this.createRowUpdateListener(e,this)}},{ xtype:"numberfield",name:"start",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/start/label"),emptyText:this.getViisonSnippet("warehouse/bin_location_format_component/field/start/empty_text/prefix")+" 0",value:e.get("start"),minValue:0,maxValue:e.get("end")?e.get("end"):t,allowBlank:false,listeners:{ scope:this,change:function(t){ e.raw.start=t.getRawValue();this.fireEvent("formChanged",this)}}},{ xtype:"numberfield",name:"end",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/end/label"),emptyText:this.getViisonSnippet("warehouse/bin_location_format_component/field/end/empty_text/prefix")+" 9",value:e.get("end"),minValue:e.get("start")?e.get("start"):0,maxValue:t,allowBlank:false,listeners:{ scope:this,change:function(t){ e.raw.end=t.getRawValue();this.fireEvent("formChanged",this)}}},{ xtype:"checkbox",name:"leadingZeros",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/leading_zeros"),value:true,inputValue:true,checked:e.get("leadingZeros"),labelWidth:110,listeners:{ scope:this,change:function(t,i){ e.raw.leadingZeros=i;this.fireEvent("formChanged",this)}}}]},createFixedComponentFields:function(e){ return[{ xtype:"textfield",name:"value",fieldLabel:this.getViisonSnippet("warehouse/bin_location_format_component/field/value"),emptyText:this.getViisonSnippet("warehouse/bin_location_format_component/field/value/empty_text/prefix")+" -",value:e.get("value"),maskRe:/[^\s]/,listeners:{ scope:this,change:function(t,i){ e.raw.value=i;this.fireEvent("formChanged",this)}}}]},createRowUpdateListener:function(e,t){ return Ext.bind(function(t,i){ e.raw[t.name]=i;Ext.Object.each(e.raw,function(t,i){ e.set(t,i)});this.renderRow(e)},t)},updateExampleBinLocationLabels:function(e){ this.exampleBinLocationLabel.update(e);this.exampleBinLocationLabel.setVisible(e.success);this.numberOfPossibleBinLocationsLabel.update(e);this.numberOfPossibleBinLocationsLabel.setVisible(e.success);this.binLocationFormatValidationErrorLabel.update({ message:e.message||this.getViisonSnippet("edit/bin_location_generator/format_validation/default_error_message")});this.binLocationFormatValidationErrorLabel.setVisible(!e.success)}});
