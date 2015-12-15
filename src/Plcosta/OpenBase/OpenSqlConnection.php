<?php

namespace Plcosta\OpenBase;

use Illuminate\Database\Connection;
use Plcosta\Openbase\Query\Processors\OpenSqlProcessor;
use Doctrine\DBAL\Driver\PDOOpenSql\Driver as DoctrineDriver;
use Plcosta\Openbase\Query\Grammars\OpenSqlGrammar as QueryGrammar;
use Plcosta\Openbase\Schema\Grammars\OpenSqlGrammar as SchemaGrammar;

class OpenSqlConnection extends Connection
{
    /**
     * Get the default query grammar instance.
     *
     * @return \Plcosta\Openbase\Query\Grammars\OpenSqlGrammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new QueryGrammar);
    }

    /**
     * Get the default schema grammar instance.
     *
     * @return \Plcosta\Openbase\Schema\Grammars\OpenSqlGrammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new SchemaGrammar);
    }

    /**
     * Get the default post processor instance.
     *
     * @return \Plcosta\Openbase\Query\Processors\OpenSqlProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new OpenSqlProcessor;
    }

    /**
     * Get the Doctrine DBAL driver.
     *
     * @return \Doctrine\DBAL\Driver\PDOOpenSql\Driver
     */
    protected function getDoctrineDriver()
    {
        return new DoctrineDriver;
    }

}
