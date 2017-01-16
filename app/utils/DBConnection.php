<?php

namespace MyApp\Utils;

class DBConnection
{
	/**
	 * @var array $options Custom login credentials for database
	 */
    private $options;

    /**
     * DBConnection constructor.
     * @param array $options Database credentials structure
     */

    public function __construct($options = array())
    {

        $this->options = [
            "dbHost" => "localhost",
            "dbPassword" => "password",
            "dbUser" => "username",
            "dbName" => "database"
        ];

        if ($options)
            $this->options = array_merge($this->options, $options);
    }

    /**
     * Opens new PDO connection
     * @return \PDO
     */
    public function PDOConnection()
    {
        $connection = new \PDO("mysql:host=" . $this->options['dbHost'] . ";dbname=" . $this->options['dbName'], $this->options['dbUser'], $this->options['dbPassword']);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        if(!$connection) {
            return false;
        }

        return $connection;
    }

    /**
     * Opens new mysqli connection
     * @return bool|\mysqli
     */
    public function mysqlConnection()
    {
        $connection = new \mysqli($this->options['dbHost'], $this->options['dbUser'], $this->options['dbPassword'], $this->options['dbName']);

        if(!$connection) {
            return false;
        }

        $connection->set_charset('utf8');

        return $connection;
    }
}