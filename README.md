
# PetStore App

PetStore App is a web application built with the Laravel framework, allowing you to manage a list of pets. You can perform operations such as viewing, adding, updating, and deleting pet records.

## Prerequisites

Before you begin, make sure you have met the following requirements:

- [PHP >= 8.0](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js and npm](https://nodejs.org/en/)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/krystianszacho/petstore-app.git
   cd petstore-app
   ```

2. **Install PHP dependencies using Composer:**

   ```bash
   composer install
   ```

3. **Set up the environment configuration:**

   Copy the `.env.example` file to create your `.env` file:

   ```bash
   cp .env.example .env
   ```

   Then, generate the application key:

   ```bash
   php artisan key:generate
   ```

4. **Set up the database:**

   Create a new database in MySQL or SQLite (depending on your `.env` configuration), then run the migrations:

   ```bash
   php artisan migrate
   ```

5. **Install front-end dependencies:**

   If your application uses front-end tools, install them using npm or yarn:

   ```bash
   npm install
   # or
   yarn install
   ```

6. **Run the development server:**

   You can now run the Laravel development server:

   ```bash
   php artisan serve
   ```

   The application will be available at `http://127.0.0.1:8000`.

## Usage

- Visit the homepage to see the list of pets.
- You can add, edit, or delete pets via the app interface.
- The app allows managing pet categories and statuses (available, pending, sold).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
