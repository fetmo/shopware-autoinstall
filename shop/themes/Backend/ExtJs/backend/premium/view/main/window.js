/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   Shopware
 * @package    Premium
 * @subpackage View
 * @version    $Id$
 * @author shopware AG
 */

//{namespace name=backend/premium/main}

/**
 * todo@all: Documentation
 */
//{block name="backend/premium/view/main/window"}
Ext.define('Shopware.apps.Premium.view.main.Window', {
    extend: 'Enlight.app.Window',
    title: '{s name=window_title}Premium articles{/s}',
    cls: Ext.baseCSSPrefix + 'premium-window',
    alias: 'widget.premium-main-window',
    border: false,
    autoShow: true,
    layout: 'border',
    height: '90%',
    width: 925,

    stateful:true,
    stateId:'shopware-premiums-window',

    /**
     * Initializes the component and builds up the main interface
     *
     * @return void
     */
    initComponent: function() {
        var me = this;

        me.items = [{
            xtype: 'premium-main-list',
            premiumStore: me.premiumStore
        }];

        me.callParent(arguments);
    }
});
//{/block}
