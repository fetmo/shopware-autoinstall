Ext.define("Shopware.apps.ViisonPickwareERPAboutPopup.controller.Main",{ override:"Shopware.apps.Index.controller.Main",init:function(){ this.callParent(arguments);Shopware.app.Application.addSubApplication({ name:"Shopware.apps.ViisonCommonIndexPopup",localizedName:"Pickware",params:{ windowWidth:740,contentURL:'{url controller="ViisonPickwareERPAboutBackend" action="getContent"}',saveURL:'{url controller="ViisonPickwareERPAboutPopup" action="save"}'}})}});