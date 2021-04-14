<?php

namespace Plcosta\Openbase;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Connectors\ConnectionFactory;
use Plcosta\Openbase\Connectors\OpenSqlConnector as Connector;



/**
 * Class OpenSQLServiceProvider.
 */
class OpenSqlServiceProvider extends ServiceProvider
{
    /**
     * Boot.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/openbase.php' => config_path('openbase.php'),
        ], 'openbase');
    }

    /**
     * Register the service provider.
     *
     * @returns plcosta\Openbase\OpenSqlConnection
     */
    public function register()
    {
        if (file_exists(config_path('database.php'))) {

            if (file_exists(config_path('openbase.php'))) {
                $this->mergeConfigFrom(config_path('openbase.php'), 'database.connections');
            } else {
                $this->mergeConfigFrom(__DIR__ . '/config/openbase.php', 'database.connections');
            }

            Connection::resolverFor('OpenSQL', function ($connection, $database, $prefix, $config) {
                $connector = new Connector();
                $connection = $connector->connect($config);

                return new OpenSqlConnection($connection, $database, $prefix, $config);
            });
        }
    }
}
