<?PHP

$Open = opendir("images");


if (!$user && !$pass) {

print ("
Log In to <B>Image Upload:</B><BR>
<FORM ACTION=\"upload.php\" METHOD=\"Post\">
<INPUT TYPE=\"text\" NAME=\"user\"><BR>
<INPUT TYPE=\"password\" NAME=\"pass\"><BR><BR>
<INPUT TYPE=\"submit\" VALUE=\"Log In\">
</FORM>
");

exit("");
}

if ($user != "Bicx" || $pass != "web") {

print ("
<B><FONT COLOR=\"red\">INCORRECT LOGIN</FONT><BR><BR>
Log In to <B>Image Upload:</B><BR>
<FORM ACTION=\"upload.php\" METHOD=\"Post\">
<INPUT TYPE=\"text\" NAME=\"user\"><BR>
<INPUT TYPE=\"password\" NAME=\"pass\"><BR><BR>
<INPUT TYPE=\"submit\" VALUE=\"Log In\">
</FORM>
");

exit("");
}

if ($user == "Bicx" && $pass == "web" && $delete) {

unlink ("$delete");

$delete = ereg_replace("images/", "", $delete);

print ("
<B>$delete has been deleted</B><BR><BR><A HREF=\"upload.php?user=$user&pass=$pass\">To Uploads --></A>
");

exit("");
}

if ($user == "Bicx" && $pass == "web" && $File) {
if (is_file("images/$File_name")) {
print ("
<B>$File_name already exists</B><BR><BR><A HREF=\"javascript:history.back()\">Back</A>
");
exit("");
}
else {
copy ($File, "images/$File_name");
unlink($File);

$filesize = filesize("images/$File_name");
$filesize = round($filesize/1024, 2);

print ("
<B>File has been uploaded.</B><BR><BR>
<B>File Name:</B> $File_name<BR>
<B>File Size:</B> $filesize Kb<BR>
<B>URL:</B> http://www.bowdenworks.net/images/$File_name<BR>
<BR><A HREF=\"upload.php?user=$user&pass=$pass\">To Uploads --></A>
");

exit("");
}
}


if ($user == "Bicx" && $pass == "web") {
print ("
<B>http://www.bowdenworks.net/images/</B><BR><BR><BR>
<FORM ACTION=\"upload.php\" METHOD=\"Post\" ENCTYPE=\"multipart/form-data\">
<B>Image Upload:</B> <INPUT TYPE=\"File\" NAME=\"File\"> <INPUT TYPE=\"submit\" VALUE=\"Upload\"><BR><BR>
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -<BR><BR>
");

$countspace = 0;
$howmanyfiles = 0;
$big = 0;

while ($file = readdir ($Open)) {

$filepath = "images/".$file;

if (is_file ($filepath)) {

$filesize = filesize($filepath);
$filesize = round($filesize/1024, 2);
$countspace += $filesize;
$howmanyfiles++;

if ($filesize > $big) {
$bigfile = $file;
$big = $filesize;
}

print ("<A HREF=\"$filepath\" style=\"text-decoration: none\"><B>$file</B></A> ($filesize Kb) -<A HREF=\"upload.php?delete=$filepath&user=$user&pass=$pass\"><FONT SIZE=2 COLOR=black>Delete</FONT></A>-   <B>URL:</B> http://www.bowdenworks.net/$filepath<BR><BR>");

}

print ("<INPUT TYPE=\"hidden\" NAME=\"user\" VALUE=\"$user\">");
print ("<INPUT TYPE=\"hidden\" NAME=\"pass\" VALUE=\"$pass\">");
print ("</FORM>");
}

$averagesize = $countspace/$howmanyfiles;
$averagesize = round($averagesize, 2);
$countspace = (round($countspace/1024, 2));
$ps = ($countspace/200)*100;
if (!$bigfile) {
$bigfile = "N/A";
}

print("<BR><BR><B>Total Number of Files: <FONT COLOR=blue><i>$howmanyfiles</i></FONT></B><BR><B>Total Space Used: <FONT COLOR=blue><i>$countspace Mb ($ps% of Available Server Space)</i></FONT></B><BR><B>Average File Size: <FONT COLOR=blue><i>$averagesize Kb</i></FONT></B><BR><B>Largest File: <FONT COLOR=blue><i>$bigfile</i></FONT> at <FONT color=blue><i>$big Kb</i></FONT></B>");
}

?>