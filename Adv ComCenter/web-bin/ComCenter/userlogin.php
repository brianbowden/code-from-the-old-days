<?PHP
require "users/users.php";
require "specs.php";

if ($multiplethemes == "yes") {
require "themes.php";
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

$root = 1;
require "menuinsert.php";

$usrname = ereg_replace("( )", "_", "u0000$username");
$usrname = strtolower($usrname);
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$positioninarray = ${$usrname}["Position"];
$passwrd = md5(crypt($password, $userinarray));
if ($passinarray == $passwrd) {
setcookie ("username", "");
setcookie ("password", "");
setcookie ("username", "$username");
setcookie ("password", "$password");
}

$header = "<html>\n<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">";

if ($positioninarray == "Banned") {
$passwrd = "if your password equals this after being encrypted and all that stuff, then you have more than luck. You have fate on your side.";
}

if ($passinarray == $passwrd) {
header("Location: users/$usrname/useredit.php?profile=1");
exit(""); 
}

if (!$username && !$password) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Your Account</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Please Log In:<BR>
<FORM ACTION=\"userlogin.php\" METHOD=\"post\">
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

if ($passinarray != $passwrd) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Your Account</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"userlogin.php\" METHOD=\"post\">
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