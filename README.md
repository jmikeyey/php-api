# User Migration and Fetch API

This project demonstrates an Object-Oriented Programming (OOP) style for implementing a simple API that fetches users from a MySQL database. It showcases a structured approach to building a PHP-based API with separate classes for routing, database management, and controllers.

To ease the setup process, a migration script is provided that automatically creates the necessary `users` table and populates it with 3 users. This removes the need for manual table creation.

## Requirements

- PHP
- MySQL

## Setup Instructions

1. Clone the repository to the C:/xampp/htdocs directory:
```
git clone https://github.com/jmikeyey/php-api
```

3. Install Dependencies

```bash
composer install
```

3. **Run the migration script:**

   Open the terminal, navigate to the project directory, and run the migration to create the database, `users` table, and add 3 users.

   ```bash
   php migrate.php

   ```

4. Access the API Endpoint

```bash
  GET http://localhost/api/users
```

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
```
