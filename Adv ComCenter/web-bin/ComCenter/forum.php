<?php
require "../../specs.php";
require "../../users/users.php";

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
$aliasinarray = ${$usrname}["Alias"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];
$passwrd = md5(crypt($password, $userinarray));

$theuser = ereg_replace("[[:punct:]]", "", $userinarray);
$theuser = ereg_replace("( )","_", $theuser);
$theuser = strtolower("_____________$theuser");

if ($positioninarray == "Banned") {
$passwrd = "if your password equals this after being encrypted and all that stuff, then you have more than luck. You have fate on your side.";
}

if ($votesubmitted && $$theuser != "no") {
require "pollinfo.php";
require "../../pollinsert.php";
}

if ($multiplethemes == "yes") {
require "../../themes.php";
}

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$passwrd = md5(crypt($password, $userinarray));

if (($post_submitted && $passinarray == $passwrd) || $shootup) {
header("Location: forum.php");
}

$twoup = 1;
require "../../menuinsert.php";

if ($locallogin) {
if ($passinarray == $passwrd) {
$back = getcwd();
$back = split("/", $back);
$numback = count($back);
$back_forum = $back[$numback-3];
setcookie ("username", "$username", 0, "/");
setcookie ("password", "$password", 0, "/");
}
}





require "array.php";
$todaysdate = date ("g:i:sa, l F j, Y");

$st = date("I");
if ($st == 0) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$todaysdate = $hour.date(":i:sa, l F j, Y");
}

$datecondensed = date ("m/d/y g:i:sa");

$st = date("I");
if ($st == 0) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$datecondensed = date("m/d/y ").$hour.date(":i:sa");
}

?>
<?php
if ($allowvisitors == "no") {
if (!$username && !$password) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$subject</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Please Log In:<BR>
<FORM ACTION=\"forum.php\" NAME=\"form1\" METHOD=\"post\">
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
}
?>
<?php

if ($post_submitted) {
if ($passinarray != $passwrd) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$subject</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"forum.php\" NAME=\"form1\" METHOD=\"post\">
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
}
?>
<?php

$uno = ereg_replace("( )", "_", $userinarray);
$uno = strtolower("u0000$uno");

if ($passinarray == $passwrd) {
$epoch = date("U");
$numofposts = count($posts);
$sfzposts = count($posts);
$numofposts = $numofposts+1;
$negnumofposts = $sfzposts-1;
$message = $msg;
$replica = 1;
if ($post_submitted) {
if ($posts[$negnumofposts][6] == $posteddate) {
$replica = 2;
}
$Open = fopen ("array.php","a+");
if ($replica == 1) {
if ($Open) {
$message = ereg_replace("\n", "<BR>", $message);
$message = ereg_replace('\$', "\\\$", $message);
fwrite ($Open, "\n<?php
\$post$numofposts = array (\"<B>Full Name:</B> $fullnameinarray\", \"<B>Username:</B> <A HREF=../../users/$uno/user.php?profile=1><FONT COLOR=\$secondarylinkcolor>$aliasinarray</FONT></A>\", \"<B>Position:</B> $positioninarray\", \"<B>Date:</B> $todaysdate\", \"<B>Post #:</B> $numofposts\", \"$message\", \"$posteddate\", \"$epoch\");
\$posts[$sfzposts] = \$post$numofposts;
?>\n");
}
fclose ($Open);

$Open = fopen ("../../users/$usrname/userspecs.php", "r");
$userspecs = file("../../users/$usrname/userspecs.php");
fclose($Open);

require "../../users/$usrname/userspecs.php";

$numwords = explode(" ", $message);
$numwords = count($numwords);

$tp_canceled = $postlength*$totalposts;

$totalposts = $totalposts+1;
$tp_canceled += $numwords;

for($i=0; $i < count($userspecs); $i++) {
$userspecs[$i] = ereg_replace("totalposts = \"[0-9]{1,10}\"", "totalposts = \"$totalposts\"", $userspecs[$i]);
$userspecs[$i] = ereg_replace("postlength = \(?[0-9]{1,10}\)?/", "postlength = $tp_canceled/", $userspecs[$i]);
$userspecs[$i] = ereg_replace("lastpostdate = \"[[:alnum:][:space:][:punct:]]{1,70}\"", "lastpostdate = \"$datecondensed\"", $userspecs[$i]);
}

$Open = fopen("../../users/$usrname/userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

}
}

if ($post_submitted || $shootup)
{
if ($replica == 1 || $shootup) {
$topiclistfile = "../topicsarray.php";
$Open = fopen ($topiclistfile, "r");
if ($Open) {
$topiclist = file($topiclistfile);
}
fclose ($Open);

for ($i=0; $i < count($topiclist); $i++) {
if (ereg ("\"$subjectfolder\"", $topiclist[$i])) {
if (!$stopnum) {
$element = $topiclist[$i];
array_push($topiclist, "$element");
$topiclist[$i] = "";
}
if ($startnum) {
$stopnum = 1;
}
$startnum = 1;
}
}

$st = "";

for ($i=0; $i < count($topiclist); $i++) {
if (ereg("\"$subjectfolder\"", $topiclist[$i])){
$topiclist[$i] = ereg_replace("\"<B>Posts:</B> [0-9][0-9]?[0-9]?[0-9]?[0-9]?\"", "\"<B>Posts:</B> $numofposts\"", $topiclist[$i]);
$topiclist[$i] = ereg_replace("\"<B>Last Post by:</B> [^\"]{1,110}\"", "\"<B>Last Post by:</B> <A HREF=../users/$uno/user.php?profile=1>$aliasinarray</A>\"", $topiclist[$i]);
$topiclist[$i] = ereg_replace("\"<B>Last Post on:</B> [^\"]{16,19}\"", "\"<B>Last Post on:</B> $datecondensed\"", $topiclist[$i]);
$topiclist[$i] = ereg_replace("\"[0-9]{10,21}\"", "\"$epoch\"", $topiclist[$i]);
}
}

$Open = fopen ($topiclistfile, "w");
if ($Open) {
for ($i=0; $i < count($topiclist); $i++) {
fwrite ($Open, "$topiclist[$i]");
}
}
fclose($Open);

exit("");
}
}

require "array.php";
$tablebordercolor = $tablecolor;

$numberofposts = count($posts);


}
?>
<html>
<head>
<title>Forum</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<STYLE TYPE="text/css">
BODY
{
<?php
print ("
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
border: thin;
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
");
?>
</STYLE>
<SCRIPT LANGUAGE=javascript>
function Expand() {
if (document.form1.msg.rows == "2") {
document.form1.msg.rows = "8";
}
else {
if (document.form1.msg.rows == "8") {
document.form1.msg.rows = "16";
}
else {
document.form1.msg.rows = "2";
}
}
}
function DontBeStupid () {
if (document.form1.msg.value == "") {
alert("You have not entered a post.");
return false;
}
document.form1.submit();
}
function EditWin (PostNum) {
properties = "left=150,top=300,width=700,height=500";
<?php
$thisdir = $SCRIPT_NAME;
$thisdirarray = explode ("/", $thisdir);
$thisdir = "$thisdirarray[3]/$thisdirarray[4]";

if ($wiki) {
$wikiopt = "&wikisend=1";
}
print ("PopUp = window.open(\"../../posteditor.php?selectarray=$thisdir&option=1$wikiopt&post=\"+PostNum, \"PopUp\", properties);");
?>
}
function EditWin2 (PostNum2) {
properties = "left=150,top=300,width=700,height=500";
<?php
$thisdir = $SCRIPT_NAME;
$thisdirarray = explode ("/", $thisdir);
$thisdir = "$thisdirarray[3]/$thisdirarray[4]";
print ("PopUp = window.open(\"../../posteditor.php?selectarray=$thisdir&option=2&post=\"+PostNum2, \"PopUp\", properties);");
?>
}
</SCRIPT>
<?php
print ("
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$secondarytablecolor\"> 
      <td height=\"23\" bgcolor=\"$secondarytablecolor\">
        <div align=\"center\"><b><FONT COLOR=\"$secondarytextcolor\">$subject</b><BR><FONT SIZE=1><B>Current Time:</B> $todaysdate</FONT></FONT></div>
      </td>
    </tr>
");

if (is_file("pollinfo.php")) {
require "pollinfo.php";
require "../../pollinsert.php";
$backlink = "no";
}

$readonlynote = "Read Only";
if ($journalpost && $userinarray != $journalpost) {
$nopost = "yes";
$journalowner = ereg_replace("( )", "_", $journalpost);
$journalowner = strtolower("u0000$journalowner");
$journalowner = ${$journalowner}["Alias"];
$
$readonlynote = "$journalowner's Journal";
}

if ($newattop == "yes" && $locked == "no" && $positioninarray != "Suspended" && $nopost == "no" && $wiki != "true") {
$scrumpy = date ("g i sa l F j Y");

$st = date("I");
if ($st == 0) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$scrumpy = $hour.date(":i:sa, l F j, Y");
}

print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\">
      <div align=\"center\">
");
if ($backlink != "no") {
print ("        <FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT>");
}
if ($username) {
print ("
<br>
          <form name=\"form1\" action=\"forum.php\" METHOD=\"post\">
            <FONT SIZE=\"2\"><B>Logged In As:</B> <i>$aliasinarray</i></FONT><BR>
            <input type=\"hidden\" name=\"username\" value=\"$username\">
            <input type=\"hidden\" name=\"password\" value=\"$password\">
            <input type=\"hidden\" name=\"post_submitted\" value=1>
            <input type=\"hidden\" name=\"posteddate\" value=\"$scrumpy\">
            <TEXTAREA name=\"msg\" cols=\"60\" rows=\"2\"></TEXTAREA><BR>
            <BR><input CLASS=\"Button\" type=\"button\" onClick=\"DontBeStupid()\" value=\"          Add Post          \">
            <input CLASS=\"Button\" type=\"button\" value=\"ResizeBox\" onClick=\"Expand()\">
            <INPUT CLASS=\"Button\" type=\"button\" value=\"CFNM\" onClick=\"history.go()\">
          </form>
        </div>
      </td>
    </tr>
");
}
if ($allowvisitors == "yes" && !$username) {
print ("
<br>
          <form name=\"form1\" action=\"forum.php\" METHOD=\"post\">
            <FONT SIZE=\"2\"><B>Username: <INPUT TYPE=\"text\" name=\"username\" size=13> &nbsp;Password: <INPUT TYPE=\"password\" name=\"password\" size=13></B></FONT><BR>
            <input type=\"hidden\" name=\"locallogin\" value=\"1\">
            <input type=\"hidden\" name=\"post_submitted\" value=1>
            <input type=\"hidden\" name=\"posteddate\" value=\"$scrumpy\">
            <TEXTAREA name=\"msg\" cols=\"60\" rows=\"2\"></TEXTAREA><BR>
            <BR><input CLASS=\"Button\" type=\"button\" onClick=\"DontBeStupid()\" value=\"          Add Post          \">
            <input CLASS=\"Button\" type=\"button\" value=\"ResizeBox\" onClick=\"Expand()\">
            <INPUT CLASS=\"Button\" type=\"button\" value=\"CFNM\" onClick=\"history.go()\">
          </form>
        </div>
      </td>
    </tr>
");
}
}
if ($newattop == "yes" && $locked == "yes") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><br><br>
<B>This Topic has been Locked.</B>
<br><BR>
        </div>
      </td>
    </tr>
");
}
if ($newattop == "yes" && $wiki == "true") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><br><br>
<B><FONT SIZE=2>This is a Wiki: Click <I>EDIT</I> to add content</FONT></B>
<br><BR>
        </div>
      </td>
    </tr>
");
}
if ($newattop == "yes" && $nopost == "yes") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><br><BR>
<B><FONT SIZE=2>($readonlynote)</FONT></B>
<br>
        </div>
      </td>
    </tr>
");
}
if ($newattop == "yes" && $positioninarray == "Suspended") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><br><br>
<B>You have been suspended. You may not post again until unsuspended.</B>
<BR><br>
        </div>
      </td>
    </tr>
");
}

if ($onlyuser) {
$onlyusr = ereg_replace("( )", "_", $onlyuser);
$onlyusr = strtolower("u0000$onlyusr");
$onlyuseralias = ${$onlyusr}["Alias"];
print ("
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><FONT SIZE=2><b>Displaying Only Posts by $onlyuseralias (<A HREF=\"../../divisiondisplay.php?deisolateuser=1\">Switch Off</A>)</b></FONT></div>
      </td>
    </tr>
");
}

$stupidslash = "\\\'";
if ($newattop == "yes") {
$posts = array_reverse($posts);
}

$postcount = count($posts);
$postsdivided = $postcount/20;

if (!$begin) {
$begin = 0;
}
if (!$end) {
if ($postsdivided > 1) {
$end = 20;
}
else {
$end = $postcount;
}
}

$displayuser = "yes";

for ($i=$begin; $i < $end; $i++) {

if ($onlyuser) {
$onlyusr = ereg_replace("( )", "_", $onlyuser);
$onlyusr = strtolower("u0000$onlyusr");
if (ereg("users/$onlyusr/user\.php\?profile=1", $posts[$i][1])) {
$displayuser = "yes";
}
else {
$displayuser = "no";
}
}

if ($displayuser == "yes") {
$posts[$i][5] = ereg_replace($stupidslash, "'", $posts[$i][5]);
if ($usefaces == "yes") {
$posts[$i][5] = ereg_replace("(:-))|(:))|(=))|(=-))", "<IMG SRC=\"../../faces/smile.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("(;-))|(;))", "<IMG SRC=\"../../faces/smirk.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("(:-D)|(:D)|(=D)|(=-D)", "<IMG SRC=\"../../faces/bigsmile.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("(8-))|(8))", "<IMG SRC=\"../../faces/wideeyedsmile.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("(;-D)|(;D)", "<IMG SRC=\"../../faces/bigsmirk.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("[=:][',`](-)?\(", "<IMG SRC=\"../../faces/crying.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("[=:](-)?\(", "<IMG SRC=\"../../faces/frown.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("[8](-)?D", "<IMG SRC=\"../../faces/extatic.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("[;](-)?\(", "<IMG SRC=\"../../faces/mad.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("[=:](-)?[\\]", "<IMG SRC=\"../../faces/notsosure.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("[=](-)?[\/]", "<IMG SRC=\"../../faces/notsosure.gif\">", $posts[$i][5]);
$posts[$i][5] = ereg_replace("[=:](-)?P", "<IMG SRC=\"../../faces/sidething.gif\">", $posts[$i][5]);
}

$posts[$i][5] = ereg_replace("(  )", " &nbsp;", $posts[$i][5]);

print ("<TR width=\"618\"><TD bgcolor=\"$secondarytablecolor\" bordercolor=\"$secondarytablecolor\"><DIV ALIGN=\"Center\"><FONT COLOR=\"$secondarytextcolor\" SIZE=\"2\">");

if ($showpostfullname == "yes") {
print ("{$posts[$i][0]} &nbsp;");
}
if ($showpostuser == "yes") {
print ("{$posts[$i][1]} &nbsp;");
}
if ($showpostposition == "yes") {
print ("{$posts[$i][2]} &nbsp;");
}
if ($showpostdate == "yes") {
print ("{$posts[$i][3]} &nbsp;");
}
if ($showpostnum == "yes") {
print ("{$posts[$i][4]} &nbsp;");
}

if ($positioninarray == "Administrator" || $positioninarray == "Moderator") {
if ($privileges == "Off") {
$positioninarray = "Member";
}
}

print ("</FONT></DIV></TD>");
print ("<TR><TD bgcolor=\"$tablecolor\" bordercolor=\"$tablecolor\"><BR>{$posts[$i][5]}<BR><BR>");
$num = count($posts);
$num = $num - $i - 1;
if ($allowedit == "yes" || $positioninarray == "Administrator" || $positioninarray == "Moderator") {
if ($positioninarray != "Suspended") {
if (ereg("users/$uno/user\.php\?profile=1", $posts[$i][1])) {
$verified = "yes";
}
if ($wiki == "true") {
$verified = "yes";
}
if ($verified == "yes" || $positioninarray == "Administrator" || $positioninarray == "Moderator") {
$verified = "no";
if ($passinarray == $passwrd) {
if ($locked == "no" || $positioninarray == "Administrator" || $positioninarray == "Moderator") {
if ($newattop == "yes") {
print ("<DIV ALIGN=\"Center\"><BR><A HREF=\"javascript:EditWin('$num')\"><FONT SIZE=\"2\"><B>[ EDIT ]</B></FONT></A></DIV>");
}
else {
print ("<DIV ALIGN=\"Center\"><BR><A HREF=\"javascript:EditWin('$i')\"><FONT SIZE=\"2\"><B>[ EDIT ]</B></FONT></A></DIV>");
}
}
}
}
}
}
if ($positioninarray != "Suspended" && $locked == "no") {
if ($journalpost) {
if ($newattop == "yes") {
print ("<DIV ALIGN=\"Center\"><BR><A HREF=\"javascript:EditWin2('$num')\"><FONT SIZE=\"2\"><B>[ Add Comment ]</B></FONT></A></DIV>");
}
else {
print ("<DIV ALIGN=\"Center\"><BR><A HREF=\"javascript:EditWin2('$i')\"><FONT SIZE=\"2\"><B>[ Add Comment ]</B></FONT></A></DIV>");
}
}
}
print ("</TD></TR>");
}
}
if ($newattop == "no" && $locked == "no" && $positioninarray != "Suspended" && $nopost == "no" && $wiki != "true") {
$scrumpy = date ("g i sa l F j Y");

$st = date("I");
if ($st == 0) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$scrumpy = $hour.date(":i:sa, l F j, Y");
}

print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><br>
");
if ($backlink != "no") {
print ("        <FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT>");
}
if ($username) {
print ("
          <form name=\"form1\" action=\"forum.php\" METHOD=\"post\">
            <FONT SIZE=\"2\"><B>Logged In As:</B> <i>$aliasinarray</i></FONT><BR>
            <input type=\"hidden\" name=\"username\" value=\"$username\">
            <input type=\"hidden\" name=\"password\" value=\"$password\">
            <input type=\"hidden\" name=\"post_submitted\" value=1>
            <input type=\"hidden\" name=\"posteddate\" value=\"$scrumpy\">
            <TEXTAREA name=\"msg\" cols=\"60\" rows=\"2\"></TEXTAREA><BR>
            <INPUT CLASS=\"Button\" TYPE=\"submit\" value=\"          Add Post          \">
            <input type=\"button\" CLASS=\"Button\" value=\"ResizeBox\" onClick=\"Expand()\">
            <INPUT CLASS=\"Button\" type=\"button\" value=\"CFNM\" onClick=\"history.go()\">
          </form>
        </div>
      </td>
    </tr>
");
}
if ($allowvisitors == "yes" && !$username) {
print ("
<br>
          <form name=\"form1\" action=\"forum.php\" METHOD=\"post\">
            <FONT SIZE=\"2\"><B>Username: <INPUT TYPE=\"text\" name=\"username\" size=13> &nbsp;Password: <INPUT TYPE=\"password\" name=\"password\" size=13></B></FONT><BR>
            <input type=\"hidden\" name=\"locallogin\" value=\"1\">
            <input type=\"hidden\" name=\"post_submitted\" value=1>
            <input type=\"hidden\" name=\"posteddate\" value=\"$scrumpy\">
            <TEXTAREA name=\"msg\" cols=\"60\" rows=\"2\"></TEXTAREA><BR>
            <BR><input CLASS=\"Button\" type=\"button\" onClick=\"DontBeStupid()\" value=\"          Add Post          \">
            <input CLASS=\"Button\" type=\"button\" value=\"ResizeBox\" onClick=\"Expand()\">
            <INPUT CLASS=\"Button\" type=\"button\" value=\"CFNM\" onClick=\"history.go()\">
          </form>
        </div>
      </td>
    </tr>
");
}
}
if ($newattop == "no" && $locked == "yes") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><br>
<FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><BR><BR>
<B>This Topic has been Locked.</B>
<br><BR>
        </div>
      </td>
    </tr>
");
}
if ($newattop == "no" && $wiki == "true") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><br>
<FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><BR><BR>
<B><FONT SIZE=2>This is a Wiki: click <I>EDIT</I> to add content</FONT></B>
<br><BR>
        </div>
      </td>
    </tr>
");
}
if ($newattop == "no" && $nopost == "yes") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><br>
<FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><BR><BR>
<B><FONT SIZE=2>(Read-Only)</FONT></B>
<br><BR>
        </div>
      </td>
    </tr>
");
}
if ($newattop == "no" && $positioninarray == "Suspended") {
print ("
    <tr bordercolor=\"$tablecolor\" valign=\"top\"> 
      <td bgcolor=\"$tablecolor\"> 
        <div align=\"center\"><br>
<B>You have been suspended. You may not post again until unsuspended.</B>
<br><BR>
        </div>
      </td>
    </tr>
");
}
if ($postsdivided > 1) {
print ("
<tr bordercolor=\"$tablecolor\" valign=\"top\">
<td bgcolor=\"$tablecolor\">
<div align=\"center\"><B>Pages:</B> 
");
$n = 1;
$begin = 0;
$end = 20;
if (!$page) {
$page = 1;
}
while ($postcount > 0) {
if ($page == $n) {
print ("<B>$n</B> ");
}
if ($page != $n) {
print ("<A HREF=\"forum.php?begin=$begin&end=$end&page=$n\">$n</A> ");
}
$postcount = $postcount-20;
$begin = $begin+20;
if ($postcount >= 20) {
$end = $end+20;
}
if ($postcount < 20) {
$end = $begin + $postcount;
}
$n++;
}
print ("
</div>
</td>
</tr>
");
}
?>
  </table>
</div>
</body>
</html>