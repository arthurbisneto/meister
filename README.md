<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - README</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #333;
        }
        code {
            background-color: #f4f4f4;
            padding: 2px 4px;
            border-radius: 3px;
        }
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Task Manager</h1>

    <p>Task Manager is a simple web application built using Zend Framework, PHPUnit, and MySQL. It allows users to manage tasks with fields such as title, description, date created, and status (pending, in progress, or completed). The application supports basic CRUD operations, search, and sorting functionality.</p>

    <h2>Features</h2>
    <ul>
        <li><strong>Create, Read, Update, Delete (CRUD) Tasks:</strong> Manage your tasks easily with intuitive forms and validations.</li>
        <li><strong>Search and Filter:</strong> Quickly find tasks by title or description.</li>
        <li><strong>Sorting:</strong> Sort tasks by title, description, or date created.</li>
        <li><strong>Responsive Design:</strong> Optimized for various devices with Bootstrap.</li>
        <li><strong>Unit Testing:</strong> Ensured code quality with PHPUnit.</li>
    </ul>

    <h2>Technologies Used</h2>
    <ul>
        <li><strong>Backend:</strong> Zend Framework (PHP)</li>
        <li><strong>Database:</strong> MySQL</li>
        <li><strong>Frontend:</strong> Bootstrap, jQuery</li>
        <li><strong>Testing:</strong> PHPUnit</li>
    </ul>

    <h2>Prerequisites</h2>
    <ul>
        <li>PHP 8.2 or higher</li>
        <li>MySQL 5.7 or higher</li>
        <li>Composer</li>
        <li>Apache Web Server</li>
    </ul>

    <h2>Installation</h2>

    <h3>1. Clone the repository:</h3>
    <pre><code>git clone https://github.com/your-username/task-manager.git
cd task-manager</code></pre>

    <h3>2. Install PHP dependencies:</h3>
    <pre><code>composer install</code></pre>

    <h3>3. Set up the database:</h3>
    <p>Create a MySQL database:</p>
    <pre><code>CREATE DATABASE task_manager;
CREATE USER 'taskuser'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON task_manager.* TO 'taskuser'@'localhost';
FLUSH PRIVILEGES;</code></pre>
    <p>Run the SQL script to create the tasks table:</p>
    <pre><code>CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    datecreated DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'in progress', 'completed') DEFAULT 'pending'
);</code></pre>

    <h3>4. Configure the application:</h3>
    <p>Copy the provided example configuration:</p>
    <pre><code>cp config/autoload/local.php.dist config/autoload/local.php</code></pre>
    <p>Update <code>local.php</code> with your database credentials.</p>

    <h3>5. Set up Apache:</h3>
    <p>Create a virtual host for the application:</p>
    <pre><code>sudo nano /etc/apache2/sites-available/task-manager.conf</code></pre>
    <p>Add the following configuration:</p>
    <pre><code>&lt;VirtualHost *:80&gt;
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/task-manager/public
    &lt;Directory /var/www/html/task-manager/public&gt;
        DirectoryIndex index.php
        AllowOverride All
        Require all granted
    &lt;/Directory&gt;
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
&lt;/VirtualHost&gt;</code></pre>
    <p>Enable the site and rewrite module:</p>
    <pre><code>sudo a2ensite task-manager
sudo a2enmod rewrite
sudo systemctl reload apache2</code></pre>

    <h3>6. Access the application:</h3>
    <p>Open your web browser and go to <code>http://your-server-ip/</code> to start using the Task Manager.</p>

    <h2>Running Tests</h2>
    <p>To run unit tests using PHPUnit, navigate to the project directory and execute:</p>
    <pre><code>phpunit</code></pre>

    <h2>Contributing</h2>
    <p>Contributions are welcome! Please submit a pull request or open an issue to discuss any changes or improvements.</p>

    <h2>License</h2>
    <p>This project is licensed under the MIT License. See the <a href="LICENSE">LICENSE</a> file for details.</p>

    <h2>Contact</h2>
    <p>If you have any questions or need support, feel free to reach out via <a href="mailto:your-email@example.com">your-email@example.com</a>.</p>

</body>
</html>
