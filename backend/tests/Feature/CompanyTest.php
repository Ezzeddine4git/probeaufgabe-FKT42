<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CompanyTest extends TestCase
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

    public function test_get_all_companies()
    {
        Artisan::call('db:seed');

        $response = $this->get('/api/get_all_companies_with_respective_employees');

        $response->assertStatus(200);

        // the database seeder generates 10 companies
        $this->assertEquals(10, count(json_decode($response->getContent(), true)));
    }

    public function test_check_that_employees_are_returned_with_the_companies()
    {
        Artisan::call('db:seed');

        $response = $this->get('/api/get_all_companies_with_respective_employees');

        $response->assertStatus(200);

        foreach (json_decode($response->getContent(), true) as $company) {
            $this->assertArrayHasKey('employees', $company);
        }
    }

    public function test_create_new_company_with_empty_fields()
    {
        $response = $this->post('/api/create_company', [
            // empty body
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_create_new_company()
    {
        $response = $this->post('/api/create_company', [
            'name' => 'Company name',
        ]);

        $response->assertStatus(200);

        $this->assertContains('Company name', json_decode($response->getContent(), true));
    }
}
