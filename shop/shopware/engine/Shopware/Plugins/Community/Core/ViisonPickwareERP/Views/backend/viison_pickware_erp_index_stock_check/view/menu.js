// {namespace name=backend/viison_pickware_erp_index_stock_check/main}
Ext.define("Shopware.apps.ViisonPickwareERPIndexStockCheck.view.Menu",{ override:"Shopware.apps.Index.view.Menu",initComponent:function(){ this.on("menu-created",function(){ window.setTimeout(function(){ this.performStockCheck()}.bind(this),500)},this);this.callParent(arguments)},performStockCheck:function(){ Ext.Ajax.request({ url:'{url controller=ViisonPickwareERPIndexStockCheck action=checkStock}',success:function(i){ var e=Ext.JSON.decode(i.responseText,true);if(!e||parseInt(e.count,10)===0){ return}Shopware.Notification.createStickyGrowlMessage({ title:'{s name=notification/title}{/s}',text:Ext.String.format('{s name=notification/message}{/s}',e.count),btnDetail:{ text:'{s name=notification/open_button}{/s}',callback:function(){ Shopware.app.Application.addSubApplication({ name:"Shopware.apps.ViisonPickwareERPStockInitialization",localizedName:'{s name=notification/title}{/s}'})}}})}})}});