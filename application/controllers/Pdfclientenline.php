<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfclientenline extends CI_Controller {

  //private $urlc = 'http://localhost/sntcuestionario/';
  private $urlc ='http://snt.pvessy.com/sntcuestionario/';

    function __construct() {
        parent::__construct();
        $this->load->model('cliente_models');
        $this->load->model('cuestionario_models');
        $this->load->helper('url');
        $this->load->library('session');
        $datoiniciar = $this->session->userdata('usuario');
        if (strlen($datoiniciar) == 0) {


            redirect('', 'refresh');
        }
    }

    public function generar() {




        $idCliente = $this->input->get('idCliente');
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SNT Center');
        $pdf->SetTitle('Cuestionario');
        $pdf->SetSubject('Cuestionario inicial');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData('tcpdf_signature.png', PDF_HEADER_LOGO_WIDTH, "SNT Center", "Sport Nutrition and Training Center", array(0, 0, 0), array(0, 0, 0));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(10,20,10,10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        //$pdf->SetFooterMargin(5);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setFontSubsetting(true);

        $pdf->AddPage();



       

        $css='<style>
        .caracte {
            width: 220px;
        }
        .descripcion {
            width: 400px;
            text-align:justify;
        }
       .caracteBasica {
            width: 270px;
        }
        .descripcionBasica {
            width: 350px;
            text-align:justify;
        }
         *{font-size:12px }

        </style>';

         $general=$this->general($idCliente);
         $queryv=$this->cuestionario_models->buscar($idCliente);
         $rowv = $queryv->row();
         $informacionBasica=$this->informacionBasica($rowv);
         $lesiones=$this->historiaLesiones($rowv);
         $ExperienciaEjercicio=$this->experienciaPracEjercicio($rowv);
         $facilidadObjetivos=$this->facilidadObjetivos($rowv);

         $experienciaFarma=$this->experienciaFarma($rowv);

         $caracteristicasExperiencia=$this->caracteristicasExperiencia($rowv);
         $informacionCorporal=$this->informacionCorporal($rowv);
         $estiloAlimentacion=$this->estiloAlimentacion($rowv);
         $estilovida=$this->estilovida($rowv);



         $html =  $css.$general.
                  $informacionBasica.$lesiones.
                  $ExperienciaEjercicio.$facilidadObjetivos.
                  $experienciaFarma.$caracteristicasExperiencia.
                  $informacionCorporal.$estiloAlimentacion.$estilovida;


       


// set font
        $pdf->SetFont('helvetica', '', 8);

// set cell padding


        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


        $nombre_archivo = utf8_decode('Caratula_de_Cita.pdf');
        $pdf->Output($nombre_archivo, 'I');
    }
function estilovida($rowv){

            $cadenapaso9=$rowv->paso9;
                if(!empty($cadenapaso9)){
                    $datos1=file_get_contents($this->urlc.$cadenapaso9);
                    $listav = explode("|",$datos1);
                    $padDormido=$listav[1];
                    $padRecostado=$listav[2];
                    $padMuysedentario=$listav[3];
                    $padsedentario=$listav[4];
                    $padmuyligeramenteactivo=$listav[5];
                    $padligeramenteactivo=$listav[6];
                    $padmoderadamenteactivo=$listav[7];
                    $padactivo=$listav[8];
                    $padmuyactivo=$listav[9];
                    $padExtemadamenteactivo=$listav[10];
                    $padDormidodes=$listav[11];
                    $padRecostadodes=$listav[12];
                    $padMuysedentariodes=$listav[13];
                    $padsedentariodes=$listav[14];
                    $padmuyligeramenteactivodes=$listav[15];
                    $padligeramenteactivodes=$listav[16];
                    $padmoderadamenteactivodes=$listav[17];
                    $padactivodes=$listav[18];
                    $padmuyactivodes=$listav[19];
                    $padExtemadamenteactivodes=$listav[20];
                    $pEVidaTipo=$listav[21];
                    $pEVidaTipo2=$listav[22];
                    $numActividad=$listav[23];

                  $html='<h3>Estilo de vida actual.  </h3><br><br><table>
                       <tr>
                            <td colspan="2" style="text-align:center;border: 1px solid #ddd;">
                            Patrón de actividades diarias (Días de entrenamiento)</td>
                   
                       </tr>
                       <tr>
                           <th style="text-align:center;border: 1px solid #ddd">Tipo de actividad</th>
                           
                           <th style="text-align:center;border: 1px solid #ddd;">Horas diarias en esas actividades</th>
                          
                          
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Dormido</td>
                           
                            <td style="border: 1px solid #ddd">'.$padDormido.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Recostado</td>
                            <td style="border: 1px solid #ddd">'.$padRecostado.'</td>
                    
                       </tr>
                         <tr>
                            <td style="border: 1px solid #ddd">Muy sedentario</td>
                            <td style="border: 1px solid #ddd">'.$padMuysedentario.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Sedentario </td>
                            <td style="border: 1px solid #ddd">'.$padsedentario.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Muy ligeramente activo</td>
                            <td style="border: 1px solid #ddd">'.$padmuyligeramenteactivo.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Ligeramente activo</td>
                            <td style="border: 1px solid #ddd">'.$padligeramenteactivo.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Moderadamente activo</td>
                            <td style="border: 1px solid #ddd">'.$padmoderadamenteactivo.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Activo</td>
                            <td style="border: 1px solid #ddd">'.$padactivo.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Muy activo</td>
                            <td style="border: 1px solid #ddd">'.$padmuyactivo.'</td>
                    
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">Extremadamente activo</td>
                            <td style="border: 1px solid #ddd">'.$padExtemadamenteactivo.'</td>
                    
                       </tr>
                       <tr>
                            <td colspan="2" style="text-align:center;border: 1px solid #ddd;">
                           Patrón de actividades diarias (Días de descanso)</td>
                   
                       </tr>

                        <tr>
                            <td style="border: 1px solid #ddd">Dormido</td>
                           
                            <td style="border: 1px solid #ddd">'.$padDormidodes.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Recostado</td>
                            <td style="border: 1px solid #ddd">'.$padRecostadodes.'</td>
                    
                       </tr>
                         <tr>
                            <td style="border: 1px solid #ddd">Muy sedentario</td>
                            <td style="border: 1px solid #ddd">'.$padMuysedentariodes.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Sedentario </td>
                            <td style="border: 1px solid #ddd">'.$padsedentariodes.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Muy ligeramente activo</td>
                            <td style="border: 1px solid #ddd">'.$padmuyligeramenteactivodes.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Ligeramente activo</td>
                            <td style="border: 1px solid #ddd">'.$padligeramenteactivodes.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Moderadamente activo</td>
                            <td style="border: 1px solid #ddd">'.$padmoderadamenteactivodes.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Activo</td>
                            <td style="border: 1px solid #ddd">'.$padactivodes.'</td>
                    
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Muy activo</td>
                            <td style="border: 1px solid #ddd">'.$padmuyactivodes.'</td>
                    
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">Extremadamente activo</td>
                            <td style="border: 1px solid #ddd">'.$padExtemadamenteactivodes.'</td>
                    
                       </tr>

                       </table>
                    <h3>Patrón de Estilo de vida</h3><br><br><table>
                       <tr>
                            <td colspan="2" style="text-align:center;border: 1px solid #ddd;">
                            Patrón de Estilo de vida</td>
                   
                       </tr>
                       <tr>
                           <th style="text-align:center;border: 1px solid #ddd">Tipo de actividad diaria</th>
                           <th style="text-align:center;border: 1px solid #ddd;">Horario</th>
                                            
                       </tr>
                        <tr>
                         
                            <td style="border: 1px solid #ddd">'.$pEVidaTipo.'</td>
                            <td style="border: 1px solid #ddd">'.$pEVidaTipo2.'</td>
                       </tr>
                       
                       ';


                    $activiadees= explode("&",$datos1);
                    $verSuplem1 = count($activiadees);
                    if($verSuplem1!=1){
                        
                        $verSuplemen1=$activiadees[1];
                        $cantidadSuplementosExtra1 = explode("-",$verSuplemen1);
                        $resultado1 = count($cantidadSuplementosExtra1);                
                        $numActividad=$resultado1;
                        for($i=0;$i<$resultado1;$i++){

                            $s1 = explode("_",$cantidadSuplementosExtra1[$i]);

                       $html.='<tr>
                         
                            <td style="border: 1px solid #ddd">'.$s1[0].'</td>
                            <td style="border: 1px solid #ddd">'.$s1[1].'</td>
                          </tr>';



                            


                          

                        }
                        
                    }
                    


                }

                return $html.'</table>';



        }
    function estiloAlimentacion($rowv){

        $cadenapaso8=$rowv->paso8;
            if(!empty($cadenapaso8)){
                $datos1=file_get_contents($this->urlc.$cadenapaso8);
                $listav = explode("|",$datos1);
                
                $patronalic1h=  $listav[1];
                $patronalic1l=  $listav[2];
                $patronalic1d=  $listav[3];
                $patronalic2h=  $listav[4];
                $patronalic2l=  $listav[5];
                $patronalic2d=  $listav[6];
                $patronalic3h=  $listav[7];
                $patronalic3l=  $listav[8];
                $patronalic3d=  $listav[9];
                $patronalic4h=  $listav[10];
                $patronalic4l=  $listav[11];
                $patronalic4d=  $listav[12];
                $patronalic5h=  $listav[13];
                $patronalic5l=  $listav[14];
                $patronalic5d=  $listav[15];
                $patronalic6h=  $listav[16];
                $patronalic6l=  $listav[17];
                $patronalic6d=  $listav[18];

                $recordatorioAlimentos24hras1h= $listav[19];
                $ecordatorioAlimentos24hras1d=  $listav[20];
                $ecordatorioAlimentos24hras1q=  $listav[21];
                $ecordatorioAlimentos24hras1c=  $listav[22];

                $recordatorioAlimentos24hras2h= $listav[23];
                $ecordatorioAlimentos24hras2d=  $listav[24];
                $ecordatorioAlimentos24hras2q=  $listav[25];
                $ecordatorioAlimentos24hras2c=  $listav[26];

                $recordatorioAlimentos24hras3h= $listav[27];
                $ecordatorioAlimentos24hras3d=  $listav[28];
                $ecordatorioAlimentos24hras3q=  $listav[29];
                $ecordatorioAlimentos24hras3c=  $listav[30];

                $recordatorioAlimentos24hras4h= $listav[31];
                $ecordatorioAlimentos24hras4d=  $listav[32];
                $ecordatorioAlimentos24hras4q=  $listav[33];
                $ecordatorioAlimentos24hras4c=  $listav[34];

                $recordatorioAlimentos24hras5h= $listav[35];
                $ecordatorioAlimentos24hras5d=  $listav[36];
                $ecordatorioAlimentos24hras5q=  $listav[37];
                $ecordatorioAlimentos24hras5c=  $listav[38];

                $recordatorioAlimentos24hras6h= $listav[39];
                $ecordatorioAlimentos24hras6d=  $listav[40];
                $ecordatorioAlimentos24hras6q=  $listav[41];
                $ecordatorioAlimentos24hras6c=  $listav[42];
                  $html='<h3>Tipo y estilo de alimentación actual. </h3><br><br><table>
                       <tr>
                            <td colspan="4" style="text-align:center;border: 1px solid #ddd;">
                            Patrón de alimentación</td>
                   
                       </tr>
                       <tr>
                           <th style="text-align:center;border: 1px solid #ddd">Tiempo de comida</th>
                           <th style="text-align:center;border: 1px solid #ddd;">Horario (hrs.min)</th>
                           <th style="text-align:center;border: 1px solid #ddd;">Ubicación (lugar)</th>
                           <th style="text-align:center;border: 1px solid #ddd;">Duración (min)</th>
                          
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">1° Comida</td>
                            <td style="border: 1px solid #ddd">'.$patronalic1h.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic1l.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic1d.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">2° Comida</td>
                            <td style="border: 1px solid #ddd">'.$patronalic2h.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic2l.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic2d.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">3° Comida</td>
                           <td style="border: 1px solid #ddd">'.$patronalic3h.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic3l.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic3d.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">4° Comida</td>
                           <td style="border: 1px solid #ddd">'.$patronalic4h.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic4l.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic4d.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">5° Comida</td>
                           <td style="border: 1px solid #ddd">'.$patronalic5h.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic5l.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic5d.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">6° Comida</td>
                            <td style="border: 1px solid #ddd">'.$patronalic6h.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic6l.'</td>
                            <td style="border: 1px solid #ddd">'.$patronalic6d.'</td>
                       </tr>
                       </table><br><br><br><br><table>
                       <tr>
                            <td colspan="5" style="text-align:center;border: 1px solid #ddd;">
                            Recordatorio de alimentos de 24 horas</td>
                   
                       </tr>
                       <tr>
                           <th style="text-align:center;border: 1px solid #ddd">Tiempo de comida</th>
                           <th style="text-align:center;border: 1px solid #ddd;">¿A qué hora?</th>
                           <th style="text-align:center;border: 1px solid #ddd;">¿En dónde?</th>
                           <th style="text-align:center;border: 1px solid #ddd;">¿Qué comió? (tipo de alimento y bebida)</th>
                          <th style="text-align:center;border: 1px solid #ddd;">¿Cuándo comió? (cantidades)</th>
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">1° Comida</td>
                            <td style="border: 1px solid #ddd">'.$recordatorioAlimentos24hras1h.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras1d.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras1q.'</td>
                             <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras1c.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">2° Comida</td>
                             <td style="border: 1px solid #ddd">'.$recordatorioAlimentos24hras2h.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras2d.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras2q.'</td>
                             <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras2c.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">3° Comida</td>
                           <td style="border: 1px solid #ddd">'.$recordatorioAlimentos24hras3h.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras3d.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras3q.'</td>
                             <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras3c.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">4° Comida</td>
                          <td style="border: 1px solid #ddd">'.$recordatorioAlimentos24hras4h.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras4d.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras4q.'</td>
                             <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras4c.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">5° Comida</td>
                       <td style="border: 1px solid #ddd">'.$recordatorioAlimentos24hras5h.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras5d.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras5q.'</td>
                             <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras5c.'</td>
                       </tr>
                       <tr>
                            <td style="border: 1px solid #ddd">6° Comida</td>
                            <td style="border: 1px solid #ddd">'.$recordatorioAlimentos24hras6h.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras6d.'</td>
                            <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras6q.'</td>
                             <td style="border: 1px solid #ddd">'.$ecordatorioAlimentos24hras6c.'</td>
                       </tr>
                       </table>';
            }

            return $html;
    }


    function informacionCorporal($rowv){

           $cadenapaso7=$rowv->paso7;
            if(!empty($cadenapaso7)){
                $datos1=file_get_contents($this->urlc.$cadenapaso7);
                $listav = explode("|",$datos1);
                
                $dabasiPeso=    $listav[1];
                $dabasiAltura=  $listav[2];
                $datosAntroespgrasa=    $listav[3];
                $datosAntroespgrasaporce=   $listav[4];
                $datosAntroespmasakg=   $listav[5];
                $datosAntroespmasaporcen=   $listav[6];
                $datosAntroespmasapmuskg=   $listav[7];
                $datosAntroespmasapmusporcentaje=   $listav[8];

                 $html='<br><h3>Información de composición corporal</h3>
                 <p style="text-align:center">Datos antropométricos básicos</p>
                 <br><br>Peso total (kg.g): '.$dabasiPeso.'<br>

                 <br>Estatura total (cm) : '.$dabasiAltura.'<br>

                  <p style="text-align:center">Datos antropométricos especializados</p>
                  <br>Grasa corporal (kg) : '.$datosAntroespgrasa.'<br>
                  <br>Grasa corporal (%) : '.$datosAntroespgrasaporce.'<br>
                  <br>Masa magra (kg) : '.$datosAntroespmasakg.'<br>
                   <br>Masa magra (%) : '.$datosAntroespmasaporcen.'<br>
                    <br>Masa muscular (kg) : '.$datosAntroespmasapmuskg.'<br>
                    <br>Masa muscular (%) : '.$datosAntroespmasapmusporcentaje.'<br>';
            }
            return  $html;



    }

    function caracteristicasExperiencia($rowv){

            $cadenapaso6=$rowv->paso6;
            if(!empty($cadenapaso6)){
                $datos1=file_get_contents($this->urlc.$cadenapaso6);
                $listav = explode("|",$datos1);
                
                $cdipersoAli=   $listav[1];
                $cdipersoAliporque= $listav[2];
                $cdipersoANivel=    $listav[3];
                $cdipersoANivelCambios= $listav[4];
                $cdipersoAlergias=  $listav[5];
                $cdipersoIntoleranciaalimen=    $listav[6];
                $cdipersoAlinoconsumir= $listav[7];
                $consumoSusAlcolTipo=   $listav[8];
                $consumoSusAlcolcantidad=   $listav[9];
                $consumoSusAlcolFrecuencia= $listav[10];
                $consumoSusTabacoTipo=  $listav[11];
                $consumoSusTabacocantidad=  $listav[12];
                $consumoSusTabacoFrecuencia=    $listav[13];
                $consumoSusCafeinaTipo= $listav[14];
                $consumoSusCafeinacocantidad=   $listav[15];
                $consumoSusCafeinaFrecuencia=   $listav[16];
                $consumoSusOtrasTipo=   $listav[17];
                $consumoSusOtrascocantidad= $listav[18];
                $consumoSusOtrasFrecuencia= $listav[19];
                $edpduraTiempo= $listav[20];
                $edpcuantoTiempo=   $listav[21];
                $edpcResulobtuvo=   $listav[22];
                $edpcxqAbandono=    $listav[23];
                $noedpduraTiempo=   $listav[24];
                $noedpcuantoTiempo= $listav[25];
                $noedpcResulobtuvo= $listav[26];
                $noedpcxqAbandono=  $listav[27];
                $siedpduraTiempo=   $listav[28];
                $siedpcuantoTiempo= $listav[29];
                $siedpcResulobtuvo= $listav[30];
                $siedpcxqAbandono=  $listav[31];
             
                 $html='<h3>Características y Experiencia dietética.</h3>
                 <p style="text-align:center">Características dietéticas personales</p>
                 <br><br>¿Alimentos evitados?: '.$cdipersoAli.'<br>

                 <br>¿Por qué? : '.$cdipersoAliporque.'<br>
                 <br>Nivel de apetito : '.$cdipersoANivel.'<br>
                  <br>¿Cambios recientes en el apetito?: '.$cdipersoANivelCambios.'<br>
                   <br>¿Tiene alguna alergia alimentaria?: '.$cdipersoAlergias.'<br>
                    <br>¿Tiene alguna intolerancia alimentaria?:'.$cdipersoIntoleranciaalimen.'<br>
                    <br>¿Qué alimentos no puede conseguir fácilmente?:'.$cdipersoAlinoconsumir.'<br><br>

                 <table>
                       <tr>
                            <td colspan="4" style="text-align:center;border: 1px solid #ddd;">
                            Consumo de sustancias bioactivas</td>
                   
                       </tr>
                       <tr>
                           <th style="text-align:center;border: 1px solid #ddd">Categoría</th>
                           <th style="text-align:center;border: 1px solid #ddd;">Tipo</th>
                           <th style="text-align:center;border: 1px solid #ddd;">Cantidad</th>
                           <th style="text-align:center;border: 1px solid #ddd;">Frecuencia</th>
                          
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Alcohol</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusAlcolTipo.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusAlcolcantidad.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusAlcolFrecuencia.'</td>
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Tabaco</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusTabacoTipo.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusTabacocantidad.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusTabacoFrecuencia.'</td>
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Cafeína</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusCafeinaTipo.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusCafeinacocantidad.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusCafeinaFrecuencia.'</td>
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Otras drogas</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusOtrasTipo.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusOtrascocantidad.'</td>
                            <td style="border: 1px solid #ddd">'.$consumoSusOtrasFrecuencia.'</td>
                       </tr>
                      </table><br>


                      <table>
                       <tr>
                            <td colspan="5" style="text-align:center;border: 1px solid #ddd;">
                            Experiencia dietética previa</td>
                   
                       </tr>
                       <tr>
                           <th style="text-align:center;border: 1px solid #ddd">Tipo de dieta</th>
                           <th style="text-align:center;border: 1px solid #ddd;">¿Durante cuánto tiempo?</th>
                           <th style="text-align:center;border: 1px solid #ddd;">¿Hace cuánto tiempo?</th>
                           <th style="text-align:center;border: 1px solid #ddd;">¿Qué resultados obtuvo?</th>
                           <th style="text-align:center;border: 1px solid #ddd;">¿Por qué abandono?</th>
                          
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">¿Dietas auto-prescritas?</td>
                            <td style="border: 1px solid #ddd">'.$edpduraTiempo.'</td>
                            <td style="border: 1px solid #ddd">'.$edpcuantoTiempo.'</td>
                            <td style="border: 1px solid #ddd">'.$edpcResulobtuvo.'</td>
                            <td style="border: 1px solid #ddd">'.$edpcxqAbandono.'</td>
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Dietas con prescripción no profesional</td>
                            <td style="border: 1px solid #ddd">'.$noedpduraTiempo.'</td>
                            <td style="border: 1px solid #ddd">'.$noedpcuantoTiempo.'</td>
                            <td style="border: 1px solid #ddd">'.$noedpcResulobtuvo.'</td>
                            <td style="border: 1px solid #ddd">'.$noedpcxqAbandono.'</td>
                       </tr>
                        <tr>
                            <td style="border: 1px solid #ddd">Dietas con prescripción profesional </td>
                            <td style="border: 1px solid #ddd">'.$siedpduraTiempo.'</td>
                            <td style="border: 1px solid #ddd">'.$siedpcuantoTiempo.'</td>
                            <td style="border: 1px solid #ddd">'.$siedpcResulobtuvo.'</td>
                            <td style="border: 1px solid #ddd">'.$siedpcxqAbandono.'</td>
                       </tr>
                      </table>

                 ';
            }
            return $html;
    }

    function experienciaFarma($rowv){
            $cadenapaso5=$rowv->paso5;
            if(!empty($cadenapaso5)){
                $datos1=file_get_contents($this->urlc.$cadenapaso5);
                $listav = explode("|",$datos1);
                
                $usoFarma=$listav[1];
                $vefarHacecuanto=$listav[2];
                $vefarDuranteCuanto=$listav[3];
                $vefarQuienlerecomendo=$listav[4];
                $vefarQuelomotivo=$listav[5];
                $vefarQuienloasesoro=$listav[6];
                $vefarQuefuequelauso=$listav[7];
                $vefarQuetipodefarmauso=$listav[8];
                $vefarQueObjetivologrouso=$listav[9];
                $vefarUsaActualmentefarma=$listav[10];
                $vefarTienePensadousarfarma=$listav[11];
                $vefarObjetivostieneeluso=$listav[12];
                $supleNombre=$listav[13];
                $supleCaracteristicas=$listav[14];
                $supleMotivo=$listav[15];
                $supleTiempo=$listav[16];
                $supleCantidad=$listav[17];
                $valorSuplemne=$listav[18];

                $html='<h3>Experiencia en el uso de Fármacos y Suplementos</h3>
                 <p style="text-align:center">Uso y experiencia con Farmacología deportiva</p>
                 <br><br>¿Ha usado ayudas farmacológicas?:<br>'.$usoFarma.'<br>

                 <br>¿Hace cuánto tiempo las uso?:<br>'.$vefarHacecuanto.'<br>
                 <br>¿Durante cuánto tiempo las uso?:<br>'.$vefarDuranteCuanto.'<br>
                 <br>¿Quién le recomendó usarlas?:<br>'.$vefarQuienlerecomendo.'<br>
                 <br>¿Qué lo motivo a usarlas?:<br>'.$vefarQuelomotivo.'<br>
                 <br>¿Quién le asesoro en su uso?:<br>'.$vefarQuienloasesoro.'<br>
                 <br>¿Cómo fue que las uso?:<br>'.$vefarQuefuequelauso.'<br>
                 <br>¿Qué tipo de fármacos uso?:<br>'.$vefarQuetipodefarmauso.'<br>

                 <br>¿Qué objetivos logro con su uso?:<br>'.$vefarQueObjetivologrouso.'<br>
                 <br>¿Usa actualmente farmacología?:<br>'.$vefarUsaActualmentefarma.'<br>
                 <br>¿Tiene pensado usar farmacología? :<br>'.$vefarTienePensadousarfarma.'<br>
                 <br>¿Qué objetivos tiene con su uso?:<br>'.$vefarObjetivostieneeluso.'<br>  
           
                  <table>
                   <tr>
                        <td colspan="5" style="text-align:center;border: 1px solid #ddd;">
                        Experiencia y uso de Suplementos nutricionales</td>
               
                   </tr>
                   <tr>
                       <th style="text-align:center;border: 1px solid #ddd">Nombre</th>
                       <th style="text-align:center;border: 1px solid #ddd;">Características</th>
                       <th style="text-align:center;border: 1px solid #ddd;">Motivo de uso</th>
                       <th style="text-align:center;border: 1px solid #ddd;">Tiempo de uso</th>
                        <th style="text-align:center;border: 1px solid #ddd;">Cantidad usada</th>
                   </tr>
                    <tr>
                        <td style="border: 1px solid #ddd">'.$supleNombre.'</td>
                        <td style="border: 1px solid #ddd">'.$supleCaracteristicas.'</td>
                        <td style="border: 1px solid #ddd">'.$supleMotivo.'</td>
                        <td style="border: 1px solid #ddd">'.$supleTiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$supleCantidad.'</td>

                      
                   </tr>
                   
                   ';


                $suplementos = explode("&",$datos1);
                $verSuplem = count($suplementos);
                if($verSuplem!=1){
                    
                    $verSuplemen=$suplementos[1];
                    $cantidadSuplementosExtra = explode("-",$verSuplemen);
                    $resultado = count($cantidadSuplementosExtra);
                    $numSuplemento=$resultado;
                    for($i=0;$i<$resultado;$i++){

                        $s1 = explode("_",$cantidadSuplementosExtra[$i]);

                        $html.= '

                        <tr>
                            <td style="border: 1px solid #ddd">'.$s1[0].'</td>
                            <td style="border: 1px solid #ddd">'.$s1[1].'</td>
                            <td style="border: 1px solid #ddd">'.$s1[2].'</td>
                            <td style="border: 1px solid #ddd">'.$s1[3].'</td>
                            <td style="border: 1px solid #ddd">'.$s1[4].'</td>
                       </tr>';

                      

                    }

                    
                }

               $html.='</table>';
                

            }
            return $html;

    }
    function facilidadObjetivos($rowv){

        $cadenapaso4=$rowv->paso4;
            if(!empty($cadenapaso4)){
                $datos1=file_get_contents($this->urlc.$cadenapaso4);
                $listav = explode("|",$datos1);
                
                $cuantasHorasd=$listav[1];
                $utilizasMaPe=$listav[2];
                $conqueHorario=$listav[3];
                $quediasDispones=$listav[4];
                $cuantotiempoAlGym=$listav[5];
                $conqueEquipocardioc=$listav[6];
                $conqueEquipoPesocuen=$listav[7];
                $quetipoClaseGruputilizar=$listav[8];
                $objmejorDepoEspecificaresistencia=$listav[9];
                $objmejorDepoEspecificaFuerza=$listav[10];
                $objmejorDepoEspecificaFlexibilidad=$listav[11];
                $objmejorDepoEspecificaBPErdida=$listav[12];
                $objmejorDepoEspecificaBGanacia=$listav[13];
                $opemsvcro=$listav[14];
                $opemsvespe=$listav[15];
                $opeSocialSensacion=$listav[16];
                $opeSocialExpectativas=$listav[17];
                 $html='<h3>Facilidad y Objetivos para la práctica de ejercicio. </h3>

                 <p style="text-align:center">Disponibilidad para la actividad física y deportiva</p>
                 <br><br>¿Cuántas horas al día dispone para hacer ejercicio? :<br>
                  '.$cuantasHorasd.'
                   <br>¿Cuántos días a la semana dispone para hacer ejercicio?:<br>
                  '.$utilizasMaPe.'
                   <br>¿Con que horario cuentas al día para hacer ejercicio? :<br>
                  '.$conqueHorario.'
                   <br>¿Con que días a la semana cuentas para hacer ejercicio? :<br>
                  '.$quediasDispones.'
                   <br>¿Cuánto tiempo duras en trasladarte el Gym? :<br>
                  '.$cuantotiempoAlGym.'
                   <br>¿Con que equipo para ejercicio cardiovascular cuenta?:<br>
                  '.$conqueEquipocardioc.'
                  <br>¿Con que equipo para ejercicio de pesas cuenta?:<br>
                  '.$conqueEquipoPesocuen.'
                  <br>¿Qué tipo de clases grupales puede realizar?:<br>
                  '.$quetipoClaseGruputilizar.'
                  <p style="text-align:center">Objetivos del programa de entrenamiento</p>
                  <p style="text-align:center">Mejora del rendimiento deportivo especifico</p>
                  <br>¿Resistencia cardiorrespiratoria?:<br>
                  '.$objmejorDepoEspecificaresistencia.'
                  <br>¿Fuerza y/o Potencia?:<br>
                  '.$objmejorDepoEspecificaFuerza.'
                  <br>¿Flexibilidad?:<br>
                  '.$objmejorDepoEspecificaFlexibilidad.'
                  <p style="text-align:center">Razones estéticas y de belleza</p>
                  <br>¿Perdida de grasa corporal?:<br>
                  '.$objmejorDepoEspecificaBPErdida.'
                  <br>¿Ganancia de masa muscular?:<br>
                  '.$objmejorDepoEspecificaBGanacia.'
                 <p style="text-align:center">Mejora del estado de salud y calidad de vida</p>
                  <br>¿Prevención de enfermedades crónicas?:<br>
                                  '.$opemsvcro.'
                  <br>¿Tratamiento de enfermedad especifica?:<br>
                  '.$opemsvespe.'
                   <p style="text-align:center">Aspecto sociocultural del ejercicio</p>
                    <br>¿Qué sensaciones y experiencias tiene con el ejercicio?:<br>
                                  '.$opeSocialSensacion.'
                  <br>¿Qué expectativas y compromiso tiene con el plan de entrenamiento?:<br>
                  '.$opeSocialExpectativas.'
                  ';
            }

         return  $html;

    }

    function experienciaPracEjercicio($rowv){

        $cadenapaso3=$rowv->paso3;
            if(!empty($cadenapaso3)){
                $datos1=file_get_contents($this->urlc.$cadenapaso3);
                $listav = explode("|",$datos1);
                
                $pFnctipo=$listav[1];
                $pFnchace=$listav[2];
                $pFncCuantos=$listav[3];
                $pFncCuantas=$listav[4];
                $pFctipo=$listav[5];
                $pFchace=$listav[6];
                $pFcCuantos=$listav[7];
                $pFcCuantas=$listav[8];
                $hasEntrenado=$listav[9];
                $hasEntrenadoPersonal=$listav[10];
                $entrabaInsCuenta=$listav[11];
                $desdecuendo=$listav[12];
                $cuentosDiasEn=$listav[13];
                $cuentosHorasEn=$listav[14];
                $utilizasMaPe=$listav[15];
                $utilizasClases=$listav[16];
                 $html='<h3>Experiencia en la práctica de ejercicio. </h3>
                <table>
                   <tr>
                        <td colspan="5" style="text-align:center;border: 1px solid #ddd;">
                        Historial de actividad física y deportiva</td>
               
                   </tr>
                   <tr>
                       <th style="text-align:center;border: 1px solid #ddd">Pregunta</th>
                       <th style="text-align:center;border: 1px solid #ddd;">¿Qué tipo de actividad?</th>
                       <th style="text-align:center;border: 1px solid #ddd;">¿Desde hace cuánto tiempo?</th>
                       <th style="text-align:center;border: 1px solid #ddd;">¿Cuántos días a la semana?</th>
                        <th style="text-align:center;border: 1px solid #ddd;">¿Cuántas horas al día?</th>
                   </tr>
                    <tr>
                        <td style="border: 1px solid #ddd">¿Practica actividad física o deporte no competitivo?</td>
                        <td style="border: 1px solid #ddd">'.$pFnctipo.'</td>
                        <td style="border: 1px solid #ddd">'.$pFnchace.'</td>
                        <td style="border: 1px solid #ddd">'.$pFncCuantos.'</td>
                        <td style="border: 1px solid #ddd">'.$pFncCuantas.'</td>

                      
                   </tr>
                    <tr>
                        <td style="border: 1px solid #ddd">¿Practica actividad física o deporte competitivo?</td>
                        <td style="border: 1px solid #ddd">'.$pFctipo.'</td>
                        <td style="border: 1px solid #ddd">'.$pFchace.'</td>
                        <td style="border: 1px solid #ddd">'.$pFcCuantos.'</td>
                        <td style="border: 1px solid #ddd">'.$pFcCuantas.'</td>

                      
                   </tr>
                   </table>

                 <strong>Historial de enfermedades personales</strong><br><br>¿Ha entrenado antes en un centro Fitness (Gym)?:<br>
                  '.$hasEntrenado.'
                   <br><br>¿Contrato a un entrenador personal?:<br>
                  '.$hasEntrenadoPersonal.'
                   <br><br>¿Entrenaba por su propia cuenta con el instructor de piso?:<br>
                   '.$entrabaInsCuenta.'
                    <br><br>¿Desde hace cuánto tiempo ha entrenado en un Gym? :<br>
                  '.$desdecuendo.'
                   <br><br>¿Cuántos días a la semana entrena actualmente?:<br>
                  '.$cuentosDiasEn.'
                   <br><br>¿Cuántas horas al día entrena actualmente? :<br>
                  '.$cuentosHorasEn.'
                    <br><br>¿Utiliza las máquinas y pesos libres?:<br>
                  '.$utilizasMaPe.'
                    <br><br>¿Usa las clases grupales? (zumba, spinning, ritmos latinos, etc.):<br>
                  '.$utilizasClases.'
                

                   ';

            }
            return  $html;

    }

     function historiaLesiones($rowv){
            $cadenapaso2=$rowv->paso2;
            if(!empty($cadenapaso2)){
                $datos2=file_get_contents($this->urlc.$cadenapaso2);
                $listav = explode("|",$datos2);
                $vertebraCuantotiempo=$listav[1];
                $vertebraComosetrato=$listav[2];
                $vdorsalesCuantotiempo=$listav[3];
                $vdorsalesComosetrato=$listav[4];
                $vdLumbaresCuantotiempo=$listav[5];
                $vdLumbaresComosetrato=$listav[6];
                $aHombroCuantotiempo=$listav[7];
                $aHombroComosetrato=$listav[8];
                $aCodoCuantotiempo=$listav[9];
                $aCodoComosetrato=$listav[10];
                $aMunecaCuantotiempo=$listav[11];
                $aMunecaComosetrato=$listav[12];
                $adedosCuantotiempo=$listav[13];
                $adedosComosetrato=$listav[14];
                $aCaderaCuantotiempo=$listav[15];
                $aCaderaComosetrato=$listav[16];
                $aRodillaCuantotiempo=$listav[17];
                $aRodillaComosetrato=$listav[18];
                $aTobilloCuantotiempo=$listav[19];
                $aTobilloComosetrato=$listav[20];
                $humeroCuantotiempo=$listav[21];
                $humeroComosetrato=$listav[22];
                $radioCuantotiempo=$listav[23];
                $radioComosetrato=$listav[24];
                $cubitoCuantotiempo=$listav[25];
                $cubitoComosetrato=$listav[26];
                $carpianosCuantotiempo=$listav[27];
                $carpianosComosetrato=$listav[28];
                $falangesCuantotiempo=$listav[29];
                $falangesComosetrato=$listav[30];
                $claviculasCuantotiempo=$listav[31];
                $claviculasComosetrato=$listav[32];
                $costillasCuantotiempo=$listav[33];
                $costillasComosetrato=$listav[34];
                $craneoCuantotiempo=$listav[35];
                $craneoComosetrato=$listav[36];
                $caderaCuantotiempo=$listav[37];
                $caderaComosetrato=$listav[38];
                $femurCuantotiempo=$listav[39];
                $femurComosetrato=$listav[40];
                $tibiaCuantotiempo=$listav[41];
                $tibiaComosetrato=$listav[42];
                $peroneCuantotiempo=$listav[43];
                $peroneComosetrato=$listav[44];
                $tarsianosCuantotiempo=$listav[45];
                $tarsianosComosetrato=$listav[46];
                $padeces=$listav[47];
                $padecesprobelmas=$listav[48];
                $dfFcar=$listav[49];
                $dfFcarres=$listav[50];
                $html='<h3>Historial de lesiones y enfermedades.</h3>
                <table>
                   <tr>
                        <td colspan="3" style="text-align:center;border: 1px solid #ddd;">Historial de lesiones con implicancia deportiva (luxaciones, esguinces y desagarres)</td>
               
                   </tr>
                   <tr>
                       <th style="text-align:center;border: 1px solid #ddd">Lugar de la lesión</th>
                       <th style="text-align:center;border: 1px solid #ddd;">¿Hace cuánto tiempo?</th>
                       <th style="text-align:center;border: 1px solid #ddd;">¿Cómo se trató la lesión?</th>
                   </tr>
                    <tr>
                        <td style="border: 1px solid #ddd">Vértebras cervicales</td>
                        <td style="border: 1px solid #ddd">'.$vertebraCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$vertebraComosetrato.'</td>
                      
                   </tr>
                    <tr>
                        <td style="border: 1px solid #ddd">Vertebras dorsales </td>
                        <td style="border: 1px solid #ddd">'.$vdorsalesCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$vdorsalesComosetrato.'</td>
                      
                   </tr>
                    <tr>
                        <td style="border: 1px solid #ddd">Vértebras lumbares </td>
                        <td style="border: 1px solid #ddd">'.$vdLumbaresCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$vdLumbaresComosetrato.'</td>
                      
                   </tr>
                    <tr>
                        <td style="border: 1px solid #ddd">Articulación del hombro </td>
                        <td style="border: 1px solid #ddd">'.$aHombroCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$aHombroComosetrato.'</td>
                      
                   </tr>

                    <tr>
                        <td style="border: 1px solid #ddd">Articulación del codo </td>
                        <td style="border: 1px solid #ddd">'.$aCodoCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$aCodoComosetrato.'</td>
                      
                   </tr>

                     <tr>
                        <td style="border: 1px solid #ddd">Articulación de la muñeca </td>
                        <td style="border: 1px solid #ddd">'.$aMunecaCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$aMunecaComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Articulación de los dedos </td>
                        <td style="border: 1px solid #ddd">'.$adedosCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$adedosComosetrato.'</td>
                      
                   </tr>

                     <tr>
                        <td style="border: 1px solid #ddd">Articulación de la cadera  </td>
                        <td style="border: 1px solid #ddd">'.$aCaderaCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$aCaderaComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Articulación de la rodilla </td>
                        <td style="border: 1px solid #ddd">'.$aRodillaCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$aRodillaComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Articulación del tobillo  </td>
                        <td style="border: 1px solid #ddd">'.$aTobilloCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$aTobilloComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td colspan="3" style="text-align:center;border: 1px solid #ddd;">Historial de lesiones con implicancia deportiva (fracturas y fisuras)</td>
               
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Humero  </td>
                        <td style="border: 1px solid #ddd">'.$humeroCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$humeroComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Radio </td>
                        <td style="border: 1px solid #ddd">'.$radioCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$radioComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Cubito </td>
                        <td style="border: 1px solid #ddd">'.$cubitoCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$cubitoComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Carpianos </td>
                        <td style="border: 1px solid #ddd">'.$carpianosCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$carpianosComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Falanges </td>
                        <td style="border: 1px solid #ddd">'.$falangesCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$falangesComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Clavículas  </td>
                        <td style="border: 1px solid #ddd">'.$claviculasCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$claviculasComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Costillas  </td>
                        <td style="border: 1px solid #ddd">'.$costillasCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$costillasComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Cráneo  </td>
                        <td style="border: 1px solid #ddd">'.$craneoCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$craneoComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Cadera  </td>
                        <td style="border: 1px solid #ddd">'.$caderaCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$caderaComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Fémur  </td>
                        <td style="border: 1px solid #ddd">'.$femurCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$femurComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Tibia  </td>
                        <td style="border: 1px solid #ddd">'.$tibiaCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$tibiaComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Peroné </td>
                        <td style="border: 1px solid #ddd">'.$peroneCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$peroneComosetrato.'</td>
                      
                   </tr>
                     <tr>
                        <td style="border: 1px solid #ddd">Tarsianos  </td>
                        <td style="border: 1px solid #ddd">'.$tarsianosCuantotiempo.'</td>
                        <td style="border: 1px solid #ddd">'.$tarsianosComosetrato.'</td>
                      
                   </tr>


                </table><br><br>
                <strong>Historial de enfermedades personales</strong>
                <br><br>¿Padece alguna enfermedad crónica? (Diabetes, Presión elevada, enfermedades del corazón, hígado riñones, etc.):<br>
                '.$padeces.'
                <br>¿Padece algún problema gastrointestinal? (estreñimiento, colitis, gastritis, ulceras, etc.):

                <br> '.$padecesprobelmas.'
                <br><br>
                <strong>Datos fisiológicos</strong>
                <br>
                Frecuencia cardiaca en reposo (pulsaciones por minuto): 
                 '.$dfFcar.'<br>
                 Frecuencia respiratoria en reposo (respiración por minuto): 
                 '.$dfFcarres.'<br>
                ';
                
            }
             return $html;

     }

     function informacionBasica($rowv){
            $cadenapaso1=$rowv->paso1;
            if(!empty($cadenapaso1)){
                
                $datos1=file_get_contents($this->urlc.$cadenapaso1);
                $listav = explode("|",$datos1);
                $nivelEducativo=    $listav[1];
                $actividadLaboral=  $listav[2];
                $nivelSocioeconomico=   $listav[3];
                $actividadocio= $listav[4];
                $estadocivil=   $listav[5];
                $cuantosHijos=  $listav[6];
                $conquienvives= $listav[7];
                $quienpreparaTucomida=  $listav[8];
                $niveldeEstres= $listav[9];
                $horasdeTiempo= $listav[10];
                $cuantasvecesdefecta=   $listav[11];
                $cuantasVecesOrina= $listav[12];
                  $html='<h3>Información sobre estilo de vida básico.</h3>
                <table>
                   <tr>
                       <td class="caracteBasica">Nivel educativo terminado :</td>
                       <td class="descripcionBasica">'.$nivelEducativo.'</td>
                   </tr>
                   <tr>
                       <td class="caracteBasica">Actividad laboral remunerada  :</td>
                       <td class="descripcionBasica">'.$actividadLaboral.'</td>
                   </tr>
                   <tr>
                       <td class="caracteBasica">Nivel socio-económico  :</td>
                       <td class="descripcionBasica">'.$nivelSocioeconomico.'</td>
                   </tr>
                   
                   <tr>
                       <td class="caracteBasica">Actividades de ocio y placer  :</td>
                       <td class="descripcionBasica">'.$actividadocio.'</td>
                   </tr>
                   <tr>
                       <td class="caracteBasica">Estado civil actual  :</td>
                       <td class="descripcionBasica">'.$estadocivil.'</td>
                   </tr>
                   <tr>
                       <td class="caracteBasica">¿Cuántos hijos tiene?  :</td>
                       <td class="descripcionBasica">'.$cuantosHijos.'</td>
                   </tr>
                   <tr>
                       <td class="caracteBasica">¿Con quién vive?  :</td>
                       <td class="descripcionBasica">'.$conquienvives.'</td>
                   </tr>
                   <tr>
                       <td class="caracteBasica">¿Quién prepara su comida?   :</td>
                       <td class="descripcionBasica">'.$quienpreparaTucomida.'</td>
                   </tr>
                    <tr>
                       <td class="caracteBasica">Nivel de estrés diario   :</td>
                       <td class="descripcionBasica">'.$horasdeTiempo.'</td>
                   </tr>
                    <tr>
                           <td class="caracteBasica">¿Cuántas veces defeca en promedio al día?:</td>
                           <td class="descripcionBasica">'.$cuantasvecesdefecta.'</td>
                   </tr>
                    <tr>
                           <td class="caracteBasica">¿Cuántas veces orina en promedio al día?:</td>
                           <td class="descripcionBasica">'.$cuantasVecesOrina.'</td>
                   </tr>
                   
                   

                </table>';

        
            }

            return $html;

     }

    function general($idclientese){


        $query=$this->cliente_models->getid($idclientese);
        $row = $query->row();
        $pedidoInicial=$row->pedidoInicial;
        $nombre=$row->nombre;
        $sexo=$row->genero;
        $fecha=$row->fecha_nacimento;
        $telefono=$row->telefono;
        $WhatsApp=$row->movil;
        $email=$row->email;
        $password=$row->password;
        $perfil=$row->perfil_facebook;
        $domicio=$row->domicilio;
        $colonia=$row->colonia;
        $ciudad=$row->ciudad;
        $estado=$row->estado;
        $Pais=$row->pais;
        $cp=$row->cp;
        $nivel_motivacion=$row->nivel_motivacion;
        $objetivo_principal=$row->objetivo_principal;
        $html='<h3>Información General y de Contacto.</h3>
        <table>
           <tr>
               <td class="caracte">Nombre completo :</td>
               <td class="descripcion">'.$nombre.'</td>
           </tr>
           <tr>
               <td class="caracte">Género (sexo) :</td>
               <td class="descripcion">'.$sexo.'</td>
           </tr>
           <tr>
               <td class="caracte">Fecha exacta de nacimiento :</td>
               <td class="descripcion">'.date("d/m/Y", strtotime($fecha)) .'</td>
           </tr>
           <tr>
               <td colspan="2"><p style="color:#A4A4A4">_________________________</p></td>
               
           </tr>
           <tr>
               <td class="caracte">Domicilio  :</td>
               <td class="descripcion">'.$domicio.'</td>
           </tr>
           <tr>
               <td class="caracte">Colonia  :</td>
               <td class="descripcion">'.$colonia.'</td>
           </tr>
           <tr>
               <td class="caracte">Ciudad  :</td>
               <td class="descripcion">'.$ciudad.'</td>
           </tr>
           <tr>
               <td class="caracte">Estado  :</td>
               <td class="descripcion">'.$estado.'</td>
           </tr>
           <tr>
               <td class="caracte">País  :</td>
               <td class="descripcion">'.$Pais.'</td>
           </tr>
            <tr>
               <td class="caracte">Código postal  :</td>
               <td class="descripcion">'.$cp.'</td>
           </tr>
           <tr>
               <td colspan="2"><p style="color:#A4A4A4">_________________________</p></td>
               
           </tr>
            <tr>
                   <td class="caracte">WhatsApp:</td>
                   <td class="descripcion">'.$WhatsApp.'</td>
           </tr>
            <tr>
                   <td class="caracte">Teléfono fijo:</td>
                   <td class="descripcion">'.$telefono.'</td>
           </tr>
            <tr>
                   <td class="caracte">Correo electrónico:</td>
                   <td class="descripcion">'.$email.'</td>
           </tr>
            <tr>
                   <td class="caracte">Perfil en Facebook :</td>
                   <td class="descripcion">'.$perfil.'</td>
           </tr>
            <tr>
               <td colspan="2"><p style="color:#A4A4A4">_________________________</p></td>
               
           </tr>
            <tr>
                   <td class="caracte">Nivel de Motivación   :</td>
                   <td class="descripcion">'.$nivel_motivacion.'</td>
           </tr>
           <tr>
                   <td class="caracte">Objetivo principal de la consulta   :</td>
                   <td class="descripcion">'.$objetivo_principal.'</td>
           </tr>

        </table>';

        return $html;

    }






}