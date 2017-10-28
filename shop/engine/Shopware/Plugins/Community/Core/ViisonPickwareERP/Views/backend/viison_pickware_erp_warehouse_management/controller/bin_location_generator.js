Ext.define("Shopware.apps.ViisonPickwareERPWarehouseManagement.controller.BinLocationGenerator",{ extend:"Ext.app.Controller",mixins:["Shopware.apps.ViisonCommonApp.Mixin"],viisonSnippetNamespace:"backend/viison_pickware_erp_warehouse_management/main",init:function(){ this.control({ "viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator":{ addComponent:this.onAddComponent,deleteComponent:this.onDeleteComponent,formChanged:Ext.Function.createBuffered(this.onFormChanged,1e3,this)},"viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator button[action=save]":{ click:this.onSave},"viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator button[action=cancel]":{ click:this.onCancel},"viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator button[action=generateBinLocations]":{ click:this.onGenerateBinLocations}});this.callParent(arguments)},createWindow:function(e,o){ var t=[];e.binLocationFormatComponents().each(function(e){ t.push(Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.model.BinLocationFormatComponent",e.raw))});var n=Ext.create("Ext.data.Store",{ model:"Shopware.apps.ViisonPickwareERPWarehouseManagement.model.BinLocationFormatComponent",data:t});if(n.count()===0){ this.addNewComponentToStore(n,0)}Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.view.edit.BinLocations.BinLocationGenerator",{ warehouse:e,store:n,saveCallback:o||Ext.emptyFn}).show()},onAddComponent:function(e,o){ var t=this.addNewComponentToStore(e.store,o);e.renderRow(t)},addNewComponentToStore:function(e,o){ var t=Math.max(0,o-1);var n={ type:!e.getAt(t)||e.getAt(t).get("type")==="fixed"?"letters":"fixed",length:1};var i=Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.model.BinLocationFormatComponent",n);e.insert(o,[i]);return i},onDeleteComponent:function(e,o){ e.store.remove(o);delete e.rowForms[o.internalId];this.onFormChanged(e)},onFormChanged:function(e){ if(e.store.count()===0){ e.updateExampleBinLocationLabels({ success:true,binLocation:"",numPossibleLocations:""});return}if(!this.validateFormatComponentForms(e.rowForms)){ return}Ext.Ajax.request({ url:ViisonCommonApp.assembleBackendUrl("ViisonPickwareERPWarehouseManagement/getExampleBinLocation"),method:"POST",jsonData:{ components:this.getFormatComponentFormData(e)},scope:this,success:function(o){ var t=Ext.JSON.decode(o.responseText,true);if(t){ e.updateExampleBinLocationLabels(t);if(typeof t.numPossibleLocations!=="undefined"){ this.estimatedNumberOfPossibleBinLocations=t.numPossibleLocations}}else{ Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/error/title"),this.getViisonSnippet("notification/error/message/get_example_bin_location"),"ViisonPickwareERPWarehouseManagement")}}})},onSave:function(e){ var o=e.up("viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator");if(!this.validateFormatComponentForms(o.rowForms)){ Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/error/title"),this.getViisonSnippet("notification/error/message/save_bin_location_format/validation"),"ViisonPickwareERPWarehouseManagement");return}Ext.Ajax.request({ url:ViisonCommonApp.assembleBackendUrl("ViisonPickwareERPWarehouseManagement/saveBinLocationFormatComponents"),method:"PUT",jsonData:{ warehouseId:o.warehouse.get("id"),components:this.getFormatComponentFormData(o)},scope:this,success:function(e){ var t=Ext.JSON.decode(e.responseText,true);if(t&&t.success){ Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/success/save_bin_location_format/title"),this.getViisonSnippet("notification/success/save_bin_location_format/message"),"ViisonPickwareERPWarehouseManagement");o.warehouse.binLocationFormatComponents().removeAll();o.store.each(function(e){ o.warehouse.binLocationFormatComponents().add(Ext.create("Shopware.apps.ViisonPickwareERPWarehouseManagement.model.BinLocationFormatComponent",e.raw))})}else{ Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/error/title"),this.getViisonSnippet("notification/error/message/save_bin_location_format"),"ViisonPickwareERPWarehouseManagement")}}})},onCancel:function(e){ e.up("viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator").close()},onGenerateBinLocations:function(e){ var o=e.up("viison_pickware_erp_warehouse_management-edit-bin_locations-bin_location_generator");if(!this.validateFormatComponentForms(o.rowForms)){ Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/error/title"),this.getViisonSnippet("notification/error/message/generate_bin_locations/validation"),"ViisonPickwareERPWarehouseManagement");return}Ext.Msg.confirm(this.getViisonSnippet("alert/title"),Ext.String.format(this.getViisonSnippet("alert/message/generate_bin_locations"),this.estimatedNumberOfPossibleBinLocations),function(e){ if(e!=="yes"){ return}o.setLoading(true);Ext.Ajax.request({ url:ViisonCommonApp.assembleBackendUrl("ViisonPickwareERPWarehouseManagement/generateBinLocations"),method:"POST",jsonData:{ warehouseId:o.warehouse.get("id"),components:this.getFormatComponentFormData(o)},scope:this,success:function(e){ o.setLoading(false);var t=Ext.JSON.decode(e.responseText,true);if(t&&t.success){ var n=Ext.String.format(this.getViisonSnippet("notification/success/generate_bin_locations/message"),t.numGeneratedBinLocations);if(t.numSkippedBinLocations){ n+=" "+Ext.String.format(this.getViisonSnippet("notification/success/generate_bin_locations/message/skipped_locations_addition"),t.numSkippedBinLocations)}Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/success/generate_bin_locations/title"),n,"ViisonPickwareERPWarehouseManagement")}else{ Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/error/title"),this.getViisonSnippet("notification/error/message/generate_bin_locations"),"ViisonPickwareERPWarehouseManagement")}},failure:function(){ o.setLoading(false);Shopware.Notification.createGrowlMessage(this.getViisonSnippet("notification/error/title"),this.getViisonSnippet("notification/error/message/generate_bin_locations"),"ViisonPickwareERPWarehouseManagement")}})},this)},validateFormatComponentForms:function(e){ var o=true;Ext.Object.each(e,function(e,t){ o=o&&t.getForm().isValid()});return o},getFormatComponentFormData:function(e){ var o=[];e.store.each(function(t){ var n=e.rowForms[t.internalId].getForm().getValues();n.leadingZeros=!!n.leadingZeros;o.push(n)});return o}});