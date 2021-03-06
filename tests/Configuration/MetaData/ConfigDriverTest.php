<?php

use LaravelDoctrine\ORM\Configuration\MetaData\Config\ConfigDriver;
use PHPUnit\Framework\TestCase;

class ConfigDriverTest extends TestCase
{
    /**
     * @var ConfigDriver
     */
    protected $driver;

    protected function setUp(): void
    {
        $this->driver = new ConfigDriver(
            [
                'App\User'    => [
                    'type'   => 'entity',
                    'table'  => 'users',
                    'id'     => [
                        'id' => [
                            'type'     => 'integer',
                            'strategy' => 'identity'
                        ],
                    ],
                    'fields' => [
                        'name' => [
                            'type' => 'string'
                        ]
                    ]
                ],
                'App\Article' => [
                    'type' => 'entity'
                ]
            ]
        );
    }

    public function test_can_get_all_class_names()
    {
        $this->assertContains('App\User', $this->driver->getAllClassNames());
        $this->assertContains('App\Article', $this->driver->getAllClassNames());
    }

    public function test_can_check_if_is_transient()
    {
        $this->assertFalse($this->driver->isTransient('App\User'));
        $this->assertTrue($this->driver->isTransient('App\NonExisting'));
    }

    public function test_can_element()
    {
        $this->assertContains('entity', $this->driver->getElement('App\Article'));
        $this->assertNull($this->driver->getElement('App\NonExisting'));
    }
}
