<?php include 'include/header.php';
if (isset($_GET['loai-tour'])) {
    $maloaitour = $_GET['loai-tour'];
    require_once 'database/db_config.php';
    $query = "SELECT * from tourdulich where MaLoaiTour='$maloaitour' ORDER BY NgayTao DESC";
    $result = mysqli_query($connection, $query);

    $query_lt = "SELECT * FROM loaitourdulich where MaLoaiTour = '$maloaitour'";
    $result_lt = mysqli_query($connection, $query_lt);
    $rows_lt = @mysqli_fetch_assoc($result_lt);
    $tenloaitour = $rows_lt["TenLoaiTour"];
    ?>

    <title><?php echo $tenloaitour ?> | Travello</title>

    <style>
        .filter-title {
            border: 1px solid rgba(0, 0, 0, .125);
            margin: 0;
            color: #1A2B48;
            padding: 20px 10px;
        }

        .filter-title h5 {
            margin: 0;
            line-height: 20px;
        }

        .filter-title h5::before {
            content: '';
            position: relative;
            background: #1A2B48;
            width: 3px;
            height: 20px;
            top: -2px;
            left: -10px;
            margin-right: 10px;
            float: left;
        }

        .fil-list {
            padding: 20px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }



        .fil-left {
            padding: 0;
            float: left;
            font-size: 14px;
            font-weight: 500;
        }

        .fil-right {
            padding: 0;
            float: right;
            line-height: 17px;
            font-size: 17px;
        }


        .filter-range {
            content: '';
            width: 100%;
            height: 5px;
            background: #1A2B48;
            margin: 20px 0;
        }

        .filter-apply {
            border: none;
            background: none;
            color: #19A1E5;
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
            outline: none;
        }

        .filter-apply:hover,
        .filter-apply:active,
        .filter-apply:focus {
            border: none;
            outline: none;
        }

        .tour-container .card-body i {
            color: #FFDC00;
            margin: 0 3px;
            font-size: 15px;
        }

        .tour-container .tour-title {
            margin: 30px 0;
        }
    </style>

    <!-- NỘI DUNG -->
    <section class="container tour-container">

        <div class="row">
            <div class="col-md-3">
                <div class="accordion" id="accordionExample">
                    <div class="filter-title">
                        <h5>LỌC THEO</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Giá Tiền</h3>
                            <?php
                                $price_max = "SELECT MAX(GiaTien) AS p FROM tourdulich";
                                $q_max =  mysqli_query($connection, $price_max);
                                $r_max = mysqli_fetch_array($q_max);
                            ?>
                            <p id="price_range">0 đ - <?php echo product_price($r_max["p"]) ?> </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="fil-list" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="fil-left">Đánh Giá</div>
                            <div class="fil-right"><i class="fas fa-sort-down"></i></div>
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="5" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="4" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <i class="fas fa-star"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="fil-list" data-toggle="collapse" data-target="#DiemDen" aria-expanded="false" aria-controls="collapseTwo">
                            <div class="fil-left">Điểm Đến</div>
                            <div class="fil-right"><i class="fas fa-sort-down"></i></div>
                        </div>

                        <div id="DiemDen" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                            <?php
                                $q = "SELECT * FROM vitri";
                                $rs = mysqli_query($connection, $q);
                                while($rw = @mysqli_fetch_array($rs)) {
                                    ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="<?php echo $rw["MaViTri"]?>" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        <p><?php echo $rw["TenViTri"]?></p>
                                    </label>
                                </div>
                                    <?php
                                }
                            ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <script>
            $(document).ready(function() {
                fuction filter_data() {
                    $(".filter-data").html(<div id="loading" style=""></div>)
                    var action = 'fetch-data';
                    var min_price = $('#hidden_min_price').val();
                    var max_price = $('#hidden_max_price').val();
                }
            })
            </script>
            
            <div class="col-md-9 filter-data">
                <h5 class="tour-title"><?php echo $rows_lt['TenLoaiTour']; ?></h5>
                <div class="row">
                    <?php while ($rows = @mysqli_fetch_array($result)) {
                        $matour = $rows["MaTour"];
                        $sql_rv = "SELECT COUNT(*) AS rv FROM nhanxet WHERE MaTour = '$matour'";
                        $rs_rv = mysqli_query($connection, $sql_rv);
                        $rw_rv = mysqli_fetch_array($rs_rv);
                    ?>


                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-img-top">
                                    <img style="height: 200px;width: 100%" src="admin/img/tour-du-lich/<?php echo $rows['Anh'] ?>" alt="Card image cap">
                                    <?php
                        $succhua = $rows["SucChua"];
                        $giamgia = $rows["GiamGia"];
                        $gia = $rows["GiaTien"];
                        if ($succhua == 0) {
                            echo '<div class="feature-soldout">Đã Bán Hết</div>';
                        } else {
                            if ($giamgia > 0) {
                            $percent = 100 - ($giamgia / $gia) * 100;
                            echo '<div class="feature-sale">Giảm Giá ' . floor($percent) . '%</div>';
                            } else {}
                        }
                    ?>
                                    <div class="like"><i class="fas fa-heart"></i></div>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $vt = $rows['MaViTri'];
                                        $query_vt = "SELECT * FROM vitri WHERE MaViTri = $vt";
                                        $rs_vt = mysqli_query($connection, $query_vt);
                                        $vitri = mysqli_fetch_array($rs_vt);
                                    ?>
                                    <p class="card-location"><i class="fas fa-map-marker-alt"></i> <?php echo $vitri["TenViTri"] ?></p>
                                    <h5 class="card-title"><a href="chi-tiet-tour.php?tour=<?php echo $rows['MaTour']; ?>"><?php echo $rows['TenTour'] ?></a></h5>
                                    <p class="card-text">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i> <span class="reviews"><?php echo $rw_rv["rv"]; ?> Đánh giá</span>
                                    </p>
                                </div>
                                <div class="card-footer d-flex">
                                    <div class="card-f-left">
                                        <p><i class="far fa-clock"></i> <?php echo $rows['SoNgay'] ?> Ngày</p>
                                        <p><i class="fas fa-couch"></i> <?php echo $succhua ?> Chỗ</p>
                                    </div>
                                    <div class="ml-auto card-f-right">
                                        <?php
                                            if ($giamgia > 0) {
                                                echo '<div class="price-available"><i class="fas fa-dollar-sign"></i> <span class="price">' . product_price($rows['GiamGia']) . '</span></div>
                                                                                        <div class="price-disable"><i class="fas fa-dollar-sign"></i> <span class="price">' . product_price($rows['GiaTien']) . '</span></div>';
                                            } else {
                                                echo '<div class="price-available"><i class="fas fa-dollar-sign"></i> <span class="price">' . product_price($rows['GiaTien']) . '</span></div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>



                                        <?php
                        }
                        }

                        ?>
                </div>
            </div>
        </div>

    </section>
    <?php include 'include/footer.php';?>