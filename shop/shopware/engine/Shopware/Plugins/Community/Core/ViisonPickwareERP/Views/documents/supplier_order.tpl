{namespace name=backend/viison_pickware_erp_supplier_orders/document}
{extends file="documents/index.tpl"}

{*
    Dieses Template erweitert das Shopware Standard Rechnungstemplate index.tpl

    Jede Spalte der Tabelle (Header-Zeile und Inhalt) kann durch Blöcke erweitert oder ersetzt werden.

    Sie haben dabei Zugriff auf alle Informationen über den Lieferanten:
    {$supplier} entspricht dem Pickware Model Shopware\CustomModels\ViisonSupplier\Supplier\Supplier

    Innerhalb der Tabelle (block name="document_index_table_each") haben Sie Zugriff auf Artikelinformationen der Position:
    {$position.article} entspricht dem Pickware Model Shopware\CustomModels\ViisonSupplier\Supplier\Order\Article
    {$position.article->getArticleDetail()} entspricht dem Shopware Model Shopware\Models\Article\Detail
    {$position.article->getArticleDetail()->getAttribute()} entspricht den Shopware Artikel Attributen (Freitextfeldern)
    {$position.article->getArticleDetail()->getAttribute()->getAttr1()} bspw. ein Zugriff auf Attribut1 (Freitextfeld 1)

    Weitere Informationen zum Variabelnzugriff in Smarty Templates finden Sie hier:
    http://www.smarty.net/docs/en/language.syntax.variables.tpl
*}

{* Add style in first block possible *}
{block name="document_index_selectAdress" prepend}
    <style type="text/css">
        #lieferantkontakt {
            position: absolute;
            top: 85mm;
            padding-left: 0mm;
            font-size: 9pt;
        }
    </style>
{/block}

{* Replace head-right customer information, because customernumber is restricted to numbers in index.tpl *}
{block name="document_index_head_right"}
    {$Containers.Header_Box_Right.value}
    {if $User.billing.customernumber}
        {s name="customernumber"}{/s} {$User.billing.customernumber}<br />
    {/if}
    {if $User.billing.ustid}
        {s name="vatno"}{/s} {$User.billing.ustid|replace:" ":""|replace:"-":""}<br />
    {/if}
    {s name="date"}{/s} {$Document.date}<br />

    {* Add Warehouse address information after right head box (shop information) *}
    {block name="document_index_warehouse"}
        {if $hasWarehouseAddress}
            <p>
                <b>{s name="shippingAddress"}{/s}</b><br />
                {$Warehouse->getAddress()|nl2br}
            </p>
        {/if}
    {/block}
{/block}

{* Add supplier contact *}
{block name="document_index_head_bottom"}
    <div id="lieferantkontakt">
        {if $hasContactInformation}{s name=contact}{/s}{/if}
        {if $email}<strong>{s name=email}{/s}</strong> {$email}{/if}
        {if $phone}<strong>{s name=phone}{/s}</strong> {$phone}{/if}
        {if $fax}<strong>{s name=fax}{/s}</strong> {$fax}{/if}
    </div>
    <h1>{s name=orderNumber}{/s} {$Document.id}</h1>
    {s name=page}{/s} {$page+1} {s name=pageof}{/s} {$Pages|@count}
{/block}

{* Modify headers (remove some, add some) *}
{block name="document_index_table_head_pos"}{/block}
{block name="document_index_table_head_nr"}
    {* Supplier and suppliernumber, instead of number only *}
    {block name="document_index_head_frabricatornumber"}<td width="20%" class="head"><strong>{s name=fabricatorNumber}{/s}</strong></td>{/block}
    {block name="document_index_head_frabricator"}<td width="20%" class="head"><strong>{s name=fabricator}{/s}</strong></td>{/block}
{/block}
{block name="document_index_table_head_name"}
    {* Article information (name, number, unit), instead of name only *}
    {block name="document_index_head_articlename"}<td width="27%" class="head"> <strong>{s name=articleName}{/s}</strong></td>{/block}
    {block name="document_index_head_articlenumber"}<td width="15%" class="head"><strong>{s name=articleNumber}{/s}</strong></td>{/block}
    {block name="document_index_head_unit"}<td width="10%" class="head"><strong>{s name=unit}{/s}</strong></td>{/block}
    {block name="document_index_head_amount"}<td align="right" width="8%" class="head"><strong>{s name=quantity}{/s}</strong></td>{/block}
    {block name="document_index_head_extra_fields"}
        {* Example (shows the item price):
            <td align="right" width="10%" class="head"><strong>{s name=purchasePrice}{/s}</strong></td>
        *}
    {/block}
{/block}
{block name="document_index_table_head_quantity"}{/block}
{block name="document_index_table_head_tax"}{/block}
{block name="document_index_table_head_price"}{/block}

{* Table content *}
{block name="document_index_table_each"}
    <tr>
        {block name="document_index_table_each_fabricatornumber"}
            {*
                Shopwares fabricator number or our supplier article number are shown in this field
                which represents the article number for the supplier. Only one of the numbers is shown.
                'supplierArticleNumber' is used with priority, 'fabricatorNumber' as a fallback.
            *}
            {if $position.supplierArticleNumber}
                <td>{$position.supplierArticleNumber}</td>
            {else}
                <td>{$position.fabricatorNumber}</td>
            {/if}
        {/block}
        {block name="document_index_table_each_fabricator"}<td>{$position.fabricator}</td>{/block}
        {block name="document_index_table_each_name"}<td>{$position.name}</td>{/block}
        {block name="document_index_table_each_articlenumber"}<td>{$position.articlenumber}</td>{/block}
        {block name="document_index_table_each_unit"}<td>{$position.unit}</td>{/block}
        {block name="document_index_table_each_orderAmount"}<td align="right">{$position.orderAmount}</td>{/block}
        {block name="document_index_table_each_extra_fields"}
            {* Example (shows the item price):
                <td align="right">
                    {if $currency.symbolOnLeft}
                        {$currency.symbol}
                    {/if}
                    {$position.article->getPrice()}
                    {if !$currency.symbolOnLeft}
                        {$currency.symbol}
                    {/if}
                </td>
            *}
        {/block}
    </tr>
{/block}

{* Replace comment block to ensure linebreaks are used *}
{block name="document_index_info_comment"}
    {if $Document.comment}
        <div style="font-size:11px;color:#333;font-weight:bold">
            {$Document.comment|replace:"€":"&euro;"|nl2br}
        </div>
    {/if}
{/block}

{* Remove additional information blocks *}
{block name="document_index_amount"}{/block}
{block name="document_index_info_net"}{/block}
{block name="document_index_info_voucher"}{/block}
{block name="document_index_info_currency"}{/block}
{block name="document_index_info_ordercomment"}{/block}
{block name="document_index_info_dispatch"}{/block}
{block name="document_index_info_currency"}{/block}
