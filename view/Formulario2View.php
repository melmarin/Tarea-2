<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
//header
include_once 'header.php';
?> 
<body>
    <div class="container">
        <p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUAL ES SU ESTILO DE APRENDIZAJE?</b></font></font></p>
    <p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"><b>Instrucciones:</b></font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> </font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Para
        utilizar el instrumento usted debe conceder una calificación alta a
        aquellas palabras que mejor caracterizan la forma en que usted
        aprende, y una calificación baja a las palabras que menos
        caracterizan su estilo de aprendizaje.</font></font></p>

<p class="western" lang="es-ES"> Le puede ser difícil seleccionar
    las palabras que mejor describen su estilo de aprendizaje, ya que no
    hay respuestas correctas o incorrectas.</p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Todas
        las respuestas son buenas, ya que el fin del instrumento es describir
        cómo y no juzgar su habilidad para aprender.</font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> De
        inmediato encontrará nueve series o líneas de cuatro palabras cada una.
        Ordene de mayor a menor cada serie o juego de cuatro palabras que hay en cada línea,
        ubicando 4 en la palabra que mejor caracteriza su estilo de
        aprendizaje, un 3 en la palabra siguiente en cuanto a la
        correspondencia con su estilo; a la siguiente un 2, y un 1 a la
        palabra que menos caracteriza su estilo. Tenga cuidado de ubicar un
        número distinto al lado de cada palabra en la misma línea. </font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#ff0000"><font size="3"><b>No olvide escribir su CARNET, seleccionar género y recinto y hacer click en los botones CALCULAR, para que vea el resultado, y en el botón ENVIAR para guardarlo...  Mil gracias !</b></font></font></p>
<big><big><br>
        Yo aprendo...</big></big>
</div>
<form action="?formulario2=calcular" method="POST">
    <div class="container">
        <input name="EC" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="RO" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <input name="CA" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <input name="EA" maxlength="12" size="12" type="hidden" ><br>

        <input type="hidden" maxlength="3" size="3" name="CAEC">&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="hidden" maxlength="3" size="3" name="EAOR">&nbsp;<br><br>
        <br>
        Escriba su último promedio de matrícula:<input type="Text" name="promedio"><br>
        Sexo:<select name="sexo" value="sexo">
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
        </select><br>
        Escoja su estilo de aprendizaje:<select name="estiloAprendizaje" value="estiloAprendizaje">
            <option value="ACOMODADOR">ACOMODADOR</option>
            <option value="DIVERGENTE">DIVERGENTE</option>
            <option value="ASIMILADOR">ASIMILADOR</option>
            <option value="CONVERGENTE">CONVERGENTE</option>
        </select><br>
        <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font><input value="ENVIAR" type="submit">

        <h2><?php if (isset($resultados)) {
    echo $resultados;
} ?></h2>
    </div>
</form>


<?php
//footer
include_once 'footer.php';
?>   