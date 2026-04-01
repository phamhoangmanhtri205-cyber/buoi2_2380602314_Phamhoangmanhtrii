<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JWTHandler
{
    private $secret_key;

    public function __construct()
    {
        // Bí kíp sinh tử (Secret Key) dài hơn 32 ký tự (256 bit) để tránh lỗi "Provided key is too short" của JWT (Bài 6)
        $this->secret_key = "HUTECH_SECRET_KEY_FOR_JWT_SECURITY_2026_PRO_MAX"; 
    }

    // Đóng gói mảng Dữ liệu thành Chuỗi Token
    public function encode($data)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // Có hạn sử dụng trong đúng 1 tiếng đồng hồ

        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'data' => $data
        );

        // Bọc ổ khóa HS256 chuẩn bảo mật CIA
        return JWT::encode($payload, $this->secret_key, 'HS256');
    }

    // Dịch ngược Chuỗi Token lấy lại mảng Data (Trả về Null nếu phát hiện vé giả hoặc vé hết hạn)
    public function decode($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, new Key($this->secret_key, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return null;
        }
    }
}
?>
