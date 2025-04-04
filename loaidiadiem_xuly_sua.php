<?php include "header.php"?>
<body>
    <div class="container">
        <!-- Menu: sử dụng navbar -->
        <?php include 'navbar.php'; ?>
        <!-- Nội dung: sử dụng card -->
        <div class="card mt-3">
            <div class="card-header"> Xử lý them loại địa điểm</div>
             <div class=" card-body">
             <?php
// ✅ Kiểm tra nếu có dữ liệu POST gửi lên
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["MaLoai"]) && !empty($_POST["TenLoai"]) && !empty($_POST["HinhAnhBanDo"])) {
    $maLoai = $_POST["MaLoai"];
    $tenLoai = $_POST["TenLoai"];
    $hinhAnhBanDo = $_POST["HinhAnhBanDo"];
} else {
    die("❌ Lỗi: Dữ liệu không hợp lệ!");
}
?>
             </div> 
            </div>
        </div>
        <!-- Footer: tự code -->
        <?php include 'footer.php'; ?>
    </div>
    <?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, doc, updateDoc } from 'https://www.gstatic.com/firebasejs/11.5.0/firebase-firestore.js';
			const db = getFirestore();
			const docRef =  doc(db, 'laoidiadiem',"<?php echo $_POST['id'];?>");
            await updateDoc(docRef,{
                MaLoai: '<?php echo $_POST['MaLoai'];?>',
                TenLoai: '<?php echo $_POST['TenLoai'];?>',
                HinhAnhBanDo: '<?php echo $_POST['HinhAnhBanDo'];?>'
            });
			location.href='loaidiadiem.php';
		</script>
</body>