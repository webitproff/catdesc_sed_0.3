<?php
/* ====================
Copyright (c) 2008-2009, Vladimir Sibirov.
All rights reserved. Distributed under BSD License.

[BEGIN_SED_EXTPLUGIN]
Code=catdesc
Part=main
File=catdesc
Hooks=standalone
Tags=
Order=
[END_SED_EXTPLUGIN]
==================== */
if (!defined('SED_CODE')) { die('Wrong URL.'); }

$c = sed_import('c', 'G', 'ALP');

sed_block(sed_auth('page', $c, 'A'));
$do = sed_import('do','P','ALP',24);

$catd_text = sed_import('catd_text', 'P', 'HTM');
/*var_dump($do);
die;*/
if($do == 'update')
{
	$catd_text = sed_sql_prep($catd_text);
	@sed_sql_query("UPDATE $db_structure SET structure_text = '$catd_text' WHERE structure_code = '$c'");
	$t->assign('CATDESC_NOTE_MSG', $L['plu_changed']);
	$t->parse('MAIN.CATDESC_NOTE');
}

$res = sed_sql_query("SELECT structure_text, structure_title FROM $db_structure WHERE structure_code = '$c'");
$catt = sed_sql_fetchassoc($res);

if ($cfg['plugin']['catdesc']['useCKEditor']){
    // ========= by Alex Инициализируем CKEditor =============
    $fileBroser = "";
    unset ($_SESSION['FileBroserFolder']);
    $_SESSION['FileBroserMaxUploadFileSize'] = 0;
    $_SESSION['FileBroserAllowedExts'] = '';

    if ($cfg['plugin']['ckeditor']['useAltFileManager']){
            $fileBroser = "
                    filebrowserBrowseUrl : '/plugins/ckeditor/ajaxfilemanager/ajaxfilemanager.php?editor=ckeditor',
            filebrowserWindowWidth : '782',
            filebrowserWindowHeight : '500',";

                    // Заряжаем настройки для AjaxFileManager
                    $_SESSION['FileBroserFolder'] = $cfg['plugin']['ckeditor']['altFolder'];
                    $_SESSION['FileBroserMaxUploadFileSize'] = $cfg['plugin']['ckeditor']['altFolder_maxUploadFileSize']*1024;
                    $_SESSION['FileBroserAllowedExts'] = $cfg['plugin']['ckeditor']['altFolder_allowedExts'];
    }
    $smiley_descriptions = '';
    $smiley_images = '';
    $i = 0;
    foreach($sed_smilies as $smile){
            if ($i > 0){
                    $smiley_descriptions .= ",";
                    $smiley_images .=  ",";
            }
            $smiley_descriptions .= "'".$smile["code"]."'";
            $smiley_images .=  "'".$smile["file"]."'";
            $i++;
    }

    $pfsUser = '';
    $pfsSite = '';
    if ($sed_groups[$usr['maingrp']]['pfs_maxtotal']>0 && $sed_groups[$usr['maingrp']]['pfs_maxfile']>0 && sed_auth('pfs', 'a', 'R')){
            if (!$cfg['disable_pfs']){
                    $pfsUser = "<a href=\"javascript:popup('ckeditor&userid=".$usr['id']."&c1=update&c2=catd_text', 754, 512);\">".$L['Mypfs']."</a>";
            }
    }

    if ($sed_groups[$usr['maingrp']]['pfs_maxtotal']>0 && $sed_groups[$usr['maingrp']]['pfs_maxfile']>0 && sed_auth('pfs', 'a', 'R')){
                    $pfsSite = (sed_auth('pfs', 'a', 'A')) ?  "<a href=\"javascript:popup('ckeditor&userid=0&c1=update&c2=catd_text', 754, 512);\">".$L['SFS']."</a>" : "";
    }

    $resize = ($cfg['plugin']['ckeditor']['resize_enabled']) ? 'true' : 'false';

    $editt = "
    <textarea name=\"catd_text\" id=\"catd_text\" >".sed_cc($catt["structure_text"])."</textarea>
    <input type=\"hidden\" name=\"do\" value=\"update\"  />
    <script type=\"text/javascript\">
            CKEDITOR.replace( 'catd_text',{
                    baseHref : '".$cfg['mainurl']."',
                    contentsCss : '".$cfg['mainurl']."/skins/".$skin."/".$skin.".css',
                    height : ".$cfg['plugin']['ckeditor']['height'].",
                    width : ".$cfg['plugin']['ckeditor']['width'].",
            $fileBroser
                    resize_enabled : $resize,
                    resize_maxHeight : ".$cfg['plugin']['ckeditor']['resize_maxHeight'].",
                    resize_maxWidth : ".$cfg['plugin']['ckeditor']['resize_maxWidth'].",
                    resize_minHeight : ".$cfg['plugin']['ckeditor']['resize_minHeight'].",
                    resize_minWidth : ".$cfg['plugin']['ckeditor']['resize_minWidth'].",
                    skin : '".$cfg['plugin']['ckeditor']['skin']."',
                    smiley_descriptions : [$smiley_descriptions],
                    smiley_images : [$smiley_images],
                    smiley_path : '/images/smilies/'
                    //uiColor : '#9AB8F3'

            });

    </script>
    ";
    // ========= by Alex End Инициализируем CKEditor =============
}else{
    $editt = "<textarea name=\"catd_text\" class=\"editor\" rows=\"15\" cols=\"50\">".sed_cc($catt["structure_text"])."</textarea>
	<input type=\"hidden\" name=\"do\" value=\"update\"  />";
}

$t->assign(array(
	'CATDESC_TITLE' => $L['plu_title'],
        'CATDESC_CATTITLE' => $catt["structure_title"],
	'CATDESC_CATURL' => sed_url('list', "c=$c"),
	'CATDESC_ACTION' => sed_url('plug', "e=catdesc&c=$c"),
	'CATDESC_TEXT' => $editt,
        'CATDESC_PFS_USER' => $pfsUser,
        'CATDESC_PFS_SITE' => $pfsSite
));
?>