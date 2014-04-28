<?PHP
require "users/users.php";

$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];

$passwrd = md5(crypt($password, $userinarray));

require "specs.php";



if ($manage) {
$comnamecondensed = ereg_replace("( )", "_", $comcentername);
$comnamecondensed = strtolower($comnamecondensed);
$cookiename = $comnamecondensed."_themecookie"."_$usrname";

$$cookiename = "$manage";
}

if (!$default && $multiplethemes == "yes") {
require "themes.php";
}

$root = 1;
require "menuinsert.php";

if ($positioninarray != "Member" && $positioninarray != "Suspended" && $passinarray == $passwrd) {

//Edit & Delete Themes

if ($deletetheme) {

$Open = fopen("themes.php", "r");
$th_f = file("themes.php");
fclose($Open);

for ($i=0; $i < count($th_f); $i++) {
if (ereg("== \"$deletetheme\"", $th_f[$i])) {
$th_f[$i-1] = "";
$c=0;
while ($c < 21) {
$th_f[$i+$c] = "";
$c++;
}
}
}

$Open2 = fopen ("themes.php", "w+");
if ($Open2) {
for ($i=0; $i < count($th_f); $i++) {
fwrite ($Open2, "$th_f[$i]");
}
fclose ($Open2);
}

header("Location: themecontrols.php?managethemes=1");
exit("");
}

if ($manage) {

print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><A HREF=\"themecontrols.php?managethemes=1\"><-Back to Edit/Delete Themes</A><BR><BR><B>Editing Theme</B><BR><BR>
");
              print ("<form name=\"newtheme\" action=\"themecontrols.php\">\n");
              print ("<b><font size=\"2\">Background Color:</font></b>\n");
              print ("<input type=text name=fbgcolor value=$bgcolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\"><b>Primary Foreground (Table) Color: </b></font>\n"); 
              print ("<input type=\"text\" name=\"ftablecolor\" value=$tablecolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\"><b>Secondary Foreground (Table) Color: </b></font>\n"); 
              print ("<input type=\"text\" name=\"fsecondarytablecolor\" value=$secondarytablecolor>\n");
              print ("<br>\n");
              print ("<b><font size=\"2\">Primary Foreground Text Color: </font></b>\n"); 
              print ("<input type=\"text\" name=\"ftextcolor\" value=$textcolor>\n");
              print ("<br>\n");
              print ("<b><font size=\"2\">Secondary Foreground Text Color: </font></b>\n"); 
              print ("<input type=\"text\" name=\"fsecondarytextcolor\" value=$secondarytextcolor>\n");
              print ("<br>\n");
              print ("<BR><B><FONT SIZE=\"2\">Color Scheme For Links on Primary Foreground:</FONT></B><BR><font size=\"2\">Unvisited Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"flinkcolor\" value=$linkcolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\">Visited Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"fvlinkcolor\" value=$vlinkcolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\">Active Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"falinkcolor\" value=$alinkcolor>\n");
              print ("<br><BR>\n");
              print ("<font size=\"2\"><B>Link Color for Secondary Foreground:</B> </font>\n");
              print ("<input type=\"text\" name=\"fsecondarylinkcolor\" value=$secondarylinkcolor><BR>\n");
              print ("<BR><BR><font size=\"2\"><B>Navigation Menu Image URL's</font><BR><BR>\n");
			print ("Banner: <INPUT TYPE=\"text\" name=\"banner_graphic\" size=40 value=\"$banner_g\"><BR>");
			print ("Log-In: <INPUT TYPE=\"text\" name=\"login_graphic\" size=40 value=\"$login_g\"><BR>");
			print ("Log-Out: <INPUT TYPE=\"text\" name=\"logout_graphic\" size=40 value=\"$logout_g\"><BR>");
			print ("The Forum: <INPUT TYPE=\"text\" name=\"forum_graphic\" size=40 value=\"$forum_g\"><BR>");
			print ("Current Members: <INPUT TYPE=\"text\" name=\"currentmembers_graphic\" size=40 value=\"$currentmembers_g\"><BR>");
			print ("Your Account: <INPUT TYPE=\"text\" name=\"youraccount_graphic\" size=40 value=\"$youraccount_g\"><BR>");
			print ("Sign Up: <INPUT TYPE=\"text\" name=\"signup_graphic\" size=40 value=\"$signup_g\"><BR>");
              print ("<INPUT TYPE=\"hidden\" NAME=\"themeedited\" VALUE=\"$manage\">");
              print ("<br>\n");
              print ("<INPUT CLASS=\"Button\" TYPE=\"submit\" name=\"Submit\" value=\"Modify\">\n");
              print ("</form>\n");

print ("
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


if ($themeedited) {

$Open = fopen("themes.php", "r");
$th_f = file("themes.php");
fclose($Open);

for ($i=0; $i < count($th_f); $i++) {
if (ereg("== \"$themeedited\"", $th_f[$i])) {
$th_f[$i+1] = "\$bgcolor=\"$fbgcolor\";\n";
$th_f[$i+2] = "\$textcolor=\"$ftextcolor\";\n";
$th_f[$i+3] = "\$tablecolor=\"$ftablecolor\";\n";
$th_f[$i+4] = "\$secondarytablecolor=\"$fsecondarytablecolor\";\n";
$th_f[$i+5] = "\$linkcolor=\"$flinkcolor\";\n";
$th_f[$i+6] = "\$vlinkcolor=\"$fvlinkcolor\";\n";
$th_f[$i+7] = "\$alinkcolor=\"$falinkcolor\";\n";
$th_f[$i+8] = "\$secondarytextcolor=\"$fsecondarytextcolor\";\n";
$th_f[$i+9] = "\$secondarylinkcolor=\"$fsecondarylinkcolor\";\n";
$th_f[$i+10] = "\$banner_g=\"$banner_graphic\";\n";
$th_f[$i+11] = "\$signup_g=\"$signup_graphic\";\n";
$th_f[$i+12] = "\$currentmembers_g=\"$currentmembers_graphic\";\n";
$th_f[$i+13] = "\$youraccount_g=\"$youraccount_graphic\";\n";
$th_f[$i+14] = "\$forum_g=\"$forum_graphic\";\n";
$th_f[$i+15] = "\$login_g=\"$login_graphic\";\n";
$th_f[$i+16] = "\$logout_g=\"$logout_graphic\";\n";
}
}

$Open2 = fopen ("themes.php", "w+");
if ($Open2) {
for ($i=0; $i < count($th_f); $i++) {
fwrite ($Open2, "$th_f[$i]");
}
fclose ($Open2);
}

header("Location: themecontrols.php?manage=$themeedited");
exit("");
}


if ($managethemes) {

print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"350\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><A HREF=\"themecontrols.php\"><-Back to Theme Controls</A><BR><BR><B>Edit/Delete Themes</B><BR><BR>
");
print ("
<FONT SIZE=2><B>Current Themes:</B><BR><BR>
");

if ($themearray) {
foreach ($themearray as $value) {
$valuecond = ereg_replace("[[:punct:]]", "", $value);
$valuecond = ereg_replace("( )", "_", $valuecond);

$value = ereg_replace('\\\"', '"', $value);
$value = ereg_replace("\\\'", "'", $value);
print ("<A HREF=\"themecontrols.php?manage=$valuecond\">$value</A> (<A HREF=\"themecontrols.php?deletetheme=$valuecond\">Delete</A>)<BR>");
}
}

print ("</FONT>");
print ("
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

//End of Edit & Delete Themes

//Color Scheme

if ($colorschemesubmitted) {

if (!$fbgcolor || !$ftextcolor || !$ftablecolor || !$fsecondarytablecolor || !$flinkcolor || !$fvlinkcolor || !$falinkcolor || !$fsecondarytextcolor || !$fsecondarylinkcolor) {

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
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>You have left one or more boxes empty.</B>
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

$Open = fopen ("specs.php","r");
if ($Open) {
$specifics = file("specs.php");
}
fclose ($Open);

$specifics[2]="\$bgcolor=\"$fbgcolor\";\n";
$specifics[3]="\$textcolor=\"$ftextcolor\";\n";
$specifics[4]="\$tablecolor=\"$ftablecolor\";\n";
$specifics[5]="\$secondarytablecolor=\"$fsecondarytablecolor\";\n";
$specifics[6]="\$linkcolor=\"$flinkcolor\";\n";
$specifics[7]="\$vlinkcolor=\"$fvlinkcolor\";\n";
$specifics[8]="\$alinkcolor=\"$falinkcolor\";\n";
$specifics[27]="\$secondarytextcolor=\"$fsecondarytextcolor\";\n";
$specifics[38]="\$secondarylinkcolor=\"$fsecondarylinkcolor\";\n";

$Open2 = fopen ("specs.php", "w+");
if ($Open2) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open2, "$specifics[$i]");
}
fclose ($Open2);
}

header("Location: themecontrols.php?default=1");
exit("");
}

//End of Color Scheme

//Image Upload

if ($imageuploaded) {

if(!empty($_FILES["File"])) {
$filename = $File_name;
$filesize = $_FILES['File']['size']; 
$filetype = $File_type;
$filetemp = $File_name;
if ($filesize == 0 || !$imgplace) {
print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Whoops!</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>You have not selected a file.</B>
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
if ($File_size > 100000) {
print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>File too Large</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>This image exceeded the 100Kb limit.</B>
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
if ($filetype != 'image/jpeg' && $filetype != 'image/gif' && $filetype != 'image/jpeg' && $filetype != 'image/pjpeg') {
print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=javascript:history.back()\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>File Type Error</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>This file is not a JPG, JPEG, or GIF image.</B>
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
unlink($$imgplace);
if (copy ($File, "structure-images/$filename")) {
$filetoopen = "specs.php";
$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

if ($imgplace == "banner_g") {
$specnum = 10;
}
if ($imgplace == "signup_g") {
$specnum = 11;
}
if ($imgplace == "currentmembers_g") {
$specnum = 12;
}
if ($imgplace == "youraccount_g") {
$specnum = 13;
}
if ($imgplace == "forum_g") {
$specnum = 14;
}
if ($imgplace == "login_g") {
$specnum = 15;
}
if ($imgplace == "logout_g") {
$specnum = 16;
}

$specifics[$specnum] = "\$$imgplace=\"structure-images/$filename\";\n";

$Open2 = fopen ($filetoopen, "w+");
if ($Open2) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open2, "$specifics[$i]");
}
}
fclose ($Open2);

print ("
<HEAD>
<META HTTP-EQUIV=Refresh CONTENT=\"2; URL=themecontrols.php?default=1\"> 
</HEAD>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Image Upload Successful</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\">
<BR><BR><BR><BR><B>Image Upload Successful!
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
}

//End of Image Upload

//Multiple Theme Option
if ($multiplesubmitted) {

$Open = fopen ("specs.php", "r");
if ($Open) {
$specifics = file("specs.php");
}
fclose ($Open);

$specifics[54]="\$multiplethemes=\"$multiple_themes\";\n";

$Open = fopen ("specs.php", "w+");
if ($Open) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open, "$specifics[$i]");
}
}
fclose ($Open);

header("Location: themecontrols.php");
exit("");
}

}
//End of Multiple Theme Option

if ($positioninarray == "Member" || $positioninarray == "Suspended") {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>You do not have access to this option.</B>
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

if ($positioninarray == "Administrator" || $positioninarray = "Moderator") {

$mt_no = "";
$mt_yes = "";
if ($multiplethemes == "yes") {
$mt_yes = "CHECKED";
}
if ($multiplethemes == "no") {
$mt_no = "CHECKED";
}

//Main Theme Page
if (!$createtheme && !$managethemes && !$default && !$newthemesubmitted) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><B>Theme Options</B><BR><BR>
<FORM ACTION=\"themecontrols.php\" METHOD=\"Post\">
<INPUT TYPE=\"radio\" NAME=\"multiple_themes\" VALUE=\"no\" $mt_no> One Theme &nbsp;&nbsp;
<INPUT TYPE=\"radio\" NAME=\"multiple_themes\" VALUE=\"yes\" $mt_yes> Multiple Themes<BR><BR>
<INPUT TYPE=\"hidden\" NAME=\"multiplesubmitted\" VALUE=\"1\">
<INPUT TYPE=\"submit\" CLASS=\"button\" VALUE=\"Apply\">
</FORM>
<BR><A HREF=\"themecontrols.php?default=1\"><B>Default Theme<B></A><BR>
");

if ($multiplethemes == "yes") {
print ("<BR><A HREF=\"themecontrols.php?createtheme=1\"><B>Create New Theme</B></A>");
if ($themearray) {
print ("<BR><A HREF=\"themecontrols.php?managethemes=1\"><B>Edit/Delete Themes</B></A>");
}
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
exit("");
}
//End of Main Theme Page

//New Theme Submitted

if ($newthemesubmitted) {

if (!$newthemename || !$fbgcolor || !$ftextcolor || !$ftablecolor || !$fsecondarytablecolor || !$flinkcolor || !$fvlinkcolor || !$falinkcolor || !$fsecondarytextcolor || !$fsecondarylinkcolor || !$banner_graphic || !$login_graphic || !$logout_graphic || !$forum_graphic || !$signup_graphic || !$currentmembers_graphic || !$youraccount_graphic) {

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
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>You have left one or more boxes empty.</B>
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

$themefile = "themes.php";
$comnamecondensed = ereg_replace("( )", "_", $comcentername);
$comnamecondensed = strtolower($comnamecondensed);
$cookiename = $comnamecondensed."_themecookie";

$newthemenamecond = ereg_replace("[[:punct:]]", "", $newthemename);
$newthemenamecond = ereg_replace("( )", "_", $newthemenamecond);

$newthemename = ereg_replace('\$', "\\\$", $newthemename);

$Open = fopen($themefile, "a+");
fwrite($Open, "<?PHP\n");
fwrite($Open, "if (\${\$cookiename} == \"$newthemenamecond\") {\n");
fwrite($Open, "\$bgcolor=\"$fbgcolor\";\n");
fwrite($Open, "\$textcolor=\"$ftextcolor\";\n");
fwrite($Open, "\$tablecolor=\"$ftablecolor\";\n");
fwrite($Open, "\$secondarytablecolor=\"$fsecondarytablecolor\";\n");
fwrite($Open, "\$linkcolor=\"$flinkcolor\";\n");
fwrite($Open, "\$vlinkcolor=\"$fvlinkcolor\";\n");
fwrite($Open, "\$alinkcolor=\"$falinkcolor\";\n");
fwrite($Open, "\$secondarytextcolor=\"$fsecondarytextcolor\";\n");
fwrite($Open, "\$secondarylinkcolor=\"$fsecondarylinkcolor\";\n");
fwrite($Open, "\$banner_g=\"$banner_graphic\";\n");
fwrite($Open, "\$signup_g=\"$signup_graphic\";\n");
fwrite($Open, "\$currentmembers_g=\"$currentmembers_graphic\";\n");
fwrite($Open, "\$youraccount_g=\"$youraccount_graphic\";\n");
fwrite($Open, "\$forum_g=\"$forum_graphic\";\n");
fwrite($Open, "\$login_g=\"$login_graphic\";\n");
fwrite($Open, "\$logout_g=\"$logout_graphic\";\n");
fwrite($Open, "\$themeexists = \"yes\";\n");
fwrite($Open, "}\n");
fwrite($Open, "\$themearray[] = \"$newthemename\";\n");
fwrite($Open, "?>\n");
fclose($Open);

header("Location: themecontrols.php");
exit("");
}

//End of New Theme Submitted

//Create New Theme

if ($createtheme) {

print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><A HREF=\"themecontrols.php\"><-Back To Theme Options</A><BR><BR><B>Create New Theme</B><BR><BR>
");

              print ("<form name=\"newtheme\" action=\"themecontrols.php\">\n");
              print ("<b>Theme Name:</b> \n");
              print ("<input type=text name=\"newthemename\"><BR><BR>\n");
              print ("<b><font size=\"2\">Background Color:</font></b>\n");
              print ("<input type=text name=fbgcolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\"><b>Primary Foreground (Table) Color: </b></font>\n"); 
              print ("<input type=\"text\" name=\"ftablecolor\">\n");
              print ("<br>\n");
              print ("<font size=\"2\"><b>Secondary Foreground (Table) Color: </b></font>\n"); 
              print ("<input type=\"text\" name=\"fsecondarytablecolor\"\>\n");
              print ("<br>\n");
              print ("<b><font size=\"2\">Primary Foreground Text Color: </font></b>\n"); 
              print ("<input type=\"text\" name=\"ftextcolor\"\>\n");
              print ("<br>\n");
              print ("<b><font size=\"2\">Secondary Foreground Text Color: </font></b>\n"); 
              print ("<input type=\"text\" name=\"fsecondarytextcolor\"\>\n");
              print ("<br>\n");
              print ("<BR><B><FONT SIZE=\"2\">Color Scheme For Links on Primary Foreground:</FONT></B><BR><font size=\"2\">Unvisited Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"flinkcolor\">\n");
              print ("<br>\n");
              print ("<font size=\"2\">Visited Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"fvlinkcolor\">\n");
              print ("<br>\n");
              print ("<font size=\"2\">Active Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"falinkcolor\">\n");
              print ("<br><BR>\n");
              print ("<font size=\"2\"><B>Link Color for Secondary Foreground:</B> </font>\n");
              print ("<input type=\"text\" name=\"fsecondarylinkcolor\"><BR>\n");
              print ("<BR><BR><font size=\"2\"><B>Navigation Menu Image URL's</font><BR><BR>\n");
			print ("Banner: <INPUT TYPE=\"text\" name=\"banner_graphic\" size=40><BR>");
			print ("Log-In: <INPUT TYPE=\"text\" name=\"login_graphic\" size=40><BR>");
			print ("Log-Out: <INPUT TYPE=\"text\" name=\"logout_graphic\" size=40><BR>");
			print ("The Forum: <INPUT TYPE=\"text\" name=\"forum_graphic\" size=40><BR>");
			print ("Current Members: <INPUT TYPE=\"text\" name=\"currentmembers_graphic\" size=40><BR>");
			print ("Your Account: <INPUT TYPE=\"text\" name=\"youraccount_graphic\" size=40><BR>");
			print ("Sign Up: <INPUT TYPE=\"text\" name=\"signup_graphic\" size=40><BR>");
              print ("<INPUT TYPE=\"hidden\" NAME=\"newthemesubmitted\" VALUE=\"1\">");
              print ("<br>\n");
              print ("<INPUT CLASS=\"Button\" TYPE=\"submit\" name=\"Submit\" value=\"Apply\">\n");
              print ("</form>\n");


exit("");
}

//End of Create New Theme

//Default Theme

if ($default) {
print ("
<html>
<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>Theme Controls</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><A HREF=\"themecontrols.php\"><-Back To Theme Options</A><BR><BR><B>Default Theme</B><BR><BR>
");

              print ("<form name=\"newtheme\" action=\"themecontrols.php\">\n");
              print ("<b><font size=\"2\">Background Color:</font></b>\n");
              print ("<input type=text name=fbgcolor value=$bgcolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\"><b>Primary Foreground (Table) Color: </b></font>\n"); 
              print ("<input type=\"text\" name=\"ftablecolor\" value=$tablecolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\"><b>Secondary Foreground (Table) Color: </b></font>\n"); 
              print ("<input type=\"text\" name=\"fsecondarytablecolor\" value=$secondarytablecolor>\n");
              print ("<br>\n");
              print ("<b><font size=\"2\">Primary Foreground Text Color: </font></b>\n"); 
              print ("<input type=\"text\" name=\"ftextcolor\" value=$textcolor>\n");
              print ("<br>\n");
              print ("<b><font size=\"2\">Secondary Foreground Text Color: </font></b>\n"); 
              print ("<input type=\"text\" name=\"fsecondarytextcolor\" value=$secondarytextcolor>\n");
              print ("<br>\n");
              print ("<BR><B><FONT SIZE=\"2\">Color Scheme For Links on Primary Foreground:</FONT></B><BR><font size=\"2\">Unvisited Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"flinkcolor\" value=$linkcolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\">Visited Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"fvlinkcolor\" value=$vlinkcolor>\n");
              print ("<br>\n");
              print ("<font size=\"2\">Active Link Color: </font>\n"); 
              print ("<input type=\"text\" name=\"falinkcolor\" value=$alinkcolor>\n");
              print ("<br><BR>\n");
              print ("<font size=\"2\"><B>Link Color for Secondary Foreground:</B> </font>\n");
              print ("<input type=\"text\" name=\"fsecondarylinkcolor\" value=$secondarylinkcolor><BR>\n");
              print ("<INPUT TYPE=\"hidden\" NAME=\"colorschemesubmitted\" VALUE=\"1\">");
              print ("<br>\n");
              print ("<INPUT CLASS=\"Button\" TYPE=\"submit\" name=\"Submit\" value=\"Apply\">\n");
              print ("</form>\n");
			print ("<BR><BR><B>Default Image Upload</B><BR><BR>");
			print ("<FORM ACTION=\"themecontrols.php\" METHOD=\"Post\" ENCTYPE=\"multipart/form-data\">");
			print ("<FONT SIZE=2><B>Image Position in Navigation Menu:</B></FONT><BR>");
			print ("
<FONT SIZE=2><INPUT TYPE=\"radio\" NAME=\"imgplace\" VALUE=\"banner_g\" CHECKED> Banner 
<INPUT TYPE=\"radio\" NAME=\"imgplace\" VALUE=\"login_g\"> Log-In 
<INPUT TYPE=\"radio\" NAME=\"imgplace\" VALUE=\"logout_g\"> Log-Out 
<INPUT TYPE=\"radio\" NAME=\"imgplace\" VALUE=\"forum_g\"> The Forum 
<INPUT TYPE=\"radio\" NAME=\"imgplace\" VALUE=\"currentmembers_g\"> Current Members 
<INPUT TYPE=\"radio\" NAME=\"imgplace\" VALUE=\"youraccount_g\"> Your Account 
<INPUT TYPE=\"radio\" NAME=\"imgplace\" VALUE=\"signup_g\">Sign Up<BR><BR>
<INPUT TYPE=\"hidden\" NAME=\"imageuploaded\" VALUE=\"1\">
Image to Upload: <INPUT TYPE=\"File\" NAME=\"File\"></FONT> <INPUT CLASS=\"button\" TYPE=\"submit\" VALUE=\"Upload\"><BR><BR>
");

print ("
<FONT SIZE=2><B>Current Images in Navigation Menu:</B><BR><BR>
<B>Banner:</B> $banner_g<BR>
<B>Log-In:</B> $login_g<BR>
<B>Log-Out:</B> $logout_g<BR>
<B>The Forum:</B> $forum_g<BR>
<B>Current Members:</B> $currentmembers_g<BR>
<B>Your Account:</B> $youraccount_g<BR>
<B>Sign Up:</B> $signup_g<BR>
</FONT><BR><BR>
");

print ("
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
//End of Default Theme
}
?>