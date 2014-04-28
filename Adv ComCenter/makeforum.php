<?PHP

if ($username == "Bicx" && $password == "web") {
if ($forumsubmitted) {

$nobad = "([^[:alnum:][:space:]])";

if (eregi($nobad, $forumname)) {

print ("
<HTML>
<B>You used some wrong characters, and you should've known better!</B><BR>Try again, you failure.<BR><BR>
<FORM ACTION=\"makeforum.php\" METHOD=\"Post\">
<B>Forum Name:</B> <INPUT TYPE=\"text\" NAME=\"forumname\"> (Remember, only letters, numbers, and spaces)<BR><BR>
<INPUT TYPE=\"hidden\" NAME=\"forumsubmitted\" VALUE=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"username\" VALUE=\"Bicx\">
<INPUT TYPE=\"hidden\" NAME=\"password\" VALUE=\"web\">
<INPUT TYPE=\"submit\" VALUE=\"Make Forum\">
</FORM>
</HTML>
");
exit("");
}

$forumnme = ereg_replace("( )", "", $forumname);

if (is_dir($forumnme)) {
print ("
<HTML>
<B>Stupid! That name's already taken!</B><BR>Try again, you complete failure.<BR><BR>
<FORM ACTION=\"makeforum.php\" METHOD=\"Post\">
<B>Forum Name:</B> <INPUT TYPE=\"text\" NAME=\"forumname\"> (Remember, only letters, numbers, and spaces)<BR><BR>
<INPUT TYPE=\"hidden\" NAME=\"forumsubmitted\" VALUE=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"username\" VALUE=\"Bicx\">
<INPUT TYPE=\"hidden\" NAME=\"password\" VALUE=\"web\">
<INPUT TYPE=\"submit\" VALUE=\"Make Forum\">
</FORM>
</HTML>
");
exit("");
}

mkdir("$forumnme", 0777);
chmod("$forumnme", 0777);

mkdir("$forumnme/faces", 0777);
chmod("$forumnme/faces", 0777);

mkdir("$forumnme/structure-images", 0777);
chmod("$forumnme/structure-images", 0777);

mkdir("$forumnme/users", 0777);
chmod("$forumnme/users", 0777);

copy("ComCenter/users/users.php", "$forumnme/users/users.php");
chmod("$forumnme/users/users.php", 0777);

//Faces

copy("ComCenter/faces/wideeyedsmile.gif", "$forumnme/faces/wideeyedsmile.gif");
chmod("$forumnme/faces/wideeyedsmile.gif", 0777);

copy("ComCenter/faces/smirk.gif", "$forumnme/faces/smirk.gif");
chmod("$forumnme/faces/smirk.gif", 0777);

copy("ComCenter/faces/smile.gif", "$forumnme/faces/smile.gif");
chmod("$forumnme/faces/smile.gif", 0777);

copy("ComCenter/faces/sidething.gif", "$forumnme/faces/sidething.gif");
chmod("$forumnme/faces/sidething.gif", 0777);

copy("ComCenter/faces/notsosure.gif", "$forumnme/faces/notsosure.gif");
chmod("$forumnme/faces/notsosure.gif", 0777);

copy("ComCenter/faces/mad.gif", "$forumnme/faces/mad.gif");
chmod("$forumnme/faces/mad.gif", 0777);

copy("ComCenter/faces/frown.gif", "$forumnme/faces/frown.gif");
chmod("$forumnme/faces/frown.gif", 0777);

copy("ComCenter/faces/extatic.gif", "$forumnme/faces/extatic.gif");
chmod("$forumnme/faces/extatic.gif", 0777);

copy("ComCenter/faces/crying.gif", "$forumnme/faces/crying.gif");
chmod("$forumnme/faces/crying.gif", 0777);

copy("ComCenter/faces/bigsmirk.gif", "$forumnme/faces/bigsmirk.gif");
chmod("$forumnme/faces/bigsmirk.gif", 0777);

copy("ComCenter/faces/bigsmile.gif", "$forumnme/faces/bigsmile.gif");
chmod("$forumnme/faces/bigsmile.gif", 0777);

//End of Faces

//Structure Images

copy("ComCenter/structure-images/banner_graphic.gif", "$forumnme/structure-images/banner_graphic.gif");
chmod("$forumnme/structure-images/banner_graphic.gif", 0777);

copy("ComCenter/structure-images/forum.gif", "$forumnme/structure-images/forum.gif");
chmod("$forumnme/structure-images/forum.gif", 0777);

copy("ComCenter/structure-images/linkbox.gif", "$forumnme/structure-images/linkbox.gif");
chmod("$forumnme/structure-images/linkbox.gif", 0777);

copy("ComCenter/structure-images/login.gif", "$forumnme/structure-images/login.gif");
chmod("$forumnme/structure-images/login.gif", 0777);

copy("ComCenter/structure-images/logout.gif", "$forumnme/structure-images/logout.gif");
chmod("$forumnme/structure-images/logout.gif", 0777);

copy("ComCenter/structure-images/members.gif", "$forumnme/structure-images/members.gif");
chmod("$forumnme/structure-images/members.gif", 0777);

copy("ComCenter/structure-images/pollbar.gif", "$forumnme/structure-images/pollbar.gif");
chmod("$forumnme/structure-images/pollbar.gif", 0777);

copy("ComCenter/structure-images/shim.gif", "$forumnme/structure-images/shim.gif");
chmod("$forumnme/structure-images/shim.gif", 0777);

copy("ComCenter/structure-images/signup.gif", "$forumnme/structure-images/signup.gif");
chmod("$forumnme/structure-images/signup.gif", 0777);

copy("ComCenter/structure-images/youraccount.gif", "$forumnme/structure-images/youraccount.gif");
chmod("$forumnme/structure-images/youraccount.gif", 0777);

//End of Structure Images

//Root Files

copy("ComCenter/create.php", "$forumnme/create.php");
chmod("$forumnme/create.php", 0777);

copy("ComCenter/create2.php", "$forumnme/create2.php");
chmod("$forumnme/create2.php", 0777);

copy("ComCenter/currentmembers.php", "$forumnme/currentmembers.php");
chmod("$forumnme/currentmembers.php", 0777);

copy("ComCenter/divisionarray.php", "$forumnme/divisionarray.php");
chmod("$forumnme/divisionarray.php", 0777);

copy("ComCenter/divisiondisplay.php", "$forumnme/divisiondisplay.php");
chmod("$forumnme/divisiondisplay.php", 0777);

copy("ComCenter/forum.php", "$forumnme/forum.php");
chmod("$forumnme/forum.php", 0777);

copy("ComCenter/index.php", "$forumnme/index.php");
chmod("$forumnme/index.php", 0777);

copy("ComCenter/log.php", "$forumnme/log.php");
chmod("$forumnme/log.php", 0777);

copy("ComCenter/mailbag.php", "$forumnme/mailbag.php");
chmod("$forumnme/mailbag.php", 0777);

copy("ComCenter/menuinsert.php", "$forumnme/menuinsert.php");
chmod("$forumnme/menuinsert.php", 0777);

copy("ComCenter/newuser.php", "$forumnme/newuser.php");
chmod("$forumnme/newuser.php", 0777);

copy("ComCenter/pollcreator.php", "$forumnme/pollcreator.php");
chmod("$forumnme/pollcreator.php", 0777);

copy("ComCenter/pollinsert.php", "$forumnme/pollinsert.php");
chmod("$forumnme/pollinsert.php", 0777);

copy("ComCenter/posteditor.php", "$forumnme/posteditor.php");
chmod("$forumnme/posteditor.php", 0777);

copy("ComCenter/specs.php", "$forumnme/specs.php");
chmod("$forumnme/specs.php", 0777);

copy("ComCenter/topicdisplay.php", "$forumnme/topicdisplay.php");
chmod("$forumnme/topicdisplay.php", 0777);

copy("ComCenter/topicsarray.php", "$forumnme/topicsarray.php");
chmod("$forumnme/topicsarray.php", 0777);

copy("ComCenter/themecontrols.php", "$forumnme/themecontrols.php");
chmod("$forumnme/themecontrols.php", 0777);

copy("ComCenter/themes.php", "$forumnme/themes.php");
chmod("$forumnme/themes.php", 0777);

copy("ComCenter/user.php", "$forumnme/user.php");
chmod("$forumnme/user.php", 0777);

copy("ComCenter/useredit.php", "$forumnme/useredit.php");
chmod("$forumnme/useredit.php", 0777);

copy("ComCenter/userlogin.php", "$forumnme/userlogin.php");
chmod("$forumnme/userlogin.php", 0777);

copy("ComCenter/userspecs.php", "$forumnme/userspecs.php");
chmod("$forumnme/userspecs.php", 0777);

copy("ComCenter/webmastercontrols.php", "$forumnme/webmastercontrols.php");
chmod("$forumnme/webmastercontrols.php", 0777);

//End of Root Files

$filetoopen = "$forumnme/specs.php";

$Open = fopen ($filetoopen, "r");
if ($Open) {
$specifics = file($filetoopen);
}
fclose ($Open);

$specifics[25]="\$comcentername=\"$forumname\";\n";

$Open = fopen ($filetoopen, "w+");
if ($Open) {
for ($i=0; $i < count($specifics); $i++) {
fwrite ($Open, "$specifics[$i]");
}
}
fclose ($Open);

print ("
<HTML>
<B>Your Forum has been Created.</B><BR><BR>
<B>You can access it at <A HREF=\"http://www.bowdenworks.net/AdvForums/$forumnme/index.php\">http://www.bowdenworks.net/AdvForums/$forumnme/index.php</A></B>
</HTML>
");
exit("");

}
}

if (!$username && !$password) {
print ("
<HTML>
<B>Log In Correctly or Die</B>, for this is the realm of the forum.<BR><BR>
<FORM ACTION=\"makeforum.php\" METHOD=\"Post\">
<B>User:</B> <INPUT TYPE=\"text\" NAME=\"username\"><BR>
<B>Pass:</B> <INPUT TYPE=\"password\" NAME=\"password\"><BR><BR>
<INPUT TYPE=\"submit\" VALUE=\"Log In\"> 
</FORM>
</HTML>
");
exit("");
}

if ($username != "Bicx" || $password != "web") {
print ("
<HTML>
<B>So you have chosen Death.<BR>I'll give you one more chance.<BR><BR>
<FORM ACTION=\"makeforum.php\" METHOD=\"Post\">
<B>User:</B> <INPUT TYPE=\"text\" NAME=\"username\"><BR>
<B>Pass:</B> <INPUT TYPE=\"password\" NAME=\"password\"><BR><BR>
<INPUT TYPE=\"submit\" VALUE=\"Log In\"> 
</FORM>
</HTML>
");
exit("");
}

if ($username == "Bicx" && $password == "web") {
print ("
<HTML>
<B>You have succeeded, and now wield a great power: the power to create a new forum.</B><BR><BR>
<FORM ACTION=\"makeforum.php\" METHOD=\"Post\">
<B>Forum Name:</B> <INPUT TYPE=\"text\" NAME=\"forumname\"> (Remember, only letters, numbers, and spaces)<BR><BR>
<INPUT TYPE=\"hidden\" NAME=\"forumsubmitted\" VALUE=\"1\">
<INPUT TYPE=\"hidden\" NAME=\"username\" VALUE=\"Bicx\">
<INPUT TYPE=\"hidden\" NAME=\"password\" VALUE=\"web\">
<INPUT TYPE=\"submit\" VALUE=\"Make Forum\">
</FORM>
</HTML>
");
exit("");
}

?>