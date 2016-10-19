<?php
require_once 'lib/phpMAILER/class.phpmailer.php';

class Alumno
{
	private $pdo;
    
    public $id;
    public $Nombre;
    public $Apellido;
    public $Sexo;
    public $FechaRegistro;
    public $FechaNacimiento;
    public $Foto;
    public $Email;
	public $Estudios;
	public $Baja;
		
	public $DNI;
	public $TelefonoMovil;
	public $TelefonoFijo;
	public $FechaCamiseta;
	public $GrupoTeoria;
	public $GrupoFisicas;
	public $GrupoAcceso;
	public $GrupoOnline;
	public $Carnet;
	public $Camiseta;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::Conectar();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();
			
			$stm = $this->pdo->prepare("SELECT * FROM alumnos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarPorGrupo($idGrupo)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM alumnos WHERE GrupoTeoria = ? OR GrupoFisicas = ? OR GrupoAcceso = ? OR GrupoOnline = ?");
			
			$stm->execute(array($idGrupo, $idGrupo, $idGrupo, $idGrupo));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarPorTipoPago($idTipoPago, $fechaInicial, $fechaFinal)
	{
		try
		{
			$result = array();
			
			$stm = $this->pdo->prepare("SELECT * FROM `alumnos` INNER JOIN `pagos` ON alumnos.id = pagos.Alumno WHERE TipoPago = ? AND pagos.Fecha >= ? AND pagos.Fecha <= ?");
			$stm->execute(array($idTipoPago, $fechaInicial, $fechaFinal));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarPorOrden($ord, $dir)
	{
		try
		{
			$result = array();

			if (intval($dir) == 1){
				$sql = "SELECT * FROM alumnos ORDER BY ". $ord . " ASC";
				$stm = $this->pdo->prepare($sql);
			}else{
				$sql = "SELECT * FROM alumnos ORDER BY ". $ord . " DESC";
				$stm = $this->pdo->prepare($sql);
			}
			
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function BuscarAlumno($busqueda)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM alumnos WHERE Nombre LIKE ? OR Apellido LIKE ? OR dni LIKE ?");
			$stm->execute(array('%'.$busqueda.'%','%'.$busqueda.'%','%'.$busqueda.'%'));
			
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM alumnos WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM alumnos WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE alumnos SET 
						Nombre          = ?, 
						Apellido        = ?,
                        Email        	= ?,
						Sexo            = ?, 
						FechaNacimiento = ?,
						FechaCamiseta   = ?,
						TelefonoMovil   = ?,
						TelefonoFijo    = ?,
						DNI            	= ?,
						FechaRegistro	= ?,
						GrupoTeoria		= ?,
						GrupoFisicas	= ?,
						Carnet			= ?,
						Camiseta		= ?,
						Foto			= ?,
						Estudios		= ?,
						Baja			= ?,
						GrupoAcceso		= ?,
						GrupoOnline		= ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nombre, 
                        $data->Apellido,
                        $data->Email,
                        $data->Sexo,
                        $data->FechaNacimiento,
                        $data->FechaCamiseta,
                        $data->TelefonoMovil,
                        $data->TelefonoFijo,
                        $data->DNI,
                        $data->FechaRegistro,
                        $data->GrupoTeoria,
                        $data->GrupoFisicas,
                        $data->Carnet,
                        $data->Camiseta,
                        $data->Foto,
						$data->Estudios,
						$data->Baja,
						$data->GrupoAcceso,
						$data->GrupoOnline,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Alumno $data)
	{
		try 
		{
		$sql = "INSERT INTO alumnos (
							Nombre,
							Apellido,
							Email,
							Sexo,
							FechaNacimiento,
							FechaRegistro,
							FechaCamiseta,
							TelefonoMovil,
							TelefonoFijo,
							DNI,
							GrupoTeoria,
							GrupoFisicas,
							Carnet,
							Camiseta,
							Foto,
							Estudios,
							Baja,
							GrupoAcceso,
							GrupoOnline) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nombre,
                    $data->Apellido, 
                    $data->Email, 
                    $data->Sexo,
                    $data->FechaNacimiento,
                    $data->FechaRegistro,
                    $data->FechaCamiseta,
                    $data->TelefonoMovil,
                    $data->TelefonoFijo,
                    $data->DNI,
                    $data->GrupoTeoria,
                    $data->GrupoFisicas,
                    $data->Carnet,
                    $data->Camiseta,
                    $data->Foto,
                    $data->Estudios,
                    $data->Baja,
                    $data->GrupoAcceso,
                    $data->GrupoOnline
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	public function EnviarEmail($id, $cuerpoMensaje){
		$alu = $this->Obtener($id);
		
		//$cuerpoMensaje = "Esto es una aviso de aprepol";
		
		$mail = new phpmailer();
		$mail->Timeout=15;
		$mail->SetFrom("info@aprepol.com", "Avisos Aprepol");
		$mail->Subject ="Avisos Aprepol";
		
		//$mail->AddAddress("proyectos@malagamicro.com");
		$mail->AddAddress($alu->Email);
		
        $mail->Body=$cuerpoMensaje; 
        $mail->IsHTML(true);			
        $mail->Send();		
	}
	
	//ESTA  FUNCION SOLO HAY QUE CAMBIAR EL MODO DE ENVIAR MAILS POR SMS, APLICAR API
	public function EnviarSMS($id, $cuerpoMensaje){
		$alu = $this->Obtener($id);
		
		//$cuerpoMensaje = "Esto es una aviso de aprepol";
		
		$mail = new phpmailer();
		$mail->Timeout=15;
		$mail->SetFrom("info@aprepol.es", "Avisos Aprepol");
		$mail->Subject ="Avisos Aprepol SMS temporal";
		
		//$mail->AddAddress("proyectos@malagamicro.com");
		$mail->AddAddress($alu->Email);
		
        $mail->Body=$cuerpoMensaje; 
        $mail->IsHTML(true);			
        $mail->Send();		
	}
	
}