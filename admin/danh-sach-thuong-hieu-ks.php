<?php
  include('security.php');
  include('includes/header.php'); 
  include('includes/navbar.php');
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Thương Hiệu
            <a href="them-thuong-hieu-ks.php">
              <button type="button" class="btn btn-primary">Thêm Thương Hiệu</button>
            </a>
    </h6>
  </div>

  <div class="card-body">
  <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] !='')
            {
                echo    '<div class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">
                        '.$_SESSION['success'].'
                        </span>
                        </div>';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
            {
                echo '<div class="btn btn-warning btn-icon-split">
                     <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                     </span>
                     <span class="text">
                        '.$_SESSION['status'].'
                     </span>
                     </div>';
                unset($_SESSION['status']);
            }
        ?>

    <div class="table-responsive">
      <?php
        $query = "SELECT * FROM thuonghieuks, loaikhachsan where thuonghieuks.MaLoaiKS = loaikhachsan.MaLoaiKS";
        $query_run = mysqli_query($connection, $query);
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã Thương Hiệu</th>
            <th>Mã Loại Khách Sạn</th>
            <th>Tên Thương Hiệu</th>
            <th>Mô Tả</th>
            <th>Hình Ảnh</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>

          <?php
            if(mysqli_num_rows($query_run) > 0) 
            {
              while($row = mysqli_fetch_assoc($query_run))
              {
          ?>
                <tr>
                  <td> <?php echo $row['MaThuongHieuKS']; ?>  </td>
                  <td><?php
                  echo $row['TenLoaiKS']; 
                  ?></td>
                  <td> <?php echo $row['TenThuongHieuKS']; ?>  </td>
                  <td><?php echo $row['MoTa']; ?></td>
                  <td> <img src="img/thuong-hieu-ks/<?php echo $row['HinhAnh']; ?>" style="width:150px;height:100px"> </td>
                  <td>
                    <form action="sua-thuong-hieu-ks.php" method="post">
                      <input type="hidden" name="sua_mathuonghieu" value="<?php echo $row['MaThuongHieuKS']; ?>">
                      <button type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-pen-square"></i></button> 
                    </form>
                  </td>
                  <td>
                    <form action="code.php" method="post">
                      <input type="hidden" name="xoa_thuonghieu" value="<?php echo $row['MaThuongHieuKS']; ?>">
                      <button type="submit" name="btn_xoa_thuonghieu_ks" class="btn btn-danger"><i class="fas fa-ban"></i></button> 
                    </form>
                  </td>
                </tr>
          <?php
              }
            }
            else {
              echo "no record found";
            }
          ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

