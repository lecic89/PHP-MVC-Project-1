<?php

/**
 * Kontroler koji služi za rad sa zapisima iz tabele user_logins
 */
class AdminUserLoginController extends AdminAuthController
{

	/**
	 * Glavni metod klase, zadužen za listanje svih zapisa
	 */
	public function index()
	{
		$this->set('title', 'Aktivnost logova korisnika');
		$data = UserLoginModel::getAll();
		foreach ($data as $row)
		{
			$row->user = UserModel::getById($row->user_id);
			unset($row->user_id);
		}
		$this->set('logins', $data);
	}

}
