<?php
class Login
{
	private $pdo;
    	
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

	public function ComprobarUsuario($Usuario)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE Nombre LIKE ?");
			$stm->execute(array('%'.$Usuario.'%'));
			
			return $stm->fetchAll(PDO::FETCH_OBJ);	
			
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}	
}