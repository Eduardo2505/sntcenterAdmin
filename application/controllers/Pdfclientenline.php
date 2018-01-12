<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfclientenline extends CI_Controller {

 private $urlc = 'http://localhost/sntcuestionario/';

    function __construct() {
        parent::__construct();
        $this->load->model('cliente_models');
        $this->load->model('cuestionario_models');
        $this->load->helper('url');
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


         $html =  $css.$general.
                  $informacionBasica.$lesiones.
                  $ExperienciaEjercicio.$facilidadObjetivos;


       


// set font
        $pdf->SetFont('helvetica', '', 8);

// set cell padding


        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


        $nombre_archivo = utf8_decode('Caratula_de_Cita.pdf');
        $pdf->Output($nombre_archivo, 'I');
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