<?php 
	include "inc/header.php"; 
	include "classes/Student.php"; 
	$stu = new Student();
?>
<?php 
	error_reporting(0);
	$cur_date = date('Y-m-d');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$attend = $_POST['attend'];
		$insertattend = $stu->insertAttendance($attend);
	}
?>
	<div class="container">
<?php 
	if (isset($insertattend)) {
		echo $insertattend;
	}
?>
<div class='alert alert-danger' style="display: none;"><strong>오류가 났습니다.</strong> 출석번호를 입력해 주세요</div>
		<div class="card">
			<div class="card-header">
				<h2>
					<a class="btn btn-success" href="add.php">학생 추가하기</a>
					<a class="btn btn-info float-right" href="date_view.php">전체 보기</a>
				</h2>
			</div>

			<div class="card-body">
				<div class="card bg-light text-center mb-3">
					<h4 class="m-0 py-3"><strong>날짜</strong>: <?php echo $cur_date; ?></h4>
				</div>
				<form action="" method="post">
					<table class="table table-striped">
						<tr>
							<th width="25%">S/L</th>
							<th width="25%">학생명</th>
							<th width="25%">출석번호</th>
							<th width="25%">출결상황</th>
						</tr>
<?php 
	$getstudent = $stu->getStudents();
	if ($getstudent) {
		$i = 0;
		while ($value = $getstudent->fetch_assoc()) {
			$i++;
?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['roll']; ?></td>
							<td>
								<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present" checked="checked">출석
								<input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent">결석
							</td>
						</tr>
<?php } } ?>

						<tr>
							<td colspan="4" class="text-center">
								<input type="제출하기" name="제출하기" class="btn btn-primary px-5" value="제출하기">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
<?php include "inc/footer.php"; ?>