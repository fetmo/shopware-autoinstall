// {namespace name=backend/viison_pickware_erp_order_document_deletion/main}
Ext.define("Shopware.apps.ViisonPickwareERPOrderDocumentDeletion.view.list.Document",{ override:"Shopware.apps.Order.view.list.Document",getColumns:function(){ var e=this.callParent();var i=null;Ext.each(e,function(e){ if(e.xtype==="actioncolumn"){ i=e;i.width+=30;return false}return undefined});if(!i){ i={ xtype:"actioncolumn",width:30,items:[]};e.push(i)}i.items.push({ iconCls:"sprite-minus-circle-frame",tooltip:'{s name=column/action/delete/tooltip}{/s}',scope:this,getClass:function(e,i,t){ if(!this.fireEvent("ViisonPickwareERP.showDocumentDeleteButton",t)){ return"x-hidden"}return undefined},handler:function(e,i){ this.fireEvent("deleteDocument",this,e.getStore().getAt(i))}});return e}});