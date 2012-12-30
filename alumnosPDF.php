<?php

$cp_fop = getClassPath();

include_once("uriAlumnos.php");

$xml = new DomDocument(); 
$xml->load($uriAlumnos); 

/* load the xml file and stylesheet as domdocuments */ 
$xsl = new DomDocument(); 
$xsl->load("XSLT/alumnos.xsf"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsl);

$proc->transformToURI($xml,"tmp/alumnos.fo");
$outPDF = "tmp/alumnos.pdf"; 
$outFull = getenv("DOCUMENT_ROOT") . "/" . $outPDF ;
$fop = getFOP();
$execStr = "$fop\\fop tmp/alumnos.fo $outPDF" ;

file_put_contents("prueba.txt", $execStr);

system($execStr);

header("Content-type: application/pdf");
header('Content-Length: ' . filesize($outPDF));

echo file_get_contents($outPDF);

// $pdf = fopen("alumnos.pdf","r");
// $contents = fread($pdf,filesize("alumnos.pdf"));
// fclose($pdf);
// echo $contents ;

function getFOP() {
	$cwd = getcwd();
	$htdocs = getenv("DOCUMENT_ROOT");

	// remove xampp/htdocs 
	$bin = substr($htdocs,0,-strlen("xampp/htdocs"));
	$fop = $bin . "fop-1.0";
	return $fop;
}

function getClassPath() {
	$fopLib = getFOP() . "\\lib";
	$cp = "";
	foreach (scandir($fopLib) as $file) {
		if (substr_compare($file,'jar',-3,3) == 0) {
			$cp .= $fopLib . $file . ";" ;
		}
	}
	return $cp;
}

?>