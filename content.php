<?php

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

$accept = explode(',', $_SERVER['HTTP_ACCEPT']);

if (in_array('application/xhtml+xml', $accept)) {
 include('alumnosHTML.php');
} 
elseif (in_array('application/rdf+xml', $accept)) {
 include('alumnosRDF.php');
} 
elseif (in_array('text/html', $accept)) {
 include('alumnosHTML.php');
} 
elseif (in_array('application/xml', $accept)) {
echo $xml->saveXML();
} 
elseif (in_array('text/xml', $accept)) {
echo $xml->saveXML();
} 
elseif (in_array('application/pdf', $accept)) {
 include('alumnosPDF.php');
} else 
 include('alumnosHTML.php');


?>