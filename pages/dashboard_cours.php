<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Argon Dashboard 3 by Educonnect
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <style>
.button_ajouter_cours
{
    position:absolute;
    top:05%;
    left:80%;
background-color: #02248a;
text-align:center;
font-size:18x;
border:none;
cursor:pointer;
padding: 16px 30px;
color:white;
border-radius:8px;
}
table
{
    border-collapse:collapse;
    width: 100%; 
}
th, td
{
    text-align:left;
    padding:10px;
}
tr:nth-child(odd)
{
    background-color: #f2f2f246;
}
tr:nth-child(1)
{
    background-color: #5d2cc0;
    color:white;
}
tr:nth-child(even+2)
{
    background-color: #f2f2f2;
}
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
          <a href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
            <img src="../assets/img/logo-ct-dark.png" style="height: 200px ; width: 100px;"   alt="main_logo">
            <span class="ms-1 font-weight-bold">Educonnect</span>
          </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="../pages/dashboard.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../pages/tables.php">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Réclamation</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../pages/dashboard_cours.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Cours</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../pages/virtual-reality.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-app text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Virtual Reality</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../pages/rtl.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">RTL</span>
              </a>
            </li>
            <li class="nav-item mt-3">
              <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../pages/profile.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../pages/sign-in.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Sign In</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="../pages/sign-up.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-collection text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Sign Up</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
          <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
              <div class="docs-info">
                <h6 class="mb-0">Need help?</h6>
                <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
              </div>
            </div>
          </div>
          <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
          <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
        </div>
      </aside>

      <main class="main-content position-relative border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-white active" aria-current="page">Cours Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Cours Dashboard</h6>
              </nav>
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                  </div>
                </a>
              </li>
              </div>
            </nav>
            <div class="row mt-5">
                <div class="col-lg-10 mb-lg-10 mb-10">
                  <div class="card z-index-3 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                      <h5 class="text-capitalize">Cours</h5>
                    </div>
                    <button class="button_ajouter_cours">Ajouter Cours</button>
                    <div class="card-body p-3">
                      <?php
                      $sql = "SELECT id, idCreator, Creation_date, category FROM Cours";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>
                    </div>
                  </div>
                </div>   
                </div>
      </main>

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
</body>
</html>