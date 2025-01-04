# account_form

account_form is a secure authentication system that allows users to log in or sign up using their username, email, and password. The application verifies user credentials using a MySQL database and hashes passwords for enhanced security. This project also features a simple front-end interface for user interaction.

## Features

- **Login System:** Users can log in using their username or email and password.
- **Signup System:** Users can sign up with a username, surname, email, and password. Passwords are securely hashed before storing in the database.
- **Security:** The passwords are hashed using PHP's `password_hash()` function, ensuring secure storage.
- **Error Handling:** Displays error messages if invalid credentials are entered or if the username/email already exists.

## Installation

To run the project locally, follow these steps:

### Prerequisites

- PHP 7.0 or higher
- MySQL database
- Web server (Apache, Nginx, etc.)

### Steps to Set Up  

1. Set up your MySQL database:
    - Create a new database called `test` (or modify the database name in `account.php`).
    - Run the following SQL query to create the required `account` table:
      ```sql
      CREATE TABLE `account` (
          `id` INT AUTO_INCREMENT PRIMARY KEY,
          `username` VARCHAR(30) NOT NULL UNIQUE,
          `surname` VARCHAR(30) NOT NULL,
          `email` VARCHAR(50) NOT NULL UNIQUE,
          `password` VARCHAR(255) NOT NULL
      );
      ```

2. Set up your local web server to point to the project directory.

3. Open the project in your browser by navigating to `localhost/account.php` or `127.0.0.1/account.php`.

## Usage

- **Login:** Users can log in by entering their username or email and password.
- **Sign Up:** New users can sign up by providing a username, surname, email, and password.
- Passwords are hashed during the signup process, ensuring secure storage.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
