<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
//header
include_once 'header.php';
?> 
<body>
    <div class="container">
        <p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUÁL ES SU CLASE DE RED?</b></font></font></p>
    <p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"><b>Instrucciones:</b></font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> </font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Para
        utilizar el instrumento usted debe llenar todo los campos con la información solicitada. 
        Por supuesto responder de la manera más sensata posible.</font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Todas
        las respuestas son buenas, ya que el fin del instrumento es describir a que
        tipo de clase pertenece su red.</font></font></p>


<p class="western" align="justify" lang="es-ES"><font color="#ff0000"><font size="3"><b>No olvide escribir llenar todos los campos y hacer click en los botones CALCULAR, para que vea el resultado. Mil gracias !</b></font></font></p>

</div>
<form class="form-horizontal" action="?formulario6=calcular" method="POST">
    <div class="container">
        <input name="EC" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="RO" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <input name="CA" maxlength="12" size="12" type="hidden" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <input name="EA" maxlength="12" size="12" type="hidden" ><br>

        <input type="hidden" maxlength="3" size="3" name="CAEC">&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="hidden" maxlength="3" size="3" name="EAOR">&nbsp;<br><br>

        <br>
         Network reliability:<select name="networkReliability" value="networkReliability">
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br>
        Number of links:<select name="numberLinks" value="numberLinks">
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
        </select><br>
        Total network capacity:<select name="networkCapacity" value="networkCapacity">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select><br>
         Network cost:<select name="networkCost" value="networkCost">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
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
