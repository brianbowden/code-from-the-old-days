<html>
<head>
<title>New User</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$todaysdate = date ("g:ia, l F j, Y");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$todaysdate = $hour.date(":i:sa, l F j, Y");
}

require ("specs.php");
require ("users/users.php");

if ($multiplethemes == "yes") {
if ($username) {
require "themes.php";
}
}

$root = 1;
require ("menuinsert.php");

print ("<body bgcolor=\"$bgcolor\" text=\"$textcolor\">\n");
print ("<div align=\"center\">");
print ("$menu");
print ("<table width=618 align=center border=1 cellspacing=2 cellpadding=3 height=421 bordercolor=\"$bgcolor\">\n");
print ("<tr bordercolor=\"$tablebordercolor\">\n"); 
print ("<td height=23 bgcolor=\"$tablecolor\">\n");
print ("<div align=\"center\"><b>Create A New User</b></div>\n");
print ("</td>\n");
print ("</tr>\n");
print ("<tr bordercolor=\"$tablebordercolor\" valign=\"top\">\n");
print ("<td height=393 bgcolor=\"$tablecolor\">\n");
$message = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please insert your full name, desired username and password,<br>and your current e-mail address into the form below:";
if ($newuser_submitted) {
$nobad = "([^[:alnum:][:space:]])";
$nobad_email = "^([0-9a-z]+)([0-9a-z\.-_]+)@([ 0-9a-z\.-_]+)\.([0-9a-z]+)";
if (eregi($nobad, $fullname)) {
$message = "<B><FONT COLOR=red>Sorry, but your full name included some invalid characters.<BR>Please try again.</FONT></B>";
$damaged = "yes";
}
if (eregi($nobad, $usrname)) {
$message = "<B><FONT COLOR=red>Sorry, but your chosen username included some invalid characters.<BR>Please try again.</FONT></B>";
$damaged = "yes";
}
if (eregi($nobad, $passwordmod)) {
$message = "<B><FONT COLOR=red>Sorry, but your chosen password included some invalid characters.<BR>Please try again.</FONT></B>";
$damaged = "yes";
}
if (eregi($nobad_email, $email) == 0) {
$message = "<B><FONT COLOR=red>Sorry, but your e-mail address included some invalid characters, or was invalid in form.<BR>Please try again.</FONT></B>";
$damaged = "yes";
}

if ($fullname == "" || $usrname == "" || $passwordmod == "" || $email == "") {
if ($fullname == "") {
$bad = "Full Name";
}
if ($usrname == "") {
$bad = "Username";
}
if ($passwordmod == "") {
$bad = "Password";
}
if ($email == "") {
$bad = "E-mail";
}
$message = "<B><FONT COLOR=red>Sorry, but the <i>$bad</i> box was left empty</FONT></B>";
$damaged = "yes";
}

if ($admitted) {
$send = "no";
}


$username = $usrname;

if (!$users) {
$position = "Administrator";

$filetoopen = "specs.php";

$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

$specifics[19]="\$send=\"yes\";\n";
$specifics[22]="\$admin_username = \"$username\";\n";
$specifics[23]="\$admin_email = \"$email\";\n";

$Open = fopen ($filetoopen, "w+");
if ($Open) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open, "$specifics[$i]");
}
}
fclose ($Open);
}



$usrname = ereg_replace("( )", "_", $usrname);
$usrname = strtolower($usrname);

$usrname = "u0000$usrname";

if ($$usrname) {
$message = "<FONT COLOR=red><B>Sorry, but the username you have chosen has already been taken.<BR>Please try again.</B></FONT>";
$damaged = "yes";
}
if ($usrname == "mailbot") {
$message = "<FONT COLOR=red><B>Sorry, but the username you have chosen is invalid due to the nature of this program.<BR>Please try again.</B></FONT>";
$damaged = "yes";
}

if ($damaged != "yes") {
$savepass = $passwordmod;
$compilation = "$passwordmod$username";
$password = md5(crypt($passwordmod, $username));

$myfavoritefile = "users/users.php";
if (!(is_writeable ($myfavoritefile))) {
mkdir ("users/", 0777);
}
$Open = fopen ($myfavoritefile, "a+");
if ($Open) {
if ($send == "no") {
fwrite ($Open, "<?php\n\$$usrname = array (");
$UN = "Username";
$PW = "Password";
$EM = "Email";
$PN = "Position";
$FN = "Full_Name";
fwrite ($Open, "\"$UN\"=>\"$username\", \"$PW\"=>\"$password\", \"$EM\"=>\"$email\", \"$PN\"=>\"$position\", \"$FN\"=>\"$fullname\", \"Alias\"=>\"$username\");\n");
fwrite ($Open, "\$users[] = \$$usrname;\n");
fwrite ($Open, "?>\n");
$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= "From: NewUserNotice@Forum\r\n";
$admitted_message = "Greetings $fullname:<BR><BR>You have become a member of $comcentername.<BR>
<B>Your Username:</B> $username<BR><B>Your Position:</B> $position<BR><BR>Please visit your profile page to make any customizations.
<BR><BR>- $comcentername MailBot";
mail($email, "You Have Become a Member of $comcentername", $admitted_message, $header);
}
fclose ($Open);

if ($send == "no") {
chmod("users", 0777);
mkdir("users/$usrname", 0777);
chmod("users/$usrname", 0777);
copy("user.php", "users/$usrname/user.php");
chmod("users/$usrname/user.php", 0777);
copy("useredit.php", "users/$usrname/useredit.php");
chmod("users/$usrname/useredit.php", 0777);
copy("userspecs.php", "users/$usrname/userspecs.php");
chmod("users/$usrname/userspecs.php", 0777);
copy("mailbag.php", "users/$usrname/mailbag.php");
chmod("users/$usrname/mailbag.php", 0777);

$Open = fopen("users/$usrname/userspecs.php", "r");
$userspecs = file("users/$usrname/userspecs.php");
fclose($Open);

$userspecs[1] = "\$user = \$$usrname;\n";

$current_time = date("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$current_time = date("m/d/y ").$hour.date(":i:sa");
}


$userspecs[18] = "\$signedupdate = \"$current_time\";\n";

$Open = fopen("users/$usrname/userspecs.php", "w+");
foreach ($userspecs as $line) {
fwrite ($Open, "$line");
}
fclose($Open);

$recipient = ereg_replace("( )", "_", $usrname);
$recipient = strtolower($recipient);

$Open = fopen ("users/$recipient/mailbag.php", "a");
fwrite ($Open, "<?php \$messages[] = array (\"Welcome!\", \"Mailbot\", \"$current_time\", \"Greetings $fullname:<BR><BR>You have become a member of $comcentername.<BR><BR>Feel free to make any customizations.\", \"u_n_read\"); ?>\n");
fclose($Open);
}

if ($notifyadmin == "yes" || $send == "yes") {
if ($position != "Administrator") {
$admin_message = "<HTML><BODY>Greetings Administrator $admin_name:<BR><BR>A new user has signed up to $comcentername.<BR><BR><B>Full Name:</B> $fullname<BR><B>Username:</B> $username<BR><B>Position:</B> $position<BR><B>E-mail:</B> $email<BR><BR><B>Date:</B> $todaysdate<BR>";
if ($send == "yes") {
$scripturl = $_SERVER["SERVER_NAME"];
$scripturl .= $_SERVER["SCRIPT_NAME"];
$admin_message .= "<BR><A HREF='http://$scripturl?usrname=$username&passwordmod=$savepass&email=$email&position=$position&admitted=1&newuser_submitted=1&fullname=$fullname'><B>Admit As User</B></A><BR><BR>- $comcentername MailBot</BODY></HTML>";
}
if ($send == "no") {
$admin_message .= "<BR>- $comcentername MailBot</BODY></HTML>";
}

if ($send == "yes" || $notifyadmin = "yes") {

require "specs.php";

$admin_user = ereg_replace("( )", "_", $admin_username);
$admin_user = strtolower($admin_user);

$current_time = date("m/d/y g:i:sa");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$current_time = date("m/d/y ").$hour.date(":i:sa");
}

$admin_usr = strtolower($admin_user);
$admin_usr = ereg_replace("( )", "_", "u0000$admin_usr");

if ($position != "Administrator") {
$Open = fopen ("users/$admin_usr/mailbag.php", "a");
fwrite ($Open, "<?php \$messages[] = array (\"---New User---\", \"Mailbot\", \"$current_time\", \"$admin_message\", \"u_n_read\"); ?>\n");
fclose($Open);
}
}

$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= "From: NewUserNotice@Forum\r\n";
mail($admin_email, "New User Notice", $admin_message, $header);
}
}
}
}
}
?>
        <div align="center">
          <p>&nbsp;</p>
          <p align="center">
          <?php
if ($admitted) {
$message = "<BR><BR><BR><BR><B>$username has become a member of $comcentername.</B>.";
}
if ($newuser_submitted) {
if ($send == "yes" && $damaged != "yes") {
$message = "<BR><BR><BR><BR><B>You have applied for membership of $comcentername.<BR>You will be notified via e-mail when you are accepted.</B>";
}
if ($send == "no" && $damaged != "yes" && $admitted != "1") {
$message = "<BR><BR><BR><BR><B>$fullname, you are now a member of $comcentername.<BR><BR>You may now Log In";
}
}
          print ("$message");
          ?>
          </p>
<?php
if (!$newuser_submitted) {
print ("
          <p align=\"center\">&nbsp;</p>
          <p align=\"center\"><b>----New User Form----</b></p>
          <p align=\"center\"><font size=\"2\"><i>Note: Please use only the characters 
            a-z, A-Z, and the underscore (&quot;_&quot;) in your username and 
            password. </i></font></p>
          <form name=\"form1\" action=\"newuser.php\" >
            <p>Full Name: 
              <input type=\"text\" name=\"fullname\"> <FONT SIZE=\"2\"><i>Example: John Smith</i></FONT>
              <br>
              Desired Username: 
              <input type=\"text\" name=\"usrname\" size=\"13\" maxlength=\"13\"> <FONT SIZE=\"2\"><i>Use only letters, dashes, underscores, or spaces</i></FONT>
              <br>
              Desired Password: 
              <input type=\"password\" name=\"passwordmod\" size=\"13\" maxlength=\"13\"> <FONT SIZE=\"2\"><i>Use only letters, dashes, underscores, and spaces</i></FONT>
              <br>
              E-mail: 
              <input type=\"text\" name=\"email\"> <FONT SIZE=\"2\"><i>Example: jsmith@domain.com</i></FONT>
              <input type=\"hidden\" name=\"position\" value=\"Member\">
              <input type=\"hidden\" name=\"newuser_submitted\" value=1>
            </p>
            <p>
              <INPUT CLASS=\"Button\" TYPE=\"submit\" name=\"Submit\" value=\"Submit\">
            </p>
          </form>");
}
?>
        </div>
      </td>
    </tr>
  </table>

</div>
</body>
</html>