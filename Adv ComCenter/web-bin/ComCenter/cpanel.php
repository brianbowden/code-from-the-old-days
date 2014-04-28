<?PHP

print("<HTML>\n<HEAD>\n<TITLE>Control Panel</TITLE>\n</HEAD>\n<BODY bgcolor=\"#0099FF\" link=\"darkblue\" alink=\"darkblue\" vlink=\"darkblue\">\n");
print("<TABLE border=1 cellpadding=2 cellspacing=3 width=600 align=\"center\" bordercolor=\"#0099FF\">\n<TR>\n<TD bordercolor=\"#000000\">\n");
require "schedule.lib";
print("<TABLE border=0 cellpadding=0 cellspacing=1 width=590 align=\"center\">\n<TR>\n<TD>");
print("<IMG SRC=\"images/schedule.gif\"><BR><FORM ACTION=\"cpanel.php\" METHOD=\"Post\">\n<B>Event:</B> <INPUT TYPE=\"text\" NAME=\"event\">\n");
print("<SELECT name=\"month\">\n<OPTION value=\"January\">January\n<OPTION value=\"February\">February\n<OPTION value=\"March\">March\n<OPTION value=\"April\">April\n<OPTION value=\"May\">Mayy\n<OPTION value=\"June\">June\n<OPTION value=\"July\">July\n<OPTION value=\"August\">August\n<OPTION value=\"September\">September\n<OPTION value=\"October\">October\n<OPTION value=\"November\">November\n<OPTION value=\"December\">December\n");
print("</TD>\n");
print("<TD>");
print("<I>No Events Scheduled</I>");
print("</TD>\n</TR>\n</TABLE>");
print("</TD>\n<TR>\n");
print("<TR>\n<TD bordercolor=\"#000000\">\n");
print("&nbsp;\n");
print("</TD>\n</TR>\n");
print("<TR>\n<TD bordercolor=\"#000000\">\n");
print("&nbsp;\n");
print("</TD>\n</TR>\n");print("<TR>\n<TD bordercolor=\"#000000\">\n");
print("&nbsp;\n");
print("</TD>\n</TR>\n");

?>