{extends file="backend/base/header.tpl"}

{block name="backend/base/header/css" append}
    <link type="text/css" media="all" rel="stylesheet" href="{link file='_resources/viison_pickware_erp/css/viison-pickware-erp-icon-set.css'}" />
    <link type="text/css" media="all" rel="stylesheet" href="{link file='_resources/viison_pickware_erp/css/viison-pickware-erp-grid.css'}" />
    <link type="text/css" media="all" rel="stylesheet" href="{link file='_resources/viison_pickware_erp/css/viison-pickware-erp-index-news-widget.css'}" />
    <style>
        {include file='_resources/viison_pickware_erp/css/viison-pickware-erp-stock-overview.css'}
    </style>
{/block}

{block name="backend/base/header/javascript" append}
    <script type="text/javascript">
        {**
         * Load the grid selection fix (see also: https://github.com/shopware/shopware/pull/590)
         *}
        {include file='_resources/viison_pickware_erp/script/ViisonPickwareERP.Ext.view.Table.js'}
        {**
         * Load the override of the plugin form panel.
         *}
        {include file='backend/viison_pickware_erp/base/component/ViisonPickwareERP.Shopware.form.PluginPanel.js'}
    </script>
{/block}
