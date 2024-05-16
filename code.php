<?php
include "index.php";

// ***** TẠO ĐIỂM CÁCH LY *****
if (isset($_POST['them_diem_cach_ly'])) {
  // Nhan du lieu tu form
  $madcl = $_POST['madcl'];
  $tendcl = $_POST['tendcl'];
  $diachi = $_POST['diachi'];
  $succhua = $_POST['succhua'];

  $sql = "INSERT INTO DIEMCACHLY(MaDiemCachLy,TenDiemCachLy,DiaChi,SucChua)
          VALUES ('$madcl', '$tendcl', '$diachi', '$succhua')";

  $query = mysqli_query($con, $sql);
  if ($query) {
    echo "<h3>Them thanh cong</h3>";
  }
}

// ***** TẠO CÔNG DÂN *****
if (isset($_POST['them_cong_dan'])) {
  $macd = $_POST['macd'];
  $tencd = $_POST['tencd'];
  $gioitinh = isset($_POST['gioitinh']) ? 1 : 0;
  $namsinh = date('Y-m-d', strtotime($_POST['namsinh']));
  $nuocve = $_POST['nuocve'];
  $madcl = $_POST['madcl'];

  $sql = "INSERT INTO CONGDAN(MaCongDan,TenCongDan,GioiTinh,NamSinh,NuocVe,MaDiemCachLy)
          VALUES ('$macd', '$tencd', '$gioitinh','$namsinh', '$nuocve', '$madcl')";

  $query = mysqli_query($con, $sql);
  if ($query) {
    echo "<h3>Them thanh cong</h3>";
  }
}

// ***** LẤY DANH SÁCH CÔNG DÂN *****
if (isset($_GET["malop"])) {
  $malop = $_GET['malop'];

  $sql = "SELECT *
            FROM HOCSINH HS
            JOIN LOP L ON HS.MALOP = L.MALOP
            WHERE HS.MALOP = '$malop'";

  $query = mysqli_query($con, $sql);

  $students = array();

  while ($row = $query->fetch_assoc()) {
    $students[] = $row;
  }

  echo json_encode($students);
}

// ***** XÓA CÔNG DÂN *****
if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
  $macd = $_POST['macd'];

  $sql = "DELETE FROM CONGDAN CD WHERE CD.MaCongDan = '$macd'";
  $query = mysqli_query($con, $sql);
}

// ***** CẬP NHẬT CÔNG DÂN *****
if (isset($_POST['update_cd'])) {
  $macd = $_POST['macd'];
  $tencd = $_POST['tencd'];
  $gioitinh = isset($_POST['gioitinh']) ? 1 : 0;
  $namsinh = date('Y-m-d', strtotime($_POST['namsinh']));
  $nuocve = $_POST['nuocve'];
  $madcl = $_POST['madcl'];

  // Cập nhật bảng CONGDAN
  $sql = "UPDATE CONGDAN
          SET TenCongDan='$tencd', GioiTinh='$gioitinh', NamSinh='$namsinh', NuocVe='$nuocve', MaDiemCachLy='$madcl'
          WHERE MaCongDan='$macd'";
  $query = mysqli_query($con, $sql);


  if ($query) {
    echo "<h3>Cap nhat thanh cong</h3>";
  } else {
    echo "<h3>Co loi xay ra khi cap nhat</h3>";
  }
}
