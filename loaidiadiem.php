<?php include "header.php"?>
<body>
    <div class="container">
        <!-- Menu: sử dụng navbar -->
        <?php include 'navbar.php'; ?>
        <!-- Nội dung: sử dụng card -->
        <div class="card mt-3">
            <div class="card-header">Loại địa điểm</div>
            <div class="card-body">
                <a href="loaidiadiem_them.php" class="btn btn-success mb2">Thêm Mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th  width="15%" >Mã loại</th>
                            <th swidth="45%">Tên loại</th>
                            <th width="30%">Hình ảnh bản đồ</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="HienThi">    

                    </tbody>
                </table>
                
            </div>
        </div>

        <!-- Footer: tự code -->
        <?php include 'footer.php'; ?>
    </div>
    <?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/11.5.0/firebase-firestore.js';
			const db = getFirestore();
			const querySnapshot = await getDocs(collection(db, 'laoidiadiem'));
			var output = '';
			querySnapshot.forEach((doc) => {
				output += '<tr>';
					output += '<td class="align-middle">' + doc.data().MaLoai + '</td>';
					output += '<td class="align-middle">' + doc.data().TenLoai + '</td>';
					output += '<td class="align-middle text-center"><img src="images/' + doc.data().HinhAnhBanDo + '"></td>';
					output += '<td class="align-middle text-center"><a href="loaidiadiem_sua.php?id=' + doc.id + '">Sửa</a></td>';
					output += '<td class="align-middle text-center"><a onclick="return confirm(\'Bạn có muốn xóa loại địa điểm ' + doc.data().TenLoai + ' không?\')" href="loaidiadiem_xoa.php?id=' + doc.id + '">Xóa</a></td>';
				output += '</tr>';
			});
			$('#HienThi').html(output);
		</script>
   </script>
</body>