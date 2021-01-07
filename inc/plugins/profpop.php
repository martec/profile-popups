<?php
// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

// Plugin info
function profpop_info ()
{

	global $db, $lang;

	$lang->load('config_profpop');

	$QAE_description = <<<EOF
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
{$lang->profpop_plug_desc}
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>
EOF;

	return array(
		"name"			  => "Profile Popups",
		"description"	 => "Profile Popups for mybb 1.8",
		"website"		 => "https://github.com/martec/profile-popups",
		"author"		=> "martec",
		"authorsite"	=> "http://community.mybb.com/user-49058.html",
		"version"		 => "1.1.1",
		"compatibility" => "18*"
	);
}

function profpop_install()
{
	global $db, $lang, $mybb;

	$lang->load('config_profpop');

	$query	= $db->simple_select("settinggroups", "COUNT(*) as counts");
	$dorder = $db->fetch_field($query, 'counts') + 1;

	$groupid = $db->insert_query('settinggroups', array(
		'name'		=> 'profpop',
		'title'		=> 'Profile Popups',
		'description'	=> $lang->profpop_sett_desc,
		'disporder'	=> $dorder,
		'isdefault'	=> '0'
	));

	$new_setting[] = array(
		'name'		=> 'profpop_nperm_use',
		'title'		=> $lang->profpop_nperm_use_title,
		'description'	=> $lang->profpop_nperm_use_desc,
		'optionscode'	=> 'groupselect',
		'value'		=> '7',
		'disporder'	=> 1,
		'gid'		=> $groupid
	);

	$db->insert_query_multiple("settings", $new_setting);
	rebuild_settings();
}

function profpop_is_installed()
{
	global $db;

	$query = $db->simple_select("settinggroups", "COUNT(*) as counts", "name = 'profpop'");
	$counts  = $db->fetch_field($query, 'counts');

	return ($counts > 0);
}

function profpop_uninstall()
{
	global $db;

	$db->write_query("DELETE FROM " . TABLE_PREFIX . "settings WHERE name IN('profpop_nperm_use')");
	$db->delete_query("settinggroups", "name = 'profpop'");
}

function profpop_activate()
{
	global $db;
	include_once MYBB_ROOT.'inc/adminfunctions_templates.php';

	$new_template_global['profpop'] = "<table>
	<tr>
		<td class=\"tvatar tl_c\">
			<span>
				<a href=\"member.php?action=profile&amp;uid={\$uid}\"><img src=\"{\$memprofile['avatar']}\" alt=\"\" /></a>
			</span>
		</td>
		<td class=\"tdprofpop\">
			<div class=\"divprofpop\">
				<a href=\"member.php?action=profile&amp;uid={\$uid}\">
					<span class=\"spprofpop\">
						<strong>{\$formattedname}</strong>
					</span>
				</a>
				<br />
				<span class=\"font_nm\">{\$usertitle}</span>
				<br /><br /><br />
				<span class=\"font_nm fo_b\">
					<a href=\"member.php?action=profile&amp;uid={\$uid}\" class=\"popcol\">{\$lang->profpop_page}</a>
					<a href=\"private.php?action=send&amp;uid={\$memprofile['uid']}\" class=\"popcol pl5\">{\$lang->profpop_send_pm}</a>
				</span>
				<hr>
				<span class=\"font_nm\">{\$lang->postbit_status} {\$online_status} &nbsp;{\$lang->registration_date} {\$memregdate} &nbsp;
					{\$lang->total_posts} {\$memprofile['postnum']} &nbsp;{\$lang->reputation} {\$memprofile['reputation']}
					&nbsp;{\$lang->warning_level} <a href=\"{\$warning_link}\" class=\"popcol\">{\$warning_level} %</a>
					<br />(<a href=\"search.php?action=finduserthreads&amp;uid={\$uid}\" class=\"popcol\">{\$lang->find_threads}</a> &mdash;
					<a href=\"search.php?action=finduser&amp;uid={\$uid}\" class=\"popcol\">{\$lang->find_posts}</a>)
					<hr> {\$lang->lastvisit} {\$memlastvisitdate} {\$memlastvisittime}
				</span>
			</div>
		</td>
	</tr>
</table>";

	$new_template_global['profile_online'] = "<a href=\"online.php\"><span class=\"online\" style=\"font-weight: bold;\">{\$lang->postbit_status_online}</span></a>";

	foreach($new_template_global as $title => $template)
	{
		$new_template_global = array('title' => $db->escape_string($title), 'template' => $db->escape_string($template), 'sid' => '-1', 'version' => '1801', 'dateline' => TIME_NOW);
		$db->insert_query('templates', $new_template_global);
	}

	find_replace_templatesets(
		'headerinclude',
		'#' . preg_quote('var MyBBEditor = null;') . '#i',
		'var MyBBEditor = null;
	var myusrgrp = "{$mybb->user[\'usergroup\']}";
	var grpignore = "{$mybb->settings[\'profpop_nperm_use\']}";
	var grpnoperm = "{$lang->profpop_no_perm}";'
	);

	find_replace_templatesets(
		'headerinclude',
		'#' . preg_quote('{$stylesheets}') . '#i',
		'{$stylesheets}
<link rel="stylesheet" href="{$mybb->asset_url}/jscripts/profpop/profpop.css" type="text/css" media="all" />
<script type="text/javascript" src="{$mybb->asset_url}/jscripts/profpop/profpop.js"></script>'
	);
}

function profpop_deactivate()
{
	global $db;
	include_once MYBB_ROOT."inc/adminfunctions_templates.php";

	$db->delete_query("templates", "title IN('profpop','profile_online')");

	find_replace_templatesets(
		'headerinclude',
		'#' . preg_quote('var MyBBEditor = null;
	var myusrgrp = "{$mybb->user[\'usergroup\']}";
	var grpignore = "{$mybb->settings[\'profpop_nperm_use\']}";
	var grpnoperm = "{$lang->profpop_no_perm}";') . '#i',
	'var MyBBEditor = null;'
	);

	find_replace_templatesets(
		'headerinclude',
		'#' . preg_quote('{$stylesheets}
<link rel="stylesheet" href="{$mybb->asset_url}/jscripts/profpop/profpop.css" type="text/css" media="all" />
<script type="text/javascript" src="{$mybb->asset_url}/jscripts/profpop/profpop.js"></script>') . '#i',
		'{$stylesheets}'
	);
}

$plugins->add_hook('global_start', 'profpop');
function profpop()
{
	global $templatelist, $lang, $mybb, $templates, $profile_pop, $db;

	if (isset($templatelist)) {
		$templatelist .= ',';
	}

	if (THIS_SCRIPT == 'misc.php' AND $mybb->input['action'] == 'profile_pop') {
		$templatelist .= 'profpop,profile_online';
	}

	$lang->load("profpop");

	if($mybb->input['action'] == "profile_pop"){

		if($mybb->usergroup['canviewprofiles'] == 0 || in_array((int)$mybb->user['usergroup'],explode(',',$mybb->settings['profpop_nperm_use']))) {
			echo $lang->profpop_no_perm;
			exit();
		}

		$uid = $mybb->input['uid'];
		$memprofile = get_user($uid);
		$memprofile['avatar'] = htmlspecialchars_uni($memprofile['avatar']);
		$formattedname = format_name($memprofile['username'], $memprofile['usergroup'], $memprofile['displaygroup']);
		$usertitle = "";
		if (!empty($memprofile['usertitle'])) { $usertitle = "(".htmlspecialchars_uni($memprofile['usertitle']).")";};
		$memregdate = my_date($mybb->settings['dateformat'], $memprofile['regdate']);
		$memprofile['postnum'] = my_number_format($memprofile['postnum']);
		$warning_link = "warnings.php?uid={$memprofile['uid']}";
		$warning_level = round(($memprofile['warningpoints']/( $mybb->settings['maxwarningpoints'] == 0 ? 1 : $mybb->settings['maxwarningpoints'] ))*100);
		$memlastvisitdate = my_date($mybb->settings['dateformat'], $memprofile['lastactive']);
		$memlastvisittime = my_date($mybb->settings['timeformat'], $memprofile['lastactive']);
		$lang->load("member");

        if(strlen(trim($memprofile['avatar'])) == 0) {$memprofile['avatar'] = "images/default_avatar.png";};

		// User is currently online and this user has permissions to view the user on the WOL
		$timesearch = TIME_NOW - $mybb->settings['wolcutoffmins']*60;
		$query = $db->simple_select("sessions", "location,nopermission", "uid='$uid' AND time>'{$timesearch}'", array('order_by' => 'time', 'order_dir' => 'DESC', 'limit' => 1));
		$session = $db->fetch_array($query);

		if(($memprofile['invisible'] != 1 || $mybb->usergroup['canviewwolinvis'] == 1 || $memprofile['uid'] == $mybb->user['uid']) && !empty($session))
		{
			eval("\$online_status = \"".$templates->get("profile_online")."\";");
		}
		// User is offline
		else
		{
			eval("\$online_status = \"".$templates->get("member_profile_offline")."\";");
		}

		echo eval($templates->render("profpop", 1, 0));
		exit();
	}
}
?>
