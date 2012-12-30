<?php
header("Content-type: text/plain");

// ejecutar("path");
ejecutar("cd");
// ejecutar("dir c:");
ejecutar("java -cp \"c:\\bin\" Hola");

$cp_fop ="c:\\cursoxmlsimple\\bin\\fop-1.0\\build\\fop.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\build\\fop-sandbox.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\build\\fop-hyph.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\xml-apis-1.3.02.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\xercesImpl-2.7.1.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\xalan-2.7.0.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\serializer-2.7.0.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\batik-all-1.6.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\xmlgraphics-commons-1.2.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\avalon-framework-4.2.0.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\commons-io-1.3.1.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\commons-logging-1.0.4.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\jimi-1.0.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\jai_core.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\jai_codec.jar;c:\\cursoxmlsimple\\bin\\fop-1.0\\lib\\fop-hyph.jar;" ;

ejecutar("java -cp \"$cp_fop\" org.apache.fop.cli.Main -out list");

$xml = new DomDocument(); 
$xml->load("http://156.35.31.21:3000/alumnos.xml"); 

/* load the xml file and stylesheet as domdocuments */ 
$xsl = new DomDocument(); 
$xsl->load("XSLT/alumnos.xsf"); 

/* create the processor and import the stylesheet */ 
$proc = new XsltProcessor(); 
$proc->importStylesheet($xsl);

$html = $proc->transformToDoc($xml); 

$fichero = fopen("alumnos.fo","w");
fwrite($fichero,$html->saveXML());
fclose($fichero); 

ejecutar("java -cp \"$cp_fop\" org.apache.fop.cli.Main alumnos.fo alumnos.pdf");

$pdf = fopen("alumnos.pdf","r");
$contents = fread($pdf,filesize("alumnos.pdf"));
echo "PDF" ;
echo $contents ;

function ejecutar($cmd) {
 echo "\n...Ejecutando " . $cmd . ": ";
// $output = shell_exec($cmd);
// echo $output;
 system($cmd);
 echo "..." ;
}

?>