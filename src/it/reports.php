<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">REPORTS</h1>
<form action='../reports/export_report.php' method='POST'>
    <input type='hidden' name='country' value='<?php echo $country?>'>

    <?php
    if($_GET['reports']=="laptop")
    {
    ?>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-danger">Desktop / Laptops / Monitors</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive text-center" style='overflow-y:hidden;'>
                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                      <tr>
                            <td colspan='6' class='modal-content-title'>GENERAL INFORMATION</td>               
                      </tr>    
                      <tr>
                            <td style='text-align:right;width:150px'><b>Status : </b></td>
                            <td> 
                                <select name="status"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT status FROM tbl_assetstatus order by status");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['status']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>

                            
                        </tr>
                        <tr>
                            <td colspan='6' class='modal-content-title'>ASSET INFORMATION</td>               
                        </tr> 
                        <tr>
                            <td style='text-align:right'><b>Type : </b></td>
                            <td>
                                <select name="type"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                    <?php 
                                      // Fetch Department
                                      $sql_department = "SELECT main FROM tbl_type order by main";
                                      $department_data = mysqli_query($con,$sql_department);
                                      while($row = mysqli_fetch_assoc($department_data))
                                      {
                                          echo "<option value='".$row['main']."' >".$row['main']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                      
                            <td style='text-align:right'><b>Model : </b></td>
                            <td>
                                <select name="model" class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT model FROM tbl_assetmain group by model");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['model']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' style='text-align:center'><button type="submit" name='btnExport' value='mainAssets' class="btn btn-primary">Export</button></td>
                        </tr>
                    </table>
            </div>
          </div>
      </div>
    <?php
    }
    elseif($_GET['reports']=='mobile')
    {
    ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Mobile Devices</h6>
          </div>
          <div class="card-body">
              <div class="table-responsive text-center" style='overflow-y:hidden;'>
                  <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                      <tr>
                            <td colspan='6' class='modal-content-title'>GENERAL INFORMATION</td>               
                      </tr>    
                      <tr>
                            <td style='text-align:right;width:150px'><b>Status : </b></td>
                            <td> 
                                <select name="statusMobile" class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                    <?php
                                      $query=mysqli_query($con,"SELECT status FROM `tbl_assetstatus` order by status");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['status']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' class='modal-content-title'>ASSET INFORMATION</td>               
                        </tr> 
                        <tr>
                            <td style='text-align:right'><b>Brand : </b></td>
                            <td>
                              <select name="brandMobile" class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                    <?php
                                      $query=mysqli_query($con,"SELECT brand FROM `tbl_assetmobile` group by brand");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['brand']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                      
                            <td style='text-align:right'><b>Model : </b></td>
                            <td>
                              <select name="modelMobile" class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                    <?php
                                      $query=mysqli_query($con,"SELECT model FROM `tbl_assetmobile` group by model");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['model']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' style='text-align:center'><button type="submit" name='btnExport' value='mobileDevices' class="btn btn-primary">Export</button></td>
                        </tr>
                    </table>
              </div>
          </div>
        </div>
    <?php
    }
    elseif($_GET['reports']=='otherAsset')
    {
    ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Other Assets</h6>
          </div>
          <div class="card-body">
              <div class="table-responsive text-center" style='overflow-y:hidden;'>
                  <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                      <tr>
                            <td colspan='6' class='modal-content-title'>GENERAL INFORMATION</td>               
                      </tr>    
                      <tr>
                            <td style='text-align:right;width:150px'><b>*Category : </b></td>
                            <td> 
                              <select name="category" class='input-text' id="inputGroupSelect01" required>
                                <option></option>
                                  <?php
                                    $query=mysqli_query($con,"SELECT category FROM `tbl_category` order by category");
                                    while($row=mysqli_fetch_assoc($query))
                                    {
                                        echo "<option>".$row['category']."</option>";
                                    }
                                    ?>
                              </select>
                            </td>

                            <td style='text-align:right;width:150px'><b>Status : </b></td>
                            <td> 
                                <select name="statusOtherAsset" class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                    <?php
                                      $query=mysqli_query($con,"SELECT status FROM `tbl_assetstatus` order by status");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['status']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>

                           
                        </tr>
                       
                        <tr>
                            <td colspan='6' style='text-align:center'><button type="submit" name='btnExport' value='OtherAssets' class="btn btn-primary">Export</button></td>
                        </tr>
                    </table>
              </div>
          </div>
        </div>
    <?php
    }
    elseif($_GET['reports']=='Applications')
    {
    ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Applications</h6>
          </div>
          <div class="card-body">
              <div class="table-responsive text-center" style='overflow-y:hidden;'>
                  <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                      <tr>
                            <td colspan='6' class='modal-content-title'>GENERAL INFORMATION</td>               
                      </tr>    
                      <tr>
                          <td style='text-align:right;width:150px'><b>Application Name : </b></td>
                          <td> 
                            <select name="applicationName" class='input-text' id="inputGroupSelect01" required>
                              <option></option>
                                <?php
                                  $query=mysqli_query($con,"SELECT application FROM `tbl_applicationlist` order by application");
                                  while($row=mysqli_fetch_assoc($query))
                                  {
                                      echo "<option>".$row['application']."</option>";
                                  }
                                  ?>
                            </select>
                          </td>

                          <td style='text-align:right;width:150px'><b>Status : </b></td>
                          <td> 
                            <select name="statusApplication" class='input-text' id="inputGroupSelect01">
                                <option>ALL</option>
                                <option>active</option>
                                <option>inactive</option>
                              </select>
                          </td>

                        </tr>
                        <tr>
                            <td colspan='6' style='text-align:center'><button type="submit" name='btnExport' value='Applications' class="btn btn-primary">Export</button></td>
                        </tr>
                    </table>
              </div>
          </div>
        </div>
    <?php
    }
    elseif($_GET['reports']=="cmdb")
    {
    ?>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-danger">CMDB</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive text-center" style='overflow-y:hidden;'>
                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                      <tr>
                          <td colspan='6' class='modal-content-title'>GENERAL INFORMATION</td>               
                      </tr>    
                      <tr>
                            <td style='text-align:right;width:150px'><b>Status : </b></td>
                            <td> 
                                <select name="status"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT status FROM tbl_assetstatus order by status");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['status']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td colspan='6' class='modal-content-title'>ASSET INFORMATION</td>               
                        </tr> 
                        <tr>
                            <td style='text-align:right'><b>Type : </b></td>
                            <td>
                                <select name="type"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                    <?php 
                                      // Fetch Department
                                      $sql_department = "SELECT main FROM tbl_type order by main";
                                      $department_data = mysqli_query($con,$sql_department);
                                      while($row = mysqli_fetch_assoc($department_data))
                                      {
                                          echo "<option value='".$row['main']."' >".$row['main']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                      
                            <td style='text-align:right'><b>Model : </b></td>
                            <td>
                                <select name="model" class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT model FROM tbl_assetmain group by model");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option>".$row['model']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' style='text-align:center'><button type="submit" name='btnExport' value='cmdb' class="btn btn-primary">Export</button></td>
                        </tr>
                    </table>
            </div>
          </div>
      </div>
    <?php
    }
    elseif($_GET['reports']=="station")
    {
       include_once('../config/config_stadadb.php');
    ?>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-danger">Station Assets</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive text-center" style='overflow-y:hidden;'>
                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                      <tr>
                            <td colspan='6' class='modal-content-title'>INFORMATION</td>               
                      </tr>    
                      <tr>
                            <td style='text-align:right;width:150px'><b>Station Name : </b></td>
                            <td> 
                                <select name="accountCode"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT * FROM tbl_station group by stationName order by stationName");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option value='".$row['accountCode']."'>".$row['stationName']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>

                            <td style='text-align:right;width:150px'><b>Item : </b></td>
                            <td> 
                                <select name="item"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT * FROM tbl_inventory_it group by item order by item");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option value='".$row['item']."'>".$row['item']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>

                            <td style='text-align:right;width:150px'><b>Brand : </b></td>
                            <td> 
                                <select name="brand"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT * FROM tbl_inventory_it group by brand order by brand");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option value='".$row['brand']."'>".$row['brand']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                          </tr>
                          <tr>
                            <td style='text-align:right;width:150px'><b>Model : </b></td>
                            <td> 
                                <select name="model"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT * FROM tbl_inventory_it group by model order by model");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option value='".$row['model']."'>".$row['model']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>

                            <td style='text-align:right;width:150px'><b>OS : </b></td>
                            <td> 
                                <select name="os"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT * FROM tbl_inventory_it group by os order by os");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option value='".$row['os']."'>".$row['os']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>

                            <td style='text-align:right;width:150px'><b>POS : </b></td>
                            <td> 
                                <select name="pos"  class='input-text' id="inputGroupSelect01">
                                  <option>ALL</option>
                                      <?php
                                      $query=mysqli_query($con,"SELECT * FROM tbl_inventory_it group by pos order by pos");
                                      while($row=mysqli_fetch_assoc($query))
                                      {
                                          echo "<option value='".$row['pos']."'>".$row['pos']."</option>";
                                      }
                                      ?>
                                </select>
                            </td>
                        </tr>
                      
                        <tr>
                            <td colspan='6' style='text-align:center'><button type="submit" name='btnExport' value='stationAssets' class="btn btn-primary">Export</button></td>
                        </tr>
                    </table>
            </div>
          </div>
      </div>
    <?php
    }
    ?>
</form>
</div>
<!-- /.container-fluid -->