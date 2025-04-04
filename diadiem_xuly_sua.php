<?php include "header.php" ?>
<body>
    <div class="container">
        <!-- Menu: sử dụng navbar -->
        <?php include 'navbar.php'; ?>
        
        <!-- Nội dung: sử dụng card -->
        <div class="card mt-3">
            <div class="card-header">Xử lý thêm địa điểm</div>
            <div class="card-body">
                <div class="alert alert-info">
                    Đang xử lý thêm địa điểm, vui lòng đợi trong giây lát...
                </div>
            </div>
        </div>
        
        <!-- Footer: tự code -->
        <?php include 'footer.php'; ?>
    </div>
    
    <?php include 'javascript.php'; ?>
    <script type="module">
        import { getFirestore, collection,udateDoc, doc, GeoPoint } from 'https://www.gstatic.com/firebasejs/11.5.0/firebase-firestore.js';
        
        const db = getFirestore();
        
        try {
            // Tạo reference đến loại địa điểm
            const loaiDiaDiemRef = doc(db, 'laoidiadiem', '<?php echo $_POST['MaLoai']; ?>');
            
            // Thêm địa điểm vào Firestore
            const docRef = await updateDoc(collection(db, "diadiem"), {
                MaDiaDiem: '<?php echo $_POST['MaDiaDiem']; ?>',
                MaLoai: loaiDiaDiemRef,
                TenDiaDiem: '<?php echo $_POST['TenDiaDiem']; ?>',
                ToaDo:  new GeoPoint(<?php echo $_POST['ViDo'];?>,<?php echo $_POST['KinhDo']; ?>),
                DiaChi: '<?php echo $_POST['DiaChi']; ?>',
                GhiChu: '<?php echo isset($_POST['GhiChu']) ? $_POST['GhiChu'] : ""; ?>'
            });
                // Redirect to the locations list
                window.location.href = 'diadiem.php';
            } catch (error) {
                console.error("Error adding document:", error);
                alert("Lỗi khi thêm địa điểm: " + error.message);
            }
            // Redirect về trang danh sách địa điểm sau khi thêm thành công
            location.href = 'diadiem.php';

    </script>
</body>
</html>