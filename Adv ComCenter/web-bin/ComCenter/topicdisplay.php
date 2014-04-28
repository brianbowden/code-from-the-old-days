<?php

$theepoch = date("U");
$currentdir = getcwd();
$currentdir = split("/", $currentdir);
$currentdir_num = count($currentdir);
$currentdir = $currentdir[$currentdir_num];

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
}

$yourcookie = "lasttime_".$usrname;
$lasttime = $$yourcookie;

if ($lasttime) {
$_lasttime = $lasttime;
}
setcookie ("lasttime_$usrname", "", time()-"10000000", "$currentdir");
setcookie ("lasttime_$usrname", "$theepoch", time()+"10000000", "$currentdir");

require "../specs.php";
require "topicsarray.php";
require "../users/users.php";

if ($multiplethemes == "yes") {
require "../themes.php";
}

$header = "<html>\n<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">";

$oneup = 1;
require "../menuinsert.php";

$epochnow = date("U");

$divisionnme = ereg_replace("[[:punct:]]", "", $divisionname);
$divisionnme = ereg_replace("( )","_", $divisionnme);


$stupidslash_ = '\\\"';
$divisionname = ereg_replace($stupidslash_, '"', $divisionname);
$stupidslash_ = "\\\'";
$divisionname = ereg_replace($stupidslash_, "'", $divisionname);
?>
<?php
if ($allowvisitors == "no") {
if (!$username && !$password) {
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$divisionname</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B>Please Log In:<BR>
<FORM ACTION=\"topicdisplay.php\" METHOD=\"post\">
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
if ($username) {
$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$passinarray = ${$usrname}["Password"];
$userinarray = ${$usrname}["Username"];
$aliasinarray = ${$usrname}["Alias"];
$fullnameinarray = ${$usrname}["Full_Name"];
$positioninarray = ${$usrname}["Position"];

if ($positioninarray == "Administrator" || $positioninarray == "Moderator") {
if ($privileges == "Off") {
$positioninarray = "Member";
}
}

$passwrd = md5(crypt($password, $userinarray));
} //

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
        <div align=\"center\"><b>$divisionname</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<div align=\"Center\"><BR><BR><BR><B><FONT COLOR=\"red\">Sorry, But either your username or password was incorrect.</FONT>
<BR><BR>Please Log In:<BR>
<FORM ACTION=\"topicdisplay.php\" METHOD=\"post\">
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

$todaysdate = date ("g:i:sa, l F j, Y");

$st = date("I");
if ($st == 1) {
$hour = date("g")+1;
if ($hour == 13) {
$hour = 1;
}
$todaysdate = $hour.date(":i:sa, l F j, Y");
}

if ($passinarray == $passwrd || $allowvisitors == "yes") {
$colspan = "COLSPAN=\"4\"";
if ($showtoplaston == "no" && $showtoplastpost == "no" && $showtoppostshour == "no" && $showtopnumposts == "no" && $showtopcreatedon == "no" && $showtopcreatedby == "no") {
$showtopinfo = "no";
$colspan = "";
}
print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$secondarytablecolor\">
      <td height=\"23\" bgcolor=\"$secondarytablecolor\" $colspan>
        <div align=\"center\"><FONT SIZE=4 COLOR=\"$secondarytextcolor\">$divisionname</FONT><BR><FONT SIZE=2>
");
if ($positioninarray != "Suspended") {
if ($username) {
print ("
<A HREF=\"../create.php?division=$divisionnme\"><FONT COLOR=\"$secondarylinkcolor\"><B>Create Topic</B></FONT></A> <FONT COLOR=\"$secondarytextcolor\">|</FONT> <A HREF=\"../pollcreator.php?division=$divisionnme\"><FONT COLOR=\"$secondarylinkcolor\"><B>Create Poll</B></FONT></A></FONT>
<BR><FONT SIZE=\"2\" COLOR=\"$secondarytextcolor\">$todaysdate</FONT><BR>");
}
}
print ("
      </div>
      </td>
    </tr>
");

if ($onlyuser) {
$onlyusr = ereg_replace("( )", "_", $onlyuser);
$onlyusr = strtolower("u0000$onlyusr");
$onlyuseralias = ${$onlyusr}["Alias"];
print ("
    <tr bordercolor=\"$tablecolor\">
      <td height=\"23\" bgcolor=\"$tablecolor\" $colspan>
        <div align=\"center\"><FONT SIZE=2><b>Displaying Only Posts by $onlyuseralias (<A HREF=\"../divisiondisplay.php?deisolateuser=1\">Switch Off</A>)</b></FONT></div>
      </td>
    </tr>
");
}

if ($topics) {
$topics = array_reverse($topics);
}

$division_name = ereg_replace("[[:punct:]]", "", $divisionname);
$division_name = ereg_replace("( )","_", $division_name);

$topcount = count($topics);
$topsdivided = $topcount/10;

if (!$begin) {
$begin = 0;
}
if (!$end) {
if ($topsdivided > 1) {
$end = 10;
}
else {
$end = $topcount;
}
}

for ($i=$begin; $i < $end; $i++) {

$rowspan_know = 0;

if ($showtoplastpost == "yes" || $showtoplaston == "yes") {
$rowspan_know = $rowspan_know+1;
$firstrow = 1;
}

if ($showtoppostshour == "yes" || $showtopnumposts == "yes") {
$rowspan_know = $rowspan_know+1;
$secondrow = 1;
}

if ($showtopcreatedon == "yes" || $showtopcreatedby == "yes") {
$rowspan_know = $rowspan_know+1;
$thirdrow = 1;
}

$rowspan_know_code = "ROWSPAN=$rowspan_know";

if ($rowspan_know < 2) {
$rowspan_know_code = "";
}

echo <<<MESSAGE
<TR>
<TD $rowspan_know_code bordercolor="$tablecolor" bgcolor="$tablecolor"><DIV ALIGN="Center"><A HREF="{$topics[$i][7]}/forum.php"><B>{$topics[$i][0]}</B></A>
MESSAGE;

if ($_lasttime) {
if ($topics[$i][10] > $_lasttime) {
print (" &nbsp;&nbsp;<B><FONT SIZE=2>New</FONT></B>");
}
}

if ($showtopcategory == "yes") {
if ($topics[$i][9] == "yes") {
$topics[$i][1] = "<B><FONT SIZE=2>Locked</FONT></B>";
}
print ("
<BR><FONT SIZE=2>{$topics[$i][1]}</FONT>
");
if ($topics[$i][5] == "<B>Posts:</B> 1" || $topics[$i][1] == "$aliasinarray's Journal") {
if (ereg("users/$usrname/user.php", $topics[$i][2])) {
$yours = "yes";
}
}
if ($positioninarray == "Administrator" || $positioninarray == "Moderator" || $yours == "yes") {
print ("
 <FONT SIZE=2>(<A HREF=\"../create2.php?deletetopic=1&topicfolder={$topics[$i][7]}&division=$division_name\">Delete</A>)</FONT>
");
$yours = "no";
}
if ($positioninarray == "Administrator" || $positioninarray == "Moderator") {
if ($topics[$i][9] == "no") {
print ("
 <FONT SIZE=2>(<A HREF=\"../create2.php?locktopic=yes&topicfolder={$topics[$i][7]}&division=$division_name\">Lock</A>)</FONT>
");
}
if ($topics[$i][9] == "yes") {
print ("
 <FONT SIZE=2>(<A HREF=\"../create2.php?locktopic=no&topicfolder={$topics[$i][7]}&division=$division_name\">Unlock</A>)</FONT>
");
}
}
}
if ($positioninarray == "Administrator" || $positioninarray == "Moderator") {
if ($showtopcategory == "no") {
print ("
<BR><FONT SIZE=2>(<A HREF=\"../create2.php?deletetopic=1&topicfolder={$topics[$i][7]}&division=$division_name\">Delete</A>)</FONT>
");
if ($topics[$i][9] == "no") {
print ("
 <FONT SIZE=2>(<A HREF=\"../create2.php?locktopic=yes&topicfolder={$topics[$i][7]}&division=$division_name\">Lock</A>)</FONT>
");
}
if ($topics[$i][9] == "yes") {
print ("
 <FONT SIZE=2>(<A HREF=\"../create2.php?locktopic=no&topicfolder={$topics[$i][7]}&division=$division_name\">Unlock</A>)</FONT>
");
}

}
}

//Topic Page Numbers

$postcount = ereg_replace ("<B>Posts:</B> ", "", $topics[$i][5]);
$postsdivided = $postcount/20;

if ($postsdivided > 1) {

$r = 1;
$begin_t = 0;
$end_t = 20;

print ("<BR><FONT SIZE=2><B>Pages:</B>  ");

while ($postcount > 0) {
print ("<A HREF=\"{$topics[$i][7]}/forum.php?begin=$begin_t&end=$end_t&page=$r\">$r</A> &nbsp;");
$postcount = $postcount-20;
$begin_t = $begin_t+20;
if ($postcount >= 20) {
$end_t = $end_t+20;
}
if ($postcount < 20) {
$end_t = $begin_t + $postcount;
}
$r++;
}

print ("</FONT>");

}

print ("
</DIV></TD>\n
");

//End of Topic Page Numbers

//Row containing "Last Post" Info

$_lastpost = $topics[$i][2];
$_lastpost = ereg_replace("<B>Last Post by:</B>", "", $_lastpost);

$_lastposton = $topics[$i][8];
$_lastposton = ereg_replace("<B>Last Post on:</B>", "", $_lastposton);

if ($rowspan_know > 1) {
$tr_or_td = "<TR>";
}
else {
$tr_or_td = "";
}

if ($showtopinfo != "no") {
if ($showtoplastpost == "yes" || $showtoplaston == "yes") {
print ("\n<TD width=\"70\" bordercolor=\"$secondarytablecolor\" bgcolor=\"$secondarytablecolor\"><FONT COLOR=\"$secondarytextcolor\" SIZE=\"2\"><B>Last Post:</B></FONT></TD>\n");
}
if ($showtoplastpost == "yes") {
$insert = "";
if ($showtoplaston != "yes") {
$insert = "COLSPAN=2";
}
print ("<TD width=\"80\" $insert bordercolor=\"$tablecolor\" bgcolor=\"$tablecolor\"><FONT SIZE=\"2\"><B>$_lastpost</B></FONT></TD>\n");
}
if ($showtoplaston == "yes") {
$insert = "";
if ($showtoplastpost != "yes") {
$insert = "COLSPAN=2";
}
print ("<TD width=\"122\" $insert bordercolor=\"$tablecolor\" bgcolor=\"$tablecolor\"><FONT SIZE=\"2\">$_lastposton</FONT></TD>\n");
}
if ($showtoplastpost == "yes" || $showtoplaston == "yes") {
print ("</TR>\n");
}

//End of Row Containing "Last Post" Info

//Row Containing "Post" Info

if ($showtoppostshour == "yes" || $showtopnumposts == "yes") {
if ($firstrow != 1) {
$tr_or_td = "";
}
print ("$tr_or_td\n<TD width=\"70\" bordercolor=\"$secondarytablecolor\" bgcolor=\"$secondarytablecolor\"><FONT COLOR=\"$secondarytextcolor\" SIZE=\"2\"><B>Total Posts:</B></FONT></TD>\n");
}

if ($showtopnumposts == "yes") {
$insert = "";
if ($showtoppostshour != "yes") {
$insert = "COLSPAN=2";
}
$thepostnumber = ereg_replace("<B>Posts:</B> ", "", $topics[$i][5]);
print ("<TD width=\"80\" $insert bordercolor=\"$tablecolor\" bgcolor=\"$tablecolor\"><FONT SIZE=\"2\"><B>$thepostnumber</B></FONT></TD>\n");
}

if ($showtoppostshour == "yes") {

$insert = "";
if ($showtopnumposts != "yes") {
$insert = "COLSPAN=2";
}

if ($topics[$i][10]-$epochnow <= 3600) {

if ($Open = fopen("{$topics[$i][7]}/array.php", "r")) {
$ta = file("{$topics[$i][7]}/array.php");
}
fclose($Open);

$h=0;
for ($b=0; $b < count($ta); $b++) {
if (preg_match("/\"([0-9]{10,21})\"/", $ta[$b], $refs)) {
$bckrfc = $refs[1];
if ($epochnow-$bckrfc <= 3600) {
$h++;
}
}
}
$topics[$i][6] = "<B>$h</B> in Last Hour";
}
//>

print ("<TD width=\"100\" $insert bordercolor=\"$tablecolor\" bgcolor=\"$tablecolor\"><FONT SIZE=\"2\">{$topics[$i][6]}</FONT></TD>\n");
}


if ($showtoplastpost == "yes" || $showtoplaston == "yes") {
print ("</TR>\n");
}

//End of Row Containing "Post" Info


//Row Containing "Created" Info

if ($showtopcreatedon == "yes" || $showtopcreatedby == "yes") {
if ($secondrow != 1 && $firstrow != 1) {
$tr_or_td = "";
}
print ("$tr_or_td\n<TD width=\"70\" bordercolor=\"$secondarytablecolor\" bgcolor=\"$secondarytablecolor\"><FONT COLOR=\"$secondarytextcolor\" SIZE=\"2\"><B>First Post:</B></FONT></TD>\n");
}

$createdon = ereg_replace("<B>Created on:</B> ", "", $topics[$i][3]);
$createdby = ereg_replace("<B>Created by:</B> ", "", $topics[$i][4]);

if ($showtopcreatedby == "yes") {
$insert = "";
if ($showtopcreatedon != "yes") {
$insert = "COLSPAN=2";
}
print ("<TD width=\"80\" $insert bordercolor=\"$tablecolor\" bgcolor=\"$tablecolor\"><FONT SIZE=\"2\">$createdby</FONT></TD>\n");
}

if ($showtopcreatedon == "yes") {
$insert = "";
if ($showtopcreatedby!= "yes") {
$insert = "COLSPAN=2";
}
print ("<TD width=\"122\" $insert bordercolor=\"$tablecolor\" bgcolor=\"$tablecolor\"><FONT SIZE=\"2\">$createdon</FONT></TD>\n");
}

if ($showtopcreatedby == "yes" || $showtopcreatedon == "yes") {
print ("</TR>\n");
}

//End of Row Containing "Created" Info

}
}

if ($topsdivided > 1) {
print ("
<tr bordercolor=\"$tablecolor\" valign=\"top\">
<td bgcolor=\"$tablecolor\" $colspan>
<div align=\"center\"><B>Pages:</B> 
");
$n = 1;
$begin = 0;
$end = 10;
if (!$page) {
$page = 1;
}
while ($topcount > 0) {
if ($page == $n) {
print ("<B>$n</B> ");
}
if ($page != $n) {
print ("<A HREF=\"topicdisplay.php?begin=$begin&end=$end&page=$n\">$n</A> ");
}
$topcount = $topcount-10;
$begin = $begin+10;
if ($topcount >= 10) {
$end = $end+10;
}
if ($topcount < 10) {
$end = $begin + $topcount;
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
");
print ("
</div>
</body>
</html>
");

}
?>