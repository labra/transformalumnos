<?php

header ("Content-Type:application/rdf+xml"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsr = new DomDocument(); 
$xsr->load("XSLT/alumnos.xsr"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsr);

$html = $proc->transformToDoc($xml); 
print $html->saveXML(); 

?>