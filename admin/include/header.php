<?php
    include ("../lib/session.php");
?>
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description">
    <meta content="Coderthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- logo icon -->
    <link rel="shortcut icon" href="assets\images\favicon.ico">
    <!--  -->
    <!-- Plugins css-->
    <link href="assets\libs\sweetalert2\sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- App css -->
    <link href="assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
    <link href="assets\css\icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<div id="wrapper">
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <!-- hộp thư  -->
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-email-outline noti-icon"></i>
                    <span class="badge badge-purple rounded-circle noti-icon-badge">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <div class="dropdown-item noti-title">
                        <h5 class="font-16 m-0">
                            <span class="float-right">
                                <a href="" class="text-dark">
                                    <small>Xóa tất cả</small>
                                </a>
                            </span>Chat
                        </h5>
                    </div>
                    <div class="slimscroll noti-scroll">
                    </div>
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        Xem tất cả
                        <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>
            <!--  -->
            <!-- thông báo  -->
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-pink rounded-circle noti-icon-badge">1</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <div class="dropdown-item noti-title">
                        <h5 class="font-16 m-0">
                            <span class="float-right">
                                <a href="" class="text-dark">
                                    <small>Xóa tất cả</small>
                                </a>
                            </span>Thông báo
                        </h5>
                    </div>
                    <div class="slimscroll noti-scroll">
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <i class="mdi mdi-comment-account-outline text-info"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar đã truy cập vào ......
                                <small class="noti-time">1 phút trước</small>
                            </p>
                        </a>
                    </div>
                    <a href="javascript:void(0);" class="dropdown-item text-center notify-item notify-all">
                        Xem tất cả thông báo
                    </a>
                </div>
            </li>
            <!--  -->
            <!-- thông tin admin  -->
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="assets/images/logo-user/logo-user.jpg" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a href="hoSoAdmin.php" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-outline"></i>
                        <span>Hồ sơ</span>
                    </a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-settings-outline"></i>
                        <span>Cài đặt</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <!-- item-->
                </div>
            </li>
            <!--  -->
        </ul>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
            <!-- <li class="d-none d-lg-block">
                <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </li> -->
        </ul>
    </div>
    <div class="left-side-menu">
        <div class="slimscroll-menu">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navigation</li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="ion-md-pie"></i>
                            <span> TRANG CHỦ </span>
                            <span class="badge badge-info badge-pill float-right"> 2 </span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="thongKeNgay.php">Thống kê theo ngày</a></li>
                            <li><a href="thongKeNam.php">Thống kê theo năm</a></li>
                            <li><a href="thongKeSoLuong.php">Thống kê số lượng</a></li>
                        </ul>
                    </li>
                    <li >
                        <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion-ios-apps"></i>
                            <span> DANH MỤC - SP </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themDanhMuc.php">Thêm danh mục</a></li>
                            <li><a href="danhSachDanhMuc.php">Danh sách danh mục</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-couch" style="font-size: 15px;"></i>
                            <span> SẢN PHẨM </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themSanPham.php">Thêm sản phẩm</a></li>
                            <li><a href="danhSachSanPham.php">Danh sách sản phẩm</a></li>
                            <li><a href="themHinhAnhSanPham.php">Thêm hình ảnh</a></li>
                            <li><a href="danhSachHinhAnh.php">Danh sách hình ảnh</a></li>
                        </ul>
                    </li>
                    <li >
                        <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion-ios-apps"></i>
                            <span> DANH MỤC - COMBO </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themDanhMucCombo.php">Thêm danh mục</a></li>
                            <li><a href="danhSachDanhMucCombo.php">Danh sách danh mục</a></li>
                        </ul>
                    </li>
                    <li >
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="fas fad fa-ellipsis-h"></i>
                            <span> COMBO </span>
                            <span class="badge badge-danger badge-pill float-right"> 2 </span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themCombo.php">Thêm combo</a></li>
                            <li><a href="danhSachCombo.php">Danh sách combo</a></li>
                            <li><a href="themHinhAnhCombo.php">Thêm hình ảnh</a></li>
                            <li><a href="danhSachHinhAnhCombo.php">Danh sách hình ảnh</a></li>
                        </ul>
                    </li>
                    <li >
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="ion-md-speedometer"></i>
                            <span> XUẤT XỨ </span>
                            <span class="badge badge-danger badge-pill float-right"> 8 </span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themXuatXu.php">Thêm xuất xứ</a></li>
                            <li><a href="danhSachXuatXu.php">Danh sách xuất xứ</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="ion-ios-list"></i>
                            <span> BỘ SƯU TẬP </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themBoSuuTap.php">Thêm bộ sưu tập</a></li>
                            <li><a href="danhSachBoSuuTap.php">Danh sách bộ sưu tập</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="ion-md-pie"></i>
                            <span> PHÒNG </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themPhong.php">Thêm phòng</a></li>
                            <li><a href="danhSachPhong.php">Danh sách phòng</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-map-marker-alt"></i>
                            <span> ĐỊA CHỈ </span>
                            <span class="badge badge-warning badge-pill float-right">12</span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="themTinh.php">Thêm tỉnh</a></li>
                            <li><a href="danhSachTinh.php">Danh sách tỉnh</a></li>
                            <li><a href="themHuyen.php">Thêm huyện</a></li>
                            <li><a href="danhSachHuyen.php">Danh sách huyện</a></li>
                            <li><a href="themXa.php">Thêm xã</a></li>
                            <li><a href="danhSachXa.php">Danh sách xã</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="ion-md-map"></i>
                            <span> GIỎ HÀNG </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="sanPham-gioHang.php">Sản phẩm - giỏ hàng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="fas fa-cart-arrow-down"></i>
                            <span> ĐƠN HÀNG </span>
                            <span class="badge badge-danger badge-pill float-right">New</span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="donHangMoi.php">Đơn hàng mới</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-users"></i>
                            <span> KHÁCH HÀNG </span>
                            <span class="badge badge-danger badge-pill float-right">New</span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="danhSachNguoiDung.php">Thông tin khách hàng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-comment"></i>
                            <span> BÌNH LUẬN </span>
                            <span class="badge badge-danger badge-pill float-right">New</span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="noiDungBinhLuan.php">Nội dung bình luận</a></li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="mdi mdi-share-variant"></i>
                            <span> Multi Level </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level nav" aria-expanded="false">
                            <li>
                                <a href="javascript: void(0);">Level 1.1</a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false">Level 1.2
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-third-level nav" aria-expanded="false">
                                    <li>
                                        <a href="javascript: void(0);">Level 2.1</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);">Level 2.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
            <!-- End Sidebar -->
            <div class="clearfix"></div>
        </div>

    </div>
</div>