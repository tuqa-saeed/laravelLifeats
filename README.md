This project provides a personalized weekly meal system for each user based on their preferences and dietary habits.

Allows users to select daily meals through an intuitive control panel.

### Each team member worked independently on either the frontend or backend repo, and then both parts were integrated together during deployment or in a unified development environment.


Offers a “meal lock” feature to finalize meal selections after confirmation.

Manages user subscriptions with flexible plan durations.

Includes a comprehensive product management system (e.g., supplements or ready-to-eat meals).

👤 2. User Registration & Authentication
📁 Controllers: RegisteredUserController, AuthenticatedSessionController

Users register their name, email, password, phone number, preferences, and sensitivities.

Role-based access control (user/admin).

Full token protection for security, with token storage handled in cookies by Sanctum
🍱 3. Meal & Category Management
📁 Controllers: MealController, MealCategoryController

Displays all available meals and categories (e.g., breakfast, lunch, dinner).

Meals can be filtered by category or date.

Allows CRUD operations for meal management.

Uses the belongsTo relationship between meals and categories.

📆 4. Meal Scheduling
📁 Controller: MealScheduleController

Each user has a meal schedule tied to their subscription.

The schedule includes dates and meals arranged by day.

✅ 5. Meal Selection & Confirmation
📁 Controller: MealSelectionController

Users select meals for each day and category.

Prevents duplicate meals within the same category.

Final confirmation locks the day’s meal selection.

Allows flexibility to modify choices before locking.

📦 6. Product Management (Supplements, Juices, etc.)
📁 Controller: ProductsController

Full CRUD functionality for products.

Each product includes name, description, and price.

Ready for sale or inclusion within subscription plans.

💳 7. Subscriptions & Plan Duration
📁 Controllers: SubscriptionController, UserSubscriptionController

Users select a subscription plan: weekly, monthly, etc.

Creates a subscription with start and end dates.

Prevents duplicate subscriptions if a valid subscription is active.

👥 8. User Interface
📁 Controller: UserController

View and edit profile.

Update preferences and sensitivities.

Only the user has access to their profile.

📌 Key Features
Full meal customization support.

Locks meal selection after confirmation.

Automatically generates meal schedule upon subscription.

Secures orders and validates data.

Clear and modular RESTful API.

🌐 Tech Stack
Back-End Framework: Laravel 10

Database: MySQL

API Testing: Postman

Design Pattern: MVC

APIs: RESTful

Authentication & Middleware

Validation & Error Handling
