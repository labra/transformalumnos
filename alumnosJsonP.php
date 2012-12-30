<?php

header ("Content-Type:text/javascript"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsl = new DomDocument(); 
$xsl->load("XSLT/alumnos2JsonP.xsl"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsl);

$out = $proc->transformToURI($xml,"tmp\\alumnos.js"); 

/*$fichero = fopen("tmp\\alumnos.js","w");
fwrite($fichero,$out->saveXML());
fclose($fichero); */

echo file_get_contents("tmp\\alumnos.js");

?>