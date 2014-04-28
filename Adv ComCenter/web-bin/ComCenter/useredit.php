<?php

require "../../specs.php";
require "../../users/users.php";

if ($multiplethemes == "yes") {
require "../../themes.php";
}

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

$twoup = 1;
require "../../menuinsert.php";

$usrname = ereg_replace("( )", "_", "u0000$username");
$usrname = strtolower($usrname);

$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$aliasinarray = ${$usrname}["Alias"];
$positioninarray = ${$usrname}["Position"];
$emailinarray = ${$usrname}["Email"];

//Change Alias

if ($newalias) {

$nobad = "([^[:alnum:][:space:]])";
if (eregi($nobad, $newalias)) {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Incorrect Form</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Only letters, numbers, and spaces can be used in your alias
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

$newal= ereg_replace("( )", "_", $newalias);
$newal = strtolower($newal);
$newal = "u0000$newal";

for ($i=0; $i < count($users); $i++) {

if ($users[$i]["Username"] == $newalias) {
if ($users[$i]["Alias"] == $newalias && $users[$i]["Username"] != $userinarray) {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Alias Taken</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">The alias you have chosen is already taken
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
}
}

//Change Alias in users.php

$Open = fopen("../users.php", "r");
$userslist = file("../users.php");
fclose($Open);

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"$userinarray\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Alias\"=>\"$aliasinarray\"", "\"Alias\"=>\"$newalias\"", $userslist[$i]);
}
}

$Open = fopen("../users.php", "w+");
foreach ($userslist as $value) {
fwrite($Open, "$value");
}
fclose($Open);

//End of Change Alias in users.php

//Change Alias in userspecs.php

$Open = fopen("userspecs.php", "r");
$userspecs = file("userspecs.php");
fclose($Open);

$Open = fopen("userspecs.php", "w+");
foreach ($userspecs as $value) {
fwrite($Open, "$value");
}
fwrite($Open, "\n<?PHP \$pastaliases[] = \"$aliasinarray\"; ?>");
fclose($Open);

header("Location: useredit.php?profile=1");

//End of Change Alias in userspecs.php

}

//End of Change Username

require "userspecs.php";

//Change Password

if ($newpass) {

$nobad = "([^[:alnum:][:space:]])";
if (eregi($nobad, $newpass)) {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Incomplete Form</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Only letters, numbers, and spaces can be used in your password
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

$newpassword = md5(crypt($newpass, $userinarray));

$oldpassword = md5(crypt($password, $userinarray));

$Open = fopen("../users.php", "r");
$usersfile = file("../users.php");
fclose($Open);

for ($i=0; $i < count($usersfile); $i++) {
if (ereg("\\\$$usrname =", $usersfile[$i])) {
$usersfile[$i] = ereg_replace("\"Password\"=>\"$oldpassword\"", "\"Password\"=>\"$newpassword\"", $usersfile[$i]);
}
}

$Open = fopen("../users.php", "w+");
foreach ($usersfile as $value) {
fwrite ($Open, "$value");
}
fclose($Open);

header("Location: ../../log.php?logout=1");

$profile = 1;

}

//End of Change Password


//Message Delete

if ($delete) {

if (!$sent) {
header("Location: useredit.php?center=1");
}
if ($sent) {
header("Location: useredit.php?center=1&sent=1");
}

require "mailbag.php";

if (!$sent) {
if ($messages) {
$messages_d = array_reverse($messages);
}
}

if ($sent) {
if ($sentmessages) {
$messages_d = array_reverse($sentmessages);
}
}

$Open = fopen ("mailbag.php", "r");
$mailbag = file("mailbag.php");
fclose($Open);

for ($j=0; $j < count($msgdates); $j++) {
$msgdate = $msgdates[$j];

for($i=0; $i < count($mailbag); $i++) {
if (!$sent) {
if (ereg("\"$msgdate\"", $mailbag[$i])) {
if (ereg("\\\$messages\[\]", $mailbag[$i])) {
$mailbag[$i] = "";
}
}
}
if ($sent) {
if (ereg("\"$msgdate\"", $mailbag[$i])) {
if (ereg("\\\$sentmessages\[\]", $mailbag[$i])) {
$mailbag[$i] = "";
}
}
}
}

}

$Open = fopen ("mailbag.php", "w+");
foreach ($mailbag as $value) {
fwrite ($Open, "$value");
}
fclose($Open);
exit("");
}

//End of Message Delete

//Message Editor

if ($editedmessage && $positioninarray != "Suspended") {

$userdir = ereg_replace("( )", "_", "u0000$Possessor");
$userdir = strtolower("$userdir");
$Open = fopen("../$userdir/mailbag.php", "r");
$hismailbag = file("../$userdir/mailbag.php");
fclose($Open);

if ($deletemsg) {
for ($i=0; $i < count($hismailbag); $i++) {
if (ereg("\"$SentDate\",", $hismailbag[$i]) && ereg("\"u_n_read\"", $hismailbag[$i])) {
$hismailbag[$i] = "";
}
}
}

$editedmessage = ereg_replace("\\\n", "<BR>", $editedmessage);
$editedmessage = ereg_replace("\\\r", "<BR>", $editedmessage);

for ($i=0; $i < count($hismailbag); $i++) {
if (ereg("\"$SentDate\",", $hismailbag[$i]) && ereg("\"u_n_read\"", $hismailbag[$i])) {
$hismailbag[$i] = "<?PHP \$messages[] = array (\"$SentSubject\", \"$userinarray\", \"$SentDate\", \"$editedmessage\", \"u_n_read\");?>\n";
}
}

$Open = fopen("../$userdir/mailbag.php", "w+");
foreach ($hismailbag as $value) {
fwrite($Open, "$value");
}
fclose($Open);

$Open = fopen("mailbag.php", "r");
$mymail = file("mailbag.php");
fclose($Open);

if ($deletemsg) {
for ($i=0; $i < count($mymail); $i++) {
if (ereg("\"$SentDate\",", $mymail[$i])) {
$mymail[$i] = "";
}
}
}

for ($i=0; $i < count($mymail); $i++) {
if (ereg("\"$SentDate\",", $mymail[$i]) && ereg("\"unread\"", $mymail[$i])) {
$mymail[$i] = "<?PHP \$sentmessages[] = array (\"$SentSubject\", \"$Possessor\", \"$SentDate\", \"$editedmessage\", \"unread\");?>\n";
}
}

$Open = fopen("mailbag.php", "w+");
foreach ($mymail as $value) {
fwrite($Open, "$value");
}
fclose($Open);

$center=1;
$sent=1;
}

//End of Message Editor

if (!$privileges) {
$privileges = "On";
}

if ($chosentheme) {

if ($chosentheme != "default") {
setcookie ("$cookiename", "$chosentheme", time()+100000000, "/");
}
if ($chosentheme == "default") {
setcookie ("$cookiename", "", time()+100000000, "/");
}

header("Location: useredit.php?profile=1");
exit("");
}

$userpass = $user[Password];

if ($positioninarray == "Banned") {
$userpass = "if your userpass equals this after being encrypted and all that stuff, then you have more than luck. You have fate on your side.";
}

if ($passinarray != $userpass) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>{$user[Alias]}</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect,<BR>or you are not authorized to access this page.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"useredit.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\"><BR>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\">
<INPUT TYPE=\"hidden\" NAME=\"profile\" Value=\"1\">
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

if ($passinarray == $userpass) {

if ($privileges_s == "Off") {
setcookie("privileges", "", time()-60);
setcookie("privileges", "Off", time()+"10000000", "/");
header("Location: useredit.php?profile=1");
exit("");
}
if ($privileges_s == "On") {
setcookie("privileges", "", time()-60);
setcookie("privileges", "On", time()+"10000000", "/");
header("Location: useredit.php?profile=1");
exit("");
}

$Open = fopen("userspecs.php", "r");
$userspecs = file("userspecs.php");
fclose($Open);

$Open2 = fopen("../users.php", "r");
$userslist = file("../users.php");
fclose($Open2);

//Last Visit Info-Giver

$datecondensed = date ("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour ==13) {
$hour = 1;
}
$datecondensed = date("m/d/y ").$hour.date(":i:sa");
}


for($i=0; $i < count($userspecs); $i++) {
if (ereg("lastvisitdate =", $userspecs[$i])) {
$userspecs[$i] = "\$lastvisitdate = \"$datecondensed\";\n";
}
}

$Open = fopen("userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

//End of Last Visit Info-Giver

//Update Personal Info

if ($linkdeleted) {

$Open = fopen ("mailbag.php", "r");
$mailbag = file("mailbag.php");
fclose($Open);

for($i=0; $i < count($mailbag); $i++) {
if (ereg("\"$cur_time\"", $mailbag[$i])) {
$h = $i-1;
$j = $i+1;
$k = $i+2;
$mailbag[$h] = "";
$mailbag[$i] = "";
$mailbag[$j] = "";
$mailbag[$k] = "";
}
}

$Open = fopen ("mailbag.php", "w+");
foreach ($mailbag as $value) {
fwrite ($Open, "$value");
}
fclose($Open);

header("Location: useredit.php?linkspage=1"); 
exit("");
}

if ($linksubmitted) {

if ($newlinkname == "" || $newlinkurl == "") {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Incomplete Form</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">You have left a text box blank.
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

$current_time = date("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour ==13) {
$hour = 1;
}
$current_time = date("m/d/y ").$hour.date(":i:sa");
}

$newlinkname = ereg_replace('\$', "\\\$", $newlinkname);

$Open = fopen ("mailbag.php", "a");
fwrite ($Open, "<?php\n\$linko = array (\"$newlinkname\", \"$newlinkurl\", \"$current_time\");\n\$links[] = \$linko;\n?>\n");
fclose($Open);

header("Location: useredit.php?linkspage=1"); 
exit("");
}

if ($sentmessage && $positioninarray != "Suspended") {

if ($subject == "" || $composition == "") {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Incomplete Form</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Either your subject or message box was left blank.
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

for($i=0; $i < count($recipients); $i++) {
$recipient = ereg_replace("( )", "_", $recipients[$i]);
$recipient = strtolower("u0000$recipient");

$recipientemail = ${$recipient}["Email"];
$recipientuser = ${$recipient}["Username"];
$recipientalias = ${$recipient}["Alias"];
$recipient_u_e = "\"$recipientalias\" <$recipientemail>";

$sender_u_e = "\"$aliasinarray from $comcentername\" <$emailinarray>";

$current_time = date("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour ==13) {
$hour = 1;
}
$current_time = date("m/d/y ").$hour.date(":i:sa");
}

if ($sendasemail == "yes") {
$asemail = 1;
}

$newline = "\n";
if (!$asemail) {
$composition = ereg_replace($newline, "<BR>", $composition);
}
$composition = ereg_replace("\\\r", "", $composition);


if (!$asemail) {
$subject_ = ereg_replace('\$', "\\\$", $subject);
$compo_ = ereg_replace('\$', "\\\$", $composition);
$Open = fopen ("../$recipient/mailbag.php", "a");
fwrite ($Open, "<?php \$messages[] = array (\"$subject_\", \"$userinarray\", \"$current_time\", \"$compo_\", \"u_n_read\");?>\n");
fclose($Open);
}

$subject_ = ereg_replace('\$', "\\\$", $subject);
$compo_ = ereg_replace('\$', "\\\$", $composition);
$Open = fopen ("../$usrname/mailbag.php", "a");
fwrite ($Open, "<?php \$sentmessages[] = array (\"$subject_\", \"$recipientuser\", \"$current_time\", \"$compo_\", \"unread\");?>\n");
fclose($Open);

if ($asemail) {

$stupidslash = '\\\"';
$stupidslash2 = "\\\'";
$subject = ereg_replace($stupidslash, '"', $subject);
$subject = ereg_replace($stupidslash2, "'", $subject);

$stupidslash = '\\\"';
$stupidslash2 = "\\\'";
$composition = ereg_replace($stupidslash, '"', $composition);
$composition = ereg_replace($stupidslash2, "'", $composition);

$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text; charset=iso-8859-1\r\n";
$header .= "From: $sender_u_e\r\n";
mail($recipient_u_e, "$subject", $composition, $header);
}
}


header("Location: useredit.php?center=1"); 
exit("");
}

if ($permessagesubmitted) {

$newpermessage = ereg_replace("\\\n", "<BR>", $newpermessage);
$newpermessage = ereg_replace("\\\r", "", $newpermessage);
$newpermessage = ereg_replace('\$', "\\\$", $newpermessage);

$userspecs[2] = "\$paragraph = \"$newpermessage\";\n";
$Open = fopen("userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

header("Location: useredit.php?profile=1");
exit("");
}

if ($emailupdatesubmitted) {

$nobad_email = "^([0-9a-z]+)([0-9a-z\.-_]+)@([ 0-9a-z\.-_]+)\.([0-9a-z]+)";

if (eregi($nobad_email, $email) == 0) {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>E-mail Invalid</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, but the e-mail address you entered is invalid.</FONT>
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

for($i=0; $i < count($userslist); $i++) {
if (ereg("\"Username\"=>\"{$user[Username]}\"", $userslist[$i])) {
$userslist[$i] = ereg_replace("\"Email\"=>\"{$user[Email]}\"", "\"Email\"=>\"$email\"", $userslist[$i]);
}
}

if ($user["Position"] == "Administrator") {
$filetoopen = "../../specs.php";
$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

$specifics[23]="\$admin_email=\"$email\";\n";

$Open2 = fopen ($filetoopen, "w+");
if ($Open2) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open2, "$specifics[$i]");
}
}
fclose ($Open2);
}

$Open = fopen("../users.php", "w+");
foreach ($userslist as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

header("Location: useredit.php?profile=1");
exit("");
}

//End Update Personal Info

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$paragraph = ereg_replace($stupidslash, '"', $paragraph);
$paragraph = ereg_replace($stupidslash2, "'", $paragraph);

print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
");
if ($center) {
print ("
<FORM NAME=\"DeleteMail\" ACTION=\"useredit.php\" METHOD=\"POST\">
<INPUT TYPE=\"Hidden\" NAME=\"delete\" VALUE=\"1\">
");
if ($sent) {
print ("<INPUT TYPE=\"Hidden\" NAME=\"sent\" VALUE=\"1\">");
}
}
print ("
  <table width=\"618\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\" COLSPAN=\"4\">
        <div align=\"center\"><b>{$user[Alias]}</b></div>
      </td>
    </tr>
<TR bordercolor=\"$secondarytablecolor\">
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"155\"><DIV ALIGN=\"Center\"><A HREF=\"useredit.php?profile=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Profile</B></FONT></A></DIV></TD>
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"154\"><DIV ALIGN=\"Center\"><A HREF=\"useredit.php?stats=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Stats</B></FONT></A></DIV></TD>
");

$Open = fopen ("mailbag.php", "r");
$mailbag = file("mailbag.php");
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
if ($msgnonedis) {
print ("
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"154\"><DIV ALIGN=\"Center\"><A HREF=\"useredit.php?center=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Message Center ($newmsgs)</B></FONT></A></DIV></TD>
");
}
if (!$msgnonedis) {
print ("
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"154\"><DIV ALIGN=\"Center\"><A HREF=\"useredit.php?center=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Message Center</B></FONT></A></DIV></TD>
");
}
print ("
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"155\"><DIV ALIGN=\"Center\"><A HREF=\"useredit.php?linkspage=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Favorite Links</B></FONT></A></DIV></TD>
</TR>
");
if ($profile) {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\" colspan=\"2\">
<BR><FONT SIZE=4>Message from {$user[Alias]}-</FONT>
<BR>
<FORM ACTION=\"useredit.php\" METHOD=\"Post\">
<DIV ALIGN=\"Center\">
");

$newline = "\n";
$paragraph = ereg_replace("<BR>", $newline, $paragraph);

print ("
<TEXTAREA cols=30 rows=8 NAME=\"newpermessage\">
$paragraph
</TEXTAREA>
<BR><INPUT CLASS=\"Button\" TYPE=\"submit\" Value=\"Modify\">
<INPUT TYPE=\"hidden\" NAME=\"permessagesubmitted\" VALUE=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"profile\" VALUE=\"1\">
</DIV>
<BR><BR><BR><B>Previous Aliases:</B><BR>
");
if ($pastaliases) {
foreach ($pastaliases as $value) {
print ("<i>$value</i><BR>");
}
}
else {
print("<i>None</i>");
}
print("
</FORM>
</td>
<td bgcolor=\"$tablecolor\" colspan=\"2\">
<BR>
<FONT SIZE=4>Profile-</FONT><BR><BR>
<FORM ACTION=\"useredit.php\" METHOD=\"Post\">
");
if ($emailupdatesubmitted) {
print ("<B>--E-mail has been updated<BR><BR>");
}
print ("
<B>Full Name:</B> {$user[Full_Name]}<BR><BR>
<B>E-mail:</B> <INPUT TYPE=\"text\" NAME=\"email\" VALUE=\"{$user[Email]}\">
<INPUT TYPE=\"hidden\" NAME=\"emailupdatesubmitted\" VALUE=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"profile\" VALUE=\"1\">
 <INPUT CLASS=\"Button\" TYPE=\"submit\" VALUE=\"Update\"><BR><BR>
</FORM>
<B>Position:</B> {$user[Position]}
<BR><BR>
<FORM ACTION=\"useredit.php\" METHOD=\"POST\">
<B>Create New Alias:</B><BR>
<INPUT TYPE=\"text\" NAME=\"newalias\" SIZE=\"13\" MAXLENGTH=\"13\">
<INPUT TYPE=\"Submit\" CLASS=\"Button\" VALUE=\"Change\">
</FORM>
<FORM ACTION=\"useredit.php\" METHOD=\"Post\">
<B>Change Password:</B><BR><INPUT TYPE=\"password\" NAME=\"newpass\">
 <INPUT TYPE=\"Submit\" CLASS=\"Button\" VALUE=\"Change\">
 </FORM>
");

if ($multiplethemes == "yes" && $themearray) {
print ("<BR><BR><B><A HREF=\"useredit.php?choosetheme=1\">Choose Your Theme</A></B>");
}

if ($user[Position] == "Moderator") {
print ("
<BR><BR><B>You have Moderator access to:</B><BR>
<A HREF=\"../../webmastercontrols.php\">Webmaster Controls</A>
<BR><BR><B>Moderator Privileges:</B>
");
if ($privileges == "On") {
print (" On <A HREF=\"useredit.php?privileges_s=Off&profile=1\"><B>Off</B></A>");
}
if ($privileges == "Off") {
print (" <A HREF=\"useredit.php?privileges_s=On&profile=1\"><B>On</B></A> Off");
}
}
if ($user[Position] == "Administrator") {
print ("
<BR><BR><B>You have Administrator access to:</B><BR>
<A HREF=\"../../webmastercontrols.php\"><B>Webmaster Controls</B></A>
<BR><BR><B>Admin Mode:</B>
");
if ($privileges == "On") {
print (" On <A HREF=\"useredit.php?privileges_s=Off&profile=1\"><B>Off</B></A>");
}
if ($privileges == "Off") {
print (" <A HREF=\"useredit.php?privileges_s=On&profile=1\"><B>On</B></A> Off");
}
}
print ("<BR><BR>");
print ("
</td>
</tr>
");
}


if ($stats) {
$postlength = round($postlength);
print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<BR>
<FONT SIZE=\"4\">{$user[Alias]}'s Statistics-</FONT><BR><BR>
<B>Signed Up On:</B> $signedupdate<BR><BR>
<B>Last Post On:</B> $lastpostdate<BR><BR>
");
if ($lastvisitdate) {
print ("
<B>Last Visit On:</B> $lastvisitdate<BR><BR>
");
}
print ("
<B>Total Number of Posts:</B> $totalposts<BR><BR>
<B>Total Number of Topics Created:</B> $totaltopics<BR><BR>
<B>Total Number of Polls Created:</B> $totalpolls<BR><BR>
<B>Average Post Length:</B> $postlength Words
</TD>
</TR>
");
}

if ($choosetheme) {

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<BR><B>Choose Your Theme-</B><BR><BR>
");

$comnamecondensed = ereg_replace("( )", "_", $comcentername);
$comnamecondensed = strtolower($comnamecondensed);
$cookiename = $comnamecondensed."_themecookie"."_$usrname";

print ("<A HREF=\"useredit.php?chosentheme=default\"><B>$comcentername Default</B></A>");
if (!${$cookiename}) {
print (" - Current Theme");
}
print ("<BR><BR>");
if ($themearray) {
foreach ($themearray as $value) {
$valuecond = ereg_replace("[[:punct:]]", "", $value);
$valuecond = ereg_replace("( )", "_", $valuecond);

$value = ereg_replace('\\\"', '"', $value);
$value = ereg_replace("\\\'", "'", $value);
print ("<A HREF=\"useredit.php?chosentheme=$valuecond\"><B>$value</B></A>");
if (${$cookiename} == $valuecond) {
print (" - Current Theme");
}
print ("<BR><BR>");
}
}

print ("
</TD>
</TR>
");

}

if ($center) {

require "mailbag.php";

if (!$sent) {
if ($messages) {
$messages_d = array_reverse($messages);
}
}

if ($sent) {
if ($sentmessages) {
$messages_d = array_reverse($sentmessages);
}
}

print ("
<TR bordercolor=\"$tablecolor\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<DIV ALIGN=\"Center\"><B>Message Center</B></DIV>
</TD>
</TR>
");

$sentornot1 = "Sent";
$sentornot2 = "sent";
if ($sent) {
$sentornot1 = "Received";
$sentornot2 = "received";
}

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<DIV ALIGN=\"Center\">

");
if ($positioninarray != "Suspended") {
print ("
<B><FONT SIZE=2><A HREF=\"useredit.php?compose=1\">Compose Message</A> | </FONT></B>
");
}
print ("
<B><FONT SIZE=2><A HREF=\"useredit.php?center=1&$sentornot2=1\">View $sentornot1 Messages</A> | <A HREF=\"javascript:SubmitTheForm()\">Delete Selected Messages</A></FONT></B></DIV>
</TD>
</TR>
");

if ($messages_d) {
for ($i=0; $i < count($messages_d); $i++) {
$sender_usrname = ereg_replace("( )", "_", $messages_d[$i][1]);
$sender_usrname = strtolower("u0000$sender_usrname");

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$titleofmessage = ereg_replace($stupidslash, '"', $messages_d[$i][0]);
$titleofmessage = ereg_replace($stupidslash2, "'", $titleofmessage);

print ("
<TR height=\"10\">
<TD bordercolor=\"$tablecolor\" bgcolor=\"$tablecolor\" width=\"309\" colspan=\"2\">
");
if (!$sent) {
if ($messages_d[$i][4] == "u_n_read") {
print ("<FONT SIZE=\"2\"><INPUT TYPE=\"checkbox\" NAME=\"msgdates[]\" VALUE=\"{$messages_d[$i][2]}\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B><A HREF=\"useredit.php?msgdisplay=1&msgnum=$i\">$titleofmessage</A></B></FONT>");
}
if ($messages_d[$i][4] == "u_r_read") {
print ("<FONT SIZE=\"2\"><INPUT TYPE=\"checkbox\" NAME=\"msgdates[]\" VALUE=\"{$messages_d[$i][2]}\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A HREF=\"useredit.php?msgdisplay=1&msgnum=$i\">$titleofmessage</A></FONT>");
}
}
if ($sent) {
if ($messages_d[$i][4] == "unread") {
print ("<FONT SIZE=\"2\"><INPUT TYPE=\"checkbox\" NAME=\"msgdates[]\" VALUE=\"{$messages_d[$i][2]}\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B><A HREF=\"useredit.php?msgdisplay=1&msgnum=$i&sent=1\">$titleofmessage</A></B></FONT>");
}
if ($messages_d[$i][4] == "isread") {
print ("<FONT SIZE=\"2\"><INPUT TYPE=\"checkbox\" NAME=\"msgdates[]\" VALUE=\"{$messages_d[$i][2]}\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A HREF=\"useredit.php?msgdisplay=1&msgnum=$i&sent=1\">$titleofmessage</A></FONT>");
}
}
$fromorto = "From:";
$receivedorsent = "Received On:";
$theurl = $sender_usrname;
if ($sent) {
$fromorto = "Sent To:";
$receivedorsent = "Sent On:";
$theurl = ereg_replace("( )", "_", $messages_d[$i][1]);
$theurl = strtolower("u0000$theurl");
}


$thealias = ${$theurl}["Alias"];

if ($theurl == "u0000mailbot") {
$thealias = $messages_d[$i][1];
$theurl = ereg_replace("( )", "_", $userinarray);
$theurl = strtolower("u0000$theurl");
}

print ("
</TD>
<TD bordercolor=\"$secondarytablecolor\" bgcolor=\"$secondarytablecolor\" width=\"309\" colspan=\"2\">
<DIV ALIGN=\"Center\"><FONT COLOR=\"$secondarytextcolor\" SIZE=\"2\">
<B>$fromorto</B> <A HREF=\"../$theurl/user.php?profile=1\"><FONT COLOR=\"$secondarylinkcolor\">$thealias</FONT></A> &nbsp;&nbsp; <B>$receivedorsent</B> {$messages_d[$i][2]}
</FONT></DIV>
</TD>
</TR>
");
}
}

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<DIV ALIGN=\"Center\">
");
if ($positioninarray != "Suspended") {
print ("
<B><FONT SIZE=2><A HREF=\"useredit.php?compose=1\">Compose Message</A> | </FONT></B>
");
}
print ("
<B><FONT SIZE=2><A HREF=\"useredit.php?center=1&$sentornot2=1\">View $sentornot1 Messages</A> | <A HREF=\"javascript:SubmitTheForm()\">Delete Selected Messages</A></FONT></B></DIV>
</TD>
</TR>
</TABLE>
</FORM>
");
}

if ($msgdisplay) {

require "mailbag.php";

if (!$sent) {
if ($messages) {
$messages_d = array_reverse($messages);
}
}

if ($sent) {
if ($sentmessages) {
$messages_d = array_reverse($sentmessages);
}
}

$Open = fopen ("mailbag.php", "r");
$mailbag = file("mailbag.php");
fclose($Open);

$recipdir = ereg_replace("( )", "_", $messages_d[$msgnum][1]);
$recipdir = strtolower("u0000$recipdir");
if ($recipdir != "u0000mailbot") {
$Open = fopen ("../$recipdir/mailbag.php", "r");
$hismailbag2 = file("../$recipdir/mailbag.php");
fclose($Open);
}

if ($mailbag != $hismailbag2) {
if (!$sent) {
for($i=0; $i < count($mailbag); $i++) {
if (ereg("\"{$messages_d[$msgnum][1]}\"", $mailbag[$i]) && ereg("\"{$messages_d[$msgnum][2]}\"", $mailbag[$i])) {
$mailbag[$i] = ereg_replace("u_n_read", "u_r_read", $mailbag[$i]);
}
}
}

for($i=0; $i < count($hismailbag2); $i++) {
if (ereg("\"$userinarray\"", $hismailbag2[$i]) && ereg("\"{$messages_d[$msgnum][2]}\"", $hismailbag2[$i])) {
$hismailbag2[$i] = ereg_replace("\"unread\"", "\"isread\"", $hismailbag2[$i]);
}
}

$Open = fopen ("mailbag.php", "w+");
foreach ($mailbag as $value) {
fwrite ($Open, "$value");
}
fclose($Open);

if ($recipdir != "u0000mailbot") {
$Open = fopen ("../$recipdir/mailbag.php", "w+");
foreach ($hismailbag2 as $value) {
fwrite ($Open, "$value");
}
fclose($Open);
}
}

if ($mailbag == $hismailbag2) {
if (!$sent) {
for($i=0; $i < count($mailbag); $i++) {
if (ereg("\"{$messages_d[$msgnum][1]}\"", $mailbag[$i]) && ereg("\"{$messages_d[$msgnum][2]}\"", $mailbag[$i])) {
$mailbag[$i] = ereg_replace("u_n_read", "u_r_read", $mailbag[$i]);
}
if (ereg("\"$userinarray\"", $mailbag[$i]) && ereg("\"{$messages_d[$msgnum][2]}\"", $mailbag[$i])) {
$mailbag[$i] = ereg_replace("\"unread\"", "\"isread\"", $mailbag[$i]);
}
}
}

$Open = fopen ("mailbag.php", "w+");
foreach ($mailbag as $value) {
fwrite ($Open, "$value");
}
fclose($Open);
}

$sender_usrname2 = ereg_replace("( )", "_", $messages_d[$msgnum][1]);
$sender_usrname2 = strtolower("u0000$sender_usrname2");

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$titleofmessage = ereg_replace($stupidslash, '"', $messages_d[$msgnum][0]);
$titleofmessage = ereg_replace($stupidslash2, "'", $titleofmessage);
$titleofmessge = ereg_replace($stupidslash, "'", $messages_d[$msgnum][0]);
$titleofmessge = ereg_replace($stupidslash2, "'", $titleofmessge);

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$body = ereg_replace($stupidslash, '"', $messages_d[$msgnum][3]);
$body = ereg_replace($stupidslash2, "'", $body);

if ($positioninarray == "Administrator" && $titleofmessage == "---New User---") {
$donotsmile = 1;
}
if ($usefaces == "yes" && !$donotsmile && !$sent) {
$body = ereg_replace("(:-))|(:))|(=))|(=-))", "<IMG SRC=\"../../faces/smile.gif\">", $body);
$body = ereg_replace("(;-))|(;))", "<IMG SRC=\"../../faces/smirk.gif\">", $body);
$body = ereg_replace("(:-D)|(:D)|(=D)|(=-D)", "<IMG SRC=\"../../faces/bigsmile.gif\">", $body);
$body = ereg_replace("(8-))|(8))", "<IMG SRC=\"../../faces/wideeyedsmile.gif\">", $body);
$body = ereg_replace("(;-D)|(;D)", "<IMG SRC=\"../../faces/bigsmirk.gif\">", $body);
$body = ereg_replace("[=:][',`](-)?\(", "<IMG SRC=\"../../faces/crying.gif\">", $body);
$body = ereg_replace("[=:](-)?\(", "<IMG SRC=\"../../faces/frown.gif\">", $body);
$body = ereg_replace("[8](-)?D", "<IMG SRC=\"../../faces/extatic.gif\">", $body);
$body = ereg_replace("[;](-)?\(", "<IMG SRC=\"../../faces/mad.gif\">", $body);
$body = ereg_replace("[=:](-)?[\\]", "<IMG SRC=\"../../faces/notsosure.gif\">", $body);
$body = ereg_replace("[=](-)?[\/]", "<IMG SRC=\"../../faces/notsosure.gif\">", $body);
$body = ereg_replace("[=:](-)?P", "<IMG SRC=\"../../faces/sidething.gif\">", $body);
$body = ereg_replace("(  )", " &nbsp;", $body);
}

$senderalias = ereg_replace("( )", "_", $messages_d[$msgnum][1]);
$senderalias = strtolower("u0000$senderalias");
$senderalias = ${$senderalias}["Alias"];

if (!$sent) {
print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
");
print ("<DIV ALIGN=\"Center\"><B>$titleofmessage</B><BR>");
print ("
<FONT SIZE=2>
<B>From:</B> $senderalias &nbsp; <B>Received On:</B> {$messages_d[$msgnum][2]}
</FONT>
</DIV>
</TD>
</TR>
");
}
if ($sent) {

$recipient_alias = ereg_replace("( )", "_", $messages_d[$msgnum][1]);
$recipient_alias = strtolower("u0000$recipient_alias");
$recipient_alias = ${$recipient_alias}["Alias"];

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
");
print ("<DIV ALIGN=\"Center\"><B>$titleofmessage</B><BR>");
print ("
<FONT SIZE=2>
<B>Sent To:</B> $recipient_alias &nbsp; <B>Sent On:</B> {$messages_d[$msgnum][2]}
</FONT>
</DIV>
</TD>
</TR>
");
}
if (!$sent | $messages_d[$msgnum][4] == "isread") {

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$tablecolor\" colspan =\"4\">
<BR>$body
</TD>
</TR>
");
if ($positioninarray != "Suspended") {
print ("
<TR bordercolor=\"$secondarytablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$secondarytablecolor\" colspan =\"4\">
<DIV ALIGN=\"Center\">
<A HREF=\"useredit.php?compose=1&reply=$sender_usrname2&subjct=$titleofmessge&messagenum=$msgnum\"><B><FONT COLOR=\"$secondarylinkcolor\">Reply</FONT></B></A>
</DIV>
</TD>
</TR>
");
}
}
if ($sent && $messages_d[$msgnum][4] == "unread" && $positioninarray != "Suspended") {

$body = ereg_replace("<BR>", "\n", $body);
$pos = "{$messages_d[$msgnum][1]}";
$SentSubject = ereg_replace("\\\'", "'", $messages_d[$msgnum][0]);
$SentSubject = ereg_replace('\"', "'",  $SentSubject);

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$tablecolor\" colspan =\"4\">
<FORM ACTION=\"useredit.php\" METHOD=\"Post\">
<DIV ALIGN=\"Center\">
<BR><BR><TEXTAREA NAME=\"editedmessage\" ROWS=\"25\" COLS=\"70\">$body</TEXTAREA><BR><BR>
<INPUT TYPE=\"Hidden\" NAME=\"SentDate\" VALUE=\"{$messages_d[$msgnum][2]}\">
<INPUT TYPE=\"Hidden\" NAME=\"SentSubject\" VALUE=\"$SentSubject\">
<INPUT TYPE=\"Hidden\" NAME=\"Possessor\" VALUE=\"{$messages_d[$msgnum][1]}\">
<INPUT TYPE=\"Submit\" Class=\"button\" VALUE=\"Modify Message\">
</DIV>
</TD>
</TR>
<TR bordercolor=\"$secondarytablecolor\" valign=\"top\" height=\"10\">
<TD bgcolor=\"$secondarytablecolor\" colspan =\"4\">
<DIV ALIGN=\"Center\">
<A HREF=\"useredit.php?editedmessage=1&deletemsg=1&SentDate={$messages_d[$msgnum][2]}&SentSubject=$SentSubject&Possessor=$pos\"><B><FONT COLOR=\"$secondarylinkcolor\">Delete Message</FONT></B></A>
</DIV>
</TD>
</TR>
");
}
}

if ($compose) {

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$subjct = ereg_replace($stupidslash, "'", $subjct);
$subjct = ereg_replace($stupidslash2, "'", $subjct);

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<DIV ALIGN=\"Center\"><B>Compose Message</B></DIV>
</TD>
</TR>
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<DIV ALIGN=\"Center\">
<FORM ACTION=\"useredit.php\" METHOD=\"Post\">
<BR><B>Recipient(s):</B>
");
if (!$reply) {
print ("
<SELECT NAME=\"recipients[]\" size=\"3\" MULTIPLE>
");

for ($i=0; $i < count($users); $i++) {
$pro_username = strtolower($users[$i]["Username"]);
$userlist[] = $pro_username;
}

sort($userlist);

for ($i=0; $i < count($userlist); $i++) {

$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", "u0000$dirname");
$dirname = strtolower($dirname);
$user_name = ${$dirname}["Username"];
$user_alias = ${$dirname}["Alias"];

print ("<OPTION VALUE=\"$user_name\">$user_alias");
}
print ("</SELECT>&nbsp;&nbsp;&nbsp;&nbsp;<B>Subject:</B> <INPUT TYPE=\"text\" NAME=\"subject\">");
}
if ($reply) {
print (" {${$reply}[Alias]}<INPUT TYPE=\"hidden\" NAME=\"recipients[]\" VALUE=\"{${$reply}[Username]}\">");
}
if ($reply) {
print ("&nbsp;&nbsp;&nbsp;&nbsp;<B>Subject:</B> <INPUT TYPE=\"text\" NAME=\"subject\" VALUE=\"Re: $subjct\">");
}
print ("
<BR><BR><FONT SIZE=\"2\">Use Ctrl+Click to Select Multiple Recipients</FONT><BR><BR><TEXTAREA NAME=\"composition\" ROWS=\"25\" COLS=\"70\"></TEXTAREA>
<BR><BR><INPUT TYPE=\"checkbox\" NAME=\"sendasemail\" VALUE=\"yes\"> <FONT SIZE=\"2\"><B>Send as E-mail</B> (Your e-mail address will be listed as sender)<BR>HTML is not supported in E-mail</FONT>
<INPUT TYPE=\"hidden\" NAME=\"sentmessage\" VALUE=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"center\" VALUE=\"1\">
<BR><BR><INPUT TYPE=\"submit\" CLASS=\"button\" value=\"          Send          \">
</FORM>
</DIV>
</TD>
</TR>
");

if ($reply) {
require "mailbag.php";
if ($messages) {
$messages_d = array_reverse($messages);
}

$stupidslash2 = "\\\'";
$respondingto = ereg_replace($stupidslash2, "'", $messages_d[$messagenum][3]);

$respondingto = ereg_replace("(:-))|(:))|(=))|(=-))", "<IMG SRC=\"../../faces/smile.gif\">", $respondingto);
$respondingto = ereg_replace("(;-))|(;))", "<IMG SRC=\"../../faces/smirk.gif\">", $respondingto);
$respondingto = ereg_replace("(:-D)|(:D)|(=D)|(=-D)", "<IMG SRC=\"../../faces/bigsmile.gif\">", $respondingto);
$respondingto = ereg_replace("(8-))|(8))", "<IMG SRC=\"../../faces/wideeyedsmile.gif\">", $respondingto);
$respondingto = ereg_replace("(;-D)|(;D)", "<IMG SRC=\"../../faces/bigsmirk.gif\">", $respondingto);
$respondingto = ereg_replace("[=:][',`](-)?\(", "<IMG SRC=\"../../faces/crying.gif\">", $respondingto);
$respondingto = ereg_replace("[=:](-)?\(", "<IMG SRC=\"../../faces/frown.gif\">", $respondingto);
$respondingto = ereg_replace("[8](-)?D", "<IMG SRC=\"../../faces/extatic.gif\">", $respondingto);
$respondingto = ereg_replace("[;](-)?\(", "<IMG SRC=\"../../faces/mad.gif\">", $respondingto);
$respondingto = ereg_replace("[=:](-)?[\\]", "<IMG SRC=\"../../faces/notsosure.gif\">", $respondingto);
$respondingto = ereg_replace("[=](-)?[\/]", "<IMG SRC=\"../../faces/notsosure.gif\">", $respondingto);
$respondingto = ereg_replace("[=:](-)?P", "<IMG SRC=\"../../faces/sidething.gif\">", $respondingto);
$respondingto = ereg_replace("(  )", " &nbsp;", $respondingto);

print ("
<TR><TD COLSPAN=\"4\" bgcolor=\"$tablecolor\">
<B>Original Message:</B><BR><BR>$respondingto
</TD></TR>
");
}

}

if ($linkspage) {

require "mailbag.php";

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<BR>
<FONT SIZE=\"4\">{$user[Alias]}'s Favorite Links-</FONT><BR><BR>
<FORM ACTION=\"useredit.php\" METHOD=\"Post\">
<B>Add Link:</B><BR>
<FONT SIZE=\"2\"><B>Site Name:</B> <INPUT TYPE=\"Text\" NAME=\"newlinkname\"\"><BR>
<B>Site URL:</B> <INPUT TYPE=\"Text\" NAME=\"newlinkurl\" VALUE=\"http://\"><BR><BR><INPUT TYPE=\"submit\" CLASS=\"button\" VALUE=\"    Add Link    \"> 
<INPUT TYPE=\"hidden\" NAME=\"linksubmitted\" VALUE=\"1\">
</FONT></FORM><BR><BR>
");

if ($links) {
$links = array_reverse($links);
foreach ($links as $link) {
$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$title = ereg_replace($stupidslash, '"', $link[0]);
$title = ereg_replace($stupidslash2, "'", $title);
$titleurl = ereg_replace($stupidslash, '"', $link[1]);
$titleurl = ereg_replace($stupidslash2, "'", $titleurl);
print ("(<A HREF=\"useredit.php?linkdeleted=1&cur_time=$link[2]\">Del</A>)&nbsp;&nbsp; <B><A HREF=\"$link[1]\">$title</A></B> - $titleurl<BR><BR>");
}
}

print ("
</TD>
</TR>
");
}

print ("
</table>
</div>
</body>
</html>
");
}

?>