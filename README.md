<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Application

Users to manage spraying records for machines. The application includes authentication, machine management, and machine reset operations.

# Project Setup

To set up the project, follow these steps:

1. Run `composer install` and create a `.env` file.
2. Run `composer refresh` (a custom Composer command), which will set up the API with dummy data.

For the frontend:

1. Run `npm install`.
2. Run `npm run dev` to start the development server.

## General Features

- **Login Functionality**: Users must log in to access the application.
- **Machine Management**: Users can create, view, update, and delete machine records.
- **Machine Reset Operations**: The front-end UI is complete, but the front-end logic and back-end logic still need to be implemented.

## Approach and Logic Used

### Backend

- **Routing**:
  - The `api.php` file defines the API routes, including routes for authentication and resource management.
  - Route groups are used to apply middleware to protected routes.

- **Controllers**:
  - Handle logic for each route, including authentication and CRUD operations.

- **Middleware**:
  - Used to protect routes requiring authentication (`auth:sanctum` middleware).

- **Models and Migrations**:
  - Models represent database tables.
  - Migrations create and modify these tables.

- **Repositories**:
  - `UserRepository`: Handles data access logic for user-related operations.
  - `MachineRepository`: Handles data access logic for machine-related operations.

- **Factories**:
  - `MachineFactory` and `UserFactory` are used to create sample user and machine records.

### Frontend

- **Routing**:
  - The `routes.js` file defines application routes, including lazy-loaded components and nested routes for machine-related actions.

- **State Management**:
  - The `auth.js` file uses Pinia to manage authentication state, storing the token in local storage and providing actions to set and clear it.

- **Main Application Setup**:
  - The `app.js` file initializes the Vue application, sets up Pinia and Vue Router, and defines a navigation guard for authentication.

- **Layout Component**:
  - The `Layout.vue` file defines the main layout, including a navigation bar and user profile dropdown.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

