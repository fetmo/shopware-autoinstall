<?php /* Smarty version Smarty-3.1.12, created on 2017-10-27 22:04:53
         compiled from "/var/www/shopware/themes/Frontend/Bare/widgets/emotion/components/component_banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67152090759f391659691b4-94978635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34f8a265e66e3894cc3a1e93ece410e1bfe699f1' => 
    array (
      0 => '/var/www/shopware/themes/Frontend/Bare/widgets/emotion/components/component_banner.tpl',
      1 => 1508840484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67152090759f391659691b4-94978635',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Data' => 1,
    'element' => 1,
    'viewport' => 1,
    'cols' => 1,
    'cellWidth' => 1,
    'elementSize' => 1,
    'breakpoints' => 1,
    'emotionFullscreen' => 1,
    'baseWidth' => 1,
    'size' => 1,
    'itemSize' => 1,
    'srcSet' => 1,
    'image' => 1,
    'retinaSrcSet' => 1,
    'baseSource' => 1,
    'retinaBaseSource' => 1,
    'mapping' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_59f39165a22453_10925784',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f39165a22453_10925784')) {function content_59f39165a22453_10925784($_smarty_tpl) {?>
    <div class="emotion--banner"
         data-coverImage="true"
         data-width="<?php echo $_smarty_tpl->tpl_vars['Data']->value['fileInfo']['width'];?>
"
         data-height="<?php echo $_smarty_tpl->tpl_vars['Data']->value['fileInfo']['height'];?>
"
         <?php if ($_smarty_tpl->tpl_vars['Data']->value['bannerMapping']){?>data-bannerMapping="true"<?php }?>>

        
            <div class="banner--content <?php echo $_smarty_tpl->tpl_vars['Data']->value['bannerPosition'];?>
">

                

                    <?php if ($_smarty_tpl->tpl_vars['Data']->value['thumbnails']){?>
                        <?php $_smarty_tpl->tpl_vars['baseSource'] = new Smarty_variable($_smarty_tpl->tpl_vars['Data']->value['thumbnails'][0]['source'], true, 0);?>
                        <?php $_smarty_tpl->tpl_vars['retinaBaseSource'] = new Smarty_variable($_smarty_tpl->tpl_vars['Data']->value['thumbnails'][0]['retinaSource'], true, 0);?>

                        <?php  $_smarty_tpl->tpl_vars['viewport'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['viewport']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['viewports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['viewport']->key => $_smarty_tpl->tpl_vars['viewport']->value){
$_smarty_tpl->tpl_vars['viewport']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable(($_smarty_tpl->tpl_vars['viewport']->value['endCol']-$_smarty_tpl->tpl_vars['viewport']->value['startCol'])+1, true, 0);?>
                            <?php $_smarty_tpl->tpl_vars['elementSize'] = new Smarty_variable($_smarty_tpl->tpl_vars['cols']->value*$_smarty_tpl->tpl_vars['cellWidth']->value, true, 0);?>
                            <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['elementSize']->value)."vw", true, 0);?>

                            <?php if ($_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]){?>

                                <?php if ($_smarty_tpl->tpl_vars['viewport']->value['alias']==='xl'&&!$_smarty_tpl->tpl_vars['emotionFullscreen']->value){?>
                                    <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("calc(".((string)($_smarty_tpl->tpl_vars['elementSize']->value/100))." * ".((string)$_smarty_tpl->tpl_vars['baseWidth']->value)."px)", true, 0);?>
                                <?php }?>

                                <?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable("(min-width: ".((string)$_smarty_tpl->tpl_vars['breakpoints']->value[$_smarty_tpl->tpl_vars['viewport']->value['alias']]).") ".((string)$_smarty_tpl->tpl_vars['size']->value), true, 0);?>
                            <?php }?>

                            <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['itemSize']->value){?><?php echo ", ";?><?php echo (string)$_smarty_tpl->tpl_vars['itemSize']->value;?><?php }?><?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['itemSize'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['size']->value).$_tmp1, true, 0);?>
                        <?php } ?>

                        <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Data']->value['thumbnails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                            <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['srcSet']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['srcSet']->value;?><?php echo ", ";?><?php }?><?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['srcSet'] = new Smarty_variable($_tmp2.((string)$_smarty_tpl->tpl_vars['image']->value['source'])." ".((string)$_smarty_tpl->tpl_vars['image']->value['maxWidth'])."w", true, 0);?>

                            <?php if ($_smarty_tpl->tpl_vars['image']->value['retinaSource']){?>
                                <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['retinaSrcSet']->value){?><?php echo (string)$_smarty_tpl->tpl_vars['retinaSrcSet']->value;?><?php echo ", ";?><?php }?><?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['retinaSrcSet'] = new Smarty_variable($_tmp3.((string)$_smarty_tpl->tpl_vars['image']->value['retinaSource'])." ".((string)$_smarty_tpl->tpl_vars['image']->value['maxWidth'])."w", true, 0);?>
                            <?php }?>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php $_smarty_tpl->tpl_vars['baseSource'] = new Smarty_variable($_smarty_tpl->tpl_vars['Data']->value['source'], true, 0);?>
                    <?php }?>

                    <picture class="banner--image">
                        <source sizes="<?php echo $_smarty_tpl->tpl_vars['itemSize']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['retinaSrcSet']->value;?>
" media="(min-resolution: 192dpi), (-webkit-min-device-pixel-ratio: 2)">
                        <source sizes="<?php echo $_smarty_tpl->tpl_vars['itemSize']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['srcSet']->value;?>
">

                        
                        <img src="<?php echo $_smarty_tpl->tpl_vars['baseSource']->value;?>
" srcset="<?php echo $_smarty_tpl->tpl_vars['retinaBaseSource']->value;?>
 2x" class="banner--image-src"<?php if ($_smarty_tpl->tpl_vars['Data']->value['title']){?> alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['Data']->value['title'], ENT_QUOTES, 'utf-8', true);?>
"<?php }?> />
                    </picture>
                

                
                
                    <?php if ($_smarty_tpl->tpl_vars['Data']->value['bannerMapping']){?>
                        <div class="banner--mapping <?php echo $_smarty_tpl->tpl_vars['Data']->value['bannerPosition'];?>
">
                            <?php  $_smarty_tpl->tpl_vars['mapping'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mapping']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['Data']->value['bannerMapping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mapping']->key => $_smarty_tpl->tpl_vars['mapping']->value){
$_smarty_tpl->tpl_vars['mapping']->_loop = true;
?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['mapping']->value['link'];?>
"
                                   class="banner--mapping-link"
                                   style="width:<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['mapping']->value['width'];?>
<?php $_tmp4=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['Data']->value['fileInfo']['width'];?>
<?php $_tmp5=ob_get_clean();?><?php echo round(($_tmp4/($_tmp5/100)),3);?>
%;
                                          height:<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['mapping']->value['height'];?>
<?php $_tmp6=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['Data']->value['fileInfo']['height'];?>
<?php $_tmp7=ob_get_clean();?><?php echo round(($_tmp6/($_tmp7/100)),3);?>
%;
                                          left:<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['mapping']->value['x'];?>
<?php $_tmp8=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['Data']->value['fileInfo']['width'];?>
<?php $_tmp9=ob_get_clean();?><?php echo round(($_tmp8/($_tmp9/100)),3);?>
%;
                                          top:<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['mapping']->value['y'];?>
<?php $_tmp10=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['Data']->value['fileInfo']['height'];?>
<?php $_tmp11=ob_get_clean();?><?php echo round(($_tmp10/($_tmp11/100)),3);?>
%"
                                   <?php if ($_smarty_tpl->tpl_vars['mapping']->value['as_tooltip']&&$_smarty_tpl->tpl_vars['mapping']->value['title']){?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mapping']->value['title'], ENT_QUOTES, 'utf-8', true);?>
"<?php }?>
                                   <?php if ($_smarty_tpl->tpl_vars['mapping']->value['linkLocation']=="external"){?> target="_blank"<?php }?>>&nbsp;</a>
                            <?php } ?>
                        </div>
                    <?php }elseif($_smarty_tpl->tpl_vars['Data']->value['link']){?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['Data']->value['link'];?>
" class="banner--link"
                           <?php if ($_smarty_tpl->tpl_vars['Data']->value['banner_link_target']){?> target="<?php echo $_smarty_tpl->tpl_vars['Data']->value['banner_link_target'];?>
"<?php }?>
                           <?php if ($_smarty_tpl->tpl_vars['Data']->value['title']){?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['Data']->value['title'], ENT_QUOTES, 'utf-8', true);?>
"<?php }?>>
                        </a>
                    <?php }?>
                
            </div>
        
    </div>


<?php }} ?>