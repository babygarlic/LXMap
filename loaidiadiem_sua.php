<?php include 'header.php'?>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Sửa loại địa điểm</div>
				<div class="card-body">
					<form action="loaidiadiem_xuly_sua.php" method="post" class="needs-validation" novalidate>
						<input type="text" id="id" name="id" hidden />
						<div class="mb-3">
							<label for="MaLoai" class="form-label">Mã loại</label>
							<input type="text" class="form-control" id="MaLoai" name="MaLoai" required />
							<div class="invalid-feedback">Mã loại không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="TenLoai" class="form-label">Tên loại</label>
							<input type="text" class="form-control" id="TenLoai" name="TenLoai" required />
							<div class="invalid-feedback">Tên loại không được bỏ trống.</div>
						</div>
						<div class="mb-3">
							<label for="HinhAnhBanDo" class="form-label">Hình ảnh bản đồ</label>
							<input type="text" class="form-control" id="HinhAnhBanDo" name="HinhAnhBanDo" required />
							<div class="invalid-feedback">Hình ảnh bản đồ không được bỏ trống.</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Cập nhật</button>
					</form>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, doc, getDoc } from 'https://www.gstatic.com/firebasejs/11.5.0/firebase-firestore.js';
			const db = getFirestore();
			const docRef =  doc(db, 'laoidiadiem',"<?php echo $_GET['id'];?>");
			const Snapshot = await getDoc(docRef);
			if (Snapshot.exists()){
				$('#id').val(Snapshot.id);
				$('#MaLoai').val(Snapshot.data().MaLoai);
				$('#TenLoai').val(Snapshot.data().TenLoai);
				$('#HinhAnhBanDo').val(Snapshot.data().HinhAnhBanDo);
			}else {
				console.log("No such document");
			}
		</script>
</body>