# Kshan-Ecommerce-site-J

## Introduction
Welcome to this Kshan E-Commerce Website ! This README will provide you with an overview of the project, its features, and how to set it up.

## Project Overview
Our E-Commerce Website is designed to provide users with an online platform to browse, purchase, and manage products. It includes features such as:

- User authentication and authorization.
- Product browsing and searching functionality.
- Shopping cart management.
- Admin dashboard with CMS (Content Management System) for managing products.
- Responsive design for optimal viewing across devices.

## Technologies Used
- HTML
- CSS (Bootstrap framework)
- JavaScript
- PHP
- MySQL

## Getting Started
To run the project locally, follow these steps:

1. **Clone the Repository:**
   ```
   git clone <repository-url>
   ```

2. **Database Setup:**
   - Import the provided SQL file (`kshan-ecommerce-j-db.sql`) into your MySQL database to set up the necessary tables.
   - Update the database configuration in `controls/conn.php` with the required MySQL database credentials.

3. **Server Setup:**
   - Ensure you have PHP installed on your local machine or set up a server environment.
   - Place the project files in the root directory of your server.

4. **Start the Server:**
   If you're using PHP's built-in server, navigate to the project directory in your terminal and run:
   ```
   php -S localhost:8000
   ```
   Otherwise, configure your server to serve the project files.

5. **Access the Website:**
   Open your web browser and navigate to `http://localhost:8000/j-clone/` (or the appropriate URL if using a different port or server).

6. **Admin Access:**
   - To access the admin dashboard, navigate to `http://localhost:8000/j-clone/admin/account/login/`log in with the provided admin credentials.
   - Once logged in, you can add, edit, or delete products using the CMS functionality.


## License
This project is licensed under the [MIT License](LICENSE).

## Get in Touch
If you have any questions, feedback, or issues, please feel free to send an email [rwenyosylvia@gmail.com](mailto:rwenyosylvia@gmail.com).
