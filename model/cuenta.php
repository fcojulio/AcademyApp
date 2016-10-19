<?php
class Cuenta
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

	public function ListarPagos($FechaInicio, $FechaFinal)
	{
		try
		{
			$result = array();

			echo $FechaFinal . " " . $FechaInicio;
			$cue = $this->pdo->prepare("SELECT TipoPago, count(TipoPago) con, SUM(Valor) sum FROM `pagos` WHERE `Fecha` >= ? AND `Fecha` <= ? GROUP BY TipoPago");
			$cue->execute(array($FechaInicio, $FechaFinal));

			return $cue->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarGastos($FechaInicio, $FechaFinal)
	{
		try
		{
			$result = array();

			echo $FechaFinal . " " . $FechaInicio;
			$cue = $this->pdo->prepare("SELECT * FROM `gastos` WHERE `Fecha` >= ? AND `Fecha` <= ?");
			$cue->execute(array($FechaInicio, $FechaFinal));

			return $cue->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
}