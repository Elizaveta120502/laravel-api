<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testTheSubmitReturnsASuccessfulResponse(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        Bus::fake();

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Data submitted successfully',
            ]);

        Bus::assertDispatched(ProcessSubmission::class, function ($job) use ($data) {
            return $job->data === $data;
        });

    }

    public function testTheSubmitReturnsAnErrorResponse(): void
    {
        $submission = Submission::factory()->create();

        $data = $submission->attributesToArray();

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'Database query error',
            ]);
    }
    public function testTheSubmitReturnsAnErrorResponseAboutRequiredValidation(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => [
                    'message' => [
                        'The message field is required.'
                    ]
                ]
            ]);
    }

    public function testTheSubmitReturnsAnErrorResponseAboutTypeValidation(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' =>  1111,
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => [
                    'message' => [
                        'The message field must be a string.'
                    ]
                ]
            ]);
    }
}
