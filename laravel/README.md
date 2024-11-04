# Tuwwaf Al-Aqsa Project

This project is built using [Laravel](https://laravel.com/) and [Filament](https://filamentphp.com/) to develop a web application. Filament provides a modern admin panel and a user-friendly interface for Laravel applications.

## Requirements

- **PHP**: Version 8.0 or higher
- **Composer**: Version 2.0 or higher
- **Laravel**: Version 10 or higher
- **Database**: MySQL, PostgreSQL, or SQLite
- **Node.js**: Version 14 or higher
- **npm**: Version 6 or higher

## Installation

Follow these steps to install and run the project on your local machine:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/abdulrahmanRadan/Tofan.git
   cd Tofan
   ```

2. **Install required packages:**

   Install the necessary packages using Composer and npm:

   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Set up the environment file:**

   Copy the `.env.example` file to `.env` and update the database settings and keys:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrate the database:**

   Run the migrations to create the tables in the database:

   ```bash
   php artisan migrate
   ```

5. **Serve the application:**

   Run the development server:

   ```bash
   php artisan serve
   ```

## Usage

After completing the installation steps, you can access the application in your web browser at `http://localhost:8000`.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contact

- **Name**:  Abdulrahman Ali  And Amjad zywd
- **Email**:  abdulrahmanraadan@gmail.com or amjdzywd87@gmail.com
