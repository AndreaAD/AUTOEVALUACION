<link rel="stylesheet" type="text/css" href="../Css/div_circular/demo.css" />
<link rel="stylesheet" type="text/css" href="../Css/div_circular/common.css" />
<link rel="stylesheet" type="text/css" href="../Css/div_circular/style4.css" />
<link href='../Css/div_circular/fuentes_div_circular.css' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="../Js/modernizr.custom.79639.js"></script> 
<link rel="stylesheet" type="text/css" href="../Css/efecto_modales/default.css" />
<link rel="stylesheet" type="text/css" href="../Css/efecto_modales/component.css" />
<script src="../Js/efecto_modales/modernizr.custom.js"></script>
<style>
    body{
        color:black !important;
    }
    .table_ponderacion{
        background-color: #47aa4b;
        color:black;

    }
    .aceptar{
        width: 30px;

    }
    .table_ponderacion tr:nth-child(even){background-color: #f2f2f2}

    .table_ponderacion th {
        background-color: #4CAF50;
        color: white;
    }
    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {
        visibility: hidden; /* Hidden by default. Visible on click */
        min-width: 250px; /* Set a default minimum width */
        margin-left: -125px; /* Divide value of min-width by 2 */
        background-color: #333; /* Black background color */
        color: #fff; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 2px; /* Rounded borders */
        padding: 16px; /* Padding */
        position: fixed; /* Sit on top of the screen */
        z-index: 1; /* Add a z-index if needed */
        left: 50%; /* Center the snackbar */
        bottom: 30px; /* 30px from the bottom */
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    #snackbar.show {
        visibility: visible; /* Show the snackbar */

        /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
        However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
</style>
<div id="snackbar"></div>
<div class="container">
    <section class="main">
        <ul class="ch-grid">

            <?php
            foreach ($listado_factores as $key => $value) {
                $valor = $key + 1;
                echo '<li>
                            <div class="ch-item ch-img-' . $valor . '">				
                                <div class="ch-info-wrap">
                                    <div class="ch-info">
                                        <div class="ch-info-front ch-img-' . $valor . '"></div>
                                        <div class="ch-info-back">
                                            <h3>' . $value['nombre'] . '</h3>
                                            <p><button class="md-trigger md-setperspective" data-modal="modal-' . $key . '">Agregar Ponderación</button></p>
                                        </div>	
                                    </div>
                                </div>
                            </div>
                        </li>';
            }
            ?>


        </ul>

    </section>
</div>
<?php
foreach ($listado_factores as $key => $value) {
    echo '<div class="md-modal md-effect-4" id="modal-' . $key . '">
            <div class="md-content">
                    <h3>' . $value['nombre'] . '</h3>                    
                    <div>
                    <form id="form_caracteristicas_'.$value['pk_factor'].'">
                    <input type="hidden" value="' . $value['pk_factor'] . '" name="id_factor">
                    <input type="hidden" name="opcion" value="agregar_ponderacion">
                            <table class="table_ponderacion">
                                <tr>
                                  <th>Caracteristica</th>
                                  <th>Ponderacion</th>
                                </tr>';

    foreach ($listado_caracteristicas[$value['pk_factor']] as $key2 => $value2) {
        echo '<tr>
                <td>' . $value2['nombre'] . '</td>
                <td>
                    <input type="text" value=' . $ponderaciones[$value['pk_factor']][$value2['pk_caracteristica']] . ' name="ponderacion_' . $value2['pk_caracteristica'] . '" id="' . $value2['pk_caracteristica'] . '" size = "4">                    
                </td>
            </tr>';
    }

    echo '                  </table><br>
                            <button onclick="enviar_form('.$value['pk_factor'].')" type="button" class="md-close">Aceptar</button>
                    </form>
                    </div>
            </div>
        </div>';
}
?>
<div class="md-overlay"></div>
<script src="../Js/efecto_modales/classie.js"></script>
<script src="../Js/efecto_modales/modalEffects.js"></script>
<script>
    // this is important for IEs
    var polyfilter_scriptpath = '../Js/efecto_modales/';
</script>
<script src="../Js/efecto_modales/cssParser.js"></script>
<script src="../Js/efecto_modales/css-filters-polyfill.js"></script>
<script>
    function enviar_form(id_factor) {
        var datos = $("#form_caracteristicas_"+id_factor).serialize();
        $.ajax({
            url: '../Controlador/CNA_ponderacion_caracteristicas.php',
            type: 'post',
            dataType: 'html',
            data: datos,
            success: function (data) {
                $('#snackbar').html(data);
                // Get the snackbar DIV
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function () {
                    x.className = x.className.replace("show", "");
                }, 3000);

            }
        });
    }
</script>