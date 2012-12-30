<?php

header ("Content-Type:text/html"); 

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

?>
<html>
<head>
   <title>Alumnos</title>
 
   <link href="tmp/alumnos.js" type="application/json" rel="exhibit/data" />
 
   <script src="http://static.simile.mit.edu/exhibit/api-2.0/exhibit-api.js"
           type="text/javascript"></script>
           
   <script src="http://static.simile.mit.edu/exhibit/extensions-2.0/time/time-extension.js"
           type="text/javascript"></script>
		   
   <script src="http://static.simile.mit.edu/exhibit/extensions-2.0/map/map-extension.js?gmapkey=ABQIAAAAaxRDl6tbqwgHGJqJpiZZyhTMsWsDstGd0AnjBftwK7NyIDyBABRPsTljU42sQCzcCKTDNUuvij3V0g"
           type="text/javascript"></script>           
   <style>
       body {
           margin: 1in;
       }
       table.alumno {
           border:     1px solid #ddd;
           padding:    0.5em;
       }
       div.nombre {
           font-weight: bold;
           font-size:   120%;
       }
       }
       .nota {
           font-style:  italic;
       }
   </style>
</head> 
<body>
   <h1>Alumnos</h1>
   
    <div ex:role="view"
           ex:viewClass="Map"
           ex:latlng=".latLng"
		   ex:zoom="1"
		   ex:center="43.363129,-5.847645">
    </div>

   <table width="100%">
       <tr valign="top">
           <td ex:role="viewPanel">
               <table ex:role="lens" class="alumno">
                   <tr>
<!--                       <td><img ex:src-content=".imageURL" /></td> -->
                       <td>
                           <div ex:content=".label" class="nombre"></div>
                           <div>
                               <span ex:content=".email" class="email"></span>, 
                               <span ex:content=".nota" class="nota"></span>
                               <span ex:content=".valorNota" class="valorNota"></span>
                           </div>
                       </td>
                   </tr>
               </table>
               <div ex:role="exhibit-view"
                   ex:viewClass="Exhibit.TabularView"
                   ex:columns=".label, .email, .nota, .valorNota"
                   ex:columnLabels="nombre, email, nota, .valorNota"
                   ex:columnFormats="list, list, list, list"
                   ex:sortColumn="1"
                   ex:sortAscending="false">
               </div>
               <div ex:role="view"
                   ex:orders=".email, .valorNota, .nota"
                   ex:possibleOrders=".label, .apellidos, .valorNota, .nota">
               </div>
            </td>
           <td width="25%">
               <div ex:role="facet" ex:facetClass="TextSearch"></div>
               <div ex:role="facet" ex:expression=".valorNota" ex:facetLabel="valorNota"></div>
               <div ex:role="facet" ex:expression=".email" ex:facetLabel="Email"></div>
           </td>
       </tr>
   </table>
</body>
</html>