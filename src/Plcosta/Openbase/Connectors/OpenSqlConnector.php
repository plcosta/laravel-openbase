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

    // /**
    //  * Constructs the sql PDO DSN.
    //  *
    //  * @param array $config
    //  *
    //  * @return string The DSN.
    //  */
    // protected function pdoDsn(array $config)
    // {
    //     $dsn = 'OpenSQL:';
    //     if (isset($config['path'])) {
    //         $dsn .= $config['path'];
    //     }
    //     return $this->getDsn($config);
    // }

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
        // add fallback in case driver is not set, will use pdo instead
        if (! in_array($config['driver'], ['php_open'])) {
            return parent::createConnection($dsn, $config, $options);
        }
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
        $dsn = !empty($config['dns']) ? $config['dns'] : $this->getDsn($config);

        $options = $this->getOptions($config);


        return $this->createConnection($dsn, $config, $options);
    }

    /**
     * Create a DSN string from a configuration.
     *
     * @param  array $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        if (!empty($config['dns'])) {
            return $config['dns'];
        }

        // parse configuration
        $config = $this->parseConfig($config);

        $config['dsn'] = "OpenSQL:HST=$config[host];DSN=$config[database];SEC=$config[username];LEV=$config[username]";

        // return generated dns
        return $config['dsn'];
    }
    /**
     * Parse configurations.
     *
     * @param array $config
     * @return array
     */
    protected function parseConfig(array $config)
    {
        $config = $this->setHost($config);
        $config = $this->setDatabase($config);
        $config = $this->setUsername($config);
        $config = $this->setPassword($config);

        return $config;
    }
    /**
     * Set host from config.
     *
     * @param array $config
     * @return array
     */
    protected function setHost(array $config)
    {
        $config['hst'] = isset($config['hst']) ? $config['hst'] : '127.0.0.1';
        $config['host'] = isset($config['host']) ? $config['host'] : $config['hst'];

        return $config;
    }
    /**
     * Set host from config.
     *
     * @param array $config
     * @return array
     */
    protected function setDatabase(array $config)
    {
        $config['database'] = isset($config['database']) ? $config['database'] : '';

        return $config;
    }
    /**
     * Set host from config.
     *
     * @param array $config
     * @return array
     */
    protected function setUsername(array $config)
    {
        $config['sec'] = isset($config['sec']) ? $config['sec'] : '1';
        $config['username'] = isset($config['username']) ? $config['username'] : $config['sec'];

        return $config;
    }
    /**
     * Set host from config.
     *
     * @param array $config
     * @return array
     */
    protected function setPassword(array $config)
    {
        $config['lev'] = isset($config['lev']) ? $config['lev'] : 'a';
        $config['password'] = isset($config['password']) ? $config['password'] : $config['lev'];

        return $config;
    }

    
}
