<?php

/**
 * Klasa za pomoć pri radu sa regularnim izrazima
 * Sadrži funkcije za validaciju na strani servera i kontrolu unosa na strani klijenta
 * Obezbeđuje konzistentnost u regularnim izrazima koji se koriste kroz ceo ovaj projekat
 */
class RegExHelper
{

	/**
	 * Šablon za adresu elektronske pošte
	 * Korisno kod pattern atributa kod ulaznih polja
	 */
	public static final function patternForEmail()
	{
		return '|^[A-z]{1}[A-z\.\_\d]{0,}\@[A-z\d]{1,}.[a-z]{1,}$|';
	}

	/**
	 * Validacija adrese elektronske pošte
	 * Napomena: autor ovog rada se opredelio da validaciju e-pošte radi preko
	 * načina koji je preporučen za PHP (filter_var metodom)
	 * Korisno kod provere u kontrolerima pri obradi formulara
	 * @param string $input
	 * @return TRUE|FALSE
	 */
	public static final function validateEmail($input)
	{
		return preg_match(self::patternForEmail(), $input);
	}

	/**
	 * Šablon za vlastito ime ili prezime sa srpskom latinicom
	 * Korisno kod pattern atributa kod ulaznih polja
	 */
	public static final function patternForFirstOrLastNameInSerbian()
	{
		return '|^['.mb_strtoupper(RegExConstants::sr_lat).']{1}['.RegExConstants::sr_lat.']+$|';
	}

	/**
	 * Validacija vlastitog imena ili prezimena na srpskoj latinici
	 * Korisno kod provere u kontrolerima pri obradi formulara
	 * @param string $input
	 * @return TRUE|FALSE
	 */
	public static final function validateFirstOrLastNameInSerbian($input)
	{
		return preg_match(self::patternForFirstOrLastNameInSerbian(), $input);
	}

	/**
	 * Šablon za ime grada
	 * Korisno kod pattern atributa kod ulaznih polja
	 */
	public static final function patternForCityNameInSerbian()
	{
		return '|^['.mb_strtoupper(RegExConstants::sr_lat).']{1}['.RegExConstants::sr_lat.']+(\ ['.mb_strtoupper(RegExConstants::sr_lat).']{1}['.RegExConstants::sr_lat.']+)?$|';
	}

	/**
	 * Validacija imena grada na srpskoj latinici
	 * Korisno kod provere u kontrolerima pri obradi formulara
	 * @param string $input
	 * @return TRUE|FALSE
	 */
	public static final function validateCityNameInSerbian($input)
	{
		return preg_match(self::patternForCityNameInSerbian(), $input);
	}

	/**
	 * Šablon za prevoz
	 * Korisno kod pattern atributa kod ulaznih polja
	 */
	public static final function patternForVehicleNameInSerbian()
	{
		return '|^['.mb_strtoupper(RegExConstants::sr_lat).RegExConstants::sr_lat.'\d\ \-\,]+?$|';
	}

	/**
	 * Validacija prevoza na srpskoj latinici
	 * Korisno kod provere u kontrolerima pri obradi formulara
	 * @param string $input
	 * @return TRUE|FALSE
	 */
	public static final function validateVehicleNameInSerbian($input)
	{
		return preg_match(self::patternForVehicleNameInSerbian(), $input);
	}

	/**
	 * Šablon za korisnički unet tekst (npr. poruka)
	 * Korisno kod pattern atributa kod ulaznih polja
	 */
	public static final function patternForUserContentInSerbian()
	{
		return '|['.mb_strtoupper(RegExConstants::sr_lat).RegExConstants::sr_lat.'\d\ \-\,\.\!\?\:\(\)\%\@\;\&]+|';
	}

	/**
	 * Validacija teksta poslatog od strane korisnika na srpskoj latinici
	 * Korisno kod provere u kontrolerima pri obradi formulara
	 * @param string $input
	 * @return TRUE|FALSE
	 */
	public static final function validateUserContentInSerbian($input)
	{
		return preg_match(self::patternForUserContentInSerbian(), $input);
	}

	/**
	 * Šablon za celobrojni broj (int)
	 * Korisno kod pattern atributa kod ulaznih polja
	 */
	public static final function patternForNumberInteger()
	{
		return '|^[0-9]+$|';
	}

	/**
	 * Validacija celobrojnog broja (int)
	 * Korisno kod provere u kontrolerima pri obradi formulara
	 * @param string $input
	 * @return TRUE|FALSE
	 */
	public static final function validateNumberInteger($input)
	{
		return preg_match($this->patternForNumberInteger(), $input);
	}

	/**
	 * Šablon za realan broj (float)
	 * Korisno kod pattern atributa kod ulaznih polja
	 */
	public static final function patternForNumberFloat()
	{
		return '|^[0-9]+(\.[0-9]+)?$|';
	}

	/**
	 * Validacija celobrojnog broja (float)
	 * Korisno kod provere u kontrolerima pri obradi formulara
	 * @param string $input
	 * @return TRUE|FALSE
	 */
	public static final function validateNumberFloat($input)
	{
		return preg_match($this->patternForNumberFloat(), $input);
	}

}
