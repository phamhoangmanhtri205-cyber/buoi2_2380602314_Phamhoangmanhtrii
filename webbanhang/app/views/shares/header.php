<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<?php 
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
?>
<link rel="stylesheet" href="<?= $basePath ?>/assets/css/neymarsport.css">
<script>
function logoutJWT() {
    // Xoá Token khỏi localStorage
    localStorage.removeItem('jwtToken');
    // Chuyển hướng về trang logout của PHP để xoá Session luôn cho đồng bộ
    window.location.href = '<?= $basePath ?>/index.php?url=User/logout';
}
</script>