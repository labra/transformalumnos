<?php

header ("Content-Type:image/svg+xml"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsv = new DomDocument(); 
$xsv->load("XSLT/alumnos.xsv"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsv);

$html = $proc->transformToDoc($xml); 
print $html->saveXML(); 

?>