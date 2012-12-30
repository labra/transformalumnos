<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns="http://www.w3.org/2000/svg"
  xmlns:a="http://www.uniovi.es/alumnos">

<xsl:output method="xml" media-type="image/svg+xml"
            indent="yes" encoding="UTF-8" 
            doctype-system="http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd"
            doctype-public="-//W3C//DTD SVG 20010904//EN"/>

<xsl:param name="height" 			select="1000" />
<xsl:param name="width" 			select="100" />

<!-- Podría ser un parámetro los rangos...?
  En este caso: susp, aprob, notable, sobre -->
<xsl:param 	  name="valores" 		select="4" /> 
<xsl:param    name="fillSuspensos"  select="'red'" />
<xsl:param    name="fillAprobados"  select="'brown'" />
<xsl:param    name="fillNotables"  	select="'green'" />
<xsl:param    name="fillSobres"  	select="'blue'" />

<xsl:variable name="total"          select="count(//a:nota)" />
<xsl:variable name="suspensos"      select="count(//a:nota[. &lt; 5])" />
<xsl:variable name="aprobados"      select="count(//a:nota[. >= 5 and . &lt; 7])" />
<xsl:variable name="notables"       select="count(//a:nota[. >= 7 and . &lt; 9])" />
<xsl:variable name="sobres" 		select="count(//a:nota[. >= 9 and . &lt; 10])" />

<xsl:variable name="heightSuspensos" 
              select="round (($suspensos div $total) * $height)" />

<xsl:variable name="heightAprobados" 
              select="round (($aprobados div $total) * $height)" />

<xsl:variable name="heightNotables" 
              select="round (($notables div $total) * $height)" />

<xsl:variable name="heightSobres" 
              select="round (($sobres div $total) * $height)" />

<xsl:template match="/">

 <svg width="100%" height="100%" version="1.0" standalone="no">

  <xsl:call-template name="barra">
   <xsl:with-param name="nombre">Suspensos</xsl:with-param>
   <xsl:with-param name="dx">100</xsl:with-param>
   <xsl:with-param name="n" select="$suspensos" />
   <xsl:with-param name="hBarra" select="$heightSuspensos" />
   <xsl:with-param name="fill" select="$fillSuspensos" />
  </xsl:call-template>

  <xsl:call-template name="barra">
   <xsl:with-param name="nombre">Aprobados</xsl:with-param>
   <xsl:with-param name="dx">300</xsl:with-param>
   <xsl:with-param name="n" select="$aprobados" />
   <xsl:with-param name="hBarra" select="$heightAprobados" />
   <xsl:with-param name="fill" select="$fillAprobados" />
  </xsl:call-template>

  <xsl:call-template name="barra">
   <xsl:with-param name="nombre">Notables</xsl:with-param>
   <xsl:with-param name="dx">500</xsl:with-param>
   <xsl:with-param name="n" select="$notables" />
   <xsl:with-param name="hBarra" select="$heightNotables" />
   <xsl:with-param name="fill" select="$fillNotables" />
  </xsl:call-template>

  <xsl:call-template name="barra">
   <xsl:with-param name="nombre">Sobres.</xsl:with-param>
   <xsl:with-param name="dx">700</xsl:with-param>
   <xsl:with-param name="n" select="$sobres" />
   <xsl:with-param name="hBarra" select="$heightSobres" />
   <xsl:with-param name="fill" select="$fillSobres" />
  </xsl:call-template>

 </svg>
</xsl:template>

<xsl:template name="barra">
 <xsl:param name="nombre"/>
 <xsl:param name="dx"/>
 <xsl:param name="n"/>
 <xsl:param name="hBarra" />
 <xsl:param name="fill" />
 
 <rect x="{$dx}" y="{$height div 2 - $hBarra}"
       width="100" height="{$hBarra}" 
       fill="{$fill}" />
 <text font-size="20" x="{$dx}" y="{$height div 2 + 20}" fill="{$fill}">
  <xsl:value-of select="$nombre" />
 </text>
 
 <text font-size="20" x="{$dx}" y="{$height div 2 + 40}" fill="{$fill}" stroke="{$fill}">
  <xsl:value-of 
    select="$n" />=<xsl:value-of 
    select="round (($hBarra div $height) * 100) " />%
 </text>
 
</xsl:template>

</xsl:stylesheet>