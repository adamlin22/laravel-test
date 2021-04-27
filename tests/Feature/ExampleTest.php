<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testWarmupEvents() {
        $response = $this->get('/warmupevents');
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonPath('0.name', 'Laravel convention 2020')
            ->assertJsonPath('1.name', 'Laravel convention 2021')
            ->assertJsonPath('2.name', 'React convention 2021');
    }

    public function testEvents() {
        $response = $this->get('/events');
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonPath('0.name', 'Laravel convention 2020')
            ->assertJsonPath('0.workshops.0.name', 'Illuminate your knowledge of the laravel code base')
            ->assertJsonPath('1.name', 'Laravel convention 2021')
            ->assertJsonPath('1.workshops.0.name', 'The new Eloquent - load more with less')
            ->assertJsonPath('1.workshops.1.name', 'AutoEx - handles exceptions 100% automatic')
            ->assertJsonPath('2.name', 'React convention 2021')
            ->assertJsonPath('2.workshops.0.name', '#NoClass pure functional programming')
            ->assertJsonPath('2.workshops.1.name', 'Navigating the function jungle');
    }

    public function testFutureEvents() {
        $response = $this->get('/futureevents');
        $response->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonPath('0.name', 'Laravel convention 2021')
            ->assertJsonPath('0.workshops.0.name', 'The new Eloquent - load more with less')
            ->assertJsonPath('0.workshops.1.name', 'AutoEx - handles exceptions 100% automatic')
            ->assertJsonPath('1.name', 'React convention 2021')
            ->assertJsonPath('1.workshops.0.name', '#NoClass pure functional programming')
            ->assertJsonPath('1.workshops.1.name', 'Navigating the function jungle');
    }

    public function testMenu() {
        $response = $this->get('/menu');
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonPath('0.children.0.name', 'Laracon')
            ->assertJsonPath('0.children.0.children.0.url', '/events/laracon/workshops/illuminate')
            ->assertJsonPath('0.children.0.children.1.url', '/events/laracon/workshops/eloquent')
            ->assertJsonPath('0.children.1.name', 'Reactcon')
            ->assertJsonPath('0.children.1.children.0.url', '/events/reactcon/workshops/noclass')
            ->assertJsonPath('0.children.1.children.1.url', '/events/reactcon/workshops/jungle');
    }
}
