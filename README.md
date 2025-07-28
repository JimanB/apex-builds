# Apex Builds - Custom PC Builder Website

A full-stack custom PC builder web application that allows users to browse components, create custom configurations, and place orders. Includes a comprehensive admin dashboard for managing products, users, and viewing site status.

---

## 1. Server Requirements

Make sure your hosting environment includes the following:

* **Web Server:** Apache
* **PHP Version:** 8.3+ (with `mysqli` and `curl` extensions enabled)
* **Database Server:** MariaDB 10.4+ (compatible with MySQL 5.7+)
* **Database Management:** phpMyAdmin 5.2+

---

## 2. Database Setup

### Step 2.1: Create the Database & User

1.  Log in to your hosting control panel (e.g., cPanel) and navigate to **phpMyAdmin**.
2.  Create a new database (e.g., `apex_builds_db`).
3.  Create a new database user and a secure password.
4.  Add the user to the database and grant **ALL PRIVILEGES**.
5.  Keep the database name, username, and password handy.

### Step 2.2: Import the Database Schema & Data

1.  Select your newly created database in phpMyAdmin.
2.  Click the **"Import"** tab at the top.
3.  Click "Choose File" and select the `bajwa11j_3340_project.sql` file provided with this project.
4.  Click **"Go"** at the bottom of the page.

This will create and populate all necessary tables.

---

## 3. Configure the Application

1.  **Database Connection:** Open the file `php/db_connect.php` and update the following variables with your credentials:
    ```php
    $servername = "localhost";
    $username = "your_database_username";
    $password = "your_database_password";
    $dbname = "your_database_name";
    ```
2.  **Weather API Key:** To enable the weather widget, get a free API key from [OpenWeatherMap](https://openweathermap.org/).
    * Open `js/main.js`, find the `fetchWeather` function, and replace the placeholder API key with your own.
    * Do the same in `admin/status.php` for the monitoring page.

---

## 4. Final Steps

1.  **Upload Files:** Upload all the project files and folders to your web server's public directory (e.g., `public_html`).
2.  **Set Admin User:** 🛈 The default user accounts are not administrators. To create an admin:
    * Register a new account through the website's registration page.
    * In phpMyAdmin, go to the `users` table and edit your new user.
    * Change the `role` field from `'customer'` to `'admin'`.
3.  **Access the Site:** Navigate to your website's URL. The application should now be fully functional.