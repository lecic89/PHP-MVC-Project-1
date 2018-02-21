<?php

/**
 * Klasa Sanitize je klasa koja obezbeđuje tzv. escaping.
 * <br>
 * Zaštita od XSS napada prvenstveno, ali treba voditi računa koji podaci se eskejpuju
 */
final class Sanitize
{

	/**
	 * Metod koji se koristi za zaštitu od XSS napada
	 * @param type $str
	 * @return string
	 */
	public static function escape($str)
	{
		return htmlentities($str, ENT_QUOTES, 'UTF-8');
	}

}
