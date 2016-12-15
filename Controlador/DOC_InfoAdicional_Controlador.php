
<?php
error_reporting(0);
session_start();
include '../Modelo/DOC_informacionAdicional_Modelo.php';

class informacionAdicional_Controlador{
    private $infoAdic;

    /**
     * [__construct constructor de la clase, inicializa una instancia del modelo]
     */



    public function __construct(){
        $this->infoAdic = new InfoAdicional_Modelo;
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        echo $randomString;
    }


    // /**
    //  * [guardarInfoAdicional sube un archivo de informacion adicional y lo guarda en la carpeta correspodiente a al instrumento y luego lo inserta en base de datos]
    //  * @return [void] [se retorna un valor numerico como codigo de estado]
    //  */
    // public function guardarInfoAdicional(){
    //     //$ruta="documentos/";
    //     $ruta="../Documentos/info_adicional/";
    //     $nombre = "";
    //     $url = "";
    //     // Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
    //     date_default_timezone_set('UTC');
    //     //Imprimimos la fecha actual dandole un formato
    //     $fecha = date("d-m-Y");
    //     if ($_FILES != null && $_POST['pregunta'] != ""){ 
    //         foreach ($_FILES as $key) {
    //             if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
    //                 $sobreescribir = false; //Sobreescribir el archivo si existe, si se deja en false genera un nombre nuevo 
    //                 $nombre = $key['name'];//Obtenemos el nombre del archivo
    //                 $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
    //                 $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaÃ±o en KB
    //                 $tipoDocumento = $key['type']; // obtenemos el tipo de documento

    //                 $aleatorio = generateRandomString(10);

    //                 $nombre_generado = $aleatorio;
                    
    //                 $url = $ruta.$nombre_generado; // generamos la url

    //                 $trozos = explode(".", $nombre); // separamos la extension del nombre del documento
    //                 $extension = end($trozos); // obtenemos la extension del documento

    //                 // verificamos que la extension sea permitida
                    
    //                 if (($extension == "pdf")||($extension == "docx")||($extension == "doc")||($extension == "xlsx")||($extension == "xls")){
    //                      // Comprueba si el archivo existe en la ubicacion donde lo vamos a copiar 
    //                     if (file_exists($ruta.$nombre_generado)) {
    //                         //si es falso se genera un nuevo nombre al documento
    //                         if (!$sobreescribir) {
    //                             $nuevo_aleatorio = generateRandomString(10);
    //                             $nombre_generado = $nuevo_aleatorio;
                                
    //                             // $i = 1;
    //                             // while ($i) {
    //                             //     if (!file_exists($ruta.$i."_".$nombre)) {
    //                             //         $nombre = $i."_".$nombre;
    //                             //         $i = 0;
    //                             //     } else {
    //                             //         $i++;
    //                             //     }
    //                             // }
    //                         }
    //                     }     

    //                    if(move_uploaded_file($temporal, $ruta.$nuevo_aleatorio))
    //                     {
    //                         $this->infoAdic = new InfoAdicional_Modelo;
    //                         $this->infoAdic->nombre = $nombre;
    //                         $this->infoAdic->url = $url;
    //                         $this->infoAdic->extension = $extension;
    //                         $this->infoAdic->fk_instrueval = $_POST['pregunta'];
    //                         $this->infoAdic->estado = 1;
    //                         $this->infoAdic->fk_usuario = $_SESSION['pk_usuario'];
    //                         echo  $this->infoAdic->guardar();
    //                     }else{
                            
    //                     }
    //                 }else{

    //                     echo 2; // la extension no sirve
    //                 }

    //             }else{
    //                 echo 3; // no pudi subirse el archivo
    //             }
    //         }
    //     }else{
            
    //        echo 4; //echo por favor seleccione un documento;
    //     }
    // }

    /**
     * [cargarArchivo sube un archivo y lo guarda en la carpeta correspodiente]
     * @return [json] [se retorna un json con la informacion del archivo o un valor numerico como codigo de estado en caso de error]
     */
    public function cargarArchivo(){

        // $carpeta = '/ruta/a/mi/carpeta';
        // if (!file_exists($carpeta)) {
        //     mkdir($carpeta, 0777, true);
        // }


        $ruta="../Documentos/info_autoevaluacion/";
            $nombre = "";
            $url = "";

            $resultados_consulta = array();

            $proceso = $_POST['proceso'];
            

            if ($_FILES != null && $_POST['pk_instru_evaluacion'] != ""){ 

                foreach ($_FILES as $key) {
                    if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
                        $sobreescribir = false; //Sobreescribir el archivo si existe, si se deja en false genera un nombre nuevo 
                        $nombre = $key['name'];//Obtenemos el nombre del archivo
                        $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                        
                        $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
                        $tamano_dato= ($key['size'] / 1000); //Obtenemos el tamaño en KB
                        $tipoDocumento = $key['type']; // obtenemos el tipo de documento

                        //generateRandomString(10);

                        //$nombre_generado = generateRandomString(10);
                        //echo '1';

                        //$random = substr( md5(rand()), 0, 10);
                        //$nombre_generado = $random;
                        
                        $url = $ruta.$nombre; // generamos la url


                        $trozos = explode(".", $nombre); // separamos la extension del nombre del documento
                        $extension = end($trozos); // obtenemos la extension del documento
                        // verificamos que la extension sea permitida
                        
                        if(! strpos($nombre, " ")){
                            if (($extension == "pdf")||($extension == "docx")||($extension == "doc")||($extension == "xlsx")||($extension == "xls")){
                                 // Comprueba si el archivo existe en la ubicacion donde lo vamos a copiar 
                                if (file_exists($ruta.$nombre)) {
                                    //si es falso se genera un nuevo nombre al documento
                                    if (!$sobreescribir) {

                                        //$nuevo_aleatorio = generateRandomString(10);
                                        //$nombre_generado = $nuevo_aleatorio;


                                        $i = 1;
                                        while ($i) {
                                            if (!file_exists($ruta.$i."_".$nombre)) {
                                                $nombre = $i."_".$nombre;
                                                $i = 0;
                                            } else {
                                                $i++;
                                            }
                                        }
                                    }
                                }     
                                //move_uploaded_file($temporal, $ruta.$nombre); //Movemos el archivo temporal a la ruta especificada
                                if($tamano_dato < 30000 ){

                                    if(move_uploaded_file($temporal, $ruta.$nombre))
                                    {
                                        // enviamos las variables al modelo para guardar la informacion en la base de datos
                                        $this->infoAdic = new InfoAdicional_Modelo;
                                        $this->infoAdic->nombre = $nombre;
                                        $this->infoAdic->url = $url;
                                        $this->infoAdic->extension = $extension;

                                        $lista_instrumentos = $_POST['pk_instru_evaluacion'];
                                        $res = explode(',' , $lista_instrumentos);

                                        foreach ($res as &$value) {
                                            $this->infoAdic->fk_instrueval = $value;
                                            $this->infoAdic->estado = 1;
                                            $this->infoAdic->fk_usuario = $_SESSION['pk_usuario'];
                                            $this->infoAdic->tipo = 2;

                                            if ($this->infoAdic->guardarDocumento() == 1){
                                                $resul = $this->infoAdic->obtenerIdDocumento($nombre)->GetRows();
                                                array_push($resultados_consulta, array('estado' => 1,'nombre' => $nombre, 'url' => $url , 'id' => $resul[0]['pk_documento']) );
                                            }else{
                                                array_push($resultados_consulta, array('estado' => 0,'nombre' => $nombre) );
                                            }
                                        }
                                        
                                    }else{
                                        array_push($resultados_consulta, array('estado' => 2,'nombre' => $nombre) );
                                    } 
                                }else{
                                    array_push($resultados_consulta, array('estado' => 3,'nombre' => $nombre) );
                                }
                            }else{
                               array_push($resultados_consulta, array('estado' => 4,'nombre' => $nombre) );
                            }
                        }else{
                            array_push($resultados_consulta, array('estado' => 6,'nombre' => $nombre) );
                        }
                    }else{
                        array_push($resultados_consulta, array('estado' => 5,'nombre' => $nombre) );
                    }
                }
            }

            echo json_encode($resultados_consulta);
    }

        // public function CargarVariosArchivos(){
        // $ruta="../Documentos/info_autoevaluacion/";
        //     $nombre = "";
        //     $url = "";
        //     if ($_FILES != null && $_POST['pk_instru_evaluacion'] != ""){ 
        //         foreach ($_FILES as $key) {
        //             if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
        //                 $sobreescribir = false; //Sobreescribir el archivo si existe, si se deja en false genera un nombre nuevo 
        //                 $nombre = $key['name'];//Obtenemos el nombre del archivo
        //                 $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
        //                 $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
        //                 $tipoDocumento = $key['type']; // obtenemos el tipo de documento
                        
        //                 $url = $ruta.$nombre; // generamos la url

        //                 $trozos = explode(".", $nombre); // separamos la extension del nombre del documento
        //                 $extension = end($trozos); // obtenemos la extension del documento
        //                 // verificamos que la extension sea permitida
                        
        //                 if (($extension == "pdf")||($extension == "docx")||($extension == "doc")||($extension == "xlsx")||($extension == "xls")){
        //                      // Comprueba si el archivo existe en la ubicacion donde lo vamos a copiar 
        //                     if (file_exists($ruta.$nombre)) {
        //                         //si es falso se genera un nuevo nombre al documento
        //                         if (!$sobreescribir) {
        //                             $i = 1;
        //                             while ($i) {
        //                                 if (!file_exists($ruta.$i."_".$nombre)) {
        //                                     $nombre = $i."_".$nombre;
        //                                     $i = 0;
        //                                 } else {
        //                                     $i++;
        //                                 }
        //                             }
        //                         }
        //                     }     

        //                     //move_uploaded_file($temporal, $ruta.$nombre); //Movemos el archivo temporal a la ruta especificada

        //                     if(move_uploaded_file($temporal, $ruta.$nombre))
        //                     {
        //                         // enviamos las variables al modelo para guardar la informacion en la base de datos
        //                         $this->infoAdic = new InfoAdicional_Modelo;
        //                         $this->infoAdic->nombre = $nombre;
        //                         $this->infoAdic->url = $url;
        //                         $this->infoAdic->extension = $extension;
        //                         $this->infoAdic->fk_instrueval = $_POST['pk_instru_evaluacion'];
        //                         $this->infoAdic->estado = 1;
        //                         $this->infoAdic->fk_usuario = $_SESSION['pk_usuario'];
        //                         $this->infoAdic->tipo = 2;
        //                         $proceso = $_POST['id_proceso'];

        //                         if ($this->infoAdic->guardarDocumento($proceso) == 1){
        //                             $resul = $this->infoAdic->obtenerIdDocumento($nombre)->GetRows();
        //                             echo json_encode(array('estado' => 1,'nombre' => $nombre, 'url' => $url , 'id' => $resul[0]['pk_documento']));
        //                         }else{
        //                             echo json_encode(array('estado' => 0));
        //                         }
        //                     }else{
        //                         echo 'no movio';
        //                     } 
        //                 }else{
        //                     echo 2; // la extension no sirve
        //                 }
        //             }else{
        //                 echo 3; // no pudi subirse el archivo
        //             }
        //         }
        //     }
        // }


    /**
     * [cargarInformacionAdicional carga informacion adicional]
     * @return [json] [un objeto en json con la informacion correspondiente de un archivo de informacion adicional]
     */
    public function cargarInformacionAdicional(){

          $ruta="../Documentos/info_autoevaluacion/";
            $nombre = "";
            $url = "";
            if ($_FILES != null && $_POST['pk_instru_evaluacion'] != ""){ 
                foreach ($_FILES as $key) {
                    if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
                        $sobreescribir = false; //Sobreescribir el archivo si existe, si se deja en false genera un nombre nuevo 
                        $nombre = $key['name'];//Obtenemos el nombre del archivo
                        $temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
                        $tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
                        $tipoDocumento = $key['type']; // obtenemos el tipo de documento
                        
                        $url = $ruta.$nombre; // generamos la url

                        $trozos = explode(".", $nombre); // separamos la extension del nombre del documento
                        $extension = end($trozos); // obtenemos la extension del documento
                        // verificamos que la extension sea permitida
                        $estado = 1;
                        if (($extension == "pdf")||($extension == "docx")||($extension == "doc")||($extension == "xlsx")||($extension == "xls")){
                             // Comprueba si el archivo existe en la ubicacion donde lo vamos a copiar 
                            if (file_exists($ruta.$nombre)) {
                                //si es falso se genera un nuevo nombre al documento
                                if (!$sobreescribir) {
                                    $i = 1;
                                    $estado = 0;
                                    while ($i) {
                                        if (!file_exists($ruta.$i."_".$nombre)) {
                                            $nombre = $i."_".$nombre;
                                            $i = 0;
                                        } else {
                                            $i++;
                                        }
                                    }
                                }
                            }     

                            if(move_uploaded_file($temporal, $ruta.$nombre))
                            {
                                echo 'movio';
                            }else{
                                echo 'no movio';
                            } 

                            //Movemos el archivo temporal a la ruta especificada
                            
                            // enviamos las variables al modelo para guardar la informacion en la base de datos
                            $this->infoAdic = new InfoAdicional_Modelo;
                            $this->infoAdic->nombre = $nombre;
                            $this->infoAdic->url = $url;
                            $this->infoAdic->extension = $extension;
                            $this->infoAdic->fk_instrueval = $_POST['pk_instru_evaluacion'];
                            $this->infoAdic->estado = $estado;
                            $this->infoAdic->fk_usuario = $_SESSION['pk_usuario'];
                            $this->infoAdic->tipo = 1;
                            $proceso = $_POST['id_proceso'];

                            if ($this->infoAdic->guardarDocumento($proceso) == 1){
                                $resul = $this->infoAdic->obtenerIdDocumento($nombre)->GetRows();
                                echo json_encode(array('estado' => 1,'nombre' => $nombre, 'url' => $url , 'id' => $resul[0]['pk_documento']));
                            }else{
                                echo json_encode(array('estado' => 0));
                            }

                        }else{
                            echo 2; // la extension no sirve
                        }
                    }else{
                        echo 3; // no pudi subirse el archivo
                    }
                }
            }
    }

    /**
     * [buscarInformacion buscar un archivo de informacion adicional]
     * @return [json] [array codificado en json con las caracteristicas de la informacion adicional]
     */
    public function buscarInformacion(){
        if( $_POST['pregunta'] != "" ){
             $this->infoAdic->fk_instrueval = $_POST['pregunta'];
             echo json_encode($this->infoAdic->buscarInformacion($this->infoAdic->fk_instrueval)->GetRows());
        }else{
            echo 0;
        }
    }

    /**
     * [eliminarInfoAdicional eliminar archivo de informacion adicional]
     * @return [bool] [estado de la operacion]
     */
    public function eliminarInfoAdicional(){
        if( $_POST['id'] != "" ){
             $this->infoAdic->id = $_POST['id'];
             echo $this->infoAdic->eliminar($this->infoAdic->id);
        }else{
             echo 0;
        }
    }

    /**
     * [eliminarDocumentos eliminar un archivo]
     * @return [bool] [estado de la operacion]
     */
    public function eliminarDocumentos(){
        echo $this->infoAdic->eliminarDoc($_POST['id_documento']);
    }

    /**
     * [cargarDocumentosEmergente cargar archivos para la emergente]
     * @return [json] [array codificado en json con la informacion de los archivos]
     */
    public function cargarDocumentosEmergente(){
        $sesion = 0;
        if($_POST['seccion'] == 1){
            echo json_encode($this->infoAdic->cargarDocumentosEmergente($_POST['id_instru'] , $_SESSION['pk_proceso'], $_SESSION['pk_usuario'])->GetRows());
        }else{
            echo json_encode($this->infoAdic->cargarDocumentosEmergente($_POST['id_instru'] , $sesion, $_SESSION['pk_usuario'])->GetRows());
        }
    }
}

$operacion = $_POST['operacion'];
$controladorIA = new informacionAdicional_Controlador;

switch ($operacion) {
    case 'guardarInfoAdicional':
		$controladorIA->guardarInfoAdicional();
    break;
    case 'cargarInfoAdicional':
        $controladorIA->buscarInformacion();
    break;
    case 'eliminarinfoAdicional':
        $controladorIA->eliminarInfoAdicional();
    break;
    case 'ConsultarInfoAdicional':
        $controladorIA->ConsultarInfoAdicional();
    break;
    case 'cargarArchivo':
        $controladorIA->cargarArchivo();
    break;
    case 'CargarVariosArchivos':
        $controladorIA->cargarArchivo();
    break;
    case 'eliminarDocumentos':
        $controladorIA->eliminarDocumentos();
    break;
    case 'cargarDocumentosEmergente':
        $controladorIA->cargarDocumentosEmergente();
    break;
    case 'cargarInfo':
        $controladorIA->cargarInformacionAdicional();
    default:

    break;
}
	


?>

