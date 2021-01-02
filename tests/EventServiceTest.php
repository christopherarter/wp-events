<?php 

use PHPUnit\Framework\TestCase;

function test_increment_function()
{
   $GLOBALS['test_incrementor']++;
}

class EventServiceTest extends TestCase {


    public function setUp() : void
    {
        $GLOBALS['test_incrementor'] = 0;
    }
    public function testFiresEvents()
    {
        
        dk_events_register([
            'event 1' => [
                'test_increment_function',
                'test_increment_function',
            ],
            'event 2' => [
                'test_increment_function'
            ]
        ]);

        dk_events_dispatch('event 1');
        $this->assertTrue($GLOBALS['test_incrementor'] == 2);
    }
}