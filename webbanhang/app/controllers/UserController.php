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

    // Hàm mới cho Bài 6: Trả về Token JWT cho AJAX
    public function checkLogin()
    {
        // Xoá sạch mọi ký tự lạ lỡ may có ở đầu file (whitespace, BOM...)
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');
        
        try {
            // Hỗ trợ cả JSON và Form Data truyền thống
            $json = file_get_contents("php://input");
            $data = json_decode($json, true);
            
            if (empty($data)) {
                $data = $_POST;
            }

            $username = $data['username'] ?? '';
            $password = $data['password'] ?? '';

            if (empty($username) || empty($password)) {
                http_response_code(400);
                echo json_encode(['message' => 'Vui lòng cung nhập đầy đủ thông tin']);
                exit;
            }

            $user = $this->userModel->login($username, $password);
            if ($user) {
                // ĐỒNG BỘ SESSION PHP: Thiết lập session để các view PHP nhận diện được User/Admin
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_role'] = $user['role'];

                if (file_exists('app/utils/JWTHandler.php')) {
                    require_once 'app/utils/JWTHandler.php';
                    $jwtHandler = new JWTHandler();
                    $token = $jwtHandler->encode([
                        'id' => $user['id'], 
                        'username' => $user['username'],
                        'role' => $user['role']
                    ]);
                    echo json_encode(['token' => $token, 'username' => $user['username']]);
                } else {
                    throw new Exception("JWTHandler file not found!");
                }
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Tài khoản hoặc mật khẩu không chính xác']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Server Error: ' . $e->getMessage()]);
        }
        exit;
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
