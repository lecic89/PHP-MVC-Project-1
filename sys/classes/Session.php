<?php

/**
 * Ova klasa sadrzi metode za rad sa PHP sesijom.
 */
final class Session
{

	/**
	 * Ovaj metod zapocinje sesiju.
	 */
	public static final function begin()
	{
		session_start();
	}

	/**
	 * Ovaj metod vrsi praznjenje postojece sesije i zatvara je.
	 */
	public static final function end()
	{
		self::clear();
		session_destroy();
	}

	/**
	 * Ovaj emtod smesta odredjeni podatak u indeks sesije.
	 * @param string $key Indeks podatka u sesiji
	 * @param mixed $value Podatak koji se cuva na indeksu sesije
	 */
	public static final function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	/**
	 * Ovaj metod sluzi za proveru da li postoji podataka u sesiji pod izabranim indeksom.
	 * @param string $key Indeks podatka u sesiji
	 * @return boolean
	 */
	public static final function exists($key)
	{
		return isset($_SESSION[$key]);
	}

	/**
	 * Ovaj metod vraca podataka u sesiji pod izabranim indeksom.
	 * @param string $key Indeks podatka u sesiji
	 * @return mixed|boolean Ako podatak postoji, bice vracen, a ako ne postoji, metod vraca FALSE
	 */
	public static final function get($key)
	{
		if (self::exists($key))
		{
			return $_SESSION[$key];
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Ovaj metod prazni niz u kojem se cuvaju podaci sesije.
	 */
	public static final function clear()
	{
		$_SESSION = [];
	}

}
