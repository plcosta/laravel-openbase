<?php

namespace Plcosta\OpenBase;

use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

/**
 * Class OracleDBServiceProvider.
 */
class OpenSqlServiceProvider extends ServiceProvider
{
    /**
     * Boot.
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__.'/../../config/opensql.php' => config_path('opensql.php'),
            ]
        );
    }


    /**
     * Register the service provider.
     *
     * @returns plcosta\OpenBase\OpenSqlConnection
     */
    public function register()
    {
        if (file_exists(config_path('openbase.php'))) {
            // merge config with other connections
            $this->mergeConfigFrom(config_path('openbase.php'), 'database.connections');

            // get only oracle configs to loop thru and extend DB
            $config = $this->app['config']->get('openbase', []);

            $connection_keys = array_keys($config);

//            if (is_array($connection_keys)) {
//                foreach ($connection_keys as $key) {
            $this->app->resolving('db', function ($db)
            {
                    $db->extend('openbase', function ($config) {
                        $Connector = new Connectors\OpenSqlConnector();

                        $connection = $Connector->connect($config);

                        return new OpenSqlConnection($connection, $config['path']);
                    });
//                }
//            }
            });
        }
    }
}
