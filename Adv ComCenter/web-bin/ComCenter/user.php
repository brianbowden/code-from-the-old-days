<?php

require "../../specs.php";
require "../users.php";

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
require "userspecs.php";

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$aliasinarray = ${$usrname}["Alias"];
$positioninarray = ${$usrname}["Position"];
$passwrd = md5(crypt($password, $userinarray));

if ($passinarray != $passwrd) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$user</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect,<BR>or you are not authorized to access this page.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"user.php\" METHOD=\"post\">
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
}

if ($passinarray == $passwrd) {

if ($sentmessage) {

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

if ($sendasemail == "yes") {
$asemail = 1;
}

$emailinarray = ${$usrname}["emailinarray"];

$recipient= ereg_replace("( )", "_", $recipient);
$recipient = strtolower($recipient);

$recipientemail = ${$recipient}["Email"];
$recipientuser = ${$recipient}["Username"];
$recipientalias = ${$recipient}["Alias"];
$recipient_u_e = "\"$recipientuser\" <$recipientemail>";

$sender_u_e = "\"$aliasinarray from $comcentername\" <$emailinarray>";

$current_time = date("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$current_time = date("m/d/y ").$hour.date(":i:sa");
}

$newline = "\n";
if (!$asemail) {
$composition = ereg_replace($newline, "<BR>", $composition);
}
$composition = ereg_replace("\\\r", "", $composition);

$subject_ = ereg_replace('\$', "\\\$", $subject);
$compo_ = ereg_replace('\$', "\\\$", $composition);

if (!$asemail) {
$Open = fopen ("../$recipient/mailbag.php", "a");
fwrite ($Open, "<?php \$messages[] = array (\"$subject_\", \"$userinarray\", \"$current_time\", \"$compo_\", \"u_n_read\");?>\n");
fclose($Open);
}

$composition = ereg_replace($newline, "<BR>", $composition);

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

header("Location: user.php?profile=1"); 
exit("");
}

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$paragraph = ereg_replace($stupidslash, '"', $paragraph);
$paragraph = ereg_replace($stupidslash2, "'", $paragraph);

if ($usefaces == "yes") {
$paragraph = ereg_replace("(:-))|(:))|(=))|(=-))", "<IMG SRC=\"../../faces/smile.gif\">", $paragraph);
$paragraph = ereg_replace("(;-))|(;))", "<IMG SRC=\"../../faces/smirk.gif\">", $paragraph);
$paragraph = ereg_replace("(:-D)|(:D)|(=D)|(=-D)", "<IMG SRC=\"../../faces/bigsmile.gif\">", $paragraph);
$paragraph = ereg_replace("(8-))|(8))", "<IMG SRC=\"../../faces/wideeyedsmile.gif\">", $paragraph);
$paragraph = ereg_replace("(;-D)|(;D)", "<IMG SRC=\"../../faces/bigsmirk.gif\">", $paragraph);
$paragraph = ereg_replace("[=:][',`](-)?\(", "<IMG SRC=\"../../faces/crying.gif\">", $paragraph);
$paragraph = ereg_replace("[=:](-)?\(", "<IMG SRC=\"../../faces/frown.gif\">", $paragraph);
$paragraph = ereg_replace("[8](-)?D", "<IMG SRC=\"../../faces/extatic.gif\">", $paragraph);
$paragraph = ereg_replace("[;](-)?\(", "<IMG SRC=\"../../faces/mad.gif\">", $paragraph);
$paragraph = ereg_replace("[=:](-)?[\\]", "<IMG SRC=\"../../faces/notsosure.gif\">", $paragraph);
$paragraph = ereg_replace("[=](-)?[\/]", "<IMG SRC=\"../../faces/notsosure.gif\">", $paragraph);
$paragraph = ereg_replace("[=:](-)?P", "<IMG SRC=\"../../faces/sidething.gif\">", $paragraph);
$paragraph = ereg_replace("(  )", " &nbsp;", $paragraph);
}

print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\" COLSPAN=\"4\">
        <div align=\"center\"><b>{$user[Alias]}</b></div>
      </td>
    </tr>
<TR bordercolor=\"$secondarytablecolor\">
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"155\"><DIV ALIGN=\"Center\"><A HREF=\"user.php?profile=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Profile</B></FONT></A></DIV></TD>
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"154\"><DIV ALIGN=\"Center\"><A HREF=\"user.php?stats=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Stats</B></FONT></A></DIV></TD>
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"154\"><DIV ALIGN=\"Center\"><A HREF=\"user.php?center=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Send Message</B></FONT></A></DIV></TD>
<TD bgcolor=\"$secondarytablecolor\" height=\"20\" width=\"155\"><DIV ALIGN=\"Center\"><A HREF=\"user.php?linkspage=1\"><FONT COLOR=\"$secondarylinkcolor\"><B>Favorite Links</B></FONT></A></DIV></TD>
</TR>
");
if ($profile) {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\" colspan=\"2\" width=\"309\">
<BR><FONT SIZE=4>Message from {$user[Alias]}-</FONT>
<BR><BR>$paragraph
<BR><BR><BR><B>Previous Aliases:</B><BR>
");
if ($pastaliases    ) {
foreach ($pastaliases as $value) {
print ("<i>$value</i><BR>");
}
}
else {
print("<i>None</i>");
}
print("
</td>
<td bgcolor=\"$tablecolor\" colspan=\"2\">
<BR>
<FONT SIZE=4>Profile-</FONT><BR><BR>
");
if ($fullnamedisplay == "yes") {
print ("<B>Full Name:</B> {$user[Full_Name]}<BR><BR>");
}
print ("
<B>E-mail:</B> <A HREF=\"mailto:{$user[Email]}\">{$user[Email]}</A><BR><BR>
<B>Position:</B> {$user[Position]}<BR><BR>
<B><A HREF=\"../../divisiondisplay.php?isolateuser={$user[Username]}\">View Only {$user[Alias]}'s Posts</A></B>
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

if ($center) {
print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<DIV ALIGN=\"Center\"><B>Send {$user[Alias]} a Message</B></DIV>
</TD>
</TR>
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<DIV ALIGN=\"Center\">
<FORM ACTION=\"user.php\" METHOD=\"Post\">
");
if ($positioninarray != "Suspended") {
print ("<BR><B>Recipient:</B> {$user[Alias]}<INPUT TYPE=\"hidden\" NAME=\"recipient\" VALUE=\"u0000{$user[Username]}\">&nbsp;&nbsp;&nbsp;&nbsp;<B>Subject:</B> <INPUT TYPE=\"text\" NAME=\"subject\">");
print ("
<BR><BR><TEXTAREA NAME=\"composition\" ROWS=\"12\" COLS=\"60\"></TEXTAREA>
<INPUT TYPE=\"hidden\" NAME=\"sentmessage\" VALUE=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"center\" VALUE=\"1\">
<BR><BR><INPUT TYPE=\"checkbox\" NAME=\"sendasemail\" VALUE=\"yes\"> <FONT SIZE=\"2\"><B>Send as E-mail</B> (Your e-mail address will be listed as sender)<BR>HTML is not supported in E-mail</FONT>
<BR><BR><INPUT TYPE=\"submit\" CLASS=\"button\" value=\"          Send          \">
</FORM>
");
}
if ($positioninarray == "Suspended") {
print ("<BR><BR><BR><B>Sorry, but you have been suspended and cannot send messages</B><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>");
}
print ("
</DIV>
</TD>
</TR>
");
}

if ($linkspage) {

require "mailbag.php";

print ("
<TR bordercolor=\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" colspan=\"4\">
<BR>
<FONT SIZE=\"4\">{$user[Alias]}'s Favorite Links-</FONT><BR><BR>
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
print (" <B><A HREF=\"$link[1]\">$title</A></B> - $titleurl<BR><BR>");
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