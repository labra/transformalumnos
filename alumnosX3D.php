<?php

header ("Content-Type:model/x3d+xml"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xs3 = new DomDocument(); 
$xs3->load("XSLT/diagramaAlumnos.xs3"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xs3);

$out = $proc->transformToDoc($xml); 
print $out->saveXML(); 

?>