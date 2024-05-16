<?php
require 'index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Them Cong Dan</title>
</head>

<body>
  <h1>Trang them Cong Dan</h1>

  <form method="POST" action="code.php">
    <?php

    if (isset($_GET["macd"])) {
      $macd = $_GET["macd"];
      $sql = "SELECT DISTINCT * FROM CONGDAN CD
              JOIN DIEMCACHLY DCL ON CD.MaDiemCachLy = DCL.MaDiemCachLy
              WHERE CD.MaCongDan = '$macd'";
      $query = mysqli_query($con, $sql);

      $item = $query->fetch_assoc();

      if ($query) {
    ?>
        <label for="macd">Ma cong dan:</label>
        <input type="text" id="macd" name="macd" value="<?= $item['MaCongDan']; ?>" readonly /><br />

        <label for="tencd">Ten cong dan:</label>
        <input type="text" id="tencd" name="tencd" value="<?= $item['TenCongDan']; ?>" /><br />

        <label for="gioitinh">Gioi tinh:</label>
        <input type="checkbox" id="gioitinh" name="gioitinh" value="<?= $item['GioiTinh']; ?>" /><br />

        <label for="namsinh">Nam sinh:</label>
        <input type="date" id="namsinh" name="namsinh" value="<?= $item['NamSinh']; ?>" /><br />

        <label for="nuocve">Nuoc ve:</label>
        <input type="text" id="nuocve" name="nuocve" value="<?= $item['NuocVe']; ?>" /><br />

        <label for="madcl">Ten diem cach ly:</label>
        <select name="madcl" id="madcl">
          <?php

          $query = "SELECT * FROM DIEMCACHLY";
          $query_run = mysqli_query($con, $query);

          if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $option) {
              $selected = ($option['MaDiemCachLy'] == $item['MaDiemCachLy']) ? 'selected' : '';

          ?>
              <option value="<?= $item['MaDiemCachLy']; ?>" selected="<?= $selected; ?>">
                <?= $item['TenDiemCachLy']; ?>
              </option>
          <?php

            }
          }

          ?>
        </select><br />
    <?php
      }
    }

    ?>
    <button type="submit" name="update_cd" class="btn btn-primary">Update</button>
  </form>
</body>
</html>