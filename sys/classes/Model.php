<?php

/**
 * Ovo je osnovna klasa Modela koja obezbeđuje lakši rad sa modelima
 * Sve metode koje mogu biti apstrakovane nalaziće se u ovoj klasi, dok će konkretni modeli
 * biti zaduženi da prošire ovu klasu i eventualno implementiraju neke specifične funkcije
 * za taj model.
 */
abstract class Model implements ModelInterface
{

	/**
	 * Privatna funkcija klase Model za vraćanje imena tabele u bazi
	 * Dorađena tako da radi u skladu sa konvencijom koju poštuje autor rada
	 * @todo Uraditi za ostale tabele konverziju za množinu, videti kako Laravel Eloquent rešava taj problem
	 * @return string
	 */
	protected static final function getTableName()
	{
		return substr(strtolower(preg_replace('|([A-Z])|', '_$0', get_called_class())), 1, -6);
	}

	/**
	 * Metod koji vraća sve redove iz tabele
	 * @return array
	 */
	public static final function getAll()
	{
		$tableName = self::getTableName();
		$sql = 'SELECT * FROM '.$tableName.' ORDER BY id ASC;';
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute();
		return $pst->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji vraća red sa odgovarajućim ID parametrom iz tabele
	 * @param int $id
	 * @return stdClass|NULL
	 */
	public static final function getById($id)
	{
		$tableName = self::getTableName();
		$sql = 'SELECT * FROM '.$tableName.' WHERE id = ?;';
		$pst = DB::getInstance()->prepare($sql);
		$pst->execute([$id]);
		return $pst->fetch(PDO::FETCH_OBJ);
	}

	/**
	 * Metod koji dodaje novi red u tabelu
	 * @param array $data
	 * @return int|FALSE
	 */
	public static final function create($data)
	{
		$tableName = self::getTableName();
		$fields = [];
		$placeholders = [];
		$values = [];
		foreach ($data as $field => $value)
		{
			if (preg_match('|^[a-z][a-z0-9\_]*$|', $field) && $field !== 'id' && !is_array($value) && !is_object($value))
			{
				$fields[] = $field;
				$values[] = $value;
				$placeholders[] = '?';
			}
		}
		$sql = 'INSERT INTO '.$tableName.' ('.implode(', ', $fields).') VALUES ('.implode(', ', $placeholders).');';
		$pst = DB::getInstance()->prepare($sql);
		if (!$pst)
		{
			return FALSE;
		}
		if ($pst->execute($values))
		{
			return DB::getInstance()->lastInsertId();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Metod koji ažurira postojeći red u tabeli
	 * @param array $data
	 * @return TRUE|FALSE
	 */
	public static function update($id, $data)
	{
		$tableName = self::getTableName();
		$fields = [];
		$values = [];
		foreach ($data as $field => $value)
		{
			if (preg_match('|^[a-z][a-z0-9\_]*$|', $field) && $field !== 'id' && !is_array($value) && !is_object($value))
			{
				$fields[] = $field.' = ?';
				$values[] = $value;
			}
		}
		$values[] = $id;
		$sql = 'UPDATE '.$tableName.' SET '.implode(', ', $fields).' WHERE id = ?;';
		$pst = DB::getInstance()->prepare($sql);
		if (!$pst)
		{
			return FALSE;
		}
		return $pst->execute($values);
	}

	/**
	 * Metod koji uklanja red iz tabele
	 * @todo Bilo bi pametno implementirati opciju sa flegovima umesto fizičkog uklanjanja iz BP
	 * @param int $id
	 * @return TRUE|FALSE
	 */
	public static function delete($id)
	{
		$tableName = self::getTableName();
		$sql = 'DELETE FROM '.$tableName.' WHERE id = ?;';
		$pst = DB::getInstance()->prepare($sql);
		if (!$pst)
		{
			return FALSE;
		}
		return $pst->execute([$id]);
	}

}
