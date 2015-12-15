<?php

namespace Plcosta\OpenBase\Connectors;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\PDOConnection;
use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;
use InvalidArgumentException;
use PDOException;

class OpenSqlConnector extends Connector implements ConnectorInterface
{

    /**
     * @var array
     */
//    protected $_userDefinedFunctions = array(
//        'sqrt' => array('callback' => array('Doctrine\DBAL\Platforms\OpenSQLPlatform', 'udfSqrt'), 'numArgs' => 1),
//        'mod'  => array('callback' => array('Doctrine\DBAL\Platforms\OpenSQLPlatform', 'udfMod'), 'numArgs' => 2),
//        'locate'  => array('callback' => array('Doctrine\DBAL\Platforms\OpenSQLPlatform', 'udfLocate'), 'numArgs' => -1),
//    );
//
//    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
//    {
//        if (isset($driverOptions[
//            'userDefinedFunctions'])) {
//            $this->_userDefinedFunctions = array_merge(
//                $this->_userDefinedFunctions, $driverOptions['userDefinedFunctions']);
//            unset($driverOptions['userDefinedFunctions']);
//        }
//
//        try {
//            $pdo = new PDOConnection(
//                $this->_constructPdoDsn($params),
//                $username,
//                $password,
//                $driverOptions
//            );
//        } catch (PDOException $ex) {
//            throw DBALException::driverException($this, $ex);
//        }
//        foreach ($this->_userDefinedFunctions as $fn => $data) {
//            $pdo->OpenSQLCreateFunction($fn, $data['callback'], $data['numArgs']);
//        }
//        return $pdo;
//    }
//
//    protected function _constructPdoDsn(array $params)
//    {
//        $dsn = 'OpenSQL:';
//        if (isset($params['path'])) {
//            $dsn .= $params['path'];
//        }
//        return $dsn;
//    }
//
//    public function getName()
//    {
//        return 'pdo_open';
//    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pdo_open';
    }

    /**
     * Constructs the sql PDO DSN.
     *
     * @param array $params
     *
     * @return string The DSN.
     */
    protected function pdoDsn(array $params)
    {
        $dsn = 'OpenSQL:';
        if (isset($params['path'])) {
            $dsn .= $params['path'];
        }
        return $dsn;
    }

    /**
     * Create a new PDO connection.
     *
     * @param  string  $dsn
     * @param  array   $config
     * @param  array   $options
     * @return PDO
     */
    public function createConnection($dsn, array $config, array $options)
    {
        return parent::createConnection($dsn, $config, $options);
    }

    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     *
     * @throws \InvalidArgumentException
     */
    public function connect(array $config)
    {
        $options = $this->getOptions($config);

        $path = $config['path'];

        return $this->createConnection("OpenSQL:{$path}", $config, $options);
    }
}
