<?php

header ("Content-Type:application/vnd.google-earth.kml+xml"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsk = new DomDocument(); 
$xsk->load("XSLT/alumnos.xsk"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsk);

$out = $proc->transformToDoc($xml); 
print $out->saveXML(); 

?>