Ext.define("Shopware.apps.ViisonPickwareERPAboutBackend",{ extend:"Enlight.app.SubApplication",name:"Shopware.apps.ViisonPickwareERPAboutBackend",launch:function(){ Shopware.app.Application.addSubApplication({ name:"Shopware.apps.ViisonCommonIndexPopup",localizedName:"Pickware",params:{ windowWidth:740,contentURL:'{url controller="ViisonPickwareERPAboutBackend" action="getContent"}'}})}});