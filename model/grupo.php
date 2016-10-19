<?php
class Grupo
{
	private $pdo;
    
    public $id;
    public $Nombre;
	public $Tipo;

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

	public function ListarGrupos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM grupos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarPorTipo($tipo)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM grupos WHERE Tipo = ?");
			$stm->execute(array($tipo));

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function TotalAlumnosPorGrupo($id)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT count(*) as TotalAlumnos FROM `alumnos` WHERE GrupoTeoria = ? OR GrupoFisicas = ? OR GrupoAcceso = ? OR GrupoOnline = ?");
			$stm->execute(array($id, $id, $id, $id));

			return $stm->fetch(PDO::FETCH_OBJ);
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
			          ->prepare("SELECT * FROM grupos WHERE id = ?");
			          

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
			            ->prepare("DELETE FROM grupos WHERE id = ?");			          

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
			$sql = "UPDATE grupos SET 
						Nombre          = ?,
						Tipo			= ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nombre, 
                        $data->Tipo,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Grupo $data)
	{
		try 
		{
		$sql = "INSERT INTO grupos (Nombre, Tipo) 
		        VALUES (?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nombre,
                    $data->Tipo
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}