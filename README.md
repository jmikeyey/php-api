# User Migration and Fetch API

This project demonstrates a simple migration script to create a database and a `users` table, followed by populating the table with 3 users. Additionally, it implements an API to fetch the users in an OOP style.

## Requirements

- PHP
- MySQL

## Setup Instructions

1. Clone the repository or copy the files

2. Install Dependencies

```bash
composer install
```

3. **Run the migration script:**

   Open the terminal, navigate to the project directory, and run the migration to create the database, `users` table, and add 3 users.

   ```bash
   php migrate.php

   ```

4. Access the API Endpoint

````bash
  GET http://localhost/api/users

Sample Response:
```bash
[
  {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2024-08-19 12:34:56"
  },
  {
    "id": 2,
    "name": "Jane Doe",
    "email": "jane@example.com",
    "created_at": "2024-08-19 12:34:56"
  },
  {
    "id": 3,
    "name": "Alice Smith",
    "email": "alice@example.com",
    "created_at": "2024-08-19 12:34:56"
  }
]
````
