{extends file="parent:frontend/account/order_item_details.tpl"}

{* Add canceled quantity *}
{block name='frontend_account_order_item_quantity'}
    <div class="panel--td order--quantity column--quantity">

        {block name='frontend_account_order_item_quantity_label'}
            <div class="column--label">{s name="OrderItemColumnQuantity"}{/s}</div>
        {/block}

        {block name='frontend_account_order_item_quantity_value'}
            <div class="column--value">
                {$article.quantity + $article.viison_canceled}{if $article.viison_canceled > 0} ({$article.viison_canceled}){/if}
            </div>
        {/block}
    </div>
{/block}

{* Show article price even if article price is zero (remove 'GRATIS' badge) *}
{block name='frontend_account_order_item_amount'}
    <div class="panel--td order--amount column--total">

        {block name='frontend_account_order_item_amount_label'}
            <div class="column--label">{s name="OrderItemColumnTotal"}{/s}</div>
        {/block}

        {block name='frontend_account_order_item_amount_value'}
            <div class="column--value">
                {$article.amount|currency} *
            </div>
        {/block}
    </div>
{/block}
