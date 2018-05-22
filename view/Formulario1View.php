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
<form action="?formulario1=calcular" method="POST">
    <div class="container">
        <table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c1">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        discerniendo<br>
                    </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c2">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        ensayando<br>
                    </td>
                    <td style="vertical-align: top;">
                        <select name="c3">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        involucrándome</td>
                    <td style="vertical-align: top;">
                        <select name="c4">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        practicando</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c5">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        receptivamente </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c6">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        relacionando </td>
                    <td style="vertical-align: top;">
                        <select name="c7">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        analíticamente </td>
                    <td style="vertical-align: top;">
                        <select name="c8">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        imparcialmente </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c9">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        sintiendo </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c10">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        observando </td>
                    <td style="vertical-align: top;">
                        <select name="c11">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        pensando </td>
                    <td style="vertical-align: top;">
                        <select name="c12">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        haciendo </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c13">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        aceptando </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c14">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        arriesgando </td>
                    <td style="vertical-align: top;">
                        <select name="c15">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        evaluando </td>
                    <td style="vertical-align: top;">
                        <select name="c16">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        con cautela </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c17">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        intuitivamente </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c18">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        productivamente </td>
                    <td style="vertical-align: top;">
                        <select name="c19">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        lógicamente </td>
                    <td style="vertical-align: top;">
                        <select name="c20">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        cuestionando </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c21">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        abstracto </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c22">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        observando </td>
                    <td style="vertical-align: top;">
                        <select name="c23">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        concreto </td>
                    <td style="vertical-align: top;">
                        <select name="c24">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        activo </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c25">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        orientado al presente </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c26">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        reflexivamente </td>
                    <td style="vertical-align: top;">
                        <select name="c27">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        orientado hacia el futuro </td>
                    <td style="vertical-align: top;">
                        <select name="c28">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        pragmático </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c29">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        aprendo más de la experiencia </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c30">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        aprendo más de la observación </td>
                    <td style="vertical-align: top;">
                        <select name="c31">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        aprendo más de la conceptualización </td>
                    <td style="vertical-align: top;">
                        <select name="c32">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        aprendo más de la experimentación </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c33">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        emotivo </td>
                    <td style="vertical-align: top; width: 25%;">
                        <select name="c34">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        reservado </td>
                    <td style="vertical-align: top;">
                        <select name="c35">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        racional </td>
                    <td style="vertical-align: top;">
                        <select name="c36">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        abierto </td>
                </tr>

            </tbody>
        </table>
        <br>
        <font color="#ff0000"><font size="4"> ------------------</font></font><input value="CALCULAR" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        <h2><?php if (isset($resultados)) {
    echo $resultados;
} ?></h2>
</form>

<form name="final" action="estilo.php" method="post">
    <input name="EC" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="RO" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <input name="CA" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <input name="EA" maxlength="12" size="12" type="hidden" ><br>

    <input type="hidden" maxlength="3" size="3" name="CAEC">&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="hidden" maxlength="3" size="3" name="EAOR">&nbsp;<br><br>

    ESTILO&nbsp;&nbsp; <input maxlength="12" size="12" name="ESTILOFINAL">
    <br>
    Escriba su carnet:<input type="Text" name="carnet"><br>
    Sexo:<select name="sex" value="Sexo">
        <option value="f">Femenino</option>
        <option value="m">Masculino</option>
    </select><br>
    Escoja su recinto:<select name="recinto" value="Recinto">
        <option value="p">Paraíso</option>
        <option value="t">Turrialba</option>
    </select><br>
    <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font><input value="ENVIAR" type="submit">
    </div>
</form>
<?php
//footer
include_once 'footer.php';
?>   