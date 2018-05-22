<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
//header
include_once 'header.php';
?> 
<body>
    <div class="container">
        <p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUAL ES SU NIVEL COMO PROFESOR?</b></font></font></p>
    <p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"><b>Instrucciones:</b></font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> </font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Para
        utilizar el instrumento usted debe llenar todo los campos con la información solicitada. 
        Por supuesto responder de la manera más sensata posible.</font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Todas
        las respuestas son buenas, ya que el fin del instrumento es describir
        cómo y no juzgar su nivel como profesor.</font></font></p>


<p class="western" align="justify" lang="es-ES"><font color="#ff0000"><font size="3"><b>No olvide escribir llenar todos los campos y hacer click en los botones CALCULAR, para que vea el resultado. Mil gracias !</b></font></font></p>

</div>
<form class="form-horizontal" action="?formulario5=calcular" method="POST">
    <div class="container">
        <input name="EC" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="RO" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <input name="CA" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <input name="EA" maxlength="12" size="12" type="hidden" ><br>

        <input type="hidden" maxlength="3" size="3" name="CAEC">&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="hidden" maxlength="3" size="3" name="EAOR">&nbsp;<br><br>

        <br>
         Age:<select name="age" value="age">
            <option value="1">less than 30</option>
            <option value="2">30 to 55</option>
            <option value="3">more than 55</option>
        </select><br>
        Gender:<select name="gender" value="gender">
            <option value="F">Female</option>
            <option value="M">Male</option>
            <option value="NA">Not available</option>
        </select><br>
        For teacher’s self-evaluation:<select name="self" value="self">
            <option value="B">beginner</option>
            <option value="I">intermediate</option>
            <option value="A">advanced</option>
        </select><br>
         For times teaching a course:<select name="course" value="course">
            <option value="1">Never</option>
            <option value="2">1 to 5 times</option>
            <option value="3">more than 5 times</option>
        </select><br>
         For teacher’s background discipline:<select name="discipline" value="discipline">
            <option value="DM">decision-making</option>
            <option value="ND">network design</option>
            <option value="O">other</option>
        </select><br>
        For teacher’s skills using computers:<select name="computers" value="computers">
            <option value="L">low</option>
            <option value="A">average</option>
            <option value="H">high</option>
        </select><br>
         For teacher’s experience using Web-based technology:<select name="webBased" value="webBased">
            <option value="N">never</option>
            <option value="S">sometimes</option>
            <option value="O">often</option>
        </select><br>
       For teacher’s experience using the Web site:<select name="webSite" value="webSite">
            <option value="N">never</option>
            <option value="S">sometimes</option>
            <option value="O">often</option>
        </select><br>
        <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font><input value="ENVIAR" type="submit">

        <h2><?php if (isset($resultados)) {
    echo $resultados;
} ?></h2>
</form>
</div>

<?php
//footer
include_once 'footer.php';
?>   