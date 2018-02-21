<?php

/**
 * Klasa za rad za bazom podataka.
 * Ovaj edukativni okvir ne implementira neki poseban sistem za rad sa bazom podataka,
 * jer je cilj da studenti nauce da rade sa SQL upitima, tako da je uloga ove klase
 * da obezbedi instancu konekcije ka bazi podataka koja se ostvaruje prvi put kada
 * aplikaciji treba baza i ubuduce se koristi postojeca konekcija za sve transakcije.
 */
final class DB
{

	/**
	 * Objekat konekcije na bazu podataka
	 * @var \PDO|NULL
	 */
	private static $dbh = null;

	private function __construct()
	{

	}

	/**
	 * Ovaj metod vrca objekat konekcije ka bazi podataka (instancu klase PDO)
	 * za vec postojecu konekciju, a ako do saad ovaj objekat nije instanciran,
	 * tj. nije ostvarena veza ka bazi podataka, metod uspostavlja konekciju
	 * ka MySQL serveru sa parametrima zadatim u klasi Config i tek zatim
	 * vraca kao rezultat objekat klase PDO za uspostavljenu konekciju.
	 * @return \PDO
	 */
	public static function getInstance()
	{
		if (self::$dbh == null)
		{
			$dsn = 'mysql:host='.Config::DB_HOST.';dbname='.Config::DB_NAME.';charset=utf8';
			$user = Config::DB_USER;
			$pass = Config::DB_PASS;
			try
			{
				self::$dbh = new PDO($dsn, $user, $pass);
				self::setExceptionModeOff();
			}
			catch (PDOException $e)
			{
				Logger::error($e->getMessage());
				ob_clean();
				die('Javila se greška pri povezivanju sa serverom BP!');
			}
		}
		return self::$dbh;
	}

	/**
	 * Koristi se u razvojnom okruženju
	 */
	public static function setExceptionModeOn()
	{
		self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * Koristi se u produkcionom okruženju
	 */
	public static function setExceptionModeOff()
	{
		self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
	}

	private function __clone()
	{

	}

	private function __wakeup()
	{

	}

}
