<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $dotenv = Dotenv::createImmutable(__DIR__, 'admin.env');
    $dotenv->load();
    
    $correct_username = $_ENV['ADMIN_USERNAME'];
    $correct_password = $_ENV['ADMIN_PASSWORD'];

    if ($username == $correct_username && $password == $correct_password) {
        $_SESSION['logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>

<form method="POST">
    <label for="username">Логин:</label>
    <input type="text" name="username" id="username" required>
    <br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Войти</button>
</form>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>