## Student Api - REST API Documentation

RESTful API Designed in Laravel for Collage Student registration details.

## Index

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Schema](#schema)
-   [Root End-Point](#root-end-point)
-   [Core Resources](#core-resources)
-   [Documentation](#documentation)
-   [Request & Response Examples](#request--response-examples)

## Requirements

-   [node & npm](http://nodejs.org)
-   [composer](https://getcomposer.org/download/)
-   [Xamp or Mamp](https://www.mongodb.com/): Make sure you have your env database URI configured in `credentials` set
-   [PostMan](https://www.getpostman.com/)

## Installation

1. Clone the repository: `https://github.com/Syldox/Student-Api-laravel.git`
2. Install the application: `composer install`
3. Place Set your ENV. URI for your `credentials`
4. Start the server: `php artisan serve`
5. Open PostMan and make a `GET` request to `http://localhost:8000/api/student/all`

## Schema

1. All API access is over HTTP, and accessed from `http://localhost:8000/api/student`.
2. All data is sent and received as JSON.

## Root End-Point

`http://localhost:8000/api/student/all`

## Core Resources

### Student

`Student` object represents snapshot of a specific Student with a unique Id. You can retrieve it to see details about the Student.

#### Schema

```Student-Table
{
     {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('class');
            $table->date('date_of_birth');
            $table->timestamps();
        });
    }
}
```

```Classes-Table
{
     {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->integer('maximum_students')->default(10);
            $table->enum('status', ['opened', 'closed']);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
}
```

### API Resources

#### Request & Response Examples End-Points

| Method | End-Point              | Description                |
| ------ | ---------------------- | -------------------------- |
| `GET`  | `/student/all`         | List all _students_        |
| `POST` | `/student/add`         | Create a new student\_     |
| `GET`  | `/student/add/:id`     | Fetch a specific _student_ |
| `PUT`  | `/api/student/edit:id` | Edit existing _student_    |

// To be updated...
