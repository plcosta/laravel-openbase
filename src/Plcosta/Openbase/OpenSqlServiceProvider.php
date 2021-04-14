<?php

namespace Plcosta\Openbase;

use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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

            // get only openbase/opensql configs to loop thru and extend DB
            $config = $this->app['config']->get('openbase', []);

            $connection_keys = array_keys($config);

            $this->app->resolving('db', function ($db)
            {
                $db->extend('openbase', function ($config) {
                    $Connector = new Connectors\OpenSqlConnector();

                    $connection = $Connector->connect($config);

                    return new OpenSqlConnection($connection, $config['path']);
                });
            });
        }
    }
}
