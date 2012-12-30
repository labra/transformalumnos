<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0" 
     xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
     xmlns:a="http://www.uniovi.es/alumnos"
     >


<xsl:output method="text"
            omit-xml-declaration="yes" />
 

<xsl:template match="a:alumnos">
<xsl:text>{
    "items" : [</xsl:text>
	  <xsl:apply-templates select="a:alumno"/>
	<xsl:text>] 
}</xsl:text>
</xsl:template>

<xsl:template match="a:alumno">
<xsl:text>{  type: 'Alumnos' , 
 label : "</xsl:text><xsl:value-of select="a:nombre"/><xsl:text> </xsl:text><xsl:value-of select="a:apellidos"/>", 
 latLng : "<xsl:value-of select="a:lat" />, <xsl:value-of select="a:long" />", 
 dni : "<xsl:value-of select="@dni"/>",
 email : "<xsl:value-of select="a:email"/>",
 nota : "<xsl:value-of select="a:nota"/>",
 valorNota: "<xsl:choose>
  <xsl:when test="a:nota &lt; 5">Suspenso</xsl:when>
  <xsl:when test="a:nota &gt;=5 and a:nota &lt; 7">Aprobado</xsl:when>
  <xsl:when test="a:nota &gt;=7 and a:nota &lt; 9">Notable</xsl:when>
  <xsl:when test="a:nota &gt;=9 and a:nota &lt;= 10">Sobresaliente</xsl:when>
  <xsl:otherwise>Incorrecta</xsl:otherwise>
 </xsl:choose>" } ,
</xsl:template>

</xsl:stylesheet>
