Ext.define("Shopware.apps.ViisonCommonMailComposer.view.Main",{ extend:"Ext.form.Panel",alias:"widget.viison_common_mail_composer-main",mixins:["Shopware.apps.ViisonCommonApp.Mixin"],flex:1,bodyPadding:10,layout:{ align:"stretch",type:"vbox"},defaults:{ allowBlank:false,labelWidth:75,margin:"5px 0"},viisonSnippetNamespace:"backend/viison_common_mail_composer/main",hideAttachmentField:false,initComponent:function(){ this.items=this.createItems();this.dockedItems=this.createDockedItems();this.callParent(arguments)},createItems:function(){ return[{ xtype:"textfield",name:"fromMail",fieldLabel:"",hidden:true,value:this.mail&&this.mail.fromMail?this.mail.fromMail:"",validate:function(){ return true}},{ xtype:"textfield",name:"fromName",fieldLabel:"",hidden:true,value:this.mail&&this.mail.fromName?this.mail.fromName:"",validate:function(){ return true}},{ xtype:"textfield",name:"toAddress",fieldLabel:this.getViisonSnippet("main/fields/to"),value:this.mail&&this.mail.toAddress?this.mail.toAddress:""},{ xtype:"textfield",name:"subject",fieldLabel:this.getViisonSnippet("main/fields/subject"),value:this.mail&&this.mail.subject?this.mail.subject:""},{ xtype:this.mail.isHtml?"tinymcefield":"textarea",name:this.mail.isHtml?"contentHtml":"content",value:this.mail.isHtml?this.mail.contentHtml:this.mail.content,minHeight:90,flex:1},{ xtype:"textfield",name:"attachment",fieldLabel:this.getViisonSnippet("main/fields/attachment"),value:this.mail&&this.mail.attachment?this.mail.attachment:"",readOnly:true,hidden:this.hideAttachmentField,validate:function(){ return true}},{ xtype:"checkboxfield",name:"isHtml",fieldLabel:"",hidden:true,inputValue:true,uncheckedValue:this.mail.isHtml}]},createDockedItems:function(){ return[{ xtype:"toolbar",dock:"bottom",ui:"shopware-ui",cls:"shopware-toolbar",items:this.createToolbarItems()}]},createToolbarItems:function(){ return[{ xtype:"tbfill"},{ text:this.getViisonSnippet("main/buttons/cancel"),cls:"secondary",action:"cancel",scope:this,handler:function(){ this.fireEvent("cancel",this)}},{ text:this.getViisonSnippet("main/buttons/send"),cls:"primary",scope:this,handler:function(){ this.fireEvent("sendMail",this)}}]}});