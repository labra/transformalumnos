<?php

header ("Content-Type:application/xml"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsl = new DomDocument(); 
$xsl->load("XSLT/alumnos.xsf"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsl);

$html = $proc->transformToDoc($xml); 
print $html->saveXML(); 

?>