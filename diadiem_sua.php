<?php include "header.php" ?>
</head>

<body>
	<div class="container">
		<!-- Menu: sử dụng navbar -->
		<?php include 'navbar.php'; ?>

		<!-- Nội dung: sử dụng card -->
		<div class="card mt-3">
			<div class="card-header">Thêm địa điểm</div>
			<div class="card-body">
				<form action="diadiem_xuly_sua.php" method="post" class="needs-validation" novalidate>
					<div class="mb-3">
						<input type="text" id="id" name="id" hidden />
						<label for="MaDiaDiem" class="form-label">Mã địa điểm</label>
						<input type="text" class="form-control" id="MaDiaDiem" name="MaDiaDiem" required />
					</div>
					<div class="mb-3">
						<label for="MaLoai" class="form-label">Loại</label>
						<select class="form-select" id="MaLoai" name="MaLoai" required>
							<option value="">-- Chọn --</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="TenDiaDiem" class="form-label">Tên địa điểm</label>
						<input type="text" class="form-control" id="TenDiaDiem" name="TenDiaDiem" required />
					</div>
					<div class="mb-3">
						<label for="ViDo" class="form-label">Vĩ độ</label>
						<input type="text" class="form-control" id="ViDo" name="ViDo" required />
					</div>
					<div class="mb-3">
						<label for="KinhDo" class="form-label">Kinh độ</label>
						<input type="text" class="form-control" id="KinhDo" name="KinhDo" required />
					</div>
					<div class="mb-3">
						<label for="DiaChi" class="form-label">Địa chỉ</label>
						<input type="text" class="form-control" id="DiaChi" name="DiaChi" required />
					</div>
					<div class="mb-3">
						<label for="GhiChu" class="form-label">Ghi chú về địa điểm</label>
						<textarea type="text" class="form-control" id="GhiChu" name="GhiChu"></textarea>
					</div>

					<button type="submit" class="btn btn-primary">Thêm mới</button>
				</form>
			</div>
		</div>

		<!-- Footer: tự code -->
		<?php include 'footer.php'; ?>
	</div>

	<?php include 'javascript.php'; ?>
	<script type="module">
		import {
			getFirestore,
			doc,
			getDoc
		} from 'https://www.gstatic.com/firebasejs/11.5.0/firebase-firestore.js';
		const db = getFirestore();
		async function getDanhSachDiaDiem() {
			const docRef = doc(db, 'diadiem', "<?php echo $_GET['id']; ?>");
			const docSnapshot = await getDoc(docRef);

			if (docSnapshot.exists()) {
				return getRefData(docSnapshot);
			} else {
				console.log("Không tìm thấy tài liệu");
				return null;
			}
		}

		async function getRefData(docSnapshot) {
			const diaDiem = docSnapshot.data();
			diaDiem.id = docSnapshot.id;

			// Giả sử MaLoai là một tham chiếu đến tài liệu khác
			const loaiDiaDiemRef = diaDiem.MaLoai;
			if (loaiDiaDiemRef) {
				const loaiDiaDiemSnapshot = await getDoc(loaiDiaDiemRef);
				if (loaiDiaDiemSnapshot.exists()) {
					diaDiem.Loai = loaiDiaDiemSnapshot.data();
				}
			}

			return diaDiem;
		}
			const querySnapshot = await getDocs(collection(db, 'laoidiadiem'));
			var output = '';
			querySnapshot.forEach((doc) => {
				output += '<option value="' + doc.id + '">' + doc.data().TenLoai + '</th>';
			});
			$('#MaLoai').append(output);
		await getDanhSachDiaDiem().then(diaDiem => {
			if (diaDiem) {
				$('#id').val(diaDiem.id);
				$('#MaDiaDiem').val(diaDiem.MaDiaDiem);
				$('#TenDiaDiem').val(diaDiem.TenDiaDiem);
				$('#DiaChi').val(diaDiem.DiaChi);
				$('#MaLoai').val(diaDiem.Loai.MaLoai || '');
				$('#ViDo').val(diaDiem.ToaDo.latitude || '');
				$('#KinhDo').val(diaDiem.ToaDo.longitude || '');
				$('#GhiChu').val(diaDiem.GhiChu || '');
			} else {
				console.log("Không tìm thấy tài liệu");
			}
		}).catch(error => {
			console.error("Lỗi khi lấy dữ liệu:", error);
		});
	</script>

	<script>
		(function() {
			'use strict';
			var forms = document.querySelectorAll('.needs-validation');
			Array.prototype.slice.call(forms).forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		})();
	</script>
</body>

</html>