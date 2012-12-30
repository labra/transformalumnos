<?php

header ("Content-Type:text/vnd.wap.wml"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsw = new DomDocument(); 
$xsw->load("XSLT/alumnos.xsw"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsw);

$html = $proc->transformToDoc($xml); 
print $html->saveXML(); 

?>