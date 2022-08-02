<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create_employee_with_empty_fields()
    {
        $response = $this->post('/api/create_employee', [
            // empty body
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_create_employee_with_a_non_existant_company()
    {
        $response = $this->post('/api/create_employee', [
            'company_id' => '1',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'email@email.com',
        ]);

        $response->assertStatus(404);
    }

    public function test_create_employee()
    {
        $create_company_response = $this->post('/api/create_company', [
            'name' => 'Company name',
        ]);

        $create_company_response->assertStatus(200);

        $create_employee_response = $this->post('/api/create_employee', [
            'company_id' => (string) json_decode($create_company_response->getContent(), true)['id'],
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'email@email.com',
        ]);

        $create_employee_response->assertStatus(200);
    }

    public function test_create_two_employees_with_same_email_adresses()
    {
        $create_company_response = $this->post('/api/create_company', [
            'name' => 'Company name',
        ]);

        $create_company_response->assertStatus(200);

        $create_first_employee_response = $this->post('/api/create_employee', [
            'company_id' => (string) json_decode($create_company_response->getContent(), true)['id'],
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'email@email.com',
        ]);

        $create_first_employee_response->assertStatus(200);

        $create_second_employee_response = $this->post('/api/create_employee', [
            'company_id' => (string) json_decode($create_company_response->getContent(), true)['id'],
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'email@email.com',
        ]);

        $create_second_employee_response->assertSessionHasErrors([
            'email' => 'The email has already been taken.',
        ]);
    }
}
