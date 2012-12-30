<?php

header ("Content-Type:model/x3d+vrml"); 

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xml2x3d = new DomDocument(); 
$xml2x3d->load("XSLT/alumnos.xs3"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xml2x3d);

$x3d = $proc->transformToDoc($xml); 

$x3d2vrml = new DomDocument();
$x3d2vrml->load("XSLT/X3dToVrml97.xslt");

$proc->importStylesheet($x3d2vrml);
$proc->setParameter('','outputDiagnostics','false');
echo $proc->transformToXML($x3d);

?>