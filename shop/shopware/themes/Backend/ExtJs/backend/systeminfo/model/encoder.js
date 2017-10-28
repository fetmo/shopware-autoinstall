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
 * @package    Systeminfo
 * @subpackage Model
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Model - Encoder list systeminfo backend module.
 *
 * This model represents a single encoder.
 */
//{block name="backend/systeminfo/model/encoder"}
Ext.define('Shopware.apps.Systeminfo.model.Encoder', {

    /**
    * Extends the standard ExtJS 4
    * @string
    */
    extend: 'Ext.data.Model',

    fields: [
        //{block name="backend/systeminfo/model/encoder/fields"}{/block}
        'name', 'required', 'version', 'result'],
    /**
    * Configure the data communication
    * @object
    */
    proxy: {
        type: 'ajax',
        api: {
            //read out all configs
            read: '{url controller="systeminfo" action="getEncoder"}'
        },
        /**
        * Configure the data reader
        * @object
        */
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//{/block}
