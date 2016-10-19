<?php
require_once 'model/pago.php';
require_once 'model/cuenta.php';
require_once 'model/alumno.php';
require_once 'model/tipopago.php';
require_once 'model/otrotipopago.php';
require_once 'model/categoriapago.php';
require_once 'model/tipodurgrupo.php';

class CuentaController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Cuenta();
    }
    
    public function Index(){
		
        require_once 'view/header.php';
        require_once 'view/cuenta/cuenta.php';
        require_once 'view/footer.php';
    }
    
	public function VerCuenta(){		
		$pg = new Pago();
    	$tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		$tp = new TipoPago();
		
		if( isset($_REQUEST['FechaInicio']) and isset($_REQUEST['FechaFinal']) ){		
		
			$fechaInicio = $_REQUEST['FechaInicio'];
			$fechaFinal = $_REQUEST['FechaFinal'];
			
			$c = new Cuenta();
			$cuentas = $c->ListarPagos($fechaInicio, $fechaFinal);
			$gastos = $c->ListarGastos($fechaInicio, $fechaFinal);
			
			require_once 'view/header.php';
	        require_once 'view/cuenta/cuenta.php';
			require_once 'view/cuenta/cuenta-ver.php';
	        require_once 'view/footer.php';
        }
	}
	
	public function ImprimirCuenta(){
		$pg = new Pago();
    	$tdg = new TipoDurGrupo();
        $cp = new CategoriaPago();
		$alu = new Alumno();
		$tp = new TipoPago();		
		
		$cuerpoTicket = "<h1>Academia Aprepol</h1>";
		$cuerpoTicket .= date('d-m-Y') . "<br><br>";
		
		$listadoNuevosPagos = $_REQUEST['TipoPago'];			
		$total = 0;
		
		for($i=0; $i < count($listadoNuevosPagos); $i++){
			
			$pg->TipoPago = $listadoNuevosPagos[$i];
			
			$pg->Valor = $tp->Obtener($listadoNuevosPagos[$i])->Valor;
			$pg->Dias = $tp->Obtener($listadoNuevosPagos[$i])->Dias;		
			
			$pg->CategoriaPago = $tp->Obtener($listadoNuevosPagos[$i])->CategoriaPago;
			$pg->TipoDurGrupo = $tp->Obtener($listadoNuevosPagos[$i])->TipoDurGrupo;
			$pg->Valor = $tp->Obtener($listadoNuevosPagos[$i])->Valor;
			$pg->Dias = $tp->Obtener($listadoNuevosPagos[$i])->Dias;
			$total = $total + $pg->Valor;
			
			$cuerpoTicket .= $tp->Obtener($pg->TipoPago)->Nombre . " - " . $cp->Obtener($pg->CategoriaPago)->Nombre . " : " . $pg->Valor . "€<br><br>";
		}
		
		$cuerpoTicket .= "<h2>TOTAL: " . $total . " €</h2><br><br>";
		
		$dompdf = new DOMPDF();
		$customPaper = array(0,0,302,400);
		$dompdf->set_paper($customPaper);
	
	    $dompdf->load_html($cuerpoTicket);
	    //$dompdf->set_paper("letter", "portrait" );
	    $dompdf->render();
	    $output = $dompdf->output();
	    $file_to_save = 'tmp/ticket.pdf';
	        
	    file_put_contents($file_to_save, $output); 
		
		require_once 'view/pago/pago-cabecera-pdf.php';
		require_once 'view/header.php';
		require_once 'view/pago/pago-aviso-impresion.php';
        require_once 'view/pago/pago.php';
        require_once 'view/footer.php';
		
	}
	
}