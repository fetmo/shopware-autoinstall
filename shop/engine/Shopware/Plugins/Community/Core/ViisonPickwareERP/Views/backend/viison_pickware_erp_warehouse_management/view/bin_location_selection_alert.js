Ext.define("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.BinLocationSelectionAlert",{ extend:"Ext.window.MessageBox",alias:"widget.viison_pickware_erp_warehouse_management-bin_location_selection_alert",alternateClassName:"ViisonPickwareBinLocationSelectionAlert",mixins:["Shopware.apps.ViisonCommonApp.Mixin"],viisonSnippetNamespace:"backend/viison_pickware_erp_warehouse_management/bin_location_selection_alert",constructor:function(){ this.callParent(arguments);this.buttonText=Ext.Msg.buttonText},statics:{ selectWarehouse:function(e,i,t,o,n){ var a=Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.BinLocationSelectionAlert",{ });return a.show({ title:e||this.getViisonSnippet("select_warehouse/title"),msg:i||this.getViisonSnippet("select_warehouse/message"),icon:a.QUESTION,buttons:t||a.OKCANCEL,showWarehouseSelection:true,showBinLocationSelection:false,callback:function(e){ if(Ext.isFunction(o)){ o.call(n,e,a.warehouseSelection.getSelectedRecord())}}})},selectWarehouseAndBinLocation:function(e,i,t,o,n){ var a=Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.BinLocationSelectionAlert",{ });return a.show({ title:e||this.getViisonSnippet("select_warehouse_and_bin_location/title"),msg:i||this.getViisonSnippet("select_warehouse_and_bin_location/message"),icon:a.QUESTION,buttons:t||a.OKCANCEL,showWarehouseSelection:true,showBinLocationSelection:true,callback:function(e){ if(Ext.isFunction(o)){ o.call(n,e,a.warehouseSelection.getSelectedRecord(),a.binLocationSelection.getSelectedRecord())}}})}},initComponent:function(){ this.callParent(arguments);this.msg.allowHtml=true;this.bottomTb.addCls("shopware-toolbar");this.bottomTb.setUI("shopware-ui");Ext.each(this.msgButtons,function(e){ var i=e.itemId==="ok"||e.itemId==="yes"?"primary":"secondary";e.addCls(i)});this.warehouseSelection=Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.WarehouseComboBox",{ name:"warehouse",margin:"10 0 0 0",hidden:true});this.promptContainer.insert(1,this.warehouseSelection);this.binLocationSelection=Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.BinLocationComboBox",{ name:"binLocation",margin:"10 0 0 0",hidden:true});this.promptContainer.insert(2,this.binLocationSelection);this.warehouseSelection.on("warehouseChanged",function(e){ this.binLocationSelection.warehouseId=e?e.get("id"):null;if(!this.binLocationSelection.isHidden()){ this.binLocationSelection.loadStore()}},this)},reconfigure:function(e){ if(e.showWarehouseSelection){ this.warehouseSelection.show();this.warehouseSelection.store.load()}else{ this.warehouseSelection.hide()}if(e.showBinLocationSelection){ this.binLocationSelection.show();this.binLocationSelection.loadStore()}else{ this.binLocationSelection.hide()}return this.callParent(arguments)}});