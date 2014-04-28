<?php
require "specs.php";
require "users/users.php";

if ($multiplethemes == "yes") {
require "themes.php";
}
?>
<HTML>
<HEAD>
<TITLE>
Edit Your Post or Add Comments
</TITLE>
<?php
if ($postedited || $postcomment) {
$usrname = ereg_replace("( )", "_", $username);
$usrname = strtolower("u0000$usrname");
$userinarray = ${$usrname}["Username"];
$passwrd = md5(crypt($password, $userinarray));
if ($wikisend)
{
$wikiopt = "?shootup=1";
}
print ("
<SCRIPT TYPE=\"text/javascript\">
opener.document.location = \"$selectarray/forum.php$wikiopt\";
window.close();
</SCRIPT>
");
}
?>
<STYLE TYPE="text/css">
BODY
{
<?php
print ("
scrollbar-arrow-color: $tablecolor;
scrollbar-track-color: $bgcolor;
scrollbar-face-color: $bgcolor;
scrollbar-highlight-color: $tablecolor;
scrollbar-3dlight-color: $tablecolor;
scrollbar-darkshadow-color: $tablecolor;
scrollbar-shadow-color: $tablecolor;

}

.Button {
background-color:$secondarytablecolor;
border-color:$textcolor;
color:$secondarytextcolor;
font-size: 10;
}

TEXTAREA {
background: $tablecolor;
border: thin;
border-style : solid;
color: $textcolor;
font-family: \"Times New Roman\";
font-size: 14;
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
<?php
require "$selectarray/array.php";
require "users/users.php";
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

$uno = ereg_replace("( )", "_", $username);
$uno = strtolower("u0000$uno");
$userinarray = ${$uno}["Username"];
$aliasinarray = ${$uno}["Alias"];

if (${$usrname}["Password"] == $passwrd) {
$msg = ereg_replace("\n", "<BR>", $msg);
$msg = ereg_replace('\$', "\\\$", $msg);
if ($comment) {
$comment = ereg_replace("\n", "<BR>", $comment);
$comment = ereg_replace('\$', "\\\$", $comment);
}
$Open = fopen ("$selectarray/array.php","a+");
if ($Open && $postedited) {
fwrite ($Open, "\n<?php
\$posts[$post][5] = \"$msg<BR><BR><SPANYouWillNeverGuess><FONT SIZE=2>[Modified by <A HREF=../../users/$uno/user.php?profile=1>$aliasinarray</A> on $datecondensed]</FONT>\";\n
\$posts[$post][3] = \"<B>Date:</B> $todaysdate\";
?>\n");
fclose ($Open);
print ("
<body bgcolor=\"$tablecolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\"><br><BR><BR><BR><BR><B>Post <B>$postdisplay</B> has been modified.</div>
");
}
if ($Open && $postcomment) {
fwrite ($Open, "\n<?php
\$posts[$post][5] = \"$msg<BR><BR><FONT SIZE=2><B>Comment from <A HREF=../../users/$uno/user.php?profile=1>$aliasinarray</A>:</B><BR><BR>$comment</FONT>\";\n
\$posts[$post][3] = \"<B>Date:</B> $todaysdate\";
?>\n");
fclose ($Open);
print ("
<body bgcolor=\"$tablecolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\"><br><BR><BR><BR><BR><B>You have commented on post <B>$postdisplay</B>.</div>
");
}
}
$postdisplay = $post+1;
if (!$postedited) {
$stupidslash = "\\\'";
$stupidslash2 = "\\\"";
$thepreviousdate = ereg_replace("<B>Date:</B> ", "", $posts[$post][3]);

$therevisedpost = $posts[$post][5];

$arrayedprev = explode("<BR>", $therevisedpost);
for ($i=0; $i < count($arrayedprev); $i++) {
if (ereg("<SPANYouWillNeverGuess>", $arrayedprev[$i])) {
$arrayedprev[$i] = "";
}
}

$therevisedpost = implode("<BR>", $arrayedprev);

$therevisedpost = ereg_replace("<BR><BR><FONT SIZE=2>\[Modified on $thepreviousdate\]</FONT>", "", $therevisedpost);
$therevisedpost = ereg_replace($stupidslash, "'", $therevisedpost);
$therevisedpost = ereg_replace($stupidslash2, "\"", $therevisedpost);
$therevisedpost = ereg_replace("<BR>", "\n", $therevisedpost);
if ($option == 1) {
print ("<body bgcolor=\"$bgcolor\" text=\"$tablecolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\"><br>
          <form name=\"form1\" action=\"posteditor.php\" METHOD=\"post\">
            Editing Post <B>$postdisplay</B><BR><BR>
            <TEXTAREA name=\"msg\" cols=\"60\" rows=\"16\">$therevisedpost</TEXTAREA><BR>
            <INPUT CLASS=\"Button\" TYPE=\"submit\" name=\"Submit\" value=\"          Submit Modified Post          \">
            <input type=\"hidden\" name=\"postedited\" value=\"1\">
            <input type=\"hidden\" name=\"postdisplay\" value=\"$postdisplay\">
            <input type=\"hidden\" name=\"selectarray\" value=\"$selectarray\">
            <input type=\"hidden\" name=\"post\" value=\"$post\">
");
if ($wikisend)
{
print ("<input type=\"hidden\" name=\"wikisend\" value=\"1\">");
}
print ("
          </form>
        </div>
</div>
");
}
if ($option == 2) {
print ("<body bgcolor=\"$bgcolor\" text=\"$tablecolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">
<div align=\"center\"><br>
          <form name=\"form1\" action=\"posteditor.php\" METHOD=\"post\">
            Commenting on Post <B>$postdisplay</B><BR><BR>
            <TEXTAREA name=\"msg\" cols=\"60\" rows=\"8\" READONLY>$therevisedpost</TEXTAREA><BR>
            <TEXTAREA name=\"comment\" cols=\"60\" rows=\"8\">(Comment goes here, delete this)</TEXTAREA><BR>
            <INPUT CLASS=\"Button\" TYPE=\"submit\" name=\"Submit\" value=\"          Add Comment          \">
            <input type=\"hidden\" name=\"postcomment\" value=\"1\">
            <input type=\"hidden\" name=\"postdisplay\" value=\"$postdisplay\">
            <input type=\"hidden\" name=\"selectarray\" value=\"$selectarray\">
            <input type=\"hidden\" name=\"post\" value=\"$post\">
          </form>
        </div>
</div>
");
}
}
?>
</BODY>
</HTML>