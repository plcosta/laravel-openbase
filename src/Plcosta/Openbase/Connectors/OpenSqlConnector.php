<?php

namespace Plcosta\Openbase\Connectors;

use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;
use InvalidArgumentException;
use PDOException;

class OpenSqlConnector extends Connector implements ConnectorInterface
{

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
