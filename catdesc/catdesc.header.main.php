<?PHP
// *********************************************
// *    Category Desc Plugin for Cotonti       *
// *        Header Main                        *
// *    Alex & Natty studio                    *
// *        http://portal30.ru                 *
// *                                           *
// *            © Alex & Naty Studio  2009     *
// *********************************************
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED_EXTPLUGIN]
Code=catdesc
Part=header.main
File=catdesc.header.main
Hooks=header.main
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

if ($cfg['plugin']['ckeditor']['onPagesOnly'] && $cfg['plugin']['catdesc']['useCKEditor']){
	if ($location == "Plugins" && $e == 'catdesc' && !defined('COT_CKEDITOR')){
		$out['compopup'] .= "\n".'<script type="text/javascript" src="'.$cfg['plugins_dir'].'/ckeditor/ckeditor/ckeditor.js"></script>';
		define('COT_CKEDITOR', TRUE);
	}
}
?>