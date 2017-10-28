/**
 * ViisonPickwareERP
 * Copyright (c) 2016 VIISON GmbH
 */

// {namespace name=backend/viison_pickware_erp_stock_overview/main}
Ext.define('Shopware.apps.ViisonPickwareERPStockOverview.view.order.List', {

    extend: 'Ext.grid.Panel',
    alias: 'widget.viison_pickware_erp_stock_overview-order-list',
    cls: 'viison-common--grid has--vertical-lines',
    style: 'border-left:none;border-top:none;border-right:none;',
    emptyText: '{s name=orderlist/empty_text}{/s}',

    /**
     * @Override
     */
    initComponent: function () {
        this.columns = [{
            header: '{s name=list/column/orderNumber}{/s}',
            sortable: false,
            dataIndex: 'orderNumber',
            width: 80,
        }, {
            header: '{s name=list/column/quantity}{/s}',
            sortable: false,
            dataIndex: 'quantity',
            width: 60,
        },
// We need extra empty/comment lines before and after smarty statements to prevent smarty from
// interpreting { or } as smarty tags
// {if $isViisonPickwareMobileInstalled}
//
        {
            header: '{s name=list/column/picked}{/s}',
            sortable: false,
            dataIndex: 'picked',
            width: 70,
        },
//
// {/if}
//
        {
            header: '{s name=list/column/shipped}{/s}',
            sortable: false,
            dataIndex: 'shipped',
            width: 70,
        }, {
            header: '{s name=list/column/status}{/s}',
            sortable: false,
            dataIndex: 'status',
            flex: 1,
        }, {
            header: '{s name=list/column/orderTime}{/s}',
            sortable: false,
            dataIndex: 'orderTime',
            flex: 1,
            renderer: Ext.util.Format.dateRenderer('d.m.Y H:i'),
        }, {
            xtype: 'actioncolumn',
            width: 25,
            items: [{
                iconCls: 'sprite-sticky-notes-pin',
                action: 'openOrder',
                tooltip: '{s name=list/column/action/open_order/tooltip}{/s}',
                scope: this,
                handler: function (view, rowIndex) {
                    this.fireEvent('openOrder', view.getStore().getAt(rowIndex));
                },
            }],
        }];
        this.dockedItems = [
            this.getPagingbar(),
        ];

        this.callParent(arguments);
    },

    /**
     * Creates and returns a new paging toolbar and adds a page size selection to it.
     *
     * @return Shopware.apps.ViisonCommonPaginationToolbar The created page toolbar.
     */
    getPagingbar: function () {
        return {
            xtype: 'viison_common_pagination_toolbar-toolbar',
            store: this.store,
        };
    },

});
