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

    <label for="macd">Ma cong dan:</label>
    <input type="text" id="macd" name="macd" /><br />

    <label for="tencd">Ten cong dan:</label>
    <input type="text" id="tencd" name="tencd" /><br />

    <label for="gioitinh">Gioi tinh:</label>
    <input type="checkbox" id="gioitinh" name="gioitinh" /><br />

    <label for="namsinh">Nam sinh:</label>
    <input type="date" id="namsinh" name="namsinh" /><br />

    <label for="nuocve">Nuoc ve:</label>
    <input type="text" id="nuocve" name="nuocve" /><br />

    <label for="madcl">Ten diem cach ly:</label>
    <select name="madcl" id="madcl">
      <?php
      $query = "SELECT * FROM DIEMCACHLY";
      $query_run = mysqli_query($con, $query);

      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) {
      ?>
          <option value="<?= $item['MaDiemCachLy']; ?>">
            <?= $item['TenDiemCachLy']; ?>
          </option>
      <?php
        }
      }
      ?>
    </select><br />

    <button type="submit" name="them_cong_dan">Them</button>
  </form>
</body>
</html>