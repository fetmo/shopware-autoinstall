Ext.define("Shopware.apps.ViisonPickwareERPAnalyticsNetRevenue.store.navigation.Countries",{ override:"Shopware.apps.Analytics.store.navigation.Countries",constructor:function(e){ this.fields.push("turnoverNet");this.callParent(arguments);if(e.shopStore){ e.shopStore.each(function(t){ e.fields.push("turnoverNet"+t.data.id)})}}});
