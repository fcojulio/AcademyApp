<?php
class TipoPago
{
	private $pdo;
    
    public $id;
    public $Nombre;
	public $CategoriaPago;
	public $TipoDurGrupo;
	public $Valor;
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

			$stm = $this->pdo->prepare("SELECT * FROM tipopagos ORDER BY CategoriaPago");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarPorCategoria($idCategoriaPago)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tipopagos WHERE CategoriaPago = ?");
			$stm->execute(array($idCategoriaPago));

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
			          ->prepare("SELECT * FROM tipopagos WHERE id = ?");
			          

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
			            ->prepare("DELETE FROM tipopagos WHERE id = ?");			          

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
			$sql = "UPDATE tipopagos SET 
						Nombre          = ?,
						CategoriaPago	= ?,
						TipoDurGrupo	= ?,
						Valor			= ?,
						Dias			= ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nombre,
                        $data->CategoriaPago,
                        $data->TipoDurGrupo,
                        $data->Valor, 
                        $data->Dias,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(TipoPago $data)
	{
		try 
		{
		$sql = "INSERT INTO tipopagos (Nombre, CategoriaPago, TipoDurGrupo, Valor,Dias) 
		        VALUES (?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nombre,
                    $data->CategoriaPago,
                    $data->TipoDurGrupo,
                    $data->Valor,
                    $data->Dias
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}