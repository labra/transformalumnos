<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0" 
     xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
     xmlns:a="http://www.uniovi.es/alumnos"
     >


<xsl:variable name="aprobados"
	      select="count(//a:alumno[a:nota &gt;= '5'])"/>

<xsl:variable name="total"
	      select="count(//a:alumno)"/>

<xsl:variable name="porcentaje"
	      select="($aprobados div $total) * 100 "/>

<xsl:output method="html"  encoding="iso-8859-1" indent="yes"/>
 

  <xsl:template match="a:alumnos">
    <html>
   <head>
   <title>Course name: <xsl:value-of select="a:curso"/></title>
   <link rel="stylesheet" href="CSS/alumnos.css"/>

   </head>
    <body>
      <h1>Grades of course: 
	<xsl:element name="a">
	   <xsl:attribute name="href"><xsl:value-of select="a:curso/@href"/>
	  </xsl:attribute>
              <xsl:value-of select="a:curso"/>
	</xsl:element>
      </h1>
    <div class="tablaCentral">
      <table> 
    <tr>
      <th class="dni">Id</th>
      <th class="alumno">Student</th>
      <th class="nota">Grade</th>
      </tr>
       <xsl:apply-templates select="a:alumno"/>
       <tr>
	 <td  class="final" colspan="3">Statistics: 
	     <xsl:value-of select="$aprobados"/>
	     passed from <xsl:value-of select="$total"/> 
	 (<xsl:value-of select="round($porcentaje)" />%)</td>
       </tr>
      </table>
    </div>
    </body>
    </html>
  </xsl:template>

<xsl:template match="a:alumno">
 <tr>
 <td class="dni"> <xsl:value-of select="@dni"/></td>
 <td class="alumno"> 
      <xsl:element name="a">
      <xsl:attribute name="href">
	mailto:<xsl:value-of select="a:email"/>
      </xsl:attribute>
     <xsl:value-of select="a:apellidos"/>, <xsl:value-of select="a:nombre"/>
   </xsl:element>
 </td>
<td class="nota">  <xsl:value-of select="a:nota"/></td>
</tr>
  
</xsl:template>

</xsl:stylesheet>
