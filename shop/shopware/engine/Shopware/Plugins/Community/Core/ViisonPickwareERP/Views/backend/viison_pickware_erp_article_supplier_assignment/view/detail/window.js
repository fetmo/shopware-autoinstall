// {namespace name=backend/viison_pickware_erp_article_supplier_assignment/main}
Ext.define("Shopware.apps.ViisonPickwareERPArticleSupplierAssignment.view.detail.Window",{ override:"Shopware.apps.Article.view.detail.Window",createMainTabPanel:function(){ var i=this.callParent(arguments);this.registerAdditionalTab({ title:'{s name=tab/title}{/s}',tabConfig:{ name:"viison_pickware_erp_article_supplier_assignment-tab"},contentFn:this.createViisonPickwareERPArticleSupplierAssignmentTab,articleChangeFn:function(i){ this.subApplication.getController("Shopware.apps.ViisonPickwareERPArticleSupplierAssignment.controller.Main").setArticle(i)},scope:this});return i},createViisonPickwareERPArticleSupplierAssignmentTab:function(i,e,t){ this.subApplication.addController({ name:"Shopware.apps.ViisonPickwareERPArticleSupplierAssignment.controller.Main"});var n=this.subApplication.getController("Shopware.apps.ViisonPickwareERPArticleSupplierAssignment.controller.Main");n.setArticle(this.article);this.ViisonPickwareERPArticleSupplierAssignmentTab=n.createAssignmentTab();t.tab.add(this.ViisonPickwareERPArticleSupplierAssignmentTab);t.tab.setDisabled(this.article.get("id")===null)}});