# Student App - REST API Documentation

RESTful API Designed in Laravel for a very simple Student Information application.

## Index

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Schema](#schema)
-   [Root End-Point](#root-end-point)
-   [Request & Response Examples](#request--response-examples)

## Requirements

-   [node & npm](http://nodejs.org)
-   [ENV](: Make sure you have set your environement variables `credentials`
-   [PostMan](https://www.getpostman.com/)

## Installation

1. Clone the repository: `git clone https://github.com/Syldox/Student-Api-laravel.git`
2. Install the application: `composer install`
3. Make sure you have set your environement variables in the `env file => username and password`
4. Generate a new key with the command: `php artisan generate:key`
5. Migrate your database with the command: `php artisan migrate`
6. Run the app with the command: `php artisan serve` to runn the app and make sure your server is running.

## Open PostMan and make a `GET` request to the endPoint`http://localhost:8000/api`.

1. `GET` request to `http://localhost:8000/api/student/all`,
2. `GET` request to `http://localhost:8000/api/student/edit`,
3. `GET` request to `http://localhost:8000/api/class/view`,
4. `GET` request to `http://localhost:8000/api/class/all`,
5. `GET` request to `http://localhost:8000/api/student/view`,
6. `POST` request to `http://localhost:8000/api/student/edit`,
7. `POST` request to `http://localhost:8000/api/student/add`,
8. `POST` request to `http://localhost:8000/api/class/add`,
9. `POST` request to `http://localhost:8000/api/class/edit`,

## Schema

1. All API access is over HTTP, and accessed from `http://localhost:3000/api/v1`.
2. All data is sent and received as JSON.
3. Date of birth can be written in any format: `YYYY-MM-DD` or `YYYY/MM/DD`

## Root End-Point

`http://localhost:8000/api`

## Core Resources

### Student app

`Student` object represents snapshot of a specific Students and classes with a unique Id. You can retrieve it to see details about the Student or classes.

#### Schema

```student model
{
    first_name: {
        type: String,
        required: true
    },
    last_name: {
        type: String,
        required: true,
    },
    date_of_birth: {
        type: Date,
        required: true,
    }

}
```

```classes model
{
    code: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true,
    },
    status: {
        type: enum,
        required: true,
    }
    description:{
         type: enum,
         nullable
    }

}
```

#### End-Points Please check the routes api for the rest of the endpoints

| Method | End-Point           | Description                |
| ------ | ------------------- | -------------------------- |
| `GET`  | `/student/all`      | List all _students_        |
| `POST` | `/student/add`      | Create a new _student_     |
| `GET`  | `/student/view/:id` | Fetch a specific _student_ |
| `PUT`  | `/student/edit/:id` | Edit existing _student_    |

Request and Responses To be Updated...
