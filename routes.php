<?php

return [
	# HomeController
	[
		'Pattern' => '|^/?$|',
		'Controller' => 'Home',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^prijava/?$|',
		'Controller' => 'Home',
		'Method' => 'login'
	],
	[
		'Pattern' => '|^odjava/?$|',
		'Controller' => 'Home',
		'Method' => 'logout'
	],
	# ContactController
	[
		'Pattern' => '|^kontakt/?$|',
		'Controller' => 'Contact',
		'Method' => 'index'
	],
	# AdminLoginController
	[
		'Pattern' => '|^mvc-admin/?$|',
		'Controller' => 'AdminLogin',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^mvc-admin/odjava/?$|',
		'Controller' => 'AdminLogin',
		'Method' => 'logout'
	],
	# AdminUserController
	[
		'Pattern' => '|^mvc-admin/users/?$|',
		'Controller' => 'AdminUser',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^mvc-admin/users/add/?$|',
		'Controller' => 'AdminUser',
		'Method' => 'create'
	],
	[
		'Pattern' => '|^mvc-admin/users/update/([0-9]+)/?$|',
		'Controller' => 'AdminUser',
		'Method' => 'update'
	],
	[
		'Pattern' => '|^mvc-admin/users/delete/([0-9]+)/?$|',
		'Controller' => 'AdminUser',
		'Method' => 'delete'
	],
	# AdminUserLoginController
	[
		'Pattern' => '|^mvc-admin/users/activity-log/?$|',
		'Controller' => 'AdminUserLogin',
		'Method' => 'index'
	],
	# AdminCityController
	[
		'Pattern' => '|^mvc-admin/cities/?$|',
		'Controller' => 'AdminCity',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^mvc-admin/cities/add/?$|',
		'Controller' => 'AdminCity',
		'Method' => 'create'
	],
	[
		'Pattern' => '|^mvc-admin/cities/update/([0-9]+)/?$|',
		'Controller' => 'AdminCity',
		'Method' => 'update'
	],
	[
		'Pattern' => '|^mvc-admin/cities/delete/([0-9]+)/?$|',
		'Controller' => 'AdminCity',
		'Method' => 'delete'
	],
	# AdminVehicleController
	[
		'Pattern' => '|^mvc-admin/vehicles/?$|',
		'Controller' => 'AdminVehicle',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^mvc-admin/vehicles/add/?$|',
		'Controller' => 'AdminVehicle',
		'Method' => 'create'
	],
	[
		'Pattern' => '|^mvc-admin/vehicles/update/([0-9]+)/?$|',
		'Controller' => 'AdminVehicle',
		'Method' => 'update'
	],
	[
		'Pattern' => '|^mvc-admin/vehicles/delete/([0-9]+)/?$|',
		'Controller' => 'AdminVehicle',
		'Method' => 'delete'
	],
	# AdminInboxController
	[
		'Pattern' => '|^mvc-admin/inbox/?$|',
		'Controller' => 'AdminInbox',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^mvc-admin/inbox/([0-9]+)/?$|',
		'Controller' => 'AdminInbox',
		'Method' => 'readById'
	],
	[
		'Pattern' => '|^mvc-admin/inbox/delete/([0-9]+)/?$|',
		'Controller' => 'AdminInbox',
		'Method' => 'delete'
	],
	# UserController
	[
		'Pattern' => '|^moj-profil/?$|',
		'Controller' => 'User',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^profil/([0-9]+)/?$|',
		'Controller' => 'User',
		'Method' => 'readById'
	],
	[
		'Pattern' => '|^moj-profil/izmena/?$|',
		'Controller' => 'User',
		'Method' => 'update'
	],
	[
		'Pattern' => '|^moj-profil/slika/?$|',
		'Controller' => 'User',
		'Method' => 'updateProfilePhoto'
	],
	# UserServiceController
	[
		'Pattern' => '|^usluge-transporta/?$|',
		'Controller' => 'UserService',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^usluge-transporta/([0-9]+)/?$|',
		'Controller' => 'UserService',
		'Method' => 'readById'
	],
	[
		'Pattern' => '|^usluge-transporta/dodavanje/?$|',
		'Controller' => 'UserService',
		'Method' => 'create'
	],
	[
		'Pattern' => '|^usluge-transporta/uklanjanje-ponude/?$|',
		'Controller' => 'UserService',
		'Method' => 'delete'
	],
	# UserOfferController
	[
		'Pattern' => '|^ponude/?$|',
		'Controller' => 'UserOffer',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^dodavanje-ponude/([0-9]+)/?$|',
		'Controller' => 'UserOffer',
		'Method' => 'create'
	],
	# UserShipmentController
	[
		'Pattern' => '|^isporuka/?$|',
		'Controller' => 'UserShipment',
		'Method' => 'index'
	],
	[
		'Pattern' => '|^isporuka/([0-9]+)/?$|',
		'Controller' => 'UserShipment',
		'Method' => 'readById'
	],
	[
		'Pattern' => '|^isporuka/checkpoint/?$|',
		'Controller' => 'UserShipment',
		'Method' => 'updateFromDriver'
	],
	[
		'Pattern' => '|^isporuka/dodavanje/([0-9]+)/?$|',
		'Controller' => 'UserShipment',
		'Method' => 'create'
	],
	[
		'Pattern' => '|^isporuka/uklanjanje/([0-9]+)/?$|',
		'Controller' => 'UserShipment',
		'Method' => 'delete'
	],
	# Poslednja (podrazumevana) ruta za sve
	[
		'Pattern' => '|^.*$|',
		'Controller' => 'Home',
		'Method' => 'index'
	]
];
