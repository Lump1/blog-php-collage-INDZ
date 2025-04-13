
# Usage

- If you are reviewing my project, write me manually — I will start the server with ngrok.
- If you want to run it by yourself, there is a small instruction below.

## Local Method

Follow these steps to run the project locally:

### 1. **Clone the Repository**
```bash
git clone https://github.com/Lump1/blog-php-collage-INDZ
cd blog-php-collage-INDZ
composer install
```

### 2. **Install and Start Apache**

Open your Linux terminal and run the following commands to install Apache:
```bash
sudo apt update
sudo apt install apache2
sudo systemctl start apache2
sudo systemctl enable apache2
```

### 3. **Install PHP and PHP Extensions**

Install PHP and necessary extensions for Apache:
```bash
sudo apt install php php-cli libapache2-mod-php php-mysql php-xml php-curl
```
After the installation is complete, restart Apache to apply the changes:
```bash
sudo systemctl restart apache2
```

### 4. **Install MySQL**

Install MySQL client and server:
```bash
sudo apt update
sudo apt install mysql-client-core-8.0
sudo apt install mysql-server
sudo systemctl start mysql
sudo systemctl enable mysql
```

### 5. **Start PHP-FPM (if needed)**

If you're using PHP 8.2, run the following to start PHP-FPM:
```bash
sudo systemctl start php8.2-fpm
php -m | grep pdo
```

### 6. **Configure MySQL**

Follow these steps to configure MySQL and create a database for the blog application.

#### Step 1: Login to MySQL
First, login to MySQL as the root user:
```bash
sudo mysql -u root -p
```

#### Step 2: Create a New Database
Create a new database for your blog application:
```sql
CREATE DATABASE blog_db;
```

#### Step 3: Use the Database
Select the newly created database:
```sql
USE blog_db;
```

#### Step 4: Create a Table for the Blog
Create a table named `posts` to store blog posts. You can adjust the fields as necessary for your project:
```sql
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    link VARCHAR(255),
    likescount INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
```

#### Step 5: Create a MySQL User (Optional)
If you want to create a specific user for your blog, run the following command to create a new user and grant the necessary permissions:
```sql
CREATE USER 'blog_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON blog_db.* TO 'blog_user'@'localhost';
FLUSH PRIVILEGES;
```

#### Step 6: Exit MySQL
Exit the MySQL shell:
```sql
EXIT;
```

### 7. **Setup environment**
1. Create `admin.env` file with fill below
```env
ADMIN_USERNAME=<username you want use to log in admin panel>
ADMIN_PASSWORD=<password you want use to log in admin panel>
```

2. Create `db_connect.php`
```php
<?php
require_once 'config.php';
$charset = 'utf8mb4';

$dsn = "mysql:host=". DB_HOST .";dbname=". DB_NAME .";charset=$charset";

$sqlCreatePost = "
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    link VARCHAR(255),
    likescount INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

$sqlGetPosts = "
SELECT * FROM posts; 
";

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $pdo->exec($sqlCreatePost);
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

try {
    $stmt = $pdo->query($sqlGetPosts);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}


?>
```
3. Create `config.php`
```php
<?php
define('DB_HOST', '<your host name>');
define('DB_NAME', '<your database name>');
define('DB_USER', '<your user name>');
define('DB_PASS', '<your password>');
?>
```

### 8. **Testing the Setup**

1. Start Apache and MySQL services (if not already running):
```bash
sudo systemctl start apache2
sudo systemctl start mysql
```

2. Open your browser and navigate to `http://localhost`. If everything is configured correctly, you should see your blog project running.

