<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh Sách Hóa Đơn Tour Tự Lên
      </h6>
      <div class="m-0">
        <form action="table-excel/xuat-bill-tour-tu-len.php" method="post">
          <input type="hidden" name="xuat_bill" value="<?php echo $row['MaHD']; ?>">
          <button type="submit" name="btn_xuat_bill_tu_len" class="btn btn-danger">Xuất Hóa Đơn</i></button>
        </form>
      </div>
    </div>

    <div class="card-body">
      <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
        echo    '<div class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">
                        ' . $_SESSION['success'] . '
                        </span>
                        </div>';
        unset($_SESSION['success']);
      }

      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo '<div class="btn btn-warning btn-icon-split">
                     <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                     </span>
                     <span class="text">
                        ' . $_SESSION['status'] . '
                     </span>
                     </div>';
        unset($_SESSION['status']);
      }
      ?>

      <div class="table-responsive">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "travello_db");
        $query = "SELECT * FROM hoadontourtutao";
        $query_run = mysqli_query($conn, $query);
        $query1 = "SELECT * FROM hoadontourtutao hdtt, thanhtoan tt, khachhang kh, tourdulich tour
         where hdtt.MaTT = tt.MaTT 
        and hdtt.MaKH=kh.MaKH and tour.MaTour=hdtt.MaTour";
        $result1 = mysqli_query($connection, $query1);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã Hóa Đơn</th>
              <th>Tên Khách Hàng</th>
              <th>Thanh Toán</th>
              <th>Tên Tour</th>
              <th>Mã HĐ Khách Sạn</th>
              <th>Mã HĐ Nhà Hàng</th>
              <th>Mã HĐ Phương Tiện</th>
              <th>Số Người Lớn</th>
              <th>Số Trẻ Em</th>
              <th>Ngày Đặt</th>
              <th>Tổng Tiền</th>
            </tr>
            <tr>
            </tr>
          </thead>
          <tbody>

            <?php
            if (mysqli_num_rows($query_run) > 0 && mysqli_num_rows($result1) > 0) {
              while (($row = mysqli_fetch_assoc($query_run)) && $rows1 = mysqli_fetch_assoc($result1)) {
            ?>
                <tr>
                  <td><?php echo $row['MaHD']; ?></td>
                  <td><?php
                      echo $rows1['TenKH'];
                      ?></td>
                  <td><?php
                      echo $rows1['TenThanhToan'];
                      ?></td>
                  <td><?php
                      echo $rows1['TenTour'];
                      ?></td>
                  <td> <?php echo $row['MaHDKS']; ?> </td>
                  <td> <?php echo $row['MaHoaDonNH']; ?> </td>
                  <td> <?php echo $row['MaHoaDonPT']; ?> </td>
                  <td> <?php echo $row['SoNguoiLon']; ?> </td>
                  <td> <?php echo $row['SoTreEm']; ?> </td>
                  <td> <?php echo $row['NgayDat']; ?> </td>
                  <td> <?php echo $row['TongTien']; ?> </td>
                </tr>
                <tr>

                </tr>
            <?php
              }
            } else {
              echo "không có bản ghi nào";
            }
            ?>

          </tbody>
        </table>

      </div>
    </div>
  </div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>