<?PHP
require "users/users.php";

if ($isolateuser) {
setcookie ("onlyuser", "$isolateuser");
}

if ($deisolateuser) {
setcookie ("onlyuser", "");
}

if ($username) {

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
$passwrd = md5(crypt($password, $userinarray));
if ($passinarray == $passwrd) {
setcookie ("username", "$username");
setcookie ("password", "$password");
}

}

require "divisionarray.php";
require "specs.php";

if ($multiplethemes == "yes") {
require "themes.php";
}

$root = "1";

require "menuinsert.php";

$header = "<html>\n<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">";
?>
<?PHP
if ($allowvisitors == "no") {
if (!$username && !$password) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$comcentername Divisions</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Please Log In:<BR>
<FORM NAME=\"loginform\" ACTION=\"divisiondisplay.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\"><BR>
<SCRIPT TYPE=\"text/javascript\">
document.loginform.username.focus();
</SCRIPT>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\">
<BR><BR><input class=\"Button\" type=\"submit\" value=\"Log In\">
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
<?PHP
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];

$passwrd = md5(crypt($password, $userinarray));

if ($positioninarray == "Banned") {
$passwrd = "if your password equals this after being encrypted and all that stuff, then you have more than luck. You have fate on your side.";
}

if ($username) {
if ($passinarray != $passwrd) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$comcentername Divisions</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect.</FONT>
<BR><BR>Please Log In:<BR>
<FORM NAME=\"loginform\" ACTION=\"divisiondisplay.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\" style=\"$tbox_style\"><BR>
<SCRIPT TYPE=\"text/javascript\">
document.loginform.username.focus();
</SCRIPT>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\" style=\"$tbox_style\">
<BR><BR><input class=\"Button\" type=\"submit\" value=\"Log In\">
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
<?PHP
if ($passinarray == $passwrd || $allowvisitors == "yes") {

//Last Visit Info-Giver

if ($passinarray == $passwrd) {
$Open = fopen("users/$usrname/userspecs.php", "r");
$userspecs = file("users/$usrname/userspecs.php");
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

for($i=0; $i < count($userspecs); $i++) {
if (ereg("lastvisitdate =", $userspecs[$i])) {
$userspecs[$i] = "\$lastvisitdate = \"$datecondensed\";\n";
}
}

$Open = fopen("users/$usrname/userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);
}

//End of Last Visit Info-Giver

print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$comcentername Divisions</b></div>
      </td>
    </tr>
");

if ($onlyuser || $isolateuser) {
$onlyusr = ereg_replace("( )", "_", $isolateuser);
$onlyusr = strtolower("u0000$onlyusr");
$onlyuseralias = ${$onlyusr}["Alias"];
if ($deisolateuser == "") {
print ("
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><FONT SIZE=2><b>Displaying Only Posts by $onlyuseralias (<A HREF=\"divisiondisplay.php?deisolateuser=1\">Switch Off</A>)</b></FONT></div>
      </td>
    </tr>
");
}
}
if ($deisolateuser) {
print ("
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><FONT SIZE=2><b>Display Mode Returned to Normal</b></FONT></div>
      </td>
    </tr>
");
}

if (!$username) {
print ("
<TR bordercolor =\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" bordercolor=\"$tablecolor\">
<DIV ALIGN=\"center\">
<BR>User Log In:<BR>
<FORM NAME=\"loginform\" ACTION=\"divisiondisplay.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\" style=\"$tbox_style\"><BR>
<SCRIPT TYPE=\"text/javascript\">
document.loginform.username.focus();
</SCRIPT>
<B>Password:</B> <INPUT TYPE=\"password\" name=\"password\" size=\"13\" style=\"$tbox_style\">
<BR><BR><input class=\"Button\" type=\"submit\" value=\"Log In\">
</FORM>
</TD>
</TR>
");
}

for ($i=0; $i < count($divisions); $i++) {

$stupidslash_ = "\\\'";
$divisions[$i][1] = ereg_replace($stupidslash_, "'", $divisions[$i][1]);

$displayit = "no";

if ($passinarray == $passwrd) {
$displayit = "yes";
}

if ($divisions[$i][3]) {
if ($divisions[$i][3] == "require") {
if ($passinarray == $passwrd) {
$displayit = "yes";
}
}
if ($divisions[$i][3] == "norequire") {
$displayit = "yes";
}
}

print ("
<TR bordercolor =\"$tablecolor\" valign=\"top\">
<TD bgcolor=\"$tablecolor\" bordercolor=\"$tablecolor\">
<DIV ALIGN=\"center\">
<BR>
");
if ($displayit == "yes") {
print ("
<A HREF=\"{$divisions[$i][0]}\"><B>{$divisions[$i][1]}</B></A>
");
}
if ($displayit != "yes") {
print ("
<B>{$divisions[$i][1]}</B><BR><FONT SIZE=2><i>Log-In Required</i></FONT><BR>
");
}
if ($divisions[$i][2] != "") {
print ("
<BR><FONT SIZE=\"2\">{$divisions[$i][2]}</FONT>
");

$displayit = "no";
}

print ("
<BR><BR>
</DIV>
</TD>
</TR>
");

}

print ("
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