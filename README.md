## Expertel Test

- Clone this repository
- Run composer to install the dependencies
- Run the migrations to create the tables
- Modify the code as you see fit
- Commit your code and send us a link to your repository
- Important: Do not modify the routes

### To run with Docker

1. Run `docker-compose build app`
2. Run `docker-compose up -d` to create the environment on the background
3. Run `docker-compose exec app rm -rf vendor composer.lock`
4. Install dependencies `docker-compose exec app composer install`
5. Generate the key `docker-compose exec app php artisan key:generate`

### API Documentation

1. Get Meetings 
    `GET localhost:8000/api/meetings`
    - Response:
    ```json
    [
        {
            "id": 1,
            "meeting_name": "new meeting",
            "start_time": "2023-10-03 10:00:00",
            "end_time": "2023-10-03 10:00:00",
            "user_id": 1
        },
        {
            "id": 2,
            "meeting_name": "new meeting",
            "start_time": "2023-10-03 10:00:00",
            "end_time": "2023-10-03 10:00:00",
            "user_id": 1
        }
    ]
    ```

2. Create a new meeting
    `POST localhost:8000/api/meetings`
    - Request: 
    ```json
    {
        "name": "new meeting",
        "date_from": "2023-12-03 08:00:00",
        "date_to": "2023-12-03 08:59:00",
        "users": [1,2,3,4]
    }
    ```

    - Response:
    ```json
    {
        "message": "<The meeting has been booked|The meeting can not be booked>"
    }
    ```