<?php

if ($username) {
$usrname_1 = ereg_replace("( )", "_", $username);
$usrname_1 = strtolower("u0000$usrname_1");
$passinarray = ${$usrname_1}["Password"];
$userinarray = ${$usrname_1}["Username"];
$passwrd = md5(crypt($password, $userinarray));
}

if ($root) {
$login = $login_g;
$forum = $forum_g;
$cmem = $currentmembers_g;
$youraccount = $youraccount_g;
$signup = $signup_g;
$banner = $banner_g;
$divurl = "log.php";
if ($passinarray == $passwrd && $username) {
$login = $logout_g;
$divurl = "log.php?logout=1";
}
$forumurl = "divisiondisplay.php";
$cmemurl = "currentmembers.php";
if ($usrname_1) {
$accounturl = "users/$usrname_1/useredit.php?profile=1";
}
if (!$usrname_1) {
$accounturl = "userlogin.php";
}
$signupurl = "newuser.php";
}

$backdir_ = "../";
$backdir2_ = "../../";

if ($themeexists == "yes") {
$backdir_ = "";
$backdir2_ = "";
}

if ($oneup) {
$login = "$backdir_$login_g";
$forum = "$backdir_$forum_g";
$cmem = "$backdir_$currentmembers_g";
$youraccount = "$backdir_$youraccount_g";
$signup = "$backdir_$signup_g";
$banner = "$backdir_$banner_g";
$divurl = "../log.php";
if ($passinarray == $passwrd && $username) {
$login = "$backdir_$logout_g";
$divurl = "../log.php?logout=1";
}
$forumurl = "../divisiondisplay.php";
$cmemurl = "../currentmembers.php";
if ($usrname_1) {
$accounturl = "../users/$usrname_1/useredit.php?profile=1";
}
if (!$usrname_1) {
$accounturl = "../userlogin.php";
}
$signupurl = "../newuser.php";
}

if ($twoup) {
$login = "$backdir2_$login_g";
$forum = "$backdir2_$forum_g";
$cmem = "$backdir2_$currentmembers_g";
$youraccount = "$backdir2_$youraccount_g";
$signup = "$backdir2_$signup_g";
$banner = "$backdir2_$banner_g";
$divurl = "../../log.php";
if ($passinarray == $passwrd && $username) {
$login = "$backdir2_$logout_g";
$divurl = "../../log.php?logout=1";
}
$forumurl = "../../divisiondisplay.php";
$cmemurl = "../../currentmembers.php";
if ($usrname_1) {
$accounturl = "../../users/$usrname_1/useredit.php?profile=1";
}
if (!$usrname_1) {
$accounturl = "../../userlogin.php";
}
$signupurl = "../../newuser.php";
}

if ($passinarray == $passwrd)
{
$path_ = $back + "users/$usrname_1/mailbag.php";
$Open = fopen ($path_, "r");
$mailbag = file($path);
fclose($Open);

$newmsgs = 0;

for($i=0; $i < count($mailbag); $i++) {
if (ereg("\"u_n_read\"", $mailbag[$i])) {
if (ereg("\\\$message", $mailbag[$i])) {
$newmsgs++;
$msgnonedis = 1;
}
}
}
}

$tbox_style = "background-color:$tablecolor; border-color:$textcolor; color:$textcolor";

$menu = "
<STYLE TYPE=\"text/css\">
A {text-decoration: none};
A:hover {text-decoration: underline};

INPUT {
background-color:$tablecolor;
border-color:$textcolor;
color:$textcolor;
font-size: 10;
}

.Button {
background-color:$secondarytablecolor;
border-color:$textcolor;
color:$secondarytextcolor;
font-size: 10;
}

TABLE {
border:0px solid;
}

TD {
border:0px;
}

.NONE {
border:0px;
}

SELECT {
background-color:$secondarytablecolor;
border-color:$secondarytextcolor;
color:$secondarytextcolor;
font-size: 10;
}

BODY {
scrollbar-arrow-color: $tablecolor;
scrollbar-track-color: $bgcolor;
scrollbar-face-color: $bgcolor;
scrollbar-highlight-color: $tablecolor;
scrollbar-3dlight-color: $tablecolor;
scrollbar-darkshadow-color: $tablecolor;
scrollbar-shadow-color: $tablecolor;
}
TEXTAREA {
background: $tablecolor;
font-family: \"Times New Roman\";
font-size: 14;
border-width: thin;
border-style : solid;
color: $textcolor;
scrollbar-arrow-color: $bgcolor;
scrollbar-track-color: $tablecolor;
scrollbar-face-color: $tablecolor;
scrollbar-highlight-color: $tablecolor;
scrollbar-3dlight-color: $tablecolor;
scrollbar-darkshadow-color: $tablecolor;
scrollbar-shadow-color: $tablecolor;
}
</STYLE>
<SCRIPT TYPE=\"text/javascript\">
function SubmitTheForm () {
document.DeleteMail.submit();
}
</SCRIPT>
<TABLE CLASS=\"NONE\" cellspacing=\"0\" cellpadding=\"0\" height=\"150\" border=0>
<TR><TD COLSPAN=5>
<DIV ALIGN=\"Center\"><IMG border=\"0\" SRC=\"$banner\"></DIV>
</TD></TR>
<TR>
<TD><A HREF=\"$divurl\"><IMG SRC=\"$login\" border=0></A></TD>
<TD><A HREF=\"$forumurl\"><IMG SRC=\"$forum\" border=0></A></TD>
<TD><A HREF=\"$cmemurl\"><IMG SRC=\"$cmem\" border=0></A></TD>
<TD><A HREF=\"$accounturl\"><IMG SRC=\"$youraccount\" border=0></A></TD>
<TD><A HREF=\"$signupurl\"><IMG SRC=\"$signup\" border=0></A></TD>
</TR>
</TABLE>
<BR><BR>
";

if ($passinarray == $passwrd)
{
$menu = $menu + "Unread Messages: <B>$newmsgs</B><BR><BR>";
}
?>
