<?php

/**
 * Kontroler koji služi za RD operacije nad tabelom messages
 */
class AdminInboxController extends AdminAuthController
{

	/**
	 * Glavni metod klase, zadužen za listanje svih zapisa
	 */
	public function index()
	{
		$this->set('title', 'Inbox');
		$this->set('messages', MessageModel::getAll());
	}

	/**
	 * Metod klase zadužen za otvaranje nove poruke
	 */
	public function readById($id)
	{
		MessageModel::markAsRead($id);
		$message = MessageModel::getById($id);
		if ($message)
		{
			$this->set('title', $message->email);
		}
		$this->set('message', $message);
	}

	/**
	 * Metod klase zadužen za uklanjanje postojećeg zapisa
	 */
	public function delete($id)
	{
		MessageModel::delete($id);
		// Redirekcija
		Redirect::to('mvc-admin/inbox');
	}

}
