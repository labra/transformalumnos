<?php
header ("Content-Type:text/html"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsh = new DomDocument(); 
$xsh->load("XSLT/alumnos.xsh"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsh);

$html = $proc->transformToDoc($xml); 
print $html->saveXML(); 

?>