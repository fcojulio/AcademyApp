<?php
class Pago
{
	private $pdo;
    
    public $id;
    public $Alumno;
	public $Fecha;
	public $FechaValidez;
	public $CategoriaPago;
	public $TipoDurGrupo;
	public $FechaFinal;
	public $Dias;
	
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

			$stm = $this->pdo->prepare("SELECT * FROM pagos ORDER BY Fecha DESC");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarPorAlumno($idAlumno)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pagos WHERE Alumno = ? ORDER BY Fecha DESC");
			$stm->execute(array($idAlumno));

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
				$sql = "SELECT * FROM pagos ORDER BY ". $ord . " ASC";
				$stm = $this->pdo->prepare($sql);
			}else{
				$sql = "SELECT * FROM pagos ORDER BY ". $ord . " DESC";
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
	
	public function ListarUltimosPorAlumno($idAlumno, $limit)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM `pagos` WHERE `Alumno` = ? ORDER BY `Fecha` DESC LIMIT 6");
			$stm->execute(array($idAlumno));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarUltimoPorAlumno($idAlumno)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM `pagos` WHERE `Alumno` = ? ORDER BY `Fecha` DESC LIMIT 1");
			$stm->execute(array($idAlumno));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarUltimoPorAlumnoTipo($idAlumno, $tipo)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM `pagos` WHERE `Alumno` = ? AND `CategoriaPago` = ? ORDER BY `Fecha` DESC LIMIT 1");
			$stm->execute(array($idAlumno, $tipo));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerUltimoPagoAlumnoMesTipo($idAlumno, $CategoriaPago, $TipoDurGrupoA, $TipoDurGrupoB, $TipoDurGrupoC)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM pagos 
			          				WHERE Alumno = ? 
			          				AND (TipoDurGrupo = ? OR TipoDurGrupo = ? OR TipoDurGrupo = ?) 
			          				AND CategoriaPago = ? 
			          				ORDER BY FechaFinal DESC 
			          				LIMIT 0,1");
			          

			$stm->execute(array($idAlumno, $TipoDurGrupoA, $TipoDurGrupoB, $TipoDurGrupoC, $CategoriaPago));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	
	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM pagos WHERE id = ?");
			          

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
			            ->prepare("DELETE FROM pagos WHERE id = ?");			          

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
			$sql = "UPDATE pagos SET 
						CategoriaPago	= ?,
						TipoDurGrupo	= ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(                        
                        $data->CategoriaPago,
                        $data->TipoDurGrupo,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Pago $data)
	{
		try 
		{
		$sql = "INSERT INTO pagos (Alumno, Fecha, CategoriaPago, TipoDurGrupo, TipoPago, Valor, FechaValidez, FechaFinal) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		$fecha = new DateTime('NOW');
		$fechaFinal = new DateTime($data->FechaValidez);
		
		if ($data->Dias >= 28 and $data->Dias <= 31 ){
			$fechaFinal = date("Y-m-t", strtotime($fechaFinal->format('Y-m-d')) );
		}else{
			$fechaFinal = $fechaFinal->add(new DateInterval('P'.$data->Dias.'D'))->format('Y-m-d');
		}
		//echo $fecha->format('Y-m-d') . "\n";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Alumno,
                    $fecha->format('Y-m-d'),
                    $data->CategoriaPago,
                    $data->TipoDurGrupo,
                    $data->TipoPago,
                    $data->Valor,
                    $data->FechaValidez,
                    $fechaFinal
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}