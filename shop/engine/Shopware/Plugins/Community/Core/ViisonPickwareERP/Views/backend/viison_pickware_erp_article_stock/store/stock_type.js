// {namespace name=backend/viison_pickware_erp_article_stock/main}
Ext.define("Shopware.apps.ViisonPickwareERPArticleStock.store.StockType",{ extend:"Ext.data.Store",model:"Shopware.apps.ViisonPickwareERPArticleStock.model.StockType",data:[{ name:null,title:'{s name=store/stock_type/all}{/s}'},{ name:"purchase",title:'{s name=store/stock_type/purchase}{/s}'},{ name:"sale",title:'{s name=store/stock_type/sale}{/s}'},{ name:"return",title:'{s name=store/stock_type/return}{/s}'},{ name:"stocktake",title:'{s name=store/stock_type/stocktake}{/s}'},{ name:"manual",title:'{s name=store/stock_type/manual}{/s}'},{ name:"incoming",title:'{s name=store/stock_type/incoming}{/s}'},{ name:"outgoing",title:'{s name=store/stock_type/outgoing}{/s}'},{ name:"relocation",title:'{s name=store/stock_type/relocation}{/s}'},{ name:"initialization",title:'{s name=store/stock_type/initialization}{/s}'}]});