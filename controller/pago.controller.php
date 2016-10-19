<?php
require_once 'model/pago.php';
require_once 'model/alumno.php';
require_once 'model/tipopago.php';
require_once 'model/otrotipopago.php';
require_once 'model/categoriapago.php';
require_once 'model/tipodurgrupo.php';
require_once 'lib/dompdf/dompdf_config.inc.php';

class PagoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Pago();
    }
    
    public function Index(){
    	$pg = new Pago();
    	$tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		$alu = new Alumno();
		$tp = new TipoPago();
		
        require_once 'view/header.php';
        require_once 'view/pago/pago.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
    	$pg = new Pago();
        $tp = new TipoPago();
		$otp = new OtroTipoPago();
        $cp = new CategoriaPago();
		$alu = new Alumno();
		$tdg = new TipoDurGrupo();
		
        if(isset($_REQUEST['id'])){
            $pg = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/pago/pago-editar.php';
        require_once 'view/footer.php';
    }
    
	public function VerPago(){
		$pg = new Pago();
        $tp = new TipoPago();
        $cp = new CategoriaPago();		
		
		$listadoNuevosPagos = $_REQUEST['TipoPago'];
		
		require_once 'view/header.php';
        require_once 'view/pago/ver-pago.php';
        require_once 'view/footer.php';
	}
	
	public function Guardar($listadoNuevosPagos, $Alumno, $FechaValidez, $ModoPago){
		
        $pg = new Pago();
        $tp = new TipoPago();
		$otp = new OtroTipoPago();
        $cp = new CategoriaPago();		
		
		//$listadoNuevosPagos = $_REQUEST['TipoPago'];
		
		for($i=0; $i < count($listadoNuevosPagos); $i++){
			
	        $pg->Alumno = $Alumno;   
			$pg->TipoPago = $listadoNuevosPagos[$i];
			$pg->FechaValidez = $FechaValidez;
			
			$pg->CategoriaPago = $tp->Obtener($listadoNuevosPagos[$i])->CategoriaPago;
			$pg->TipoDurGrupo = $tp->Obtener($listadoNuevosPagos[$i])->TipoDurGrupo;
			$pg->Valor = $tp->Obtener($listadoNuevosPagos[$i])->Valor;
			
			if ($ModoPago == 2){
				$pg->Valor = 0000000;
			}
			
			$pg->Dias = $tp->Obtener($listadoNuevosPagos[$i])->Dias;		
			
			$this->model->Registrar($pg);
		}		
		
        //header('Location: index.php?c=Pago&ListarPorAlumno='.$_REQUEST['Alumno']);
    }
	
	public function ImprimirPago(){
		$pg = new Pago();
    	$tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		$alu = new Alumno();
		$tp = new TipoPago();		
				
		$listadoNuevosPagos = $_REQUEST['TipoPago'];	
		$AlumnoTicketImprimir = $_REQUEST['Alumno'];
		$FechaValidez = $_REQUEST['FechaValidez'];
		$MesP = $_REQUEST['Mes'];
		$ModoPago = $_REQUEST['ModoPago'];
		
		$this->Guardar($listadoNuevosPagos, $AlumnoTicketImprimir, $FechaValidez, $ModoPago);
				
		$total = 0;
					
		$mes = "";
		
		switch (date('m')) {
			case '01':
				$mes = "Enero";
				break;
			case '02':
				$mes = "Febrero";
				break;
			case '03':
				$mes = "Marzo";
				break;
			case '04':
				$mes = "Abril";
				break;
			case '05':
				$mes = "Mayo";
				break;
			case '06':
				$mes = "Junio";
				break;
			case '07':
				$mes = "Julio";
				break;
			case '08':
				$mes = "Agosto";
				break;
			case '09':
				$mes = "Septiembre";
				break;
			case '10':
				$mes = "Octubre";
				break;
			case '11':
				$mes = "Noviembre";
				break;
			case '12':
				$mes = "Diciembre";
				break;
			default:				
				break;
		}
		
		switch ($MesP) {
			case '01':
				$MesP = "Enero";
				break;
			case '02':
				$MesP = "Febrero";
				break;
			case '03':
				$MesP = "Marzo";
				break;
			case '04':
				$MesP = "Abril";
				break;
			case '05':
				$MesP = "Mayo";
				break;
			case '06':
				$MesP = "Junio";
				break;
			case '07':
				$MesP = "Julio";
				break;
			case '08':
				$MesP = "Agosto";
				break;
			case '09':
				$MesP = "Septiembre";
				break;
			case '10':
				$MesP = "Octubre";
				break;
			case '11':
				$MesP = "Noviembre";
				break;
			case '12':
				$MesP = "Diciembre";
				break;
			default:				
				break;
		}
					
		$cuerpoTicket = "<div align='center' ><h3>" . date('d') ." - " . $mes . " - ". date('Y') . "<br>";	
		$cuerpoTicket .= strtoupper($alu->Obtener($AlumnoTicketImprimir)->Nombre) . " " . strtoupper($alu->Obtener($AlumnoTicketImprimir)->Apellido) . "</h3></div>";			
		$cuerpoTicket .= "<table style='width: 100%; ' >";
		$cuerpoTicket .= "<tr><td style='border-bottom: 1px dashed black;' >Concepto</td><td style='border-bottom: 1px dashed black;' >Importe</h3></td>";
		
		for($i=0; $i < count($listadoNuevosPagos); $i++){
			
			$pg->TipoPago = $listadoNuevosPagos[$i];
			
			$pg->Valor = $tp->Obtener($listadoNuevosPagos[$i])->Valor;
			$pg->Dias = $tp->Obtener($listadoNuevosPagos[$i])->Dias;		
			//$pg->FechaValidez = $tp->Obtener($listadoNuevosPagos[$i])->FechaValidez;
			
			$pg->CategoriaPago = $tp->Obtener($listadoNuevosPagos[$i])->CategoriaPago;
			$pg->TipoDurGrupo = $tp->Obtener($listadoNuevosPagos[$i])->TipoDurGrupo;
			$pg->Valor = $tp->Obtener($listadoNuevosPagos[$i])->Valor;
			$pg->Dias = $tp->Obtener($listadoNuevosPagos[$i])->Dias;
			$total = $total + $pg->Valor;
			$cuerpoTicket .= "<tr><td>" . $tp->Obtener($pg->TipoPago)->Nombre . " " . $MesP . "</td><td >" . $pg->Valor . " €</td></tr>";
		}
		
		$cuerpoTicket .= "<tr><td style='border-top: 1px dashed black;' ><h3>TOTAL</h3></td><td style='border-top: 1px dashed black;' ><h3>" . $total . " €</h3></td>";
		$cuerpoTicket .= "</table>";
				
		$ticket = "<html><head></head><body style='font-family: Helvetica' >";
		$ticket .= "<div style='margin-top: -40px;' align='center'><img src='./images/misc/logoMINI.png' width=240px /></div>";
		$ticket .= "<div align='center' >www.-__-.com<br>";
		$ticket .= "Address<br>";
		$ticket .= "NIF: - PHONE</div";
		$ticket .= $cuerpoTicket;		
		$ticket .= "<div align='center'>Mantenga dicho recibo para cualquier reclamación</div>";
		//$ticket .= "</body></html>";
		
		$ticket .= "<div style='page-break-before: always;'>";
		
		//$ticket .= "<body><html>";
		$ticket .= $cuerpoTicket;
		$ticket .= "</body></html>";
		
		if ($ModoPago == 1){		
		
			$dompdf = new DOMPDF();
			$dompdf->set_option('enable_css_float',true);
			$customPaper = array(0,0,302,450);
			$dompdf->set_paper($customPaper);
		
		    $dompdf->load_html($ticket);
		    //$dompdf->set_paper("letter", "portrait" );
		    $dompdf->render();
		    $output = $dompdf->output();
		    $file_to_save = 'tmp/ticket1.pdf';
		        
		    file_put_contents($file_to_save, $output); 
		}
	    /*$dompdf = new DOMPDF();
		$dompdf->set_option('enable_css_float',true);
		$customPaper = array(0,0,302,400);
		$dompdf->set_paper($customPaper);
	
	    $dompdf->load_html($ticket2);
	    //$dompdf->set_paper("letter", "portrait" );
	    $dompdf->render();
	    $output = $dompdf->output();
	    $file_to_save = 'tmp/ticket2.pdf';
	        
	    file_put_contents($file_to_save, $output); */
		
		require_once 'view/pago/pago-cabecera-pdf.php';
		require_once 'view/header.php';
		require_once 'view/pago/pago-aviso-impresion.php';
        require_once 'view/pago/pago.php';
        require_once 'view/footer.php';
		
	}    
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
		$idAlumno = $_REQUEST['idAlumno'];
        header('Location: index.php?c=Pago&ListarPorAlumno='.$idAlumno);
    }
}