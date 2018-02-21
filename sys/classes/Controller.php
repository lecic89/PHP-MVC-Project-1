<?php

/**
 * Ova klasa predstavlja osnovnu klasu kontrolera aplikacije koju moraju da
 * nasledjuju svi kontroleri aplikacije razvijeni u ovom MVC okviru.
 */
abstract class Controller
{

	/**
	 * Ovaj privatni clan predstavlja skladiste podataka koje metodi kontrolera koriste za podatke koji se salju pogledima
	 */
	private $data = [];

	/**
	 * Osnovni metod koji svaki kontroler apliakcije mora da ima, koji se koristi u rutama kao metod podrazumevane rute
	 */
	public function index()
	{

	}

	/**
	 * Ovaj metod koriste metodi kontrolera aplikacije kada treba da sacuvaju neki podatak koji ce biti prosledjen pogledima i sablonima za prikaz
	 * @param string $key Indeks/ime pod kojim ce podatak biti sacuvan. Indeks moze da sadrzi samo mala slova a-z i simbol _, a mora da pocne sa slovom a-z
	 * @param mixed $value Konkretan podatak koji treba sacuvati
	 */
	final protected function set($key, $value)
	{
		$this->data[$key] = $value;
	}

	/**
	 * Ovaj metod sluzi da vrati kompletan niz podataka koji su bili upisani od strane metoda kontrolera aplikacije
	 * @return array
	 */
	final public function getData()
	{
		return $this->data;
	}

}
