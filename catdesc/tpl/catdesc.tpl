<!-- BEGIN: MAIN -->
<div id="main">
<div class="mboxHD"><a href="{PHP.cfg.mainurl}" title="{PHP.skinlang.header.Home}">
            <img src="skins/{PHP.skin}/img/system/icon-home.gif" alt="{PHP.cfg.maintitle}" align="absmiddle" width="16" height="16" /></a>&nbsp;{PHP.cfg.separator} {CATDESC_TITLE}</div>

<!-- BEGIN: CATDESC_NOTE -->
<div class="error">
	{CATDESC_NOTE_MSG}
</div>
<!-- END: CATDESC_NOTE -->

{PHP.L.Category}: <a href="{CATDESC_CATURL}"> {CATDESC_CATTITLE}</a><br /><br />
<form name="catdescform" id="catdescform" action="{CATDESC_ACTION}" method="POST">
<div style="width:100%;">
{CATDESC_TEXT}
{CATDESC_PFS_USER}&nbsp;&nbsp; {CATDESC_PFS_SITE}
</div><br />
<input type="submit" value="{PHP.L.Submit}" />
</form>

</div>
<!-- END: MAIN -->