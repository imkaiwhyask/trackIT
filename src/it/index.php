<?php
  session_start();
  date_default_timezone_set('Asia/Singapore');
  if(!isset($_SESSION['uidrps']))
  {
     header('Location:../index.php');
  }

  include('../config/config.php');
  $query=mysqli_query($con,"SELECT * FROM tbl_user where id='".$_SESSION['uidrps']."'");
    $row=mysqli_fetch_assoc($query);
    $byUser=$row['name'];
    $uid=$row['id'];
    $igg=$row['login'];
    $flag=$row['icon'];
    $country=$row['country'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="../assets/images/icon.png"/>
  <title>trackIT</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

 
    <!--autocompute-->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    <!--end-->

    <!--calendar-->
    <link rel="stylesheet" type="text/css" href="../js/calendar/dhtmlxcalendar.css"/>
    <script src="../js/calendar/dhtmlxcalendar.js"></script>
    <script>
		var myCalendar;
		function doOnLoad() {
			myCalendar = new dhtmlXCalendarObject(["calendar", "calendar2", "calendar3", "calendar4"]);
		}
	</script>
    <!--end calendar-->

    <!--checkbox-->
    <script type="text/javascript" src="../js/checkbox.js"></script>
    <!--checkbox-->

    <!--chart canvasjs-->
    <script type="text/javascript" src="../js/canvas/jquery.min.js"></script>
    <script type="text/javascript" src="../js/canvas/Chart.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    #chart-container {
    width: 100%;
    height: auto;
}
    </style>
    <!--end-->

    <!--disable enter key-->
    <script>
    $(document).ready(function() {
        $(window).keydown(function(event){
          if(event.keyCode == 13) {
            event.preventDefault();
            return false;
          }
        });
      });
    </script>
</head>

<body id="page-top" onload="doOnLoad();">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-gray sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          trackIT
        </div>
        <div class="sidebar-brand-text mx-3"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
       <!-- Nav Item - Dashboard -->
       <li class="nav-item <?php if(isset($_GET['inv'])) { echo "active"; }?>">
        <a class="nav-link" href="?inv=laptop">
          <i class="fas fa-user"></i>
          <span>Inventory</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

       <!-- Nav Item - Dashboard -->
       <li class="nav-item <?php if(isset($_GET['reports'])) { echo "active"; }?>">
        <a class="nav-link" href="?reports=laptop">
          <i class="fas fa-file-download"></i>
          <span>Reports</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

       <!-- Nav Item - Dashboard -->
       <!--<li class="nav-item <?php if(isset($_GET['reports'])) { echo "active"; }?>">
        <a class="nav-link" href="?reports">
          <i class="fas fa-user"></i>
          <span>User Management</span></a>
      </li>-->

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item <?php if(isset($_GET['assetLoan'])) { echo "active"; }?>">
        <!--<a class="nav-link" href="#" data-toggle="modal" data-target="#assetLoanModal">-->
        <a class="nav-link" href="?assetLoan">
          <i class="fas fa-truck-loading"></i>
          <span>Asset Loan Form</span>
        </a>
          
          <!-- Modal -->
          <div class="modal fade" id="assetLoanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title " id="exampleModalLabel">
                    <img src='../assets/images/trackit-logo.png' style='width:30%' class='mr-2'>
                    <span class=''>Asset Loan</span>
                  </h5>
                  
                  </button>
                </div>
                <div class="modal-body align-center">
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col modal-content-title'><b>Applicant Details</b></div>
                        </div>
                        <div class='row p-2' style='background:#f5f5f5'>
                            <div class='col' style='font-size:12px'>
                                <b>IGG Number</b> : <br><input type='text' name='igg' required>
                            </div>
                            <div class='col'style='font-size:12px'>
                                <b>Full Name</b> : <br><input type='text' name='fullName' required>
                            </div>
                        </div>
                        <div class='row p-2'>
                            <div class='col'style='font-size:12px'>
                                <b>Email</b> : <br><br><input type='text' name='email' required>
                            </div>
                            <div class='col'style='font-size:12px'>
                                <b>Contact No</b> : <br><input type='text' name='contactNo' required>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col modal-content-title'><b>Asset Details</b></div>
                        </div>
                        <div class='row p-2' style='background:#f5f5f5'>
                            <div class='col' style='font-size:12px'>
                                <b>Asset</b> :<br>
                                <select name='asset' required>
                                  <option></option>
                                  <option>PROJECTOR</option>
                                  <option>MONITOR</option>
                                  <option>LAPTOP</option>
                                  <option>MOBILE TV</option>
                                  <option>SPEAKER W/ MIC</option>
                                  <option>DESKTOP</option>
                                  <option>KEYBOARD/MOUSE</option>
                                  <option>OTHERS</option>
                                </select>
                            </div>
                            <div class='col'style='font-size:12px'>
                                <b>Quantity</b> : <br><input type='text' name='quantity' required>
                            </div>
                        </div>
                        <div class='row p-2'>
                            <div class='col'style='font-size:12px'>
                                <b>From</b> : <br><input type='text' id='calendar1' autocomplete='off' name='dateFrom' required>
                            </div>
                            <div class='col' style='font-size:12px'>
                                <b>To</b> : <br><input type='text' id='calendar2' autocomplete='off' name='dateTo' required>
                            </div>
                        </div>
                        <div class='row p-2' style='background:#f5f5f5'>
                            <div class='col' style='font-size:12px'>
                                <b>Business Justification</b> :
                                  <textarea style='width:100%;height:50px'>
                                  </textarea>
                                  <span style='font-size:10px;' class='text-danger'><i>** For multiple requests, choose OTHERS then type-in the assets requested in Business Justification</i></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" data-dismiss="modal">Submit</button>
                </div>
              </div>
            </div>
          </div>
      </li>

       <!-- Divider -->
       <hr class="sidebar-divider my-0">
        <li class="nav-item <?php if(isset($_GET['separation'])) { echo "active"; }?>">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#separationModal">
          <i class="fas fa-users-slash"></i>
          <span>Separation Form</span></a>

          <!-- Modal -->
          <div class="modal fade" id="separationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-center" id="exampleModalLabel">
                    <img src='../assets/images/trackit-logo.png' style='width:100%'>
                  </h5>
                  
                  </button>
                </div>
                <form action='../forms/separationForm.php' method='POST' target='_blank'>
                  <div class="modal-body align-center">
                      <div class='container-fluid'>
                          <div class='row'>
                              <div class='col text-center'><b>Is this Goodbye?</b></div>
                          </div>
                          <div class='row p-2'>
                            <div class='col text-center'>
                              <input type='text' name='igg' required>
                            </div>
                          </div>
                          <div class='row p-2'>
                              <div class='col text-center'>
                                <button type="submit" class="btn btn-danger">Generate Form</button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      </li>

  

        <!-- Divider -->
     <!-- <hr class="sidebar-divider ">-->

      <!-- Heading -->
      <!--<div class="sidebar-heading mt-2">
        ARCHIVED
      </div>-->

        <!-- Nav Item - archive -->
     <!--   <li class="nav-item <?php if(isset($_GET['archive'])){ echo "active"; }?>">
          <a class="nav-link" href="?archive">
            <i class="fas fa-archive"></i>
            <span>Archived</span></a>
        </li>
                                -->

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!--<img src='../assets/images/total2.png' style='width:150px'>-->

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row['name']?></span>
                <img src='../assets/flag/<?php echo $flag?>' style='width:30px'>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        	
        <!-- Begin Page Content -->
        <?php
        if(isset($_GET['inv']))
        {
              include('main_assets.php');
            
        }
        elseif(isset($_GET['reports']))
        {
            include('reports.php');
        }
        elseif(isset($_GET['assetLoan']))
        {
          include('asset_loan.php');
        }
        elseif(isset($_GET['archive']))
        {
          include('archive.php');
        }
        else
        {
        ?>
            <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
            </div>
            <div class='row'>
              <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Asset Summary</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                  <div class="table-responsive">
                    <table class="table " style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Asset</th>
                          <th>In Use</th>
                          <th>In Stock</th>
                          <th>TOTAL</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                             $query=mysqli_query($con,"SELECT * from tbl_accessories where country='".$country."' group by asset order by asset");
                              while($row=mysqli_fetch_assoc($query))
                              {
                                echo "<tr>
                                        <td>".$row['asset']."</td>";
                                        
                                        if($row['type']=='main')
                                        {
                                            //In Use
                                            if($row['asset']=='Monitor')
                                            {
                                              $query_use=mysqli_query($con,"SELECT count(*) as inuse FROM tbl_assetmainlogs where (monitor1='YES' or monitor2='YES') and status='active' and country='".$country."'");
                                            }
                                            elseif($row['asset']=='Laptop' || $row['asset']=='Desktop')
                                            {
                                             
                                              $query_use=mysqli_query($con,"SELECT count(*) as inuse FROM tbl_assetmain where type='".$row['asset']."' and assetStatus='In Use' and country='".$country."'");
                                            }
                                            else
                                            {
                                             
                                              $query_use=mysqli_query($con,"SELECT count(*) as inuse FROM tbl_assetmainlogs where ".$row['colname']."='YES' and status='active' and country='".$country."'");
                                          
                                            }
                                             
                                                $row_use=mysqli_fetch_assoc($query_use);
                                                echo "<td>".$row_use['inuse']."</td>";
                                             
                                              

                                            //In Stock
                                            if($row['asset']=='Laptop' || $row['asset']=='Desktop')
                                            {
                                              $query_stock=mysqli_query($con,"SELECT count(*) as stock FROM tbl_assetmain where type='".$row['asset']."' and assetStatus='In Stock' and country='".$country."'");
                                              $row_stock=mysqli_fetch_assoc($query_stock);
                                              echo "<td>".$row_stock['stock']."</td>";
                                            }
                                            else
                                            {
                                              $instock=intval($row['qty'])-intval($row_use['inuse']);  
                                              echo "<td>".$instock."</td>";
                                            }
                                              
                                             
                                          }
                                          
                                       
                                          //TOTAL
                                          if($row['asset']=='Laptop' || $row['asset']=='Desktop')
                                            {
                                                $total=$row_stock['stock']+$row_use['inuse'];
                                                echo "<td>".$total."</td>";
                                            }
                                            else
                                            {
                                              echo "<td>".$row['qty']."</td>";
                                            }
                              }
                          ?>
                      </tbody>
                    </table>
                  </div>
                    
                  </div>
                </div>
              </div>
              
              <!--Loan Asset-->
              <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Request of Loan Assets</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                  <div class="table-responsive">
                    <table class="table " style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>IGG</th>
                          <th>Assets</th>
                          <th>Quantity</th>
                          <th>From</th>
                          <th>To</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                             $query=mysqli_query($con,"SELECT * FROM tbl_assetLoan where status='PENDING' and country='".$country."'");
                              while($row=mysqli_fetch_assoc($query))
                              {
                                echo "<tr>
                                  <td><a href='?assetLoan&edit&id=".$row['id']."'>".$row['id']."</a></td>
                                  <td>".$row['name']."</td>
                                  <td>".$row['igg']."</td>
                                  <td>".$row['asset']."</td>
                                  <td>".$row['qty']."</td>
                                  <td>".$row['startDate']."</td>
                                  <td>".$row['endDate']."</td>
                                </tr>";
                              }
                          ?>
                      </tbody>
                    </table>
                  </div>
                    
                  </div>
                </div>
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Active Loan Assets</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                  <div class="table-responsive">
                    <table class="table " style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>IGG</th>
                          <th>Assets</th>
                          <th>Quantity</th>
                          <th>From</th>
                          <th>To</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                             $query=mysqli_query($con,"SELECT * FROM tbl_assetLoan where loanStatus='Open' and status='APPROVED' and country='".$country."'");
                              while($row=mysqli_fetch_assoc($query))
                              {
                                echo "<tr>
                                  <td><a href='?assetLoan&editupdate&id=".$row['id']."'>".$row['id']."</a></td>
                                  <td>".$row['name']."</td>
                                  <td>".$row['igg']."</td>
                                  <td>".$row['asset']."</td>
                                  <td>".$row['qty']."</td>
                                  <td>".$row['startDate']."</td>
                                  <td>".$row['endDate']."</td>
                                </tr>";
                              }
                          ?>
                      </tbody>
                    </table>
                  </div>
                    
                  </div>
                </div>
                <!--
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent User Updates</h6>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive">
                    <table class="table " style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Application Name</th>
                          <th>Role</th>
                          <th>Start of Access</th>
                          <th>End of Access</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                           // $week = date("Y-m-d", strtotime("-7 days"));
                          
                             $query=mysqli_query($con,"SELECT * FROM tbl_application where end_access!='' and status='active' and country='".$country."'");
                              while($row=mysqli_fetch_assoc($query))
                              {
                                echo "<tr>
                                  <td><a href='?inv=Applications&edit&id=".$row['id']."'>".$row['id']."</a></td>
                                  <td>".$row['name']."</td>
                                  <td>".$row['applicationName']."</td>
                                  <td>".$row['role']."</td>
                                  <td>".$row['start_access']."</td>
                                  <td>".$row['end_access']."</td>
                                </tr>";
                              }
                          ?>
                      </tbody>
                    </table>
                  </div>
                    
                  </div>
                </div>
                            -->
            </div>
        <?php
        }
        ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>  Copyright &copy; 
  <a href="https://github.com/imkaiwhyask" target="_blank">Kai Angelo</a> 
  </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../backend/_logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

        <!--select all checkbox-->
        <script type="text/javascript">
        $('.checked_all').on('change', function() {     
                $('.checkbox').prop('checked', $(this).prop("checked"));              
        });
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
        $('.checkbox').change(function(){ //".checkbox" change 
            if($('.checkbox:checked').length == $('.checkbox').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
    </script>

    
   
</body>

</html>
