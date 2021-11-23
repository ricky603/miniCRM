<?php

namespace Tests\Feature\Http\Controllers\Admin\Companies;

use Tests\TestCase;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class CompaniesControllerTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function createCompany()
    {
        $user = User::make([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test123'
        ]);
        $response = $this->actingAs($user)->post(
            '/companies',
            [
                'name' => 'testing unit',
                'email' => 'testingunit@gmail.com',
                'website' => 'testingunit@gmail.com'
            ]
        );
        $response->assertStatus(302);
    }
    /** @test */
    public function accessCompanyById()
    {
        $user = User::make([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test123'
        ]);
        $response = $this->actingAs($user)->get('/companies/1');

        $response->assertStatus(200);
    }
    /** @test */
    public function showEmployeeList()
    {
        $user = User::make([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test123'
        ]);
        $response = $this->actingAs($user)->get('/companies/employeelist/1');

        $response->assertStatus(200);
    }
    /** @test */
    public function createEmployee()
    {
        $user = User::make([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test123'
        ]);
        $response = $this->actingAs($user)->post(
            '/companies/1/employee',
            [
                'first_name' => 'testing',
                'first_name' => 'unit',
                'email' => 'testingunit@gmail.com',
                'phone' => '08123123124123'
            ]
        );
        $response->assertStatus(302);
    }

    /** @test */
    public function destroyEmployee()
    {
        $user = User::make([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test123'
        ]);
        $employee = $this->actingAs($user)->post(
            '/companies/1/employee',
            [
                'first_name' => 'testing',
                'first_name' => 'unit',
                'email' => 'testingunit@gmail.com',
                'phone' => '08123123124123'
            ]
        );
        $response = $this->actingAs($user)->delete('/companies/employee/2');
        $response->assertStatus(302);
    }
    /** @test */
    public function destroyCompany()
    {
        $user = User::make([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => 'test123'
        ]);
        $response = $this->actingAs($user)->delete('/companies/1');
        $response->assertStatus(302);

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        // use refreshDatabase;
    }
}
