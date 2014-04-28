<?PHP
//Create & Delete File #2

require "specs.php";
require "users/users.php";

if ($multiplethemes == "yes") {
require "themes.php";
}

$root = 1;
require "menuinsert.php";

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];
$passwrd = md5(crypt($password, $userinarray));

if ($passinarray == $passwrd) {
if ($positioninarray == "Administrator" || "Moderator") {

if ($locktopic) {

if ($locktopic == "yes") {
$Open = fopen ("$division/$topicfolder/array.php", "r");
if ($Open) {
$thearrayarray = file("$division/$topicfolder/array.php");
}
fclose ($Open);
$thearrayarray[4] = "\$locked = \"yes\";\n";
if ($Open = fopen ("$division/$topicfolder/array.php", "w")) {
foreach ($thearrayarray as $value) {
fwrite ($Open, "$value");
}
}
fclose ($Open);

if ($Open = fopen ("$division/topicsarray.php", "r")) {
$thetopicsarray = file("$division/topicsarray.php");
}
fclose($Open);
for ($i=0; $i < count($thetopicsarray); $i++) {
if (ereg("\"$topicfolder\"", $thetopicsarray[$i])) {
$thetopicsarray[$i] = ereg_replace("\"no\"", "\"yes\"", $thetopicsarray[$i]);
}
}
if ($Open = fopen ("$division/topicsarray.php", "w")) {
foreach ($thetopicsarray as $value) {
fwrite ($Open, "$value");
}
}
fclose ($Open);

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=$division/topicdisplay.php\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Topic Locked</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>This topic has been locked</B>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
}

if ($locktopic == "no") {
$Open = fopen ("$division/$topicfolder/array.php", "r");
if ($Open) {
$thearrayarray = file("$division/$topicfolder/array.php");
}
fclose ($Open);
$thearrayarray[4] = "\$locked = \"no\";\n";
if ($Open = fopen ("$division/$topicfolder/array.php", "w")) {
foreach ($thearrayarray as $value) {
fwrite ($Open, "$value");
}
}
fclose ($Open);

if ($Open = fopen ("$division/topicsarray.php", "r")) {
$thetopicsarray = file("$division/topicsarray.php");
}
fclose($Open);
for ($i=0; $i < count($thetopicsarray); $i++) {
if (ereg("\"$topicfolder\"", $thetopicsarray[$i])) {
$thetopicsarray[$i] = ereg_replace("\"yes\"", "\"no\"", $thetopicsarray[$i]);
}
}
if ($Open = fopen ("$division/topicsarray.php", "w")) {
foreach ($thetopicsarray as $value) {
fwrite ($Open, "$value");
}
}
fclose ($Open);

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=$division/topicdisplay.php\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Topic Unlocked</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>This topic has been unlocked</B>
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

if ($deletetopic) {
print ("
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Delete Topic</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Are you sure you want to delete this topic?<BR><BR><A HREF=\"create2.php?deletetopic_yes=1&topicfolder=$topicfolder&division=$division\"><B>Yes</B></A> &nbsp; &nbsp; &nbsp; &nbsp;
<A HREF=\"javascript:history.back()\"><B>No</B></A>
</div>
</td>
</tr>
</table>
</div>
</body>
</html>
");
exit();
}

if ($deletetopic_yes) {

$Open = fopen ("$division/topicsarray.php","r");
if ($Open) {
$topics = file("$division/topicsarray.php");
}
fclose ($Open);

for ($i=0; $i < count($topics); $i++) {
if (ereg("\"$topicfolder\"", $topics[$i])) {
$topics[$i] = "";
$happycheck = 1;
}
}

$Open2 = fopen ("$division/topicsarray.php", "w");
if ($Open2) {
foreach ($topics as $value) {
fwrite($Open2, "$value");
}
}
fclose($Open2);

if ($happycheck) {
unlink ("$division/$topicfolder/forum.php");
unlink ("$division/$topicfolder/array.php");
if (is_file("$division/$topicfolder/pollinfo.php")) {
unlink ("$division/$topicfolder/pollinfo.php");
}
if (is_file("$division/$topicfolder/pollinfo.php")) {
unlink ("$division/$topicfolder/pollinfo.php");
}
if (is_file("$division/$topicfolder/error_log")) {
unlink ("$division/$topicfolder/error_log");
}
rmdir("$division/$topicfolder");
}

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=$division/topicdisplay.php\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Topic has been Deleted</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>This topic has been deleted</B>
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
else {
print ("<B>You have serious problems. Better start heading to ole Mexico.<BR>This file is forbidden to the public, and you tried to open it.</B>");
}
?>