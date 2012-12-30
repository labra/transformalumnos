<?php

echo "Buscando classpath de FOP";
$cwd = getcwd();
//echo $cwd ;
$htdocs = getenv("DOCUMENT_ROOT");

// remove xampp/htdocs 
$bin = substr($htdocs,0,-strlen("xampp/htdocs"));
$fopLib = $bin . "fop-1.0\\lib";
$cp = "";
foreach (scandir($fopLib) as $file) {
 if (substr_compare($file,'jar',-3,3) == 0) {
   $cp .= $fopLib . $file . ";" ;
 }
}
echo $cp;
system("java -cp \"$cp\" org.apache.fop.cli.Main");

phpinfo(); 

?>