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

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
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

if ($positioninarray == "Banned") {
$passwrd = "if your password equals this after being encrypted and all that stuff, then you have more than luck. You have fate on your side.";
}

$header = "<html>\n<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">";

if (!$username && !$password) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Current Members</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Please Log In:<BR>
<FORM ACTION=\"currentmembers.php\" METHOD=\"post\">
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
        <div align=\"center\"><b>Current Members</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"currentmembers.php\" METHOD=\"post\">
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

if ($passinarray == $passwrd) {

//Last Visit Info-Giver

$Open = fopen("users/$usrname/userspecs.php", "r");
$userspecs = file("users/$usrname/userspecs.php");
fclose($Open);

$datecondensed = date ("m/d/y g:i:sa");

$st = date("I");
if ($st == 0) {
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

//End of Last Visit Info-Giver

print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\" COLSPAN=\"2\">
        <div align=\"center\"><b>Current Members</b></div>
      </td>
    </tr>
");

for ($i=0; $i < count($users); $i++) {
$pro_username = strtolower($users[$i]["Username"]);
$userlist[] = $pro_username;
}

sort($userlist);

$profilecount = count($users);
$profilesdivided = $profilecount/20;

if (!$begin) {
$begin = 0;
}
if (!$end) {
if ($profilesdivided > 1) {
$end = 20;
}
else {
$end = $profilecount;
}
}

for ($i=$begin; $i < $end; $i++) {

$dirname = $userlist[$i];
$dirname = ereg_replace("( )", "_", $dirname);
$dirname = strtolower("u0000$dirname");
$user_name = ${$dirname}["Alias"];
$user_fullname = ${$dirname}["Full_Name"];
$user_position = ${$dirname}["Position"];

if ($fullnamedisplay == "no") {
$user_fullname = "";
}

if ($user_position != "Banned") {
print ("
<TR><TD bgcolor=\"$tablecolor\" width=\"309\" bordercolor=\"$tablecolor\"><A HREF=\"users/$dirname/user.php?profile=1\"><B>$user_name</B></A><BR></TD>
<TD bgcolor=\"$secondarytablecolor\" width=\"309\" bordercolor=\"$secondarytablecolor\"><DIV ALIGN=\"right\"><FONT COLOR=\"$secondarytextcolor\"><i>$user_fullname</i> &nbsp;$user_position</FONT></DIV></TR>
");
}
if ($positioninarray == "Administrator" && $user_position == "Banned") {
print ("
<TR><TD bgcolor=\"$tablecolor\" width=\"309\" bordercolor=\"$tablecolor\"><A HREF=\"users/$dirname/user.php?profile=1\"><B>$user_name</B></A><BR></TD>
<TD bgcolor=\"$tablecolor\" width=\"309\" bordercolor=\"$tablecolor\"><DIV ALIGN=\"right\"><FONT COLOR=\"$textcolor\"><i>$user_fullname</i> &nbsp;$user_position</FONT></DIV></TR>
");
}
}

if ($profilesdivided > 1) {
print ("
<tr bordercolor=\"$tablecolor\" valign=\"top\">
<td colspan=\"2\" bgcolor=\"$tablecolor\">
<div align=\"center\"><B>Pages:</B> 
");
$n = 1;
$begin = 0;
$end = 20;
if (!$page) {
$page = 1;
}
while ($profilecount > 0) {
if ($page == $n) {
print ("<B>$n</B> ");
}
if ($page != $n) {
print ("<A HREF=\"currentmembers.php?begin=$begin&end=$end&page=$n\">$n</A> ");
}
$profilecount = $profilecount-20;
$begin = $begin+20;
if ($profilecount >= 20) {
$end = $end+20;
}
if ($profilecount < 20) {
$end = $begin + $profilecount;
}
$n++;
}
print ("
</div>
</td>
</tr>
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