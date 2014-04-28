<?PHP
require "users/users.php";
require "specs.php";

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
$positioninarray = ${$usrname}["Position"];
$passwrd = md5(crypt($password, $userinarray));

if ($passinarray == $passwrd) {
if (!$logout) {
setcookie ("username", "$username");
setcookie ("password", "$password");
}
}
if ($logout) {
setcookie ("username", "", time()-3600, "/");
setcookie ("password", "", time()-3600, "/");
setcookie ("username", "");
setcookie ("password", "");
header("Location: log.php?logout_2=1");
exit("");
}

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

if ($multiplethemes == "yes") {
require "themes.php";
}

$root = "1";

require "menuinsert.php";

$header = "<html>\n<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">";

if (!$username && !$password && !$logout) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$comcentername Log Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Log In:<BR>
<FORM ACTION=\"log.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\"><BR>
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

if ($passinarray != $passwrd && !$logout || $positioninarray == "Banned") {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$comcentername Log Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect.</FONT>
<BR><BR>Log In:<BR>
<FORM ACTION=\"log.php\" METHOD=\"post\">
<B>Username:</B> <INPUT TYPE=\"text\" name=\"username\" size=\"13\" style=\"$tbox_style\"><BR>
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

if ($passinarray == $passwrd && !$logout) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$comcentername Log Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><BR>You are now <B>Logged In</B>
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