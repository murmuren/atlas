<?php
class DAOLocator {
	private $daoPath;

	public function __construct(SimpleXMLElement $xml) {
		$path = (string) $xml->application->paths->dao;
		if(!$path) throw new ServletApplicationException("Tag application.paths.dao is mandatory!");
		$this->daoPath = $path;
	}

	public function locate(SimpleXMLElement $xml, $parameterName, $parentClassName) {
		$dao = (string) $xml[$parameterName];
		if(!$dao) throw new ServletApplicationException("'$parameterName' attribute is missing!");

		// load file
		$daoFile = $this->daoPath."/".$dao.".php";
		if(!file_exists($daoFile)) throw new ServletApplicationException("DAO file not found: ".$daoFile."!");
		require_once($daoFile);

		// locate class
		$daoObject = new $dao();
		if(!($daoObject instanceof $parentClassName)) throw new ServletApplicationException($dao." must be instance of ".$parentClassName."!");
		return $daoObject;
	}
}