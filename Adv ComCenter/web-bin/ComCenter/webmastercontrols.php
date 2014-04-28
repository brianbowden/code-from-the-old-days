<?php
require "users/users.php";

if ($username && $password) {

$usrname__ = ereg_replace("( )", "_", $username);
$usrname__ = strtolower($usrname__);
$usrname_ = "u0000$usrname__";
$passinarray_ = ${$usrname_}["Password"];
$userinarray_ = ${$usrname_}["Username"];
$passwrd_ = md5(crypt($password, $userinarray_));

if ($passinarray_ != $passwrd_) {
for($i=0; $i < count($users); $i++) {
$possiblealias = strtolower($users[$i][Alias]);
$possiblealias = ereg_replace("( )", "_", $possiblealias);
if ($possiblealias == $usrname__) {
$username = $users[$i][Username];
}
}
}

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$aliasinarray = ${usrname}["Alias"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];

$passwrd = md5(crypt($password, $userinarray));

if ($positioninarray == "Administrator") {
$allowedtocontrols = "yes";
}
if ($positioninarray == "Moderator") {
$allowedtocontrols = "yes";
}
if ($passinarray == $passwrd && $positioninarray == "Administrator" || "Moderator") {
setcookie("username", "$username");
setcookie("password", "$password");
}
}

require "specs.php";

if ($arrangediv) {
header("Location: webmastercontrols.php?divisionoptions_check=1");
}

if ($multiplethemes == "yes") {
require "themes.php";
}

$root = 1;
require "menuinsert.php";

?>
<?php
if (!$username && !$password) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Webmaster Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Please Log In:<BR><FONT SIZE=\"2\">Note: Access to the Webmaster Controls is only<BR> allowed to the Administrator and Moderator(s).</FONT>
<FORM ACTION=\"webmastercontrols.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\"><BR>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\">
<BR><BR><INPUT CLASS=\"Button\" TYPE=\"submit\" value=\"Log In\">
</FORM>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");
}
?>
<?php

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$aliasinarray = ${$usrname}["Alias"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];

$passwrd = md5(crypt($password, $userinarray));

if ($positioninarray == "Administrator") {
$allowedtocontrols = "yes";
}
if ($positioninarray == "Moderator") {
$allowedtocontrols = "yes";
}

if ($passinarray != $passwrd || $allowedtocontrols != "yes") {
setcookie("username", "");
setcookie("password", "");
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Webmaster Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect,<BR>or you are not authorized to access the Webmaster Controls.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"webmastercontrols.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\"><BR>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\">
<BR><BR><INPUT CLASS=\"Button\" TYPE=\"submit\" value=\"Log In\">
</FORM>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");
}
?>
<?php
if ($passinarray == $passwrd && $positioninarray == "Administrator" || "Moderator") {

print ("
<html>
<head>
<title>Webmaster Controls</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
</head>
");

$filetoopen = "specs.php";

//CliqueOrNot option script
if ($cliqueornot) {
$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

if (!$sendnotice) {
$sendnotice = "no";
}

$specifics[19]="\$send=\"$sendmod\";\n";
$specifics[20]="\$notifyadmin=\"$sendnotice\";\n";

$Open2 = fopen ($filetoopen, "w+");
if ($Open2) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open2, "$specifics[$i]");
}
}
fclose ($Open2);
}
//End of CliqueOrNot option script

//Forum Options
if ($forumoptions) {
$Open = fopen ($filetoopen,"r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

if($usefaces != "yes") {
$usefaces = "no";
}

$specifics[29]="\$newattop=\"$newattopmod\";\n";
$specifics[30]="\$usefaces=\"$usefacesmod\";\n";

if ($fullnamedis != "yes") {
$fullnamedis = "no";
}
if ($usernamedis != "yes") {
$usernamedis = "no";
}
if ($positiondis != "yes") {
$positiondis = "no";
}
if ($datedis != "yes") {
$datedis = "no";
}
if ($postnumdis != "yes") {
$postnumdis = "no";
}
if ($allowedit != "yes") {
$allowedit = "no";
}
$specifics[31]="\$showpostuser=\"$usernamedis\";\n";
$specifics[32]="\$showpostfullname=\"$fullnamedis\";\n";
$specifics[33]="\$showpostposition=\"$positiondis\";\n";
$specifics[34]="\$showpostdate=\"$datedis\";\n";
$specifics[35]="\$showpostnum=\"$postnumdis\";\n";
$specifics[36]="\$allowedit=\"$alloweditmod\";\n";

$Open2 = fopen ($filetoopen, "w+");
if ($Open2) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open2, "$specifics[$i]");
}
}
fclose ($Open2);
}
//End of Forum Options

//Topic Listing Options
if ($topicinfodisplay) {

if ($showcategory != "yes") {
$showcategory = "no";
}

if ($showlastpost != "yes") {
$showlastpost = "no";
}

if ($showlastposton != "yes") {
$showlastposton = "no";
}

if ($showpostsperhour != "yes") {
$showpostsperhour = "no";
}

if ($shownumposts != "yes") {
$shownumposts = "no";
}

if ($showcreatedon != "yes") {
$showcreatedon = "no";
}

if ($showcreatedby != "yes") {
$showcreatedby = "no";
}

$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

$specifics[42]="\$showtopcategory=\"$showcategory\";\n";
$specifics[43]="\$showtoplastpost=\"$showlastpost\";\n";
$specifics[44]="\$showtopcreatedon=\"$showcreatedon\";\n";
$specifics[45]="\$showtopcreatedby=\"$showcreatedby\";\n";
$specifics[46]="\$showtopnumposts=\"$shownumposts\";\n";
$specifics[47]="\$showtoppostshour=\"$showpostsperhour\";\n";
$specifics[48]="\$showtoplaston=\"$showlastposton\";\n";

$Open = fopen ($filetoopen, "w+");
if ($Open) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open, "$specifics[$i]");
}
}
fclose ($Open);
}
//End of Topic Listing Options

//User Promote

if ($UserPromoted) {

$Open2 = fopen("users/users.php", "r");
$userslist = file("users/users.php");
fclose($Open2);

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"$UserPromoted\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Position\"=>\"Member\"", "\"Position\"=>\"Moderator\"", $userslist[$i]);
}
}

$Open = fopen("users/users.php", "w+");
foreach ($userslist as $line) {
fwrite ($Open, "$line");
}

print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?userprodem=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Member Promoted</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>$UserPromoted has been promoted to Moderator.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");

}

//End of User Promote

//User Demote

if ($UserDemoted) {

$Open2 = fopen("users/users.php", "r");
$userslist = file("users/users.php");
fclose($Open2);

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"$UserDemoted\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Position\"=>\"Moderator\"", "\"Position\"=>\"Member\"", $userslist[$i]);
}
}

$Open = fopen("users/users.php", "w+");
foreach ($userslist as $line) {
fwrite ($Open, "$line");
}

print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?userprodem=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Member Demoted</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>$UserDemoted has been demoted to Member status.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");

}

//End of User Demote

//User Ban

if ($UserBanned) {

$Open2 = fopen("users/users.php", "r");
$userslist = file("users/users.php");
fclose($Open2);

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"$UserBanned\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Position\"=>\"Member\"", "\"Position\"=>\"Banned\"", $userslist[$i]);
$userslist[$i] = ereg_replace("\"Position\"=>\"Moderator\"", "\"Position\"=>\"Banned\"", $userslist[$i]);
$userslist[$i] = ereg_replace("\"Position\"=>\"Suspended\"", "\"Position\"=>\"Banned\"", $userslist[$i]);
}
}

$Open = fopen("users/users.php", "w+");
foreach ($userslist as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?userprodem=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>User Banned</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><i>$UserBanned</i> has been banned.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");
}

//End of User Ban

//User Unban

if ($UserUnbanned) {
$Open2 = fopen("users/users.php", "r");
$userslist = file("users/users.php");
fclose($Open2);

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"$UserUnbanned\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Position\"=>\"Banned\"", "\"Position\"=>\"Member\"", $userslist[$i]);
}
}

$Open = fopen("users/users.php", "w+");
foreach ($userslist as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?userprodem=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>User Unbanned</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><i>$UserUnbanned</i> has been unbanned
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");

}

//End of User Unban

//User Suspend

if ($UserSuspend) {
$Open2 = fopen("users/users.php", "r");
$userslist = file("users/users.php");
fclose($Open2);

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"$UserSuspended\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Position\"=>\"Member\"", "\"Position\"=>\"Suspended\"", $userslist[$i]);
$userslist[$i] = ereg_replace("\"Position\"=>\"Moderator\"", "\"Position\"=>\"Suspended\"", $userslist[$i]);
}
}

$Open = fopen("users/users.php", "w+");
foreach ($userslist as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?userprodem=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>User Suspended</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><i>$UserSuspended</i> has been suspended.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");

}

//End of User Suspend

//User Unsuspend

if ($UserUnsuspend) {
$Open2 = fopen("users/users.php", "r");
$userslist = file("users/users.php");
fclose($Open2);

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"$UserUnsuspended\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Position\"=>\"Suspended\"", "\"Position\"=>\"Member\"", $userslist[$i]);
}
}

$Open = fopen("users/users.php", "w+");
foreach ($userslist as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?userprodem=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>User Unsuspended</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><i>$UserUnsuspended</i> has been unsuspended.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit("");

}

//End of User Unsuspend

//Intro Message

if ($introsubmitted) {

$newline = "\n";
$theintro = ereg_replace($newline, "<BR>", $theintro);
$theintro = ereg_replace("\\\r", "", $theintro);
$theintro = ereg_replace('\$', "\\\$", $theintro);
$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

$specifics[50]="\$intromessage=\"$theintro\";\n";

$Open = fopen ($filetoopen, "w+");
if ($Open) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open, "$specifics[$i]");
}
}
fclose ($Open);

}

//End of Intro Message

//Allow Visitors to View Forum

if ($visitorinfosubmitted) {

if ($av_option != "yes") {
$av_option = "no";
}

$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

$specifics[52]="\$allowvisitors=\"$av_option\";\n";

$Open = fopen ($filetoopen, "w+");
if ($Open) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open, "$specifics[$i]");
}
}
fclose ($Open);

}

//End of Allow Visitors to View Forum

//Display Full Name

if ($df_submitted) {

if ($display_fullname != "yes") {
$display_fullname = "no";
}

$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

$specifics[56]="\$fullnamedisplay=\"$display_fullname\";\n";

$Open = fopen ($filetoopen, "w+");
if ($Open) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open, "$specifics[$i]");
}
}
fclose ($Open);

}

//End of Display Full Name

//Arrange Divisions

if ($arrangediv) {

$divtoarrange = ereg_replace("( )", "_", $arrangediv);

$Open = fopen ("divisionarray.php", "r");
$thedivisions = file("divisionarray.php");
fclose($Open);

for ($i=0; $i < count($thedivisions); $i++) {
if (ereg("\\\$$divtoarrange ", $thedivisions[$i])) {

$one = $thedivisions[$i];

$thedivisions[$i] = "";


$Open = fopen("divisionarray.php", "w+");
foreach ($thedivisions as $value) {
fwrite ($Open, "$value");
}
fwrite ($Open, "$one");
fclose($Open);
}
}

exit("");
}

//End of Arrange Divisions

require ("specs.php");

if ($multiplethemes == "yes") {
require "themes.php";
}

print ("<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">\n");
print ("<div align=\"center\">$menu");
print ("<table width=618 border=1 cellspacing=2 cellpadding=3 height=421 bordercolor=\"$bgcolor\">\n");
print ("<tr bordercolor=\"$tablebordercolor\">\n"); 
print ("<td height=23 bgcolor=\"$tablecolor\">\n");
print ("<div align=\"center\"><b>Webmaster Controls</b></div>\n");
print ("</td>\n");
print ("</tr>\n");
print ("<tr bordercolor=\"$tablebordercolor\" valign=\"top\">\n");
print ("<td height=393 bgcolor=\"$tablecolor\">\n");
if ($colorscheme_submitted) {
print ("<B><DIV ALIGN=CENTER>--Website color scheme has been modified.</DIV></B><BR>");
}
if ($cliqueornot) {
print ("<B><DIV ALIGN=CENTER>--User Sign-Up Method has been modified.</DIV></B><BR>");
}
if ($forumoptions) {
print ("<B><DIV ALIGN=CENTER>--Forum Options have been modified.</DIV></B><BR>");
}
if ($topicinfodisplay) {
print ("<B><DIV ALIGN=CENTER>--Topic Info Display Options have been modified.</DIV></B><BR>");
}

print ("<div align=\"center\"><BR><BR>");

print ("<A HREF=\"themecontrols.php\"><B>Theme Controls</B></A>\n");

if (!$forumoptions_check && $positioninarray == "Administrator") {
print ("<BR><BR><A HREF=\"webmastercontrols.php?forumoptions_check=1\"><B>Topic Page Options</B></A>\n");
}
if ($newattop == "yes") {
$yep = "checked";
$nope = "";
}
if ($newattop == "no") {
$nope = "checked";
$yep = "";
}
if ($usefaces == "yes") {
$faces = "checked";
}
else {
$faces = "";
}
$fn = "CHECKED";
$un = "CHECKED";
$dt = "CHECKED";
$pt = "CHECKED";
$pn = "CHECKED";
$ae = "CHECKED";
if ($showpostfullname != "yes") {
$fn = "";
}
if ($showpostuser != "yes") {
$un = "";
}
if ($showpostposition != "yes") {
$pt = "";
}
if ($showpostdate != "yes") {
$dt = "";
}
if ($showpostnum != "yes") {
$pn = "";
}
if ($showpostnum != "yes") {
$pn = "";
}
if ($allowedit != "yes") {
$ae = "";
}
if ($forumoptions_check) {
print ("<BR><BR><A HREF=\"webmastercontrols.php\"><B>Topic Page Options</B></A>\n");
print ("<BR><BR><B>----Topic Page Options----</B>\n");
print ("<FORM NAME=\"ForumOptions\" action=\"webmastercontrols.php?username=$username&password=$password&submitform=1\"><FONT SIZE=\"2\"><B>Chronological Listing of Posts:</B><BR>
<INPUT TYPE=\"radio\" name=\"newattopmod\" value=\"yes\" $yep> Place Newest Posts at the Top<BR>
<INPUT TYPE=\"radio\" name=\"newattopmod\" value=\"no\" $nope> Place Newest Posts at the Bottom<BR>\n");
print ("<BR><INPUT TYPE=\"checkbox\" name=\"usefacesmod\" value=\"yes\" $faces> <B>Replace Text Smileys with Cartoon Smileys</B>");
print ("<BR><BR><B>Info Display for Each Post:</B><BR><i>For best display, do not chose more than 3 or 4 types of post info.</i><BR><BR>");
print ("<INPUT TYPE=\"checkbox\" name=\"fullnamedis\" value=\"yes\" $fn> Full Name 
<INPUT TYPE=\"checkbox\" name=\"usernamedis\" value=\"yes\" $un> Username 
<INPUT TYPE=\"checkbox\" name=\"positiondis\" value=\"yes\" $pt> User's Position 
<INPUT TYPE=\"checkbox\" name=\"datedis\" value=\"yes\" $dt> Date of Post
<INPUT TYPE=\"checkbox\" name=\"postnumdis\" value=\"yes\" $pn> Post Number
");
print("<BR><BR><INPUT TYPE=\"checkbox\" name=\"alloweditmod\" value=\"yes\" $ae> <B>Allow Users to Edit Their Own Posts</B>");
print ("<INPUT TYPE=\"hidden\" name=\"forumoptions\" value=\"1\">");
print ("<BR><BR><INPUT CLASS=\"Button\" TYPE=\"submit\" value=\"Modify\"></FONT></FORM>\n");
}
if (!$divisionoptions_check) {
print ("<BR><BR><A HREF=\"webmastercontrols.php?divisionoptions_check=1\"><B>Create/Modify Divisions</B></A>\n");
}
if ($divisionoptions_check) {
print ("<BR><BR><A HREF=\"webmastercontrols.php\"><B>Create/Modify Divisions</B></A>\n");
print ("<BR><BR><B>----Create/Modify Divisions----</B>\n");
print ("
<BR><BR><FORM ACTION=\"create.php\">
<B><i>Create New Division:</i></B><BR><BR>
<FONT SIZE=2><B>Name:</B><INPUT TYPE=\"text\" name=\"newdivision\"><BR><input name=\"requirelogin\" type=\"checkbox\" value=\"yes\"> <B>Permit Visitor Viewing</B>
<BR><BR><B>Brief Description:</B><BR><INPUT TYPE=\"text\" NAME=\"divdescription\" size=\"40\">
<INPUT TYPE=\"hidden\" NAME=\"moddivisions\" VALUE=\"1\">
</FONT><BR><INPUT CLASS=\"Button\" TYPE=\"submit\" Value=\"Create\"></FORM>
<FORM ACTION=\"create.php\">
<B><i>Delete Division:</i><B> <SELECT NAME=\"deldivision\">");

require "divisionarray.php";

for ($i=0; $i < count($divisions); $i++) {

$stupidslash = "\\\'";
$stupidslash2 = '\\\"';
$moddivname2 = ereg_replace($stupidslash2, '"', $divisions[$i][1]);
$moddivname2 = ereg_replace($stupidslash, "'", $moddivname2);

$moddivname1 = ereg_replace("[[:punct:]]", "", $divisions[$i][1]);

print ("<OPTION VALUE=\"$moddivname1\"> $moddivname2");
}

print ("</SELECT> <INPUT CLASS=\"Button\" TYPE=\"submit\" Value=\"Delete\">
<INPUT TYPE=\"hidden\" NAME=\"moddivisions\" VALUE=\"1\">
</FORM>
<FORM ACTION=\"create.php\"><FONT SIZE=\"2\">
<B><FONT SIZE=\"3\"><i>Rename Division:</i></FONT><B><BR><BR>
<B>Present Name:</B> <SELECT NAME=\"oldnamedivision\">");

for ($i=0; $i < count($divisions); $i++) {

$stupidslash = "\\\'";
$stupidslash2 = '\\\"';
$moddivname2 = ereg_replace($stupidslash2, '"', $divisions[$i][1]);
$moddivname2 = ereg_replace($stupidslash, "'", $moddivname2);

$moddivname1 = ereg_replace("[[:punct:]]", "", $divisions[$i][1]);

print ("<OPTION VALUE=\"$moddivname1\"> $moddivname2");
}

print ("</SELECT><BR><BR>
<B>New Name:<B> <INPUT TYPE=\"text\" name=\"renamedivision\"><BR>
<INPUT CLASS=\"Button\" TYPE=\"submit\" Value=\"Rename\">
<INPUT TYPE=\"hidden\" NAME=\"moddivisions\" VALUE=\"1\">
</FONT></FORM>
");

print ("
<BR><FORM ACTION=\"webmastercontrols.php\" METHOD=\"POST\">
<B>Arrange Divisions:</B> <SELECT NAME=\"arrangediv\">
");

for ($i=0; $i < count($divisions); $i++) {

$stupidslash = "\\\'";
$stupidslash2 = '\\\"';
$moddivname2 = ereg_replace($stupidslash2, '"', $divisions[$i][1]);
$moddivname2 = ereg_replace($stupidslash, "'", $moddivname2);

$moddivname1 = ereg_replace("[[:punct:]]", "", $divisions[$i][1]);

print ("<OPTION VALUE=\"$moddivname1\"> $moddivname2");
}

print ("
</SELECT> <INPUT CLASS=\"button\" TYPE=\"Submit\" VALUE=\"Send to Bottom\">
</FORM><BR>
");
}
if (!$forumlistingoptions_check && $positioninarray == "Administrator") {
print ("<BR><BR><A HREF=\"webmastercontrols.php?forumlistingoptions_check=1\"><B>Topic Listing Options</B></A>\n");
}
if ($forumlistingoptions_check) {
print ("<BR><BR><A HREF=\"webmastercontrols.php\"><B>Topic Listing Options</B></A>\n");
print ("<BR><BR><B>----Topic Listing Options----</B>\n");

$tc = "CHECKED";
$lp = "CHECKED";
$lo = "CHECKED";
$plh = "CHECKED";
$np = "CHECKED";
$co = "CHECKED";
$cb = "CHECKED";

if ($showtopcategory == "no") {
$tc = "";
}
if ($showtoplastpost == "no") {
$lp = "";
}
if ($showtoplaston == "no") {
$lo = "";
}
if ($showtoppostshour == "no") {
$plh = "";
}
if ($showtopnumposts == "no") {
$np = "";
}
if ($showtopcreatedon == "no") {
$co = "";
}
if ($showtopcreatedby == "no") {
$cb = "";
}

print ("
<BR><BR>
<FORM ACTION=\"webmastercontrols.php\">
<B><I>Topic Info Display Options:</B></I><BR><BR><FONT SIZE=\"2\">
<INPUT TYPE=\"checkbox\" name=\"showcategory\" value=\"yes\" $tc> Topic Category
<BR><INPUT TYPE=\"checkbox\" name=\"showlastpost\" value=\"yes\" $lp> Last Post by:
<BR><INPUT TYPE=\"checkbox\" name=\"showlastposton\" value=\"yes\" $lo> Last Post on:
<BR><INPUT TYPE=\"checkbox\" name=\"showpostsperhour\" value=\"yes\" $plh> Posts in Last Hour:
<BR><INPUT TYPE=\"checkbox\" name=\"shownumposts\" value=\"yes\" $np> Posts: (# of Posts)
<BR><INPUT TYPE=\"checkbox\" name=\"showcreatedon\" value=\"yes\" $co> Created on:
<BR><INPUT TYPE=\"checkbox\" name=\"showcreatedby\" value=\"yes\" $cb> Created by: 
<INPUT TYPE=\"hidden\" name=\"topicinfodisplay\" value=\"1\">
<BR><BR><INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Modify\">
</FONT>
</FORM>
");
}

if (!$cliqueornot_check && $positioninarray == "Administrator") {
print ("<BR><BR><A HREF=\"webmastercontrols.php?cliqueornot_check=1\"><B>User Sign-Up Method</B></A>\n");
}
if ($cliqueornot_check) {
print ("<BR><BR><A HREF=\"webmastercontrols.php\"><B>User Sign-Up Method</B></A>\n");
if ($send == "yes") {
$yep = "CHECKED";
$nope = "";
}
else {
$nope = "CHECKED";
$yep = "";
}
if ($notifyadmin == "yes") {
$checked = "CHECKED";
}
if ($notifyadmin != "yes") {
$checked = "";
}
print ("<BR><BR><B>----User Sign-Up Method----</B>\n");
print ("<FORM NAME=\"CliqueOrNot\" action=\"webmastercontrols.php\"><FONT SIZE=\"2\"><INPUT TYPE=\"radio\" name=\"sendmod\" value=\"yes\" $yep>\n");
print ("Send Administrator e-mail every time a visitor attempts to signs up,<BR>\n");
print ("giving the administrator the choice of the visitor's acceptance as a user.</FONT><BR>\n");
print ("<INPUT TYPE=\"radio\" name=\"sendmod\" value=\"no\" $nope><FONT SIZE=\"2\">Automatically allow every visitor who signs up<BR>to become a user.</FONT>\n");
print ("<BR><BR><INPUT TYPE=\"checkbox\" name=\"sendnotice\" Value=\"yes\" $checked> <FONT SIZE=\"2\">Notify Administrator everytime a user signs up</FONT>\n");
print ("<INPUT TYPE=\"hidden\" name=\"cliqueornot\" value=1>\n");
print ("<BR><BR><INPUT CLASS=\"Button\" TYPE=\"submit\" value=\"Apply\">\n");
print ("</FORM>\n");
}

if (!$userprodem) {
print ("<BR><BR><A HREF=\"webmastercontrols.php?userprodem=1\"><B>Manage Users</B></A>\n");
}
if ($userprodem) {
print ("<BR><BR><A HREF=\"webmastercontrols.php\"><B>Mangage Users</B></A>\n");
print ("<BR><BR><B>----Manage Users----</B>\n");

for ($i=0; $i < count($users); $i++) {
$pro_username = strtolower($users[$i]["Username"]);
$userlist[] = $pro_username;
}

sort($userlist);

print ("<FORM NAME=\"PromoteUser\" ACTION=\"webmastercontrols.php\" Method=\"Post\">");
if ($positioninarray == "Administrator") {
print ("<BR><B><I>Promote:</I></B> <SELECT NAME=\"UserPromoted\">");
for ($i=0; $i < count($userlist); $i++) {

$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", $dirname);
$dirname = strtolower("u0000$dirname");
$user_fullname = ${$dirname}["Full_Name"];
$user_position = ${$dirname}["Position"];
$user_name = ${$dirname}["Username"];
$user_alias = ${$dirname}["Alias"];

if ($user_position == "Member") {
print ("<OPTION VALUE=\"$user_name\"> $user_alias");
}
}
print ("</SELECT> <INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Promote\">");
print ("</FORM>");
}
//
if ($positioninarray == "Administrator") {
print ("<FORM NAME=\"DemoteUser\" ACTION=\"webmastercontrols.php\" Method=\"Post\">");
print ("<B><I>Demote:</I></B> <SELECT NAME=\"UserDemoted\">");
for ($i=0; $i < count($userlist); $i++) {

$user_name = $userlist[$i];
$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", $dirname);
$dirname = strtolower("u0000$dirname");
$user_fullname = ${$dirname}["Full_Name"];
$user_position = ${$dirname}["Position"];
$user_name = ${$dirname}["Username"];
$user_alias = ${$dirname}["Alias"];

if ($user_position == "Moderator") {
print ("<OPTION VALUE=\"$user_name\"> $user_alias");
}
}
print ("</SELECT> <INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Demote\">");
print ("</FORM>");
}
//
if ($positioninarray == "Administrator") {
print ("<FORM NAME=\"BanUser\" ACTION=\"webmastercontrols.php\" METHOD=\"Post\">");
print ("<B><I>Ban:</I></B> <SELECT NAME=\"UserBanned\">");
for ($i=0; $i < count($userlist); $i++) {

$user_name = $userlist[$i];
$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", $dirname);
$dirname = strtolower("u0000$dirname");
$user_fullname = ${$dirname}["Full_Name"];
$user_position = ${$dirname}["Position"];
$user_name = ${$dirname}["Username"];
$user_alias = ${$dirname}["Alias"];

if ($user_position != "Administrator" && $user_position != "Banned") {
print ("<OPTION VALUE=\"$user_name\"> $user_alias");
}
}
print ("</SELECT> <INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Ban\">");
print ("</FORM>");
}

if ($positioninarray == "Administrator") {
print ("<FORM NAME=\"UnbanUser\" ACTION=\"webmastercontrols.php\" METHOD=\"Post\">");
print ("<B><I>Unban:</I></B> <SELECT NAME=\"UserUnbanned\">");
for ($i=0; $i < count($userlist); $i++) {

$user_name = $userlist[$i];
$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", $dirname);
$dirname = strtolower("u0000$dirname");
$user_fullname = ${$dirname}["Full_Name"];
$user_position = ${$dirname}["Position"];
$user_name = ${$dirname}["Username"];
$user_alias = ${$dirname}["Alias"];

if ($user_position == "Banned") {
print ("<OPTION VALUE=\"$user_name\"> $user_alias");
}
}
print ("</SELECT> <INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Unban\">");
print ("</FORM>");
}

print ("<FORM Method=\"Post\" ACTION=\"webmastercontrols.php\">");
print ("<B><I>Suspend:</I></B> <SELECT NAME=\"UserSuspended\">");
for ($i=0; $i < count($userlist); $i++) {

$user_name = $userlist[$i];
$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", $dirname);
$dirname = strtolower("u0000$dirname");
$user_fullname = ${$dirname}["Full_Name"];
$user_position = ${$dirname}["Position"];
$user_name = ${$dirname}["Username"];
$user_alias = ${$dirname}["Alias"];

if ($user_position != "Administrator" && $user_position != "Suspended") {
print ("<OPTION VALUE=\"$user_name\"> $user_alias");
}
}
print ("</SELECT> <INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Suspend\">");
print ("<INPUT TYPE=\"hidden\" NAME=\"UserSuspend\" VALUE=\"1\">");
print ("</FORM>");

print ("<FORM Method=\"Post\" ACTION=\"webmastercontrols.php\">");
print ("<B><I>Unsuspend:</I></B> <SELECT NAME=\"UserUnsuspended\">");
for ($i=0; $i < count($userlist); $i++) {

$user_name = $userlist[$i];
$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", $dirname);
$dirname = strtolower("u0000$dirname");
$user_fullname = ${$dirname}["Full_Name"];
$user_position = ${$dirname}["Position"];
$user_name = ${$dirname}["Username"];
$user_alias = ${$dirname}["Alias"];

if ($user_position == "Suspended") {
print ("<OPTION VALUE=\"$user_name\"> $user_alias");
}
}
print ("</SELECT> <INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Unsuspend\">");
print ("<INPUT TYPE=\"hidden\" NAME=\"UserUnsuspend\" VALUE=\"1\">");
print ("</FORM>");
}

if ($positioninarray == "Administrator") {

if (!$intromessagedis) {
print ("<BR><BR><A HREF=\"webmastercontrols.php?intromessagedis=1\"><B>Forum General Info</B></A>\n");
}
if ($intromessagedis) {

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$intromessage = ereg_replace($stupidslash, "'", $intromessage);
$intromessage = ereg_replace($stupidslash2, "'", $intromessage);

$intromessage = ereg_replace("<BR>", "\n", $intromessage);

print ("<BR><BR><A HREF=\"webmastercontrols.php\"><B>Forum General Info</B></A>\n");
print ("<BR><BR><B>----Forum General Info----</B>\n");
print ("
<BR><BR><FORM ACTION=\"webmastercontrols.php\" METHOD=\"Post\">
<B><FONT SIZE=2>Intro Message:</FONT></B><BR>
<TEXTAREA NAME=\"theintro\" ROWS=\"10\" COLS=\"60\">$intromessage</TEXTAREA>
<INPUT TYPE=\"hidden\" NAME=\"introsubmitted\" VALUE=\"1\">
<BR><BR><INPUT TYPE=\"submit\" CLASS=\"button\" VALUE=\"Update\">
</FORM>
");

if ($allowvisitors == "yes") {
$av_checked = "CHECKED";
}
else {
$av_checked = "";
}
print ("
<BR><FORM ACTION=\"webmastercontrols.php\" METHOD=\"Post\">
<INPUT TYPE=\"checkbox\" NAME=\"av_option\" VALUE=\"yes\" $av_checked><B><FONT SIZE=2>Allow Visitors to View Forum</FONT></B><BR>
<INPUT TYPE=\"hidden\" NAME=\"visitorinfosubmitted\" VALUE=\"1\">
<BR><INPUT TYPE=\"submit\" CLASS=\"button\" VALUE=\"Apply\">
</FORM>
");

if ($fullnamedisplay == "yes") {
$df_checked = "CHECKED";
}
else {
$df_checked = "";
}

print ("
<BR><FORM ACTION=\"webmastercontrols.php\" METHOD=\"Post\">
<INPUT TYPE=\"checkbox\" NAME=\"display_fullname\" VALUE=\"yes\" $df_checked><B><FONT SIZE=2>Display Full Name for Member Viewing</FONT></B><BR>
<INPUT TYPE=\"hidden\" NAME=\"df_submitted\" VALUE=\"1\">
<BR><INPUT TYPE=\"submit\" CLASS=\"button\" VALUE=\"Apply\">
</FORM>
");
}
}

print ("
      <BR><BR>
      </div>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
");
}
?>