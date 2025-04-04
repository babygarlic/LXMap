<?php include 'header.php'?>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Xóa loại địa điểm</div>
				<div class="card-body">
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, doc, deleteDoc } from 'https://www.gstatic.com/firebasejs/11.5.0/firebase-firestore.js';
			const db = getFirestore();
			const docRef =  doc(db, 'laoidiadiem',"<?php echo $_GET['id'];?>");
            await deleteDoc(docRef);
			location.href='loaidiadiem.php';
		</script>
</body>