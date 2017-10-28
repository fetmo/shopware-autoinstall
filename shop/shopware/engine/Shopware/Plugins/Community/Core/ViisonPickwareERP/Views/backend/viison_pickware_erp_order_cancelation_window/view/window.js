// {namespace name=backend/viison_pickware_erp_order_cancelation_window/main}
Ext.define("Shopware.apps.ViisonPickwareERPOrderCancelationWindow.view.Window",{ extend:"Ext.window.Window",alias:"widget.viison_pickware_erp_order_cancelation_window-window",alternateClassName:"ViisonPickwareERPOrderCancelationWindow",title:'{s name=window/title}{/s}',layout:"border",modal:true,height:440,width:800,order:null,positionsData:[],callback:null,requireDocumentCreation:false,initComponent:function(){ this.positionsData.push(this.getDummyPosition());this.store=Ext.create("Shopware.apps.ViisonPickwareERPOrderCancelationWindow.store.Position",{ data:this.positionsData});this.documentTypeStore=Ext.create("Shopware.apps.ViisonPickwareERPOrderCancelationWindow.store.DocumentType",{ });this.documentTypeStore.getProxy().extraParams.addNoDocumentDummyType=!this.requireDocumentCreation;this.documentTypeStore.load();this.items=[this.createPositionsGrid(),this.createFormPanel()];this.callParent(arguments);this.updateTotalAndSaveButton()},onCancel:function(){ this.close()},onSave:function(){ if(Ext.isFunction(this.callback)){ this.callback(this)}},onPositionsGridBeforeEdit:function(e,i){ if(i.record.get("dummy")){ e.editor.form.findField("canceledQuantity").setMaxValue(Number.MAX_VALUE)}else{ e.editor.form.findField("canceledQuantity").setMaxValue(i.record.get("quantity"));if(e.editor.form.findField("availableChange")){ e.editor.form.findField("availableChange").setMaxValue(Ext.max([0,Ext.min([i.record.get("quantity")-i.record.get("shippedQuantity"),i.record.get("canceledQuantity")])]))}}e.editor.form.getFields().each(function(e){ e.disable()});var t=i.record.get("dummy")?this.getActiveFieldsForDummyPositions():this.getActiveFieldsForNonDummyPositions();Ext.Array.forEach(t,function(i){ var t=e.editor.form.findField(i);if(t){ t.enable()}})},onPositionsGridEdit:function(e,i){ var t=Ext.max([0,Ext.min([i.record.get("quantity")-i.record.get("shippedQuantity"),i.newValues.canceledQuantity])]);if(i.record.get("availableChange")>t){ i.record.set("availableChange",t)}if(i.record.get("dummy")){ i.record.set("canceledQuantity",i.record.get("quantity"))}i.record.commit();this.updateTotalAndSaveButton()},updateTotalAndSaveButton:function(){ var e=0;var i=0;var t=this.down("checkbox[name=cancelShippingCosts]").getValue();this.store.each(function(t){ e+=t.get("price")*t.get("canceledQuantity");i+=t.get("canceledQuantity")});if(t){ e+=-1*this.getShippingCost()}this.down("displayfield[name=totalAmount]").setValue(ViisonCurrencyFormatter.renderer(e));this.down("button[action=save]").setDisabled(i===0&&!t)},createPositionsGrid:function(){ return{ xtype:"grid",name:"viison_pickware_erp_order_cancelation_window-positions",cls:"viison-common--grid has-feature--hide-disabled-editors",region:"center",store:this.store,viewConfig:{ getRowClass:function(e){ return e.get("dummy")?"x-grid-row-viison-disabled":""}},columns:this.getPositionsGridColumns(),plugins:[{ ptype:"rowediting",clicksToEdit:1,listeners:{ scope:this,beforeedit:function(e,i){ return this.onPositionsGridBeforeEdit(e,i)},edit:function(e,i){ return this.onPositionsGridEdit(e,i)}}}]}},getPositionsGridColumns:function(){ return[{ dataIndex:"articleName",header:'{s name=positions/columns/article_name/title}{/s}',tooltip:'{s name=positions/columns/article_name/tooltip}{/s}',itemId:"articleName",flex:1,editor:{ xtype:"textfield",allowBlank:false}},{ dataIndex:"articleNumber",header:'{s name=positions/columns/article_number/title}{/s}',tooltip:'{s name=positions/columns/article_number/tooltip}{/s}',itemId:"articleNumber",width:120},{ dataIndex:"price",header:'{s name=positions/columns/price/title}{/s}',tooltip:'{s name=positions/columns/price/tooltip}{/s}',itemId:"price",width:70,align:"right",renderer:ViisonCurrencyFormatter.renderer,editor:{ xtype:"numberfield",allowDecimals:true,decimalPrecision:2}},{ dataIndex:"quantity",header:'{s name=positions/columns/quantity/title}{/s}',tooltip:'{s name=positions/columns/quantity/tooltip}{/s}',itemId:"quantity",width:70,align:"right",editor:{ xtype:"numberfield",minValue:0}},{ dataIndex:"price",header:'{s name=positions/columns/total/title}{/s}',tooltip:'{s name=positions/columns/total/tooltip}{/s}',itemId:"total",width:70,align:"right",renderer:function(e,i,t){ return ViisonCurrencyFormatter.renderer(e*t.get("canceledQuantity"))}},{ dataIndex:"taxId",header:'{s name=positions/columns/taxId/title}{/s}',tooltip:'{s name=positions/columns/taxId/tooltip}{/s}',itemId:"taxId",width:70,align:"right",scope:this,renderer:function(e,i,t){ if(e===Ext.undefined){ return e}var d=this.taxStore.getById(e);if(d instanceof Ext.data.Model){ return d.get("name")}if(e===0||e===null){ return t.get("taxRate")+"%"}return e},editor:{ xtype:"combobox",queryMode:"local",allowBlank:false,store:this.taxStore,displayField:"name",valueField:"id"}},{ dataIndex:"shippedQuantity",header:'{s name=positions/columns/shipped_quantity/title}{/s}',tooltip:'{s name=positions/columns/shipped_quantity/tooltip}{/s}',itemId:"shippedQuantity",width:70,align:"right",renderer:function(e,i,t){ if(t.get("dummy")){ return"-"}return e}},{ dataIndex:"canceledQuantity",header:'{s name=positions/columns/canceled_quantity/title}{/s}',tooltip:'{s name=positions/columns/canceled_quantity/tooltip}{/s}',itemId:"canceledQuantity",width:70,align:"right",renderer:function(e,i,t){ if(t.get("dummy")){ return"-"}return e},editor:{ xtype:"numberfield",minValue:0}},{ dataIndex:"availableChange",header:'{s name=positions/columns/available_change/title}{/s}',tooltip:'{s name=positions/columns/available_change/tooltip}{/s}',itemId:"availableChange",width:70,align:"right",renderer:function(e,i,t){ if(t.get("dummy")){ return"-"}return"+"+e},editor:{ xtype:"numberfield",minValue:0}}]},createFormPanel:function(){ return{ xtype:"form",name:"viison_pickware_erp_order_cancelation_window-form",region:"south",layout:{ type:"vbox",align:"stretch"},border:0,bodyPadding:10,defaults:{ border:0},items:this.getFormPanelItems(),dockedItems:this.getFormPanelDockedItems()}},getFormPanelItems:function(){ return[{ xtype:"form",html:'{s name=form/edit_info/message}{/s}',border:0,padding:"0 0 15 0"},{ xtype:"form",layout:{ type:"hbox",align:"stretch"},flex:1,defaults:{ border:0},items:[this.createFormPanelLeftForm(),this.createFormPanelRightForm()]}]},getFormPanelDockedItems:function(){ return[{ xtype:"toolbar",dock:"bottom",ui:"shopware-ui",padding:7,items:["->",{ xtype:"button",text:'{s name=form/toolbar/button/cancel}{/s}',cls:"secondary",action:"cancel",scope:this,handler:function(){ this.onCancel()}},{ xtype:"button",text:'{s name=form/toolbar/button/save}{/s}',cls:"primary",action:"save",disabled:true,scope:this,handler:function(){ this.onSave()}}]}]},createFormPanelLeftForm:function(){ return{ xtype:"form",layout:{ type:"vbox",align:"stretch"},padding:"0 12 0 0",flex:1,defaults:{ labelWidth:140},items:[{ xtype:"textfield",name:"invoiceNumber",fieldLabel:'{s name=form/field/invoice_number/label}{/s}',helpText:'{s name=form/field/invoice_number/help_text}{/s}',value:this.getInvoiceNumber()},{ xtype:"combobox",name:"documentType",fieldLabel:'{s name=form/field/document_type/label}{/s}',value:4,queryMode:"local",store:this.documentTypeStore,valueField:"id",displayField:"name",allowBlank:false,editable:false,autoSelect:true,forceSelection:true},{ xtype:"datefield",name:"documentDate",fieldLabel:'{s name=form/field/document_date/label}{/s}'}]}},createFormPanelRightForm:function(){ return{ xtype:"form",layout:{ type:"vbox",align:"stretch"},flex:1,padding:"0 0 0 12",defaults:{ labelWidth:90},items:[{ xtype:"textarea",name:"documentComment",fieldLabel:'{s name=form/field/document_comment/label}{/s}',height:55},{ xtype:"checkbox",name:"cancelShippingCosts",labelAlign:"right",boxLabel:Ext.String.format('{s name=form/field/cancel_shipping_costs/label}{/s}',Ext.util.Format.currency(this.getShippingCost()," €",2,true)),disabled:this.getShippingCost()<=0,inputValue:true,fieldStyle:{ "margin-top":"8px"},listeners:{ scope:this,change:function(){ this.updateTotalAndSaveButton()}}},{ xtype:"displayfield",name:"totalAmount",fieldLabel:'{s name=form/field/total_amount/label}{/s}',value:ViisonCurrencyFormatter.renderer(0),fieldStyle:{ "padding-top":"7px"}}]}},getInvoiceNumber:function(){ var e=this.order.getReceipt();var i="";e.each(function(e){ if(e.get("typeId")===1){ i=e.get("documentId");return false}return undefined});return i},getShippingCost:function(){ if(this.order.get("net")){ return this.order.get("invoiceShippingNet")}return this.order.get("invoiceShipping")},getActiveFieldsForNonDummyPositions:function(){ return["canceledQuantity","availableChange"]},getActiveFieldsForDummyPositions:function(){ return["articleName","price","quantity","taxId"]},getDummyPosition:function(){ var e=this.taxStore.first();if(e){ this.taxStore.each(function(i){ if(i.get("tax")>e.get("tax")){ e=i}})}return{ articleName:'{s name="dummyposition/name"}{/s}',articleNumber:"",canceled:0,price:0,taxRate:e?e.get("tax"):0,taxId:e?e.get("id"):0,dummy:true}},statics:{ updateDetailWindow:function(e){ var i=e.record;e.setLoading(true);var t=i.store.getProxy().extraParams.orderID;var d=Ext.create("Shopware.apps.Order.store.Order");d.getProxy().extraParams.orderID=i.get("id");d.load({ callback:function(t){ var d=t[0];i.getPositions().loadRecords(d.getPositions().getRange(),{ addRecords:false});i.getReceipt().loadRecords(d.getReceipt().getRange(),{ addRecords:false});i.set("invoiceAmount",d.get("invoiceAmount"));i.set("invoiceAmountNet",d.get("invoiceAmountNet"));i.set("invoiceShipping",d.get("invoiceShipping"));i.set("invoiceShippingNet",d.get("invoiceShippingNet"));e.doLayout();var o=e.query("order-overview-panel");if(o.length>0){ o[0].detailsForm.loadRecord(i);o[0].editForm.loadRecord(i)}e.setLoading(false)}});i.store.getProxy().extraParams.orderID=t}}});
