<?PHP

if ($update) {

$h_open = "No";

if ($handle = opendir('.')) {

$h_open = "Yes";

print ("<H2>Beginning Search Sequence...</H2><BR><BR><B><A HREF=\"javascript:history.back()\"><-BACK<-</A></B><BR><BR>");

while (false !== ($element = readdir($handle))) {

print ("Main Folder Loop<BR>");

        if (is_dir($element) && $element != "ComCenter" && $element != "." && $element != "..") {
        print ("A main directory $element<BR>");
        $Open2 = opendir("$element");
        while ($element2 = readdir($Open2)) {
        print ("Secondary Loop $element2<BR>");
        if (is_file("$element/$element2") && $element2 != "." && $element2 != "..") {
        print ("Secondary IsFile $element2<BR>");
        if ($element2 == $update) {
        print ("Secondary MATCH $element2<BR>");
        unlink("$element/$element2");
        copy("ComCenter/$update", "$element/$update");
        chmod("$element/$update", 0777);
        }
        }
                if (is_dir("$element/$element2") && $element2 != "." && $element2 != "..") {
                print ("Secondary IsDir $element2<BR>");
                $Open3 = opendir("$element/$element2");
                while ($element3 = readdir($Open3)) {
                print ("Tertiary Loop $element3<BR>");
                if (is_file("$element/$element2/$element3") && $element3 != "." && $element3 != "..") {
                print ("Tertiary IsFile $element3<BR>");
                if ($element3 == $update) {
                print ("Tertiary MATCH $element3<BR>");
                unlink("$element/$element2/$element3");
                copy("ComCenter/$update", "$element/$element2/$update");
                chmod("$element/$element2/$update", 0777);
                }
                }
                        if (is_dir("$element/$element2/$element3") && $element3 != "." && $element3 != "..") {
                        print ("Tertiary IsDir $element3<BR>");
                        $Open4 = opendir("$element/$element2/$element3");
                        while ($element4 = readdir($Open4)) {
                        print ("Quad Loop $element4<BR>");
                        if (is_file("$element/$element2/$element3/$element4") && $element4 != "." && $element4 != "..") {
                        print ("Quad IsFile $element4<BR>");
                        if ($element4 == $update) {
                        print ("Quad MATCH $element4<BR>");
                        unlink("$element/$element2/$element3/$element4");
                        copy("ComCenter/$update", "$element/$element2/$element3/$update");
                        chmod("$element/$element2/$element3/$update", 0777);
                        }
                        }
                        }
                        }
                }
                }
        }
        }

}
}

closedir($handle);
if ($Open2) {
closedir($Open2);
}
if ($Open3) {
closedir($Open3);
}
if ($Open4) {
closedir($Open4);
}


print ("<H2>Completed</H2><BR><BR><BR><BR>The file <B>$update</B> has been distributed");
print ("<BR><BR>Handle Open: $h_open<BR><BR><B><A HREF=\"javascript:history.back()\"><-BACK<-</A></B>");

exit("");
}


if (!$update) {

$Open = opendir("ComCenter");

print("<H2>ComCenter File Distributor</H2>");
print("<BR><BR><B>Please select a file to distribute</B><BR><BR>");

while ($file = readdir ($Open)) {

$filepath = "ComCenter/".$file;

if (is_file ($filepath)) {

$filesize = filesize($filepath);
$filesize = round($filesize/1024, 2);

print ("<A HREF=\"filedis.php?update=$file\" style=\"text-decoration: none\"><B>$file</B></A> ($filesize Kb)   <B>URL:</B> http://www.bowdenworks.net/Forums/$filepath<BR><BR>");

}
}

}

?>