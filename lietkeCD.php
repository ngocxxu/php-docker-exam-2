<?php
require 'index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liet ke cong dan</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
</style>

<body>
  <h1>Trang liet ke cong dan</h1>

  <table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Ten cong dan</th>
        <th>Gioi tinh</th>
        <th>Nam sinh</th>
        <th>Nuoc ve</th>
        <th>Chuc nang</th>
      </tr>
    </thead>

    <tbody>
      <?php

      $sql = "SELECT * FROM CONGDAN";
      $query = mysqli_query($con, $sql);
      $stt = 1;

      if (mysqli_num_rows($query) > 0) {
        foreach ($query as $item) {
      ?>
          <tr data-macd="<?= $item['MaCongDan']; ?>">
            <td><?= $stt++; ?></td>
            <td><?= $item['TenCongDan']; ?></td>

            <td>
              <?php
              if ($item['GioiTinh'] == 0) {
                echo "Nữ";
              } else {
                echo "Nam";
              }
              ?>
            </td>

            <td><?= $item['NamSinh']; ?></td>
            <td><?= $item['NuocVe']; ?></td>
            <td style="display:flex; gap:10px">
              <a href="updateCD.php?macd=<?= $item['MaCongDan']; ?>">View</a>
              <button type="button" id="delete">Delete</button>
            </td>
          </tr>
      <?php
        }
      }

      ?>
    </tbody>
  </table>

  <script>
    $(document).ready(function() {
      $("tbody").on("click", "#delete", function() {
        const row = $(this).closest('tr');
        const macd = row.data('macd');

        $.ajax({
          url: "code.php",
          type: "POST",
          data: {
            _method: "DELETE",
            macd: macd
          },
          success: function(data, status) {
            row.remove();
            alert("Xóa thành công");
          },
        })
      });

    });
  </script>
</body>

</html>