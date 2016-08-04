<?php
    $idProceso=$_SESSION["pk_proceso"];
    require_once("../Modelo/ENC_gruposInteres_modelo.php");
    require_once("../Modelo/ENC_consultas_modelo.php");
    $objGrupoInteres=new GruposInteres();
    $objConsultas=new Consultas(); 
    $rsGrupos=$objGrupoInteres->getAllGrupos();
    $rsGrupos=$rsGrupos!=null ? $rsGrupos->GetArray() : false;
     ?>
    
    <p>La siguiente tabla hace un resumen de la cantidad de encuestas que han sido llenadas por cada grupo de interes
hasta el momento de entrar en esta pagina.</p>
<style type="text/css">
    table{
        width: 80%;
        margin-left: 10%;
        margin-top:1rem;
    }
    table thead th{
        text-align: center;
        font-size:0.8rem;
    }
    table tbody tr td a{
        padding-left:0.5rem;
    }
    table tbody tr td:first-child{
        padding-left:1rem;
    }
    table tbody tr td:last-child{
        text-align:center;
    }
</style>
<table>
    <thead>
    <th>GRUPO DE INTERES</th>
    <th>CANTIDA DE ENCUESTAS</th>
    </thead>
    <tbody>
    <?php
        foreach($rsGrupos as $grupo){
            ?><tr>
            <td><?php echo $grupo['nombre'];?></td>
            <?php
            $cantidad=$objConsultas->getEncuestasGrupoInteres($idProceso,$grupo['pk_grupo_interes'])->fields[0];
            ?>
            <td><?php echo $cantidad; ?></td>
            </tr><?php
        }
    ?>
    </tbody>
</table>
<?php ?>
