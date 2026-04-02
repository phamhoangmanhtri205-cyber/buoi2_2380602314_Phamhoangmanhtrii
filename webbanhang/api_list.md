# Danh sách API và Hướng dẫn test bằng Postman

Môi trường kiểm thử: **Postman**
Base URL: `http://localhost:888/buoi2_2380602314_Phamhoangmanhtrii/webbanhang/index.php?url=`

## Hướng dẫn chung
1. API lấy Token (`/User/checkLogin`) không yêu cầu JWT Auth.
2. Tất cả các API còn lại (như `ProductApi`, `CategoryApi`) đều yêu cầu phải có Token JWT hợp lệ.
3. Để truyền Token trong Postman:
   - Trong Tab **Authorization** của request.
   - Chọn Type là **Bearer Token**.
   - Dán Token nhận được từ bước Đăng nhập vào ô **Token**.

---

## 1. Authentication API (Đăng nhập & Lấy JWT Token)

### `POST /User/checkLogin`
- **Mô tả:** Đăng nhập để nhận Token JWT.
- **Headers:** `Content-Type: application/json`
- **Body (raw JSON):**
  ```json
  {
      "username": "your_username",
      "password": "your_password"
  }
  ```
- **Response thành công:** Có chứa JWT Token. Lưu Token này lại để dùng cho các API bên dưới.
  ```json
  {
      "token": "eyJ0eXAi...",
      "username": "your_username"
  }
  ```

---

## 2. Product APIs (Quản lý Sản phẩm)
*Yêu cầu Header Authorization: Bearer {Token}*

### `GET /ProductApi/index` (hoặc `/ProductApi`)
- **Mô tả:** Lấy danh sách tất cả sản phẩm.
- **Method:** GET

### `GET /ProductApi/show/{id}`
- **Mô tả:** Lấy thông tin chi tiết một sản phẩm theo ID.
- **Method:** GET
- **Ví dụ:** `http://localhost:888/.../index.php?url=ProductApi/show/1`

### `POST /ProductApi/store`
- **Mô tả:** Thêm một sản phẩm mới.
- **Method:** POST
- **Headers:** `Content-Type: application/json`
- **Body (raw JSON):**
  ```json
  {
      "name": "Giày Mizuno mới",
      "description": "Giày xịn",
      "price": 1500000,
      "category_id": 1
  }
  ```

### `PUT /ProductApi/update/{id}` (hoặc xử lý bằng POST tùy Routing)
- **Mô tả:** Cập nhật thông tin sản phẩm.
- **Method:** PUT (hoặc POST)
- **Headers:** `Content-Type: application/json`
- **Body (raw JSON):**
  ```json
  {
      "name": "Giày Mizuno sửa đồ",
      "description": "Giày quá xịn",
      "price": 1600000,
      "category_id": 2
  }
  ```

### `DELETE /ProductApi/destroy/{id}`
- **Mô tả:** Xóa một sản phẩm.
- **Method:** DELETE
- **Ví dụ:** `http://localhost:888/.../index.php?url=ProductApi/destroy/1`

---

## 3. Category APIs (Quản lý Danh mục)
*Yêu cầu Header Authorization: Bearer {Token}*

### `GET /CategoryApi/index` (hoặc `/CategoryApi`)
- **Mô tả:** Lấy danh sách tất cả danh mục.
- **Method:** GET

### `GET /CategoryApi/show/{id}`
- **Mô tả:** Lấy thông tin chi tiết một danh mục theo ID.
- **Method:** GET

### `POST /CategoryApi/store`
- **Mô tả:** Thêm một danh mục mới.
- **Method:** POST
- **Headers:** `Content-Type: application/json`
- **Body (raw JSON):**
  ```json
  {
      "name": "Tất vớ thể thao",
      "description": "Chống trượt"
  }
  ```

### `PUT /CategoryApi/update/{id}`
- **Mô tả:** Cập nhật thông tin danh mục.
- **Method:** PUT (hoặc POST)
- **Headers:** `Content-Type: application/json`
- **Body (raw JSON):**
  ```json
  {
      "name": "Tất vớ xịn",
      "description": "Chống trượt tốt hơn"
  }
  ```

### `DELETE /CategoryApi/destroy/{id}`
- **Mô tả:** Xóa một danh mục.
- **Method:** DELETE
