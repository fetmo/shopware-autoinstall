Ext.define("Shopware.apps.ViisonPickwareERPOrderStatusBasedPositionUpdate.model.Order",{ override:"Shopware.apps.Order.model.Order",viisonPickwareERPcancelShippingCosts:function(){ this.set("invoiceShipping",0);this.set("invoiceShippingEuro",0);this.set("invoiceShippingNet",0)}});