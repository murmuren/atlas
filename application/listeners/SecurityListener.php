<?php
require_once("application/models/DAOLocator.php");
require_once("libraries/php-security-api/loader.php");

class SecurityListener extends RequestListener {
	private $daoLocator;
	private $persistenceDrivers = array();

	public function run() {
		$this->setDAOLocator();
		$this->setPersistenceDrivers();
		$this->setUserID();

		$this->csrf();
		$this->authenticate();
		$this->authorize();
	}

	private function setDAOLocator() {
		$this->daoLocator = new DAOLocator($this->application->getXML());
	}

	private function setPersistenceDrivers() {
		$xml = $this->application->getXML()->security->persistence;
		if(empty($xml)) return; // it is allowed for elements to not persist

		if($xml->session) {
			require_once("application/models/persistence/SessionPersistenceDriverWrapper.php");
			$wrapper = new SessionPersistenceDriverWrapper($xml->session);
			$this->persistenceDrivers[] = $wrapper->getDriver();
		}

		if($xml->remember_me) {
			require_once("application/models/persistence/RememberMePersistenceDriverWrapper.php");
			$wrapper = new RememberMePersistenceDriverWrapper($xml->remember_me);
			$this->persistenceDrivers[] = $wrapper->getDriver();
		}

		if($xml->token) {
			require_once("application/models/persistence/TokenPersistenceDriverWrapper.php");
			$wrapper = new TokenPersistenceDriverWrapper($xml->token);
			$this->persistenceDrivers[] = $wrapper->getDriver();
		}
	}

	private function setUserID() {
		$userID = null;
		foreach($this->persistenceDrivers as $persistenceDriver) {
			$userID = $persistenceDriver->load();
			if($userID) {
				break;
			}
		}
		$this->request->setAttribute("user_id", $userID);
	}

	private function csrf() {

	}

	// TODO: tokens do not support redirection
	private function authenticate() {
		$xml = $this->application->getXML()->security->authentication;
		if(empty($xml)) throw new ServletApplicationException("Entry missing in configuration.xml: security.authentication");

		if($xml->form) {
			require_once("application/models/authentication/FormAuthenticationWrapper.php");
			new FormAuthenticationWrapper($xml->form, $this->request->getAttribute("page_url"), $this->persistenceDrivers, $this->daoLocator);
		}
		if($xml->oauth2) {
			require_once("application/models/authentication/Oauth2AuthenticationWrapper.php");
			new Oauth2AuthenticationWrapper($xml->oauth2, $this->request->getAttribute("page_url"), $this->persistenceDrivers, $this->daoLocator);
		}
	}

	private function authorize() {
		$xml = $this->application->getXML()->security->authorization;
		if(empty($xml)) throw new ServletApplicationException("Entry missing in configuration.xml: security.authentication");

		if($xml->by_route) {
			require_once("application/models/authorization/XMLAuthorizationWrapper.php");
			new XMLAuthorizationWrapper($this->application->getXML(), $this->request->getAttribute("page_url"), $this->request->getAttribute("user_id"));
		}
		if($xml->by_dao) {
			require_once("application/models/authorization/DAOAuthorizationWrapper.php");
			new DAOAuthorizationWrapper($xml->by_dao, $this->request->getAttribute("page_url"), $this->request->getAttribute("user_id"), $this->daoLocator);
		}
	}
}