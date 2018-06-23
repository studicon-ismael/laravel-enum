<?php

namespace MadWeb\Enum\Test;

use Orchestra\Testbench\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Contracts\Debug\ExceptionHandler;


class ExampleTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [\MadWeb\Enum\EnumServiceProvider::class];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [];
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('avatar');
        });

        User::create(['email' => $this->userEmail]);
    }
}
