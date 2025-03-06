## **Project Setup**
To set up the project:
1. Run `composer install` and create a `.env` file.
2. Then, run `composer refresh` (a custom Composer command) to set up the API with dummy data.

For the frontend:
1. Run `npm install`.
2. Then, run `npm run dev` to start the development server.

## **General Features**
- **Login Functionality**: Users can log in to access the application and log out.
- **Machine Management**: Users can create, view, update, and delete machine records.
- **Machine Reset Operations**: Users can update the date and hours and reset the hours.

## **Approach and Logic Used to Solve the Problem**

### **Backend**
- **Routing**: The `api.php` file defines API routes, including those for authentication and resource management. Route groups are used to apply middleware to protected routes.
- **Controllers**: Controllers handle the logic for each route, including authentication and CRUD operations.
- **Middleware**: Middleware is used to protect routes that require authentication. The `auth:sanctum` middleware secures these routes.
- **Models and Migrations**: Models represent database tables, and migrations are used to create and modify them.
- **Repositories**:
  - `UserRepository`: Encapsulates data access logic for user-related operations.
  - `MachineRepository`: Encapsulates data access logic for machine-related operations.
- **Factories**:
  - `MachineFactory` and `UserFactory` are used to create sample user and machine records.

### **Frontend**
- **Routing**: The `routes.js` file defines the application routes, including lazy-loaded components and nested routes.
- **Modal Popup**: The `Teleport` component is used to load popups.
- **State Management**: The `auth.js` file uses Pinia to manage authentication state, storing the token in local storage and providing actions to set and clear it.
- **Main Application Setup**: The `app.js` file initializes the Vue application, sets up Pinia and Vue Router, and defines a navigation guard to handle authentication.
- **Layout Component**: The `Layout.vue` file defines the main layout, including a navigation bar and user profile dropdown.

## **Assumptions**
- The total hours will be stored in each machine record. When a user adds new time, it will be added to the total and saved in the machine record.
- If multiple time records are needed, a JSON array can be used to store all date and time entries individually.

### **Example Format:**
```json
[
  { "date": "05/03/2025", "hours": 10 },
  { "date": "06/03/2025", "hours": 4 },
  { "date": "07/03/2025", "hours": 8 }
]
```

## **Challenges Faced**
- **Validate Timer Reset**: Prevent users from adding multiple reset entries at the same time.
