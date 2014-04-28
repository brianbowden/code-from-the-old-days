<?PHP
require "users/users.php";
require "specs.php";

if ($multiplethemes == "yes") {
require "themes.php";
}

$root = 1;
require "menuinsert.php";

$header = "<html>\n<body bgcolor=\"$bgcolor\" text=\"$textcolor\" link=\"$linkcolor\" vlink=\"$vlinkcolor\" alink=\"$alinkcolor\">";

$stupidslash = "\\\"";
$stupidslash2 = "\\\'";
$intromessage = ereg_replace($stupidslash, '"', $intromessage);
$intromessage = ereg_replace($stupidslash2, "'", $intromessage);

if ($usefaces == "yes") {
$intromessage = ereg_replace("(:-))|(:))|(=))|(=-))", "<IMG SRC=\"faces/smile.gif\">", $intromessage);
$intromessage = ereg_replace("(;-))|(;))", "<IMG SRC=\"faces/smirk.gif\">", $intromessage);
$intromessage = ereg_replace("(:-D)|(:D)|(=D)|(=-D)", "<IMG SRC=\"faces/bigsmile.gif\">", $intromessage);
$intromessage = ereg_replace("(8-))|(8))", "<IMG SRC=\"faces/wideeyedsmile.gif\">", $intromessage);
$intromessage = ereg_replace("(;-D)|(;D)", "<IMG SRC=\"faces/bigsmirk.gif\">", $intromessage);
$intromessage = ereg_replace("[=:][',`](-)?\(", "<IMG SRC=\"faces/crying.gif\">", $intromessage);
$intromessage = ereg_replace("[=:](-)?\(", "<IMG SRC=\"faces/frown.gif\">", $intromessage);
$intromessage = ereg_replace("[8](-)?D", "<IMG SRC=\"faces/extatic.gif\">", $intromessage);
$intromessage = ereg_replace("[;](-)?\(", "<IMG SRC=\"faces/mad.gif\">", $intromessage);
$intromessage = ereg_replace("[=:](-)?[\\]", "<IMG SRC=\"faces/notsosure.gif\">", $intromessage);
$intromessage = ereg_replace("[=](-)?[\/]", "<IMG SRC=\"faces/notsosure.gif\">", $intromessage);
$intromessage = ereg_replace("[=:](-)?P", "<IMG SRC=\"faces/sidething.gif\">", $intromessage);
$intromessage = ereg_replace("(  )", " &nbsp;", $intromessage);
}

print ("
$header
<div align=\"center\">
$menu
  <table width=\"618\" height=\"300\" border=\"1\" cellspacing=\"2\" cellpadding=\"3\" bordercolor=\"$bgcolor\">
    <tr bordercolor=\"$tablecolor\"> 
      <td height=\"23\" bgcolor=\"$tablecolor\">
        <div align=\"center\"><b>$comcentername</b></div>
      </td>
    </tr>
    <tr bordercolor=\"$tablecolor\" valign=\"top\">
      <td bgcolor=\"$tablecolor\">
<BR><BR>$intromessage
</td>
</tr>
</table>
</div>
</body>
</html>
");

?>