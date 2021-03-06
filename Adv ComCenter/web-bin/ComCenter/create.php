<?PHP
if ($deletethisdir) {
if (!is_dir($deletethisdir)) {
echo "$deletethisdir is not a Directory.";
}
if (is_dir($deletethisdir)) {
if ($open = opendir($deletethisdir)) {
while (($filename = readdir($open)) !== false) {
if ($filename != "." && $filename != "..") {
unlink ("$deletethisdir/$filename");
}
}
closedir($open);
rmdir($deletethisdir);
echo "$deletethisdir Deleted.";
}
}

exit("");
}
?>
<HTML>
<HEAD>
<TITLE>Create New Topic</TITLE>

<?PHP

require "specs.php";
require "users/users.php";

if ($multiplethemes == "yes") {
require "themes.php";
}

print ("<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">");

$root = 1;
require "menuinsert.php";
print ("<DIV ALIGN=\"Center\">$menu</DIV>");

$todaysdate = date ("g:i:sa, l F j, Y");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$todaysdate = $hour.date(":i:sa, l F j, Y");
}

$datecondensed = date ("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$datecondensed = date("m/d/y ").$hour.date(":i:sa");
}

$scrumpy = date ("g i sa l F j Y");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$scrumpy = $hour.date(":i:sa, l F j, Y");
}

$epoch = date("U");

$charerror = "
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Could Not Create Division</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Division name must contain at least one letter or number.</B>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
";

?>
<STYLE TYPE="text/css">
BODY
{
<?PHP
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
</HEAD>
<?PHP
if (!$username && !$password) {
print ("
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$division - Create New Topic</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Please Log In:<BR>
<FORM ACTION=\"create.php\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\"><BR>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\">
<INPUT TYPE=\"hidden\" name=\"division\" value=\"$division\">
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
<?PHP
$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$aliasinarray = ${$usrname}["Alias"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];
$passwrd = md5(crypt($password, $userinarray));

if ($moddivisions && $positioninarray == "Moderator") {
$positioninarray = "Administrator";
}
if ($passinarray == $passwrd && $moddivisions && $positioninarray == "Administrator") {

if ($deldivision) {

$delete = ereg_replace("[[:punct:]]", "", $deldivision);
$delete = ereg_replace("( )","_", $delete);
$stupidslash = "\\\'";
$stupidslash2 = '\\\"';
$deldivision = ereg_replace($stupidslash, "'", $deldivision);
$deldivision = ereg_replace($stupidslash2, '"', $deldivision);

if (is_dir($delete)) {
if ($open = opendir($delete)) {
while (($filename = readdir($open)) !== false) {
if (is_dir("$delete/$filename") && $filename != "." && $filename != "..") {
unlink ("$delete/$filename/forum.php");
unlink ("$delete/$filename/array.php");
if (is_file("$delete/$filename/pollinfo.php")) {
unlink ("$delete/$filename/pollinfo.php");
}
if (is_file("$delete/$filename/error_log")) {
unlink ("$delete/$filename/error_log");
}
rmdir("$delete/$filename");
}
if (is_file("$delete/$filename") && $filename != "." && $filename != "..") {
unlink ("$delete/$filename");
}
}
closedir($open);
rmdir($delete);

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?divisionoptions_check=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Deleted Division $deldivision</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Division <i>$deldivision</i> has been deleted.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");

$divarrayfile = "divisionarray.php";
$Open = fopen ($divarrayfile,"r");
if ($Open) {
$divarray = file($divarrayfile);
}
fclose ($Open);

for ($i=0; $i < count($divarray); $i++) {
if (ereg("\\\$$delete ", $divarray[$i])) {
$divarray[$i] = "";
} 
}


$Open = fopen ($divarrayfile, "w");
if ($Open) {
for ($i=0; $i < count($divarray); $i++) {
if ($divarray[$i] != "") {
fwrite ($Open, "$divarray[$i]");
}
}
fclose ($Open);
}

exit("");
}
}
if (!is_dir($delete)) {

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Cannot Find Division $deldivision</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Division <i>$deldivision</i> cannot be found.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");

}

exit("");
}

if ($oldnamedivision) {

require "divisionarray.php";

$stupidslash = "\\\'";
$stupidslash2 = '\\"';
$slashquote = "'";
$slashquote2 = '"';
$oldnamedivision = ereg_replace($slashquote, '\'', $oldnamedivision);
$oldnamedivision = ereg_replace($slashquote2, '\"', $oldnamedivision);
$renamedivision = ereg_replace('\$', "\\\$", $renamedivision);

$oldnamediv = ereg_replace("[[:punct:]]", "", $oldnamedivision);
$oldnamediv = ereg_replace("( )","_", $oldnamediv);

$renamediv = ereg_replace("[[:punct:]]", "", $renamedivision);
$renamediv = ereg_replace("( )","_", $renamediv);


for($i=0; $i < count($divisions); $i++) {
if ($divisions[$i][0] == "$oldnamediv/topicdisplay.php") {
$discription = $divisions[$i][2];
$discription = ereg_replace($slashquote2, $stupidslash2, $discription);
$discription = ereg_replace('\$', "\\\$", $discription);
}
}

$stupidslash = "\\\'";
$stupidslash2 = '\\\"';

if ($oldnamediv !== "") {
$divarrayfile = "divisionarray.php";
$Open = fopen ($divarrayfile,"r");
if ($Open) {
$divarray = file($divarrayfile);
}
fclose ($Open);

for ($i=0; $i < count($divarray); $i++) {
if (ereg($oldnamediv, $divarray[$i])) {
$divarray[$i] = ereg_replace("\\\${$oldnamediv}", "\${$renamediv}", $divarray[$i]);
}
if (ereg("\"$oldnamediv/topicdisplay.php\"", $divarray[$i]) == 1) {
$divarray[$i] = "<?PHP \$divisions[] = array (\"$renamediv/topicdisplay.php\", \"$renamedivision\", \"$discription\", \"require\"); /* \$$renamediv */ ?>\n";
$found = 1;
}
}
}

if ($found == 1 && is_dir($renamediv)) {
print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?divisionoptions_check=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Division Cannot Be Renamed</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>The new name you have chosen already exists as a different division
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");

$found = 0;

exit("");
}

if ($found) {

rename($oldnamediv, $renamediv);

$oldnamedivision = ereg_replace("\\\'", $slashquote, $oldnamedivision);
$oldnamedivision = ereg_replace('\\\"', $slashquote2, $oldnamedivision);

$Open = fopen ($divarrayfile, "w");
if ($Open) {
for ($i=0; $i < count($divarray); $i++) {
fwrite ($Open, "$divarray[$i]");
}
fclose ($Open);
}

$topicsfile = "$renamediv/topicsarray.php";

$Open = fopen ($topicsfile,"r");
if ($Open) {
$toparray = file($topicsfile);
}
fclose ($Open);

for ($i=0; $i < count($toparray); $i++) {
if (ereg("divisionname =", $toparray[$i])) {
$toparray[$i] = "\$divisionname = '$renamedivision';";
}
}

$Open = fopen ($topicsfile, "w");
if ($Open) {
for ($i=0; $i < count($toparray); $i++) {
fwrite ($Open, "$toparray[$i]");
}
fclose ($Open);
}

$oldnamedivision = ereg_replace($stupidslash, "'", $oldnamedivision);
$oldnamedivision = ereg_replace($stupidslash2, '"', $oldnamedivision);
$renamedivision = ereg_replace($stupidslash, "'", $renamedivision);
$renamedivision = ereg_replace($stupidslash2, '"', $renamedivision);

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?divisionoptions_check=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Division has been Renamed</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Division <i>$oldnamedivision</i> has been renamed to <i>$renamedivision</i>.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
}

if (!$found) {
$stupidslash = "\\\'";
$stupidslash2 = '\\\"';
$stupidslash2_ = '\\\"';

$oldnamedivision = ereg_replace($stupidslash, "'", $oldnamedivision);
$oldnamedivision = ereg_replace($stupidslash2, '"', $oldnamedivision);
$oldnamedivision = ereg_replace($stupidslash2_, '"', $oldnamedivision);

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Division cannot be Found</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Division <i>$oldnamedivision</i> cannot be found.
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
}
exit("");
}


$newdivision = ereg_replace('\$', "\\\$", $newdivision);
$divisionnme = ereg_replace("[[:punct:]]", "", $newdivision);
$divisionnme = ereg_replace("( )","_", $divisionnme);
$stupidslash = "\\\'";
$stupidslash2 = '\\\"';

require "divisionarray.php";
$filedir = "$divisionnme/topicsarray.php";

if (file_exists($filedir)) {

$divdescription = ereg_replace('\$', "\\\$", $divdescription);
$newdivision = ereg_replace($stupidslash, "'", $newdivision);
$newdivision = ereg_replace($stupidslash2, '"', $newdivision);
$divdescription = ereg_replace($stupidslash, "'", $divdescription);
$divdescription = ereg_replace($stupidslash2, '"', $divdescription);

print ("
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Unable to Create Division $newdivision</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Division <i>$newdivision</i> already exists.<BR>Please use another name.
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

mkdir($divisionnme, 0777);

$divdescription = ereg_replace($stupidslash, "'", $divdescription);
$divdescription = ereg_replace('\$', "\\\$", $divdescription);

$Open = fopen ("$divisionnme/topicsarray.php", "a");
if ($Open) {
fwrite ($Open, "<?PHP
\$divisionname = '$newdivision';
\$topics = array();
?>
");
fclose($Open);
}
chmod("$divisionnme/topicsarray.php", 0777);

copy("topicdisplay.php", "$divisionnme/topicdisplay.php");
chmod("$divisionnme/topicdisplay.php", 0777);

$required = "require";

if ($requirelogin == "yes") {
$required = "norequire";
}

$sfzdivisionnum = count($divisions);
$Open = fopen ("divisionarray.php","a+");
if ($Open) {
fwrite($Open, "<?PHP \$divisions[] = array (\"$divisionnme/topicdisplay.php\", \"$newdivision\", \"$divdescription\", \"$required\"); /* $$divisionnme */ ?>\n");
fclose($Open);
}

$newdivision = ereg_replace($stupidslash2, '"', $newdivision);
$newdivision = ereg_replace($stupidslash, "'", $newdivision);
$newdivision = ereg_replace("[\\]", "", $newdivision);

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=webmastercontrols.php?divisionoptions_check=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Created Division $newdivision</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Division <i>$newdivision</i> has been created.
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

if ($passinarray != $passwrd) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Couldn't Log In</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"create.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\"><BR>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\">
<INPUT TYPE=\"hidden\" name=\"division\" value=\"$division\">
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
if ($passinarray == $passwrd) {
if ($pollsubmitted) {
$topicsubmitted = "1";
}
if ($topicsubmitted) {
$typeoftopic = "Topic";
if ($pollsubmitted) {
$typeoftopic = "Poll";
}
if ($topicname != "") {
if ($pollsubmitted) {
if ($question == "" || $PollVal[0] == "") {
$noshow = 1;
}

for ($b=0; $b < 6; $b++) {
if ($b > 1) {
if ($PollVal[$b]) {
for ($i=0; $i < $b; $i++) {
if ($PollVal[$i] == "") {
$noshow = 1;
}
}
}
}
}

}
if (!$noshow) {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=$division/topicdisplay.php\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$typeoftopic Created</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>$typeoftopic has been created.</B>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
}
}
}
if (!$topicsubmitted && !$pollsubmitted) {

print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Create New Topic</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<DIV ALIGN=\"Center\">
<FORM ACTION=\"create.php\" METHOD=\"Post\">
<BR>
<B>Topic Name:</B> <INPUT TYPE=\"text\" name=\"topicname\"><BR><BR>
<TEXTAREA name=\"message\" cols=\"60\" rows=\"16\"></TEXTAREA><BR>
");
if ($topictype == "yes") {
print ("
<BR><FONT SIZE=2><B>Content Category:</B><BR>
<INPUT TYPE=\"radio\" Name=\"TopicType\" Value=\"General Discussion\" CHECKED>General Discussion 
<INPUT TYPE=\"radio\" Name=\"TopicType\" Value=\"Notice\">Notice 
<INPUT TYPE=\"radio\" Name=\"TopicType\" Value=\"<B>Important</B>\"><B>Important</B>
<BR>
<INPUT TYPE=\"radio\" Name=\"TopicType\" Value=\"Gallery\">Gallery 
<INPUT TYPE=\"radio\" Name=\"TopicType\" Value=\"Game\">Game
<INPUT TYPE=\"radio\" Name=\"TopicType\" Value=\"Journal\">Journal
");
}
print ("
<INPUT TYPE=\"hidden\" name=\"division\" value=\"$division\"><BR><BR>
<INPUT TYPE=\"hidden\" name=\"topicsubmitted\" value=\"1\">
<INPUT TYPE=\"hidden\" name=\"username\" value=\"$username\">
<INPUT TYPE=\"hidden\" name=\"password\" value=\"$password\">
<B>Read-Only (No Posting) <INPUT TYPE=\"checkbox\" Name=\"readonly\" Value=\"yes\"><BR><BR>
<INPUT CLASS=\"Button\" TYPE=\"submit\" Value=\"Create Topic\">
</FORM>
</DIV>
</td>
</tr>
</table>
</div>
</body>
</html>
");
}
if ($topicsubmitted) {

$topicname = ereg_replace('\$', "\\\$", $topicname);

if ($topicname == "" || $message == "") {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Incomplete Form</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">You have not completed the form.
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

if ($pollsubmitted) {
$advice = "";
$timer_1 = "2";
if (!$PollVal[0]) {
$advice = "You have either forgotten to add any poll choices,<BR>or you have not begun listing the choices at the first box.";
$timer_1 = "6";
$damaged = 1;
}
for ($b=0; $b < 6; $b++) {
if ($b > 1) {
if ($PollVal[$b]) {
for ($i=0; $i < $b; $i++) {
if ($PollVal[$i] == "") {
$advice = "You cannot have empty boxes between your choices.<BR>Please try again.";
$damaged = 1;
}
}
}
}
}
if ($topicname == "" || $question == "" || $damaged) {
print ("
<html>
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"$timer_1; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Error</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Poll form is incomplete or incorrectly filled out.<BR>$advice</B>
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



chdir($division);
srand ((double) microtime() * 1000000);
$random = rand(1,999);
$topicnme = ereg_replace("[[:punct:]]", "", $topicname);
$topicnme = ereg_replace("( )","_", $topicnme);
$topicnme .= $random;

$stupidslash = "\\\'";
$topicname = ereg_replace($stupidslash, "'", $topicname);
$message = ereg_replace($stupidslash, "'", $message);
$message = ereg_replace("\n", "<BR>", $message);

$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$aliasinarray = ${$usrname}["Alias"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];

mkdir($topicnme, 0777);

//New Post

$Open = fopen ("../users/$usrname/userspecs.php", "r");
$userspecs = file("../users/$usrname/userspecs.php");
fclose($Open);

$datecondensed = date ("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$datecondensed = date("m/d/y ").$hour.date(":i:sa");
}

require "../users/$usrname/userspecs.php";

$numwords = explode(" ", $message);
$numwords = count($numwords);

$tp_canceled = $postlength*$totalposts;

$tp_canceled += $numwords;
$userspecs[7] = "\$postlength = $tp_canceled/\$totalposts;\n";

$userspecs[12] = "\$lastpostdate = \"$datecondensed\";\n";

$Open = fopen("../users/$usrname/userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

//End of New Post

//Poll Info Creator

$stupidslash = "\\\'";
$stupidslash2 = '\\\"';

if ($pollsubmitted) {

if ($Open = fopen("$topicnme/pollinfo.php", "w+")) {
fwrite ($Open, "<?PHP \$thequestion = \"$question\"; ?>");
fwrite ($Open, "\n<?PHP \$numofvotes = \"0\"; ?>");
if ($PollVal[0] != "") {
$PollVal[0] = ereg_replace('\$', "\\\$", $PollVal[0]);
fwrite ($Open, "\n<?PHP \$choice1 = \"$PollVal[0]\"; ?>");
fwrite ($Open, "\n<?PHP \$votes1 = \"0\"; ?>");
}

if ($PollVal[1] != "") {
$PollVal[1] = ereg_replace('\$', "\\\$", $PollVal[1]);
fwrite ($Open, "\n<?PHP \$choice2 = \"$PollVal[1]\"; ?>");
fwrite ($Open, "\n<?PHP \$votes2 = \"0\"; ?>");
}

if ($PollVal[2] != "") {
$PollVal[2] = ereg_replace('\$', "\\\$", $PollVal[2]);
fwrite ($Open, "\n<?PHP \$choice3 = \"$PollVal[2]\"; ?>");
fwrite ($Open, "\n<?PHP \$votes3 = \"0\"; ?>");
}

if ($PollVal[3] != "") {
$PollVal[3] = ereg_replace('\$', "\\\$", $PollVal[3]);
fwrite ($Open, "\n<?PHP \$choice4 = \"$PollVal[3]\"; ?>");
fwrite ($Open, "\n<?PHP \$votes4 = \"0\"; ?>");
}

if ($PollVal[4] != "") {
$PollVal[4] = ereg_replace('\$', "\\\$", $PollVal[4]);
fwrite ($Open, "\n<?PHP \$choice5 = \"$PollVal[4]\"; ?>");
fwrite ($Open, "\n<?PHP \$votes5 = \"0\"; ?>");
}

if ($PollVal[5] != "") {
$PollVal[5] = ereg_replace('\$', "\\\$", $PollVal[5]);
fwrite ($Open, "\n<?PHP \$choice6 = \"$PollVal[5]\"; ?>");
fwrite ($Open, "\n<?PHP \$votes6 = \"0\"; ?>");
}
}
fclose($Open);

@chmod("$topicnme/pollinfo.php", 0777);

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");

$Open = fopen ("../users/$usrname/userspecs.php", "r");
$userspecs = file("../users/$usrname/userspecs.php");
fclose($Open);

require "../users/$usrname/userspecs.php";

$totalpolls = $totalpolls+1;
$userspecs[5] = "\$totalpolls = \"$totalpolls\";\n";

$totalposts = $totalposts+1;
$userspecs[3] = "\$totalposts = \"$totalposts\";\n";

$Open = fopen("../users/$usrname/userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

}
//End of Poll Info Creator

if ($topicsubmitted && !$pollsubmitted) {
$Open = fopen ("../users/$usrname/userspecs.php", "r");
$userspecs = file("../users/$usrname/userspecs.php");
fclose($Open);

require "../users/$usrname/userspecs.php";

$totaltopics = $totaltopics+1;
$userspecs[4] = "\$totaltopics = \"$totaltopics\";\n";

$totalposts = $totalposts+1;
$userspecs[3] = "\$totalposts = \"$totalposts\";\n";

$Open = fopen("../users/$usrname/userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);
}

copy("../forum.php","$topicnme/forum.php");
@chmod("$topicnme/forum.php", 0777);

$uno = ereg_replace("( )", "_", $userinarray);
$uno = strtolower("u0000$uno");

if ($readonly != "yes") {
$readonly = "no";
}

$message = ereg_replace('\$', "\\\$", $message);

$Open = fopen ("$topicnme/array.php","a+");
if ($Open) {
fwrite($Open, "
<?PHP
\$subject = \"$topicname\";
\$subjectfolder = \"$topicnme\";
\$locked = \"no\";
\$nopost = \"$readonly\";
\$post0 = array (\"<B>Full Name:</B> $fullnameinarray\", \"<B>Username:</B> <A HREF=../../users/$uno/user.php?profile=1><FONT COLOR=\$secondarylinkcolor>$aliasinarray</FONT></A>\", \"<B>Position:</B> $positioninarray\", \"<B>Date:</B> $todaysdate\", \"<B>Post #:</B> 1\", \"$message\", \"$scrumpy\", \"$epoch\");
\$posts[0] = \$post0;
?>
");
if ($TopicType == "Journal") {
fwrite($Open, "\n<?PHP \$journalpost = \"$userinarray\"; ?>\n");
}
}
fclose ($Open);

$Open = fopen ("topicsarray.php","a+");
if ($Open) {

$thistopic = date("U");
if (!$TopicType) {
$TopicType  = "General Discussion";
}
if ($TopicType == "Journal") {
$TopicType = "$aliasinarray's Journal";
}

$epoch = date("U");

fwrite($Open, "<?PHP \$topics[] = array (\"$topicname\", \"$TopicType\", \"<B>Last Post by:</B> <A HREF=../users/$uno/user.php?profile=1>$aliasinarray</A>\", \"<B>Created on:</B> $datecondensed\", \"<B>Created by:</B> <A HREF=../users/$uno/user.php?profile=1>$aliasinarray</A>\", \"<B>Posts:</B> 1\", \"<B>Posts in Last Hour:</B> 0\", \"$topicnme\", \"<B>Last Post on:</B> $datecondensed\", \"no\", \"$epoch\");?>\n");
}
fclose ($Open);

}
}
?>
<?PHP
if ($deletethisdir) {
if (is_dir($deletethisdir)) {
if ($open = opendir($deletethisdir)) {
while (($filename = readdir($open)) !== false) {
if ($filename != "." && $filename != "..") {
unlink ("$deletethisdir/$filename");
}
}
closedir($open);
rmdir($delete);
echo "$deletethisdir Deleted.";
}
}
if (!is_dir($deletethisdir)) {
echo "$deletethisdir is not a Directory.";
}
}
?>