<?PHP
//Poll Creator

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
$datecondensed = date ("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$datecondensed = date("m/d/y ").$hour.date(":i:sa");
}

if ($passinarray == $passwrd) {

print ("
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Create Poll</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><FORM ACTION=\"create.php\" METHOD=\"Post\">
<BR><B>Poll Name:</B> <INPUT TYPE=\"text\" Name=\"topicname\"><BR><BR>
<B>Poll Question:</B> <INPUT TYPE=\"text\" Name=\"question\"><BR><BR>
<B>Please Type in your Poll Choices:<BR><FONT SIZE=\"2\">Not all boxes must be filled.</FONT><BR>
<B>1 <INPUT TYPE=\"text\" Name=\"PollVal[0]\"><BR>
2 <INPUT TYPE=\"text\" Name=\"PollVal[1]\"><BR>
3 <INPUT TYPE=\"text\" Name=\"PollVal[2]\"><BR>
4 <INPUT TYPE=\"text\" Name=\"PollVal[3]\"><BR>
5 <INPUT TYPE=\"text\" Name=\"PollVal[4]\"><BR>
6 <INPUT TYPE=\"text\" Name=\"PollVal[5]\"><BR><BR>
<INPUT TYPE=\"hidden\" NAME=\"TopicType\" Value=\"Poll\">
<INPUT TYPE=\"hidden\" NAME=\"message\" Value=\"Poll began on $datecondensed\">
<INPUT TYPE=\"hidden\" NAME=\"pollsubmitted\" Value=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"division\" Value=\"$division\">
<INPUT CLASS=\"Button\" TYPE=\"submit\" Value=\"Begin Poll\">
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
?>