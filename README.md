## Simple Laravel API with Job Queue, Database, and Event Handling


### Objective
Create a Laravel API that demonstrates your proficiency with Laravel's job queues, database operations, migrations, and event handling. This test should take approximately 2-3 hours to complete.


## Requirements
- API Endpoint: Develop a single API endpoint `/submit` that accepts a `POST` request with the following JSON payload structure:
{
"name": "John Doe",
"email": "john.doe@example.com",
"message": "This is a test message."
}
- Validate the data (ensure `name`, `email`, and `message` are present).
- Database Setup: Use Laravel migrations to create a table named `submissions` with columns for `id`, `name`, `email`, `message`, and timestamps (`created_at` and `updated_at`).
- Job Queue: Upon receiving the API request, the data should not be immediately saved to the database. Instead, dispatch a Laravel job to process the data. The job should perform the following tasks:
- Save the data to the `submissions` table in the database.
- Events: After the data is successfully saved to the database, trigger a Laravel event named `SubmissionSaved`. Attach a listener to this event that logs a message indicating a successful save, including the `name` and `email` of the submission.
- Error Handling: Implement error handling for the API to respond with appropriate messages and status codes for the following scenarios:
- Invalid data input (e.g., missing required fields).
- Any errors that occur during the job processing.
- Documentation: Briefly document the following in a README file:
- Instructions on setting up the project and running migrations.
- A simple explanation of how to test the API endpoint.
- Write a simple Unit test.

## Launch of the project

Copy the example environment file and set up your environment variables
````
cp .env.example .env
````
Use Docker Compose to build and start the containers

````
docker-compose up -d
````

After the containers are up and running, execute the database migrations
````
docker-compose exec app php artisan migrate
````

Start the Laravel queue worker to process jobs
````
docker-compose exec app php artisan queue:work
````
You can now test the API by sending a POST request to the /submit endpoint


If there are any errors during job processing or other operations, check the logs
````
docker-compose exec app tail -f storage/logs/laravel.log
````



