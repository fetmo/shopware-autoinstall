<?php /* Smarty version Smarty-3.1.12, created on 2017-10-27 22:04:53
         compiled from "/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/box-emotion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126541006859f39165e29ad5-18733438%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f3eda4bf6524f4553e14ae287efa7057abc68ba' => 
    array (
      0 => '/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/box-emotion.tpl',
      1 => 1508840484,
      2 => 'file',
    ),
    '49c711b10f214ea06e64b0bc15fe627a86a1e991' => 
    array (
      0 => '/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/product-badges.tpl',
      1 => 1508840484,
      2 => 'snippet',
    ),
    '3d9261a090e9f2f3cf3d5167b816dfed7435b30f' => 
    array (
      0 => '/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/product-price-unit.tpl',
      1 => 1508840484,
      2 => 'snippet',
    ),
    '658b7f4fcc89b55487d74a7c1d2d4677c5c08524' => 
    array (
      0 => '/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/product-price.tpl',
      1 => 1508840484,
      2 => 'snippet',
    ),
  ),
  'nocache_hash' => '126541006859f39165e29ad5-18733438',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productBoxLayout' => 0,
    'sArticle' => 0,
    'productName' => 0,
    'imageOnly' => 0,
    'element' => 0,
    'fixedImageSize' => 0,
    'viewport' => 1,
    'cols' => 0,
    'cellWidth' => 1,
    'elementSize' => 1,
    'breakpoints' => 1,
    'emotionFullscreen' => 1,
    'baseWidth' => 1,
    'size' => 1,
    'itemSize' => 1,
    'srcSet' => 0,
    'image' => 0,
    'srcSetRetina' => 0,
    'desc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59f39166031753_86536548',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f39166031753_86536548')) {function content_59f39166031753_86536548($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/shopware/engine/Library/Smarty/plugins/modifier.truncate.php';
?>


    <div class="product--box box--<?php echo $_smarty_tpl->tpl_vars['productBoxLayout']->value;?>
" data-ordernumber="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['ordernumber'];?>
">

        
            <?php $_smarty_tpl->tpl_vars['productName'] = new Smarty_variable($_smarty_tpl->tpl_vars['sArticle']->value['articleName'], null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['additionaltext']){?>
                <?php $_smarty_tpl->tpl_vars['productName'] = new Smarty_variable((($_smarty_tpl->tpl_vars['productName']->value).(' ')).($_smarty_tpl->tpl_vars['sArticle']->value['additionaltext']), null, 0);?>
            <?php }?>
        

        
            <div class="box--content">

                
                
                    <?php if (!$_smarty_tpl->tpl_vars['imageOnly']->value){?>
                        <?php /*  Call merged included template "frontend/listing/product-box/product-badges.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("frontend/listing/product-box/product-badges.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '126541006859f39165e29ad5-18733438');
content_59f39165e4ae28_38363824($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "frontend/listing/product-box/product-badges.tpl" */?>
                    <?php }?>
                

                
                    <div class="product--info">

                        
                        
                            <a href="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['linkDetails'];?>
"
                               title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['productName']->value, ENT_QUOTES, 'utf-8', true);?>
"
                               class="product--image<?php if ($_smarty_tpl->tpl_vars['imageOnly']->value){?> is--large<?php }?>">

                                
                                    <span class="image--element">

                                        
                                            <span class="image--media">

                                                

                                                    <?php $_smarty_tpl->tpl_vars['desc'] = new Smarty_variable(htmlspecialchars($_smarty_tpl->tpl_vars['productName']->value, ENT_QUOTES, 'utf-8', true), null, 0);?>

                                                    <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['image']['description']){?>
                                                        <?php $_smarty_tpl->tpl_vars['desc'] = new Smarty_variable(htmlspecialchars($_smarty_tpl->tpl_vars['sArticle']->value['image']['description'], ENT_QUOTES, 'utf-8', true), null, 0);?>
                                                    <?php }?>

                                                    <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['image']['thumbnails']){?>

                                                        <?php if ($_smarty_tpl->tpl_vars['element']->value['viewports']&&!$_smarty_tpl->tpl_vars['fixedImageSize']->value){?>
                                                            <?php  $_smarty_tpl->tpl_vars['viewport'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewport']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['viewports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['viewport']->key => $_smarty_tpl->tpl_vars['viewport']->value){
$_smarty_tpl->tpl_vars['viewport']->_loop = true;
?>
                                                                <?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable(($_smarty_tpl->tpl_vars['viewport']->value['endCol']-$_smarty_tpl->tpl_vars['viewport']->value['startCol'])+1, null, 0);?>
                                                                <?php $_smarty_tpl->tpl_vars['elementSize'] = new Smarty_variable($_smarty_tpl->tpl_vars['cols']->value*$_smarty_tpl->tpl_vars['cellWidth']->value, true, 0);?>
                                                                <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['elementSize']->value)."vw", true, 0);?>

                                                                <?php if ($_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]){?>

                                                                    <?php if ($_smarty_tpl->tpl_vars['viewport']->value['alias']==='xl'&&!$_smarty_tpl->tpl_vars['emotionFullscreen']->value){?>
                                                                        <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("calc(".((string)($_smarty_tpl->tpl_vars['elementSize']->value/100))." * ".((string)$_smarty_tpl->tpl_vars['baseWidth']->value)."px)", true, 0);?>
                                                                        <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("(min-width: ".((string)$_smarty_tpl->tpl_vars['baseWidth']->value)."px) ".((string)$_smarty_tpl->tpl_vars['size']->value), true, 0);?>
                                                                    <?php }else{ ?>
                                                                        <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("(min-width: ".((string)$_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]).") ".((string)$_smarty_tpl->tpl_vars['size']->value), true, 0);?>
                                                                    <?php }?>
                                                                <?php }?>

                                                                <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['itemSize']->value){?><?php echo ", ";?><?php echo (string)$_smarty_tpl->tpl_vars['itemSize']->value;?><?php }?><?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['itemSize'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['size']->value).$_tmp1, true, 0);?>
                                                            <?php } ?>
                                                        <?php }else{ ?>
                                                            <?php $_smarty_tpl->tpl_vars['itemSize'] = new Smarty_variable("200px", null, 0);?>
                                                        <?php }?>

                                                        <?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable('', null, 0);?>
                                                        <?php $_smarty_tpl->tpl_vars['srcSetRetina'] = new Smarty_variable('', null, 0);?>

                                                        <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sArticle']->value['image']['thumbnails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                                                            <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['srcSet']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['srcSet']->value;?><?php echo ", ";?><?php }?><?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable($_tmp2.((string)$_smarty_tpl->tpl_vars['image']->value['source'])." ".((string)$_smarty_tpl->tpl_vars['image']->value['maxWidth'])."w", null, 0);?>

                                                            <?php if ($_smarty_tpl->tpl_vars['image']->value['retinaSource']){?>
                                                                <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['srcSetRetina']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['srcSetRetina']->value;?><?php echo ", ";?><?php }?><?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['srcSetRetina'] = new Smarty_variable($_tmp3.((string)$_smarty_tpl->tpl_vars['image']->value['retinaSource'])." ".((string)($_smarty_tpl->tpl_vars['image']->value['maxWidth']*2))."w", null, 0);?>
                                                            <?php }?>
                                                        <?php } ?>

                                                        <picture>
                                                            <source sizes="<?php echo $_smarty_tpl->tpl_vars['itemSize']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['srcSetRetina']->value;?>
" media="(min-resolution: 192dpi)" />
                                                            <source sizes="<?php echo $_smarty_tpl->tpl_vars['itemSize']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['srcSet']->value;?>
" />

                                                            <img src="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['image']['thumbnails'][0]['source'];?>
" alt="<?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['desc']->value),160);?>
" />
                                                        </picture>

                                                    <?php }elseif($_smarty_tpl->tpl_vars['sArticle']->value['image']['source']){?>
                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['image']['source'];?>
" alt="<?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['desc']->value),160);?>
" />
                                                    <?php }else{ ?>
                                                        <img src="/themes/Frontend/Responsive/frontend/_public/src/img/no-picture.jpg" alt="<?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['desc']->value),160);?>
" />
                                                    <?php }?>
                                                
                                            </span>
                                        
                                    </span>
                                
                            </a>
                        

                        <?php if (!$_smarty_tpl->tpl_vars['imageOnly']->value){?>
                            <div class="product--details">

                                
                                
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['sArticle']->value['linkDetails'];?>
"
                                       class="product--title"
                                       title="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escapeHtml'][0][0]->escapeHtml($_smarty_tpl->tpl_vars['productName']->value);?>
">
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['escapeHtml'][0][0]->escapeHtml(smarty_modifier_truncate($_smarty_tpl->tpl_vars['productName']->value,50));?>

                                    </a>
                                

                                
                                    <div class="product--price-info">

                                        
                                        
                                            <?php /*  Call merged included template "frontend/listing/product-box/product-price-unit.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("frontend/listing/product-box/product-price-unit.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '126541006859f39165e29ad5-18733438');
content_59f39165f09e94_17731722($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "frontend/listing/product-box/product-price-unit.tpl" */?>
                                        

                                        
                                        
                                            <?php /*  Call merged included template "frontend/listing/product-box/product-price.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("frontend/listing/product-box/product-price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '126541006859f39165e29ad5-18733438');
content_59f39165f3b825_13347123($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "frontend/listing/product-box/product-price.tpl" */?>
                                        
                                    </div>
                                
                            </div>
                        <?php }?>
                    </div>
                
            </div>
        
    </div>

<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2017-10-27 22:04:53
         compiled from "/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/product-badges.tpl" */ ?>
<?php if ($_valid && !is_callable('content_59f39165e4ae28_38363824')) {function content_59f39165e4ae28_38363824($_smarty_tpl) {?>



    <div class="product--badges">

        
        
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?>
                <div class="product--badge badge--discount">
                    <i class="icon--percent2"></i>
                </div>
            <?php }?>
        

        
        
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['highlight']){?>
                <div class="product--badge badge--recommend">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"ListingBoxTip",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"ListingBoxTip",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TIPP!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"ListingBoxTip",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </div>
            <?php }?>
        

        
        
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['newArticle']){?>
                <div class="product--badge badge--newcomer">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"ListingBoxNew",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"ListingBoxNew",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NEU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"ListingBoxNew",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </div>
            <?php }?>
        

        
        
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['esd']){?>
                <div class="product--badge badge--esd">
                    <i class="icon--download"></i>
                </div>
            <?php }?>
        
    </div>







<?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2017-10-27 22:04:53
         compiled from "/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/product-price-unit.tpl" */ ?>
<?php if ($_valid && !is_callable('content_59f39165f09e94_17731722')) {function content_59f39165f09e94_17731722($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_currency')) include '/var/www/shopware/engine/Library/Enlight/Template/Plugins/modifier.currency.php';
?>

<div class="price--unit">

    
    <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']&&$_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']!=0){?>

        
        
            <span class="price--label label--purchase-unit is--bold is--nowrap">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"ListingBoxArticleContent",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"ListingBoxArticleContent",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Inhalt<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"ListingBoxArticleContent",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </span>
        

        
        
            <span class="is--nowrap">
                <?php echo $_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit'];?>
 <?php echo $_smarty_tpl->tpl_vars['sArticle']->value['sUnit']['description'];?>

            </span>
        
    <?php }?>

    
    <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']&&$_smarty_tpl->tpl_vars['sArticle']->value['purchaseunit']!=$_smarty_tpl->tpl_vars['sArticle']->value['referenceunit']){?>

        
        
            <span class="is--nowrap">
                (<?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['referenceprice']);?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"Star",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"Star",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
*<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"Star",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 / <?php echo $_smarty_tpl->tpl_vars['sArticle']->value['referenceunit'];?>
 <?php echo $_smarty_tpl->tpl_vars['sArticle']->value['sUnit']['description'];?>
)
            </span>
        
    <?php }?>
</div><?php }} ?><?php /* Smarty version Smarty-3.1.12, created on 2017-10-27 22:04:53
         compiled from "/var/www/shopware/themes/Frontend/Bare/frontend/listing/product-box/product-price.tpl" */ ?>
<?php if ($_valid && !is_callable('content_59f39165f3b825_13347123')) {function content_59f39165f3b825_13347123($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_currency')) include '/var/www/shopware/engine/Library/Enlight/Template/Plugins/modifier.currency.php';
?>

<div class="product--price">

    
    
        <span class="price--default is--nowrap<?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?> is--discount<?php }?>">
            <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['priceStartingFrom']&&!$_smarty_tpl->tpl_vars['sArticle']->value['liveshoppingData']){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ab<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ListingBoxArticleStartsAt','namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php }?>
            <?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['price']);?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"Star",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"Star",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
*<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"Star",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </span>
    

    
    
        <?php if ($_smarty_tpl->tpl_vars['sArticle']->value['has_pseudoprice']){?>
            <span class="price--pseudo">

                
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"priceDiscountLabel",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"priceDiscountLabel",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"priceDiscountLabel",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                

                <span class="price--discount is--nowrap">
                    <?php echo smarty_modifier_currency($_smarty_tpl->tpl_vars['sArticle']->value['pseudoprice']);?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"Star",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"Star",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
*<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"Star",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </span>

                
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>"priceDiscountInfo",'namespace'=>'frontend/listing/box_article')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"priceDiscountInfo",'namespace'=>'frontend/listing/box_article'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>"priceDiscountInfo",'namespace'=>'frontend/listing/box_article'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                
            </span>
        <?php }?>
    
</div>
<?php }} ?>