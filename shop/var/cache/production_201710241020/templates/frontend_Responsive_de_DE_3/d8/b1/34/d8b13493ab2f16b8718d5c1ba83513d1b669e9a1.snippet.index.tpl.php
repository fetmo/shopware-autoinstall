<?php /* Smarty version Smarty-3.1.12, created on 2017-10-27 22:04:52
         compiled from "/var/www/shopware/themes/Frontend/Bare/widgets/emotion/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180122915059f391644921f0-31810377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8b13493ab2f16b8718d5c1ba83513d1b669e9a1' => 
    array (
      0 => '/var/www/shopware/themes/Frontend/Bare/widgets/emotion/index.tpl',
      1 => 1508840484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180122915059f391644921f0-31810377',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sEmotions' => 1,
    'emotion' => 1,
    'Controller' => 1,
    'theme' => 1,
    'emotionCols' => 1,
    'emotionMode' => 1,
    'emotionGridMode' => 1,
    'emotionFullscreen' => 1,
    'cellSpacing' => 1,
    'cellHeight' => 1,
    'baseWidth' => 1,
    'element' => 1,
    'itemRows' => 1,
    'cellWidth' => 1,
    'itemCls' => 1,
    'itemCols' => 1,
    'viewport' => 1,
    'viewportCols' => 1,
    'viewportColCls' => 1,
    'viewportRows' => 1,
    'viewportRowCls' => 1,
    'emotionRows' => 1,
    'itemStyle' => 1,
    'template' => 1,
    'file' => 1,
    'alias' => 1,
    'rows' => 1,
    'containerHeight' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59f391646fc146_56914084',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f391646fc146_56914084')) {function content_59f391646fc146_56914084($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['sEmotions']->value)>0){?>
    <?php  $_smarty_tpl->tpl_vars['emotion'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['emotion']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sEmotions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['emotion']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['emotion']->key => $_smarty_tpl->tpl_vars['emotion']->value){
$_smarty_tpl->tpl_vars['emotion']->_loop = true;
 $_smarty_tpl->tpl_vars['emotion']->index++;
?>

        

            
            
                <?php $_smarty_tpl->tpl_vars['cellHeight'] = new Smarty_variable($_smarty_tpl->tpl_vars['emotion']->value['cellHeight'], true, 0);?>
                <?php $_smarty_tpl->tpl_vars['cellWidth'] = new Smarty_variable(100/$_smarty_tpl->tpl_vars['emotion']->value['cols'], true, 0);?>
                <?php $_smarty_tpl->tpl_vars['cellSpacing'] = new Smarty_variable($_smarty_tpl->tpl_vars['emotion']->value['cellSpacing'], true, 0);?>
                <?php $_smarty_tpl->tpl_vars['baseWidth'] = new Smarty_variable(1160, true, 0);?>

                <?php $_smarty_tpl->tpl_vars['emotionMode'] = new Smarty_variable($_smarty_tpl->tpl_vars['emotion']->value['mode'], true, 0);?>
                <?php $_smarty_tpl->tpl_vars['emotionGridMode'] = new Smarty_variable($_smarty_tpl->tpl_vars['emotion']->value['mode'], true, 0);?>
                <?php $_smarty_tpl->tpl_vars['emotionFullscreen'] = new Smarty_variable($_smarty_tpl->tpl_vars['emotion']->value['fullscreen'], true, 0);?>
                <?php $_smarty_tpl->tpl_vars['emotionCols'] = new Smarty_variable($_smarty_tpl->tpl_vars['emotion']->value['cols'], true, 0);?>

                <?php $_smarty_tpl->tpl_vars['breakpoints'] = new Smarty_variable(array('s'=>'30em','m'=>'48em','l'=>'64em','xl'=>'78.75em'), true, 0);?>

                <?php if ($_smarty_tpl->tpl_vars['Controller']->value=='listing'&&$_smarty_tpl->tpl_vars['theme']->value['displaySidebar']){?>
                    <?php $_smarty_tpl->tpl_vars['baseWidth'] = new Smarty_variable(900, true, 0);?>
                <?php }?>

                <?php $_smarty_tpl->tpl_vars['emotionRows'] = new Smarty_variable(array(), true, 0);?>
                <?php $_smarty_tpl->createLocalArrayVariable('emotionRows', true, 0);
$_smarty_tpl->tpl_vars['emotionRows']->value['base'] = 0;?>
            

            
                <section class="emotion--container emotion--column-<?php echo $_smarty_tpl->tpl_vars['emotionCols']->value;?>
 emotion--mode-<?php echo $_smarty_tpl->tpl_vars['emotionMode']->value;?>
 emotion--<?php echo $_smarty_tpl->tpl_vars['emotion']->index;?>
"
                         data-emotion="true"
                         data-gridMode="<?php echo $_smarty_tpl->tpl_vars['emotionGridMode']->value;?>
"
                         data-fullscreen="<?php if ($_smarty_tpl->tpl_vars['emotionFullscreen']->value){?>true<?php }else{ ?>false<?php }?>"
                         data-columns="<?php echo $_smarty_tpl->tpl_vars['emotionCols']->value;?>
"
                         data-cellSpacing="<?php echo $_smarty_tpl->tpl_vars['cellSpacing']->value;?>
"
                         data-cellHeight="<?php echo $_smarty_tpl->tpl_vars['cellHeight']->value;?>
"
                         data-baseWidth="<?php echo $_smarty_tpl->tpl_vars['baseWidth']->value;?>
"
                         >

                    <?php if ($_smarty_tpl->tpl_vars['emotion']->value['elements'][0]){?>
                        <?php  $_smarty_tpl->tpl_vars['element'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['element']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emotion']->value['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['element']->key => $_smarty_tpl->tpl_vars['element']->value){
$_smarty_tpl->tpl_vars['element']->_loop = true;
?>
                            

                                
                                
                                    <?php $_smarty_tpl->tpl_vars['template'] = new Smarty_variable($_smarty_tpl->tpl_vars['element']->value['component']['template'], true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['Data'] = new Smarty_variable($_smarty_tpl->tpl_vars['element']->value['data'], true, 0);?>

                                    <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable("emotion--element", true, 0);?>

                                    <?php $_smarty_tpl->tpl_vars['itemCols'] = new Smarty_variable(($_smarty_tpl->tpl_vars['element']->value['endCol']-$_smarty_tpl->tpl_vars['element']->value['startCol'])+1, true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemRows'] = new Smarty_variable(($_smarty_tpl->tpl_vars['element']->value['endRow']-$_smarty_tpl->tpl_vars['element']->value['startRow'])+1, true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemHeight'] = new Smarty_variable($_smarty_tpl->tpl_vars['itemRows']->value*($_smarty_tpl->tpl_vars['cellHeight']->value+$_smarty_tpl->tpl_vars['cellSpacing']->value), true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemTop'] = new Smarty_variable(($_smarty_tpl->tpl_vars['element']->value['startRow']-1)*($_smarty_tpl->tpl_vars['cellHeight']->value+$_smarty_tpl->tpl_vars['cellSpacing']->value), true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemLeft'] = new Smarty_variable($_smarty_tpl->tpl_vars['cellWidth']->value*($_smarty_tpl->tpl_vars['element']->value['startCol']-1), true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemStyle'] = new Smarty_variable("padding-left: ".((string)($_smarty_tpl->tpl_vars['cellSpacing']->value/16))."rem; padding-bottom: ".((string)($_smarty_tpl->tpl_vars['cellSpacing']->value/16))."rem;", true, 0);?>

                                    <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." col-".((string)$_smarty_tpl->tpl_vars['itemCols']->value), true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." row-".((string)$_smarty_tpl->tpl_vars['itemRows']->value), true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." start-col-".((string)$_smarty_tpl->tpl_vars['element']->value['startCol']), true, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." start-row-".((string)$_smarty_tpl->tpl_vars['element']->value['startRow']), true, 0);?>

                                    <?php  $_smarty_tpl->tpl_vars['viewport'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewport']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['viewports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['viewport']->key => $_smarty_tpl->tpl_vars['viewport']->value){
$_smarty_tpl->tpl_vars['viewport']->_loop = true;
?>
                                        <?php $_smarty_tpl->tpl_vars['viewportCols'] = new Smarty_variable(($_smarty_tpl->tpl_vars['viewport']->value['endCol']-$_smarty_tpl->tpl_vars['viewport']->value['startCol'])+1, true, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['viewportRows'] = new Smarty_variable(($_smarty_tpl->tpl_vars['viewport']->value['endRow']-$_smarty_tpl->tpl_vars['viewport']->value['startRow'])+1, true, 0);?>

                                        <?php $_smarty_tpl->tpl_vars['viewportColCls'] = new Smarty_variable("col-".((string)$_smarty_tpl->tpl_vars['viewport']->value['alias'])."-".((string)$_smarty_tpl->tpl_vars['viewportCols']->value), true, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['viewportColCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['viewportColCls']->value)." start-col-".((string)$_smarty_tpl->tpl_vars['viewport']->value['alias'])."-".((string)$_smarty_tpl->tpl_vars['viewport']->value['startCol']), true, 0);?>

                                        <?php $_smarty_tpl->tpl_vars['viewportRowCls'] = new Smarty_variable("row-".((string)$_smarty_tpl->tpl_vars['viewport']->value['alias'])."-".((string)$_smarty_tpl->tpl_vars['viewportRows']->value), true, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['viewportRowCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['viewportRowCls']->value)." start-row-".((string)$_smarty_tpl->tpl_vars['viewport']->value['alias'])."-".((string)$_smarty_tpl->tpl_vars['viewport']->value['startRow']), true, 0);?>

                                        <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." ".((string)$_smarty_tpl->tpl_vars['viewportColCls']->value), true, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." ".((string)$_smarty_tpl->tpl_vars['viewportRowCls']->value), true, 0);?>

                                        <?php if (!$_smarty_tpl->tpl_vars['viewport']->value['visible']){?>
                                            <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." is--hidden-".((string)$_smarty_tpl->tpl_vars['viewport']->value['alias']), true, 0);?>
                                        <?php }?>

                                        <?php if (!$_smarty_tpl->tpl_vars['emotionRows']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]){?>
                                            <?php $_smarty_tpl->createLocalArrayVariable('emotionRows', true, 0);
$_smarty_tpl->tpl_vars['emotionRows']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']] = 0;?>
                                        <?php }?>

                                        <?php if ($_smarty_tpl->tpl_vars['emotionRows']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]<$_smarty_tpl->tpl_vars['viewport']->value['endRow']){?>
                                            <?php $_smarty_tpl->createLocalArrayVariable('emotionRows', true, 0);
$_smarty_tpl->tpl_vars['emotionRows']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']] = $_smarty_tpl->tpl_vars['viewport']->value['endRow'];?>
                                        <?php }?>
                                    <?php } ?>

                                    <?php if ($_smarty_tpl->tpl_vars['element']->value['cssClass']){?>
                                        <?php $_smarty_tpl->tpl_vars['itemCls'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['itemCls']->value)." ".((string)$_smarty_tpl->tpl_vars['element']->value['cssClass']), true, 0);?>
                                    <?php }?>

                                    <?php if ($_smarty_tpl->tpl_vars['emotionRows']->value['base']<$_smarty_tpl->tpl_vars['element']->value['endRow']){?>
                                        <?php $_smarty_tpl->createLocalArrayVariable('emotionRows', true, 0);
$_smarty_tpl->tpl_vars['emotionRows']->value['base'] = $_smarty_tpl->tpl_vars['element']->value['endRow'];?>
                                    <?php }?>
                                

                                <div class="<?php echo $_smarty_tpl->tpl_vars['itemCls']->value;?>
" style="<?php echo $_smarty_tpl->tpl_vars['itemStyle']->value;?>
"><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('', true, 0);?><?php if ($_smarty_tpl->tpl_vars['template']->value=='component_article'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_article.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_article_slider'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_article_slider.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_banner'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_banner.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_banner_slider'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_banner_slider.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_blog'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_blog.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_category_teaser'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_category_teaser.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_html'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_html.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_iframe'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_iframe.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_manufacturer_slider'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_manufacturer_slider.tpl', true, 0);?><?php }elseif($_smarty_tpl->tpl_vars['template']->value=='component_youtube'){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable('widgets/emotion/components/component_youtube.tpl', true, 0);?><?php }elseif($_smarty_tpl->smarty->templateExists("widgets/emotion/components/".((string)$_smarty_tpl->tpl_vars['template']->value).".tpl")){?><?php $_smarty_tpl->tpl_vars['file'] = new Smarty_variable("widgets/emotion/components/".((string)$_smarty_tpl->tpl_vars['template']->value).".tpl", true, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['file']->value!=''){?><?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['file']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }?></div>
                            
                        <?php } ?>

                        
                            <?php  $_smarty_tpl->tpl_vars['rows'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rows']->_loop = false;
 $_smarty_tpl->tpl_vars['alias'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['emotionRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->key => $_smarty_tpl->tpl_vars['rows']->value){
$_smarty_tpl->tpl_vars['rows']->_loop = true;
 $_smarty_tpl->tpl_vars['alias']->value = $_smarty_tpl->tpl_vars['rows']->key;
?>
                                <?php if ($_smarty_tpl->tpl_vars['alias']->value==='base'){?>
                                    <?php continue 1?>
                                <?php }?>

                                <?php $_smarty_tpl->tpl_vars['containerHeight'] = new Smarty_variable($_smarty_tpl->tpl_vars['rows']->value*($_smarty_tpl->tpl_vars['cellHeight']->value+$_smarty_tpl->tpl_vars['cellSpacing']->value), true, 0);?>
                                <div class="emotion--sizer-<?php echo $_smarty_tpl->tpl_vars['alias']->value;?>
 col--1" data-rows="<?php echo $_smarty_tpl->tpl_vars['rows']->value;?>
" style="height: <?php echo $_smarty_tpl->tpl_vars['containerHeight']->value;?>
px;"></div>
                            <?php } ?>

                            <?php $_smarty_tpl->tpl_vars['containerHeight'] = new Smarty_variable($_smarty_tpl->tpl_vars['emotionRows']->value['base']*($_smarty_tpl->tpl_vars['cellHeight']->value+$_smarty_tpl->tpl_vars['cellSpacing']->value), true, 0);?>
                            <div class="emotion--sizer col-1" data-rows="<?php echo $_smarty_tpl->tpl_vars['emotionRows']->value['base'];?>
" style="height: <?php echo $_smarty_tpl->tpl_vars['containerHeight']->value;?>
px;"></div>
                        
                    <?php }?>
                </section>
            
        
    <?php } ?>
<?php }?>
<?php }} ?>