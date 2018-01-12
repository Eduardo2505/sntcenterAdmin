<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    private $limite = 10;

    function __construct() {

        parent::__construct();
        
    }

    public function close() {
        redirect('', 'refresh');
    }

    public function index() {

        $datam['agenda'] = "start active";

        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']="-";//Eliminar

        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('calendario', $data);
    }
    public function pacienteLista() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);


        $data['pagination']="-";//Eliminar
        $datab['usuario']="-";//Eliminar

        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('paciente/lista', $data);
    }

    public function paciente() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('paciente/paciente', $data);
    }
    public function ficha() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('paciente/ficha', $data);
    }

    public function hitorial() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']="-";//Eliminar

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('historial/historial', $data);
    }

    public function nuevohitorial() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']="-";//Eliminar

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('historial/nuevoHistorial', $data);
    }

    public function editarhitorial() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('historial/editarHistorial', $data);
    }
    public function pagos() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']="-";//Eliminar

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('pagos/lista', $data);
    }
    public function nuevoPagos() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']="-";//Eliminar

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('pagos/registro', $data);
    }
    public function editarPagos() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['usuario']="-";//Eliminar

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('pagos/editar', $data);
    }


    public function citas() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('citas/lista', $data);
    }

    public function nuevaCita() {


        $datam['paciente'] = "start active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('citas/registro', $data);
    }

    public function rHistorial() {


        $datam['reportes'] = "start active";
        $datam['rhistorial'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);
        $datab['agendex'] = "x";
        
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('rHistorial/historial', $data);
    }
    public function rHistorialreporte() {


        $datam['reportes'] = "start active";
        $datam['rhistorial'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('rHistorial/reporte', $data);
    }

    
    
    public function rPagos() {


        $datam['reportes'] = "start active";
        $datam['rPagos'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('rPagos/lista', $data);
    }

    public function rPagosreporte() {


        $datam['reportes'] = "start active";
        $datam['rPagos'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        
        $datab['usuario']="-";//Eliminar

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('rPagos/reporte', $data);
    }
    public function rCitas() {


        $datam['reportes'] = "start active";
        $datam['rCitas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('rCitas/lista', $data);
    }

    public function rCitasreporte() {


        $datam['reportes'] = "start active";
        $datam['rCitas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('rCitas/reporte', $data);
    }

    public function profesionales() {


        $datam['admin'] = "start active";
        $datam['aprofesionales'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('profesionales/lista', $data);
    }
    public function nuevoprofesionales() {


        $datam['admin'] = "start active";
        $datam['aprofesionales'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('profesionales/registro', $data);
    }
    public function editarprofesionales() {


        $datam['admin'] = "start active";
        $datam['aprofesionales'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('profesionales/editar', $data);
    }

    public function empresa() {


        $datam['admin'] = "start active";
        $datam['aempresa'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('empresas/lista', $data);
    }
    public function nuevaempresa() {


        $datam['admin'] = "start active";
        $datam['aempresa'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('empresas/registro', $data);
    }
    public function editarempresa() {


        $datam['admin'] = "start active";
        $datam['aempresa'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('empresas/editar', $data);
    }
    public function productos() {


        $datam['inventario'] = "start active";
        $datam['iproducto'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('productos/lista', $data);
    }
    public function nuevoproductos() {


        $datam['inventario'] = "start active";
        $datam['iproducto'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('productos/registro', $data);
    }
    public function editarproductos() {


        $datam['inventario'] = "start active";
        $datam['iproducto'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('productos/editar', $data);
    }

    public function exitencias() {


        $datam['inventario'] = "start active";
        $datam['iexitencias'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('existencias/lista', $data);
    }

    public function entradas() {


        $datam['inventario'] = "start active";
        $datam['ientradas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('entradas/lista', $data);
    }
    public function nuevaentradas() {


        $datam['inventario'] = "start active";
        $datam['ientradas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('entradas/registro', $data);
    }
    public function editarentradas() {


        $datam['inventario'] = "start active";
        $datam['ientradas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('entradas/editar', $data);
    }
    public function salidas() {


        $datam['inventario'] = "start active";
        $datam['isalidas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('salidas/lista', $data);
    }
    public function nuevasalidas() {


        $datam['inventario'] = "start active";
        $datam['isalidas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('salidas/registro', $data);
    }
    public function editarsalidas() {


        $datam['inventario'] = "start active";
        $datam['isalidas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('salidas/editar', $data);
    }

    public function quincenas() {


        $datam['corte'] = "start active";
        $datam['cquincenas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('quincenas/lista', $data);
    }

    public function nuevaquincenas() {


        $datam['corte'] = "start active";
        $datam['cquincenas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('quincenas/registro', $data);
    }
    public function editarquincenas() {


        $datam['corte'] = "start active";
        $datam['cquincenas'] = "active";
        $data['menu'] = $this->load->view('plantilla/menu', $datam, true);

        $datab['usuario']="-";//Eliminar
        

        $data['pagination']="-";//Eliminar
        
        $data['barra'] = $this->load->view('plantilla/barra', $datab, true);
        $this->load->view('quincenas/editar', $data);
    }





}
