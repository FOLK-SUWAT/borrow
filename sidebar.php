<head>
  <meta charset="utf-8">
  
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/menu.css">
  <link rel="stylesheet" type="text/css" href="css/page.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
 
</head>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <?php if (isset($_SESSION['mem_type_id']) || @$_SESSION["mem_type_id"] != $_SESSION["mem_type_id"]) { ?>
      <div class="menu_page">
        <a  href="index.php">หน้าหลัก</a>
      </div>
      <ul class="nav navbar-nav  ">
        <li class="menu_page"><a href="index.php">รายการอุปกรณ์ที่ยืม</a></li>
        <li class="menu_page"><a href="borrow.php">ยืมอุปกรณ์</a></li>
        </ul>
      <?php } ?>

      


      <?php if (isset($_SESSION['mem_type_id']) && ($_SESSION["mem_type_id"] == "MANAGER") or ($_SESSION["mem_type_id"] == "ADMIN")) { ?>
        <li class="menu_page"><a href="bill.php">ตรวจสอบการยืม</a></li>

        <li class="dropdown menu_page">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">จัดการข้อมูลอุปกรณ์
            <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="category_type.php">เพิ่มประเภท</a></li>
            <li><a href="category.php">เพิ่มหมวดหมู่</a></li>
            <li><a href="manager.php">รายการอุปกรณ์</a></li>
          </ul>
        </li>

      <?php } ?>
      <?php if (isset($_SESSION['mem_type_id']) && $_SESSION["mem_type_id"] == "ADMIN") { ?>


        <li class="dropdown menu_page">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">จัดการข้อมูลผู้ใช้
            <span class="caret"></span></a>
            
          <ul class="dropdown-menu">
            <li><a href="admin.php">ข้อมูลสมาชิก</a></li>
            <li><a href="department.php">แผนก&Line</a></li>
            <li><a href="Report.php">Report</a></li>
          </ul>
        </li>                          
      <?php } ?>

      </ul>
  </div>
</nav>