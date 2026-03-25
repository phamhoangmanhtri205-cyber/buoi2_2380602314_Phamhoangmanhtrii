<?php
require_once 'app/Models/UserModel.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->userModel = new UserModel($db);
    }

    public function login()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($username) || empty($password)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } else {
                $user = $this->userModel->login($username, $password);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_role'] = $user['role'];
                    
                    // Redirect to home
                    header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=Product/index');
                    exit;
                } else {
                    $error = "Tài khoản hoặc mật khẩu không chính xác!";
                }
            }
        }
        
        // Show login view
        include 'app/views/user/login.php';
    }

    public function register()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (empty($username) || empty($password) || empty($confirm_password)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } elseif ($password !== $confirm_password) {
                $error = "Mật khẩu xác nhận không khớp!";
            } else {
                $result = $this->userModel->register($username, $password);
                if ($result === true) {
                    // Trả về login với success message
                    echo "<script>alert('Đăng ký thành công!'); window.location.href='" . dirname($_SERVER['SCRIPT_NAME']) . "/index.php?url=User/login';</script>";
                    exit;
                } else {
                    $error = $result;
                }
            }
        }
        
        // Show register view
        include 'app/views/user/register.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=Product/index');
        exit;
    }
}
?>
