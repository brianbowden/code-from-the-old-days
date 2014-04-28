<?PHP
$usrnameth = ereg_replace("( )", "_", $username);
$usrnameth = strtolower("u0000$usrnameth");
$comnamecondensed = ereg_replace("( )", "_", $comcentername);
$comnamecondensed = strtolower($comnamecondensed);
$cookiename = $comnamecondensed."_themecookie"."_$usrnameth";
?>
