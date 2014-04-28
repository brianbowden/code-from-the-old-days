<?PHP
if ($votesubmitted && $$theuser != "no") {

$z = $choices;

if ($Open = fopen("pollinfo.php", "r")) {
$pollinfo = file("pollinfo.php");
}
fclose($Open);

for ($i=0; $i < count($pollinfo); $i++) {
$x = "\\$"."votes$z";
if (ereg("$x =", $pollinfo[$i])) {
$nextvote_2 = "votes$z";
$nextvote_1 = $$nextvote_2;
$nextvote = $nextvote_1+1;
$pollinfo[$i] = "<?PHP \$votes$z = \"$nextvote\"; ?>\n";
}
$y = "\\$"."numofvotes";
if (ereg("$y =", $pollinfo[$i])) {
$nextnum = $numofvotes+1;
$pollinfo[$i] = "<?PHP \$numofvotes = \"$nextnum\"; ?>\n";
}
}

if ($Open = fopen("pollinfo.php", "w+")) {
foreach ($pollinfo as $value) {
fwrite($Open, "$value");
}
fwrite ($Open, "\n<?PHP \$$theuser = \"no\"; ?>");
}
fclose($Open);

header("Location: forum.php");
exit("");
}

$stupidslash = "\\\'";
$stupidslash2 = '\\\"';

$thequestion = ereg_replace($stupidslash, "'", $thequestion);
$thequestion = ereg_replace($stupidslash2, '"', $thequestion);

$numofvoters = count($users);
$undecided = $numofvoters-$numofvotes;

print ("
 <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<DIV ALIGN=\"Center\"><FONT SIZE=2><B><A HREF=\"../topicdisplay.php\">Back to Topics</A></B></FONT><BR><BR><B>$thequestion</B>
<BR><BR><FONT SIZE=2><B>Total Votes:</B> $numofvotes &nbsp;&nbsp;<B>Undecided Users:</B> $undecided</FONT></DIV>
");

if ($choice1) {
$choice1 = ereg_replace($stupidslash, "'", $choice1);
$choice1 = ereg_replace($stupidslash2, '"', $choice1);
$percent1 = 0;
if ($numofvotes !=0) {
$percent1 = round(($votes1/$numofvotes)*100, 2);
}
$l_percent1 = round($percent1);
$length1 = 3*$l_percent1;
if ($votes1 == 0) {
$length1 = 1;
}
print ("<BR><FONT SIZE=2><B>$choice1</B> [ <B>Votes:</B> $votes1, $percent1% ]</FONT>");
print ("<BR><BR><IMG SRC=\"../../structure-images/pollbar.gif\" border=1 width=\"$length1\" height=\"5\"><BR>");
}
if ($choice2) {
$choice2 = ereg_replace($stupidslash, "'", $choice2);
$choice2 = ereg_replace($stupidslash2, '"', $choice2);
$percent2 = 0;
if ($numofvotes !=0) {
$percent2 = round(($votes2/$numofvotes)*100, 2);
}
$l_percent2 = round($percent2);
$length2 = 3*$l_percent2;
if ($votes2 == 0) {
$length2 = 1;
}
print ("<BR><FONT SIZE=2><B>$choice2</B> [ <B>Votes:</B> $votes2, $percent2% ]</FONT>");
print ("<BR><BR><IMG SRC=\"../../structure-images/pollbar.gif\" border=1 width=\"$length2\" height=\"5\"><BR>");
}
if ($choice3) {
$choice3 = ereg_replace($stupidslash, "'", $choice3);
$choice3 = ereg_replace($stupidslash2, '"', $choice3);
$percent3 = 0;
if ($numofvotes !=0) {
$percent3 = round(($votes3/$numofvotes)*100, 2);
}
$l_percent3 = round($percent3);
$length3 = 3*$l_percent3;
if ($votes3 == 0) {
$length3 = 1;
}
print ("<BR><FONT SIZE=2><B>$choice3</B> [ <B>Votes:</B> $votes3, $percent3% ]</FONT>");
print ("<BR><BR><IMG SRC=\"../../structure-images/pollbar.gif\" border=1 width=\"$length3\" height=\"5\"><BR>");
}
if ($choice4) {
$choice4 = ereg_replace($stupidslash, "'", $choice4);
$choice4 = ereg_replace($stupidslash2, '"', $choice4);
$percent4 = 0;
if ($numofvotes !=0) {
$percent4 = round(($votes4/$numofvotes)*100, 2);
}
$l_percent4 = round($percent4);
$length4 = 3*$l_percent4;
if ($votes4 == 0) {
$length4 = 1;
}
print ("<BR><FONT SIZE=2><B>$choice4</B> [ <B>Votes:</B> $votes4, $percent4% ]</FONT>");
print ("<BR><BR><IMG SRC=\"../../structure-images/pollbar.gif\" border=1 width=\"$length4\" height=\"5\"><BR>");
}
if ($choice5) {
$choice5 = ereg_replace($stupidslash, "'", $choice5);
$choice5 = ereg_replace($stupidslash2, '"', $choice5);
$percent5 = 0;
if ($numofvotes !=0) {
$percent5 = round(($votes5/$numofvotes)*100, 2);
}
$l_percent5 = round($percent5);
$length5 = 3*$l_percent5;
if ($votes5 == 0) {
$length5 = 1;
}
print ("<BR><FONT SIZE=2><B>$choice5</B> [ <B>Votes:</B> $votes5, $percent5% ]</FONT>");
print ("<BR><BR><IMG SRC=\"../../structure-images/pollbar.gif\" border=1 width=\"$length5\" height=\"5\"><BR>");
}
if ($choice6) {
$choice6 = ereg_replace($stupidslash, "'", $choice6);
$choice6 = ereg_replace($stupidslash2, '"', $choice6);
$percent6 = 0;
if ($numofvotes !=0) {
$percent6 = round(($votes6/$numofvotes)*100, 2);
}
$l_percent6 = round($percent6);
$length6 = 3*$l_percent6;
if ($votes6 == 0) {
$length6 = 1;
}
print ("<BR><FONT SIZE=2><B>$choice6</B> [ <B>Votes:</B> $votes6, $percent6% ]</FONT>");
print ("<BR><BR><IMG SRC=\"../../structure-images/pollbar.gif\" border=1 width=\"$length6\" height=\"5\">");
}
print ("
<BR>
</td>
</tr>
");

$theuser = $$theuser;

if ($passinarray != $passwrd) {
$theuser = "no";
}

if ($theuser != "no") {
print ("
 <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
");
print ("<B>$thequestion</B><BR><BR>");
print ("<FORM ACTION=\"forum.php\" METHOD=\"Post\"><FONT SIZE=2>");
if ($choice1) {
print ("<INPUT TYPE=\"radio\" NAME=\"choices\" VALUE=\"1\"> <B>$choice1</B><BR>");
}
if ($choice2) {
print ("<INPUT TYPE=\"radio\" NAME=\"choices\" VALUE=\"2\"> <B>$choice2</B><BR>");
}
if ($choice3) {
print ("<INPUT TYPE=\"radio\" NAME=\"choices\" VALUE=\"3\"> <B>$choice3</B><BR>");
}
if ($choice4) {
print ("<INPUT TYPE=\"radio\" NAME=\"choices\" VALUE=\"4\"> <B>$choice4</B><BR>");
}
if ($choice5) {
print ("<INPUT TYPE=\"radio\" NAME=\"choices\" VALUE=\"5\"> <B>$choice5</B><BR>");
}
if ($choice6) {
print ("<INPUT TYPE=\"radio\" NAME=\"choices\" VALUE=\"6\"> <B>$choice6</B><BR>");
}
print ("<INPUT TYPE=\"hidden\" NAME=\"votesubmitted\" VALUE=\"1\">");
print ("<BR><INPUT CLASS=\"Button\" TYPE=\"submit\" Value=\"VOTE\">");
print ("</FONT></FORM>");
print ("
</td>
</tr>
");
}

?>