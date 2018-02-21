<?php

/**
 * Klasa Hash obezbeđuje fasadni pristup korišćenju heš funkcije.
 * <br>
 * Pošto se ova aplikacija koristi u edukativne svrhe, radi jednostavnosti koristi samo predefinisanu heš funkciju.
 */
final class Hash
{

	/**
	 * Metod koji vraća Heš vrednost prosleđenog stringa i koristi globalno dostupni salt u zavisnosti od vrednosti drugog parametra.
	 * @param string $password
	 * @param boolean $salt
	 * @return string
	 */
	public static final function make($password, $salt = FALSE)
	{
		if ($salt)
		{
			return hash('sha512', $password.Config::SALT);
		}
		else
		{
			return hash('sha512', $password);
		}
	}

}
