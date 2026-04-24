<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">LAPTOP/DESKTOP ASSET INVENTORY</h1>

<?php
 if(isset($_GET['success']))
 {
     echo "<div class='msg-success p-1 m-3 text-center'>Data has been successfully saved!</div>";
 }
 if(isset($_GET['existing']))
 {
     echo "<div class='msg-error p-1 m-3 text-center'>Duplicate Asset! Data not saved.</div>";
 }
?>

<?php
if(isset($_GET['new']))
{
   
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class='row'>
                <div class='col'>
                    <h6 class="m-0 font-weight-bold text-danger">Search Asset</h6>
                </div>
                <div class='col text-right'>
                    <a href='?inv=<?php echo $_GET['inv']?>'><button type="button" class="btn btn-dark">Back</button></a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <div class='row'>
                <div class='col-6'>
                    <form action='?' method='GET'>
                        <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                        <input type='hidden' name='new'>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">*Serial Number</span>
                            </div>
                            <input type="text" name='txtSearch' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                            <input type='submit' class='btn btn-danger ml-3' value='Search'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_GET['txtSearch']))
    {
        $search=mysqli_query($con,"SELECT * FROM tbl_assetmain where serial='".$_GET['txtSearch']."' and country='".$country."' and department!='Solar'");
            $row_search=mysqli_fetch_assoc($search);
        if(($numrow=mysqli_num_rows($search))<>0)
        {
            if($row_search['activeDirectory']=='AD Removed') 
            {
                echo "<div class='msg-error p-1 m-3 text-center'>Asset status is <b>AD Removed</b><div>";
            }
            if($row_search['assetCondition']=='Disposed' || $row_search['assetCondition']=='Defective') 
            {
                echo "<div class='msg-error p-1 m-3 text-center'>Asset Condition is <b>Disposed/Defective</b><div>";
            }
            else 
            {
            
                if($row_search['assetStatus']=='In Stock')
                {
                ?>
                    <form action='../backend/_save_new_inventory.php' method='POST' enctype="multipart/form-data">
                        <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                        <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                        <input type='hidden' name='serial' value='<?php echo $_GET['txtSearch']?>'>
                        <input type='hidden' name='country' value='<?php echo $country?>'>

                        <!-- Asset -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class='row'>
                                        <h6 class="m-0 font-weight-bold text-danger">Asset and Employee Details</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                                    <tr><td colspan='6' class='modal-content-title'>ASSET DETAILS</td></tr>        
                                    <tr>
                                        <td style='text-align:right'><b>Type :</b></td>
                                        <td> <?php echo $row_search['type']?></td>
                                        <td style='text-align:right'><b>Model :</b></td>
                                        <td> <?php echo $row_search['model']?></td>
                                        <td style='text-align:right'><b>Condition :</b></td>
                                        <td> <?php echo $row_search['assetCondition']?></td>
                                    </tr> 
                                    <tr>
                                        <td style='text-align:right'><b>MAC Address :</b></td>
                                        <td> <?php echo $row_search['macAddress']?></td>
                                        <td style='text-align:right'><b>Serial :</b></td>
                                        <td> <?php echo $row_search['serial']?></td>
                                        <td style='text-align:right'><b>Asset Tag :</b></td>
                                        <td> <?php echo $row_search['assetTag']?></td>
                                    </tr>
                                
                                    <tr><td colspan='6' class='modal-content-title'>ASSIGNED TO NEW EMPLOYEES</td></tr>
                                    <tr>
                                        <td style='text-align:right'><b>*Employee Name</b></td>
                                        <td>: <input type='text' class='input-text' name='employeeName' required></td>
                                        <td style='text-align:right'><b>*IGG</b></td>
                                        <td>: <input type='text' class='input-text' name='igg' required></td>
                                        <td style='text-align:right'><b>*Department</b></td>
                                        <td>: <input type='text' name='department' class='input-text' required></td>
                                    </tr>
                                    <tr>
                                        <td style='text-align:right'><b>*Location</b></td>
                                        <td>: <select class="custom-select" class='input-text' style='width:90%;' name='location' required>
                                                <option selected>Choose...</option>
                                                    <?php
                                                    $location_query=mysqli_query($con,"SELECT province from tbl_location where country='".$country."' group by province order by province");
                                                        while($row=mysqli_fetch_assoc($location_query))
                                                        {
                                                            echo " 
                                                            <option value='".$row['province']."'>".$row['province']."</option>";
                                                        }   
                                                
                                                    ?>
                                            </select>
                                        </td>
                                        <td style='text-align:right'><b>*Start Date</b></td>
                                        <td>: <input type='text' class='input-text' name='startDate' placeholder='yyyy-mm-dd' id='calendar' autocomplete='off' required></td>
                                    </tr>

                                    <tr>
                                        <td colspan='6'><b>Accessories Details :</b></td>
                                </tr>
                                <tr>
                                        <td colspan='6'>
                                            <?php
                                                $query_accessories=mysqli_query($con,"SELECT * FROM tbl_accessories where type='main' and country='".$country."' group by asset order by asset");
                                                while($row_accessories=mysqli_fetch_assoc($query_accessories))
                                                {
                                                        if($row_accessories['asset']=='Monitor')
                                                        {
                                                        
                                                            $x='1';
                                                            while($x<=2)
                                                            {
                                                                echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."".$x."' class='ml-4'> ".$row_accessories['asset']." ".$x."";
                                                                $x++;
                                                            }
                                                        
                                                        }
                                                        else {
                                                            echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."' class='ml-4'> ".$row_accessories['asset']."";
                                                        }
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                
                                <tr>
                                        <td style='text-align:right'><b>*Permanent Form</b></td>
                                        <td>:  <input type="file" name="permanentForm" id="fileSelect" required>
                                                <a href='../forms/assignmentForm.php?serial=<?php echo $row_search['serial']?>&type=<?php echo $row_search['type']?>' target='_blank'><div  style='margin-left:10px;font-size:15px' class='btn btn-primary'>Generate Form</div></a>
                                        </td>
                                        <td style='text-align:right'><b>Remarks</b></td>
                                        <td colspan='4'>:   <textarea class="input-text" name='remarks'></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan='6' align='center'><input type='submit' name='submit' class='btn btn-danger' value='Submit'></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                        <!-- Asset HISTORY -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class='row'>
                                        <h6 class="m-0 font-weight-bold text-danger">Asset History</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Employee Name</th>
                                            <th>IGG</th>
                                            <th>Permanent Forms</th>
                                            <th>Return Forms</th>
                                            <th>Remarks</th>
                                            <th>LastChanged</th>
                                            <th>By User</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $history_query=mysqli_query($con,"SELECT * FROM tbl_assetmainlogs where serial='".$_GET['txtSearch']."' and status='inactive' and country='".$country."' and department!='Solar' order by id DESC");
                                                while($row_history=mysqli_fetch_assoc($history_query))
                                                {
                                                    echo "<tr>
                                                            <td>".$row_history['startDate']."</td>
                                                            <td>".$row_history['endDate']."</td> 
                                                            <td>".$row_history['assignedTo']."</td>  
                                                            <td>".$row_history['igg']."</td>   
                                                            <td><a href='../pdf/".$row_history['permanentForms']."'>".$row_history['permanentForms']."</a></td>   
                                                            <td><a href='../pdf/".$row_history['returnForms']."'>".$row_history['returnForms']."</a></td> 
                                                            <td>".$row_history['remarks']."</td> 
                                                            <td>".$row_history['lastChanged']."</td>  
                                                            <td>".$row_history['byUser']."</td>   
                                                            <td></td>  
                                                        </tr>";
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                    </div>
                            </div>
                        </div>
                <?php
                }
                else
                {
                    echo "<div class='msg-error p-1 m-3 text-center'>Asset is <b>".$row_search['assetStatus']."</b><div>";
                }
            }
            ?>

            
        <?php
        }
        else
        {
            echo "<div class='msg-error p-1 m-3 text-center'>Serial Number is not existing</div>";
        }
    }
}
elseif(isset($_GET['edit']))
{
   
    
    $query=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* FROM tbl_assetmain,tbl_assetmainlogs where  tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmainlogs.id='".$_GET['id']."' and tbl_assetmainlogs.country='".$country."' and tbl_assetmainlogs.department!='Solar'");
        $row=mysqli_fetch_assoc($query);
        if(($numrow=mysqli_num_rows($query))<>0)
        {
        ?>
                <form action='../backend/_update_new_inventory.php' method='POST' enctype="multipart/form-data">
                    <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                    <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                    <input type='hidden' name='serial' value='<?php echo $row['serial']?>'>
                    <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
                    <input type='hidden' name='country' value='<?php echo $country?>'>
                    <!-- Asset -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class='row'>
                                <div class='col'>
                                    <h6 class="m-0 font-weight-bold text-danger">Asset</h6>
                                </div>
                                <div class='col text-right'>
                                    <a href='?inv=<?php echo $_GET['inv']?>'><button type="button" class="btn btn-dark">Back</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-center" style='overflow-y:hidden;'>
                                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                                    <tr>
                                        <td style='text-align:right'><b>*Type : </b></td>
                                        <td><?php echo $row['type']?>  </td>
                                        <td style='text-align:right'><b>*Model : </b></td>
                                        <td><?php echo $row['model']?></td>
                                        <td style='text-align:right'><b>*Condition : </b></td>
                                        <td><?php echo $row['assetCondition']?> </td>
                                    </tr>
                                    <tr>
                                        <td style='text-align:right'><b>MAC Address :</b></td>
                                        <td> <?php echo $row['macAddress']?></td>
                                        <td style='text-align:right'><b>Serial :</b></td>
                                        <td> <?php echo $row['serial']?></td>
                                        <td style='text-align:right'><b>Asset Tag :</b></td>
                                        <td>  <?php echo $row['assetTag']?></td>
                                    </tr>                    
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class='row'>
                                    <h6 class="m-0 font-weight-bold text-danger">Assigned to New Employee</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                                <tr>
                                     <td colspan='6' class='modal-content-title'>EMPLOYEE DETAILS</td>               
                                <tr>
                                    <td style='text-align:right;width:12%'><b>Employee Name :</b></td>
                                    <td style='width:24%'> <input type='text' class='input-text' name='employeeName' value='<?php echo $row['assignedTo']?>'></td>
                                    <td style='text-align:right;width:12%'><b>IGG :</b></td>
                                    <td style='width:20%'> <input type='text' class='input-text' name='igg' value='<?php echo $row['igg']?>'></td>
                                    <td style='text-align:right;width:12%'><b>Department :</b></td>
                                    <td style='width:20%'> <input type='text' class='input-text' name='department' value='<?php echo $row['department']?>'></td>
                                </tr>   

                                <tr>
                                    <td style='text-align:right'><b>*Location :</b></td>
                                    <td> 
                                        <select name='location' class='input-text' required>
                                            <option><?php echo $row['location']?></option>
                                            <option></option>
                                                <?php
                                                $location_query=mysqli_query($con,"SELECT province from tbl_location where country='".$country."' group by province order by province");
                                                    while($row_location=mysqli_fetch_assoc($location_query))
                                                    {
                                                        echo " 
                                                        <option value='".$row_location['province']."'>".$row_location['province']."</option>";
                                                    }   
                                            
                                                ?>
                                        </select>
                                    </td>
                                    <td style='text-align:right'><b>*Start Date :</b></td>
                                    <td> <input type="text" class='input-text' name='startDate' value=' <?php if($row['startDate']=='0000-00-00') { echo "";} else {echo $row['startDate'];}?>' placeholder='yyyy-mm-dd' id='calendar' autocomplete='off' required></td>
                                   
                                    <td style='text-align:right'><b>End Date :</b></td>
                                    <td><input type="text" class='input-text' name='endDate' value=' <?php if($row['endDate']=='0000-00-00') {echo '';}else {echo $row['endDate'];}?>' placeholder='yyyy-mm-dd' id='calendar3' autocomplete='off'></td>
                                </tr>   
                                <tr>
                                     <td colspan='6' class='modal-content-title'>ACCESSORIES DETAILS</td> 
                                </tr>              
                                <tr>
                                    <td colspan='6'>
                                        <div class='row'>
                                        <?php
                                            
                                            $query_accessories=mysqli_query($con,"SELECT * FROM tbl_accessories where type='main' and country='".$country."' group by asset order by asset");
                                            while($row_accessories=mysqli_fetch_assoc($query_accessories))
                                            {
                                                
                                                
                                            if($row_accessories['asset']=='Monitor')
                                            {
                                                $x='1';
                                                while($x<=2)
                                                {
                                                    $check_status=mysqli_query($con,"SELECT * from tbl_assetmainlogs where ".$row_accessories['colname']."".$x."='YES' and id='".$_GET['id']."' and country='".$country."'");
                                                        if(($numrows=mysqli_num_rows($check_status))<>0)
                                                        {
                                                            //echo "<div class='col'><b>".$row_accessories['asset']." ".$x."</b>: YES</div>";
                                                            echo "<input type='checkbox' checked name='asset[]' value='".$row_accessories['colname']."".$x."' class='ml-5' checked>&nbsp;&nbsp;".$row_accessories['asset']." ".$x."";
                                                        }
                                                        else {
                                                            //echo "<div class='col'><b>".$row_accessories['asset']." ".$x."</b>: NO</div>";
                                                            echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."".$x."' class='ml-5'>&nbsp;&nbsp;".$row_accessories['asset']." ".$x."";
                                                        
                                                        }
                                                    
                                                    $x++;
                                                }
                                                
                                            }
                                            elseif($row_accessories['asset']!='Desktop' && $row_accessories['asset']!='Laptop') {
                                                $check_status=mysqli_query($con,"SELECT * from tbl_assetmainlogs where ".$row_accessories['colname']."='YES' and id='".$_GET['id']."' and country='".$country."'");
                                                        if(($numrows=mysqli_num_rows($check_status))<>0)
                                                        {
                                                            //echo "<div class='col'><b>".$row_accessories['asset']."</b>: YES</div>";
                                                            echo "<input type='checkbox' checked name='asset[]' value='".$row_accessories['colname']."' class='ml-5' checked>&nbsp;&nbsp;".$row_accessories['asset']."";
                                                            
                                                        }
                                                        else {
                                                            //echo "<div class='col'><b>".$row_accessories['asset']."</b>: NO</div>";
                                                            echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."' class='ml-5'>&nbsp;&nbsp;".$row_accessories['asset']."";
                                                        }
                                                }
                                                    
                                            }
                                        ?>
                                        </div>
                                    </td>
                                </tr>   
                                <tr>
                                     <td colspan='6' class='modal-content-title'>OTHER DETAILS</td>               
                                <tr>  
                                <tr>
                                    <td style='text-align:right'><b>Permanent Form :</b></td>
                                    <td colspan='2'>    <?php
                                        if($row['permanentForms']!='')
                                        {
                                        ?>
                                            <a href='../pdf/<?php echo $row['permanentForms']?>' target='_blank'><?php echo $row['permanentForms']?></a></label>
                                        <?php
                                        }
                                        else {
                                            echo "Not Available ";
                                            ?>
                                            <input type="file"  class='input-text' name="permanentForm" id="fileSelect">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td style='text-align:right'><b>*Return Form :</b></td>
                                    <td  colspan='2'>    <?php
                                        if($row['returnForms']!='')
                                        {
                                        ?>
                                            <a href='../pdf/<?php echo $row['returnForms']?>' target='_blank'><?php echo $row['returnForms']?></a></label>
                                        <?php
                                        }
                                        else {
                                            ?>
                                         
                                            <input type="file"  class='input-text' name="returnForm" id="fileSelect" required>
                                        <?php    
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Remarks</b></td>
                                    <td colspan='5'>:  <textarea style='width:90%;height:50px' name='assetRemarks'><?php echo $row['remarks']?></textarea> </td>
                                </tr>
                                <tr>
                                    <td colspan='6' style='color:#ff2427'><i><b>*Note:</b> Return Form should be uploaded to update the status of the asset to In Stock</i></td>
                                </tr>             
                            </table>

                            <div class='row'>
                                <div class='col text-center'>
                                        
                                        <input type='submit' name='submit' class='btn btn-danger' value='Update'>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <!-- Asset HISTORY -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class='row'>
                                    <h6 class="m-0 font-weight-bold text-danger">Asset History</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Employee Name</th>
                                        <th>IGG</th>
                                        <th>Permanent Forms</th>
                                        <th>Return Forms</th>
                                        <th>Remarks</th>
                                        <th>LastChanged</th>
                                        <th>By User</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $history_query=mysqli_query($con,"SELECT * FROM tbl_assetmainlogs where serial='".$row['serial']."' and status='inactive' and country='".$country."' and department!='Solar' order by id DESC");
                                               while($row_history=mysqli_fetch_assoc($history_query))
                                               {
                                                   echo "<tr>
                                                        <td>".$row_history['startDate']."</td>
                                                        <td>".$row_history['endDate']."</td> 
                                                        <td>".$row_history['assignedTo']."</td>  
                                                        <td>".$row_history['igg']."</td>   
                                                        <td><a href='../pdf/".$row_history['permanentForms']."' target='_blank'>".$row_history['permanentForms']."</a></td>   
                                                        <td><a href='../pdf/".$row_history['returnForms']."' target='_blank'>".$row_history['returnForms']."</a></td> 
                                                        <td>".$row_history['remarks']."</td> 
                                                        <td>".$row_history['lastChanged']."</td>  
                                                        <td>".$row_history['byUser']."</td>   
                                                        <td></td>  
                                                    </tr>";
                                               } 
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                        </div>
                    </div>
            <?php
           
        }
}
elseif(isset($_GET['add']))
{
    ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class='row'>
                <div class='col'>
                    <h6 class="m-0 font-weight-bold text-danger">Add New Asset</h6>
                </div>
                <div class='col text-right'>
                    <?php
                    if(isset($_GET['add']))
                    {
                    ?>
                         <a href='?inv=<?php echo $_GET['inv']?>'><button type="button" class="btn btn-dark">Back</button></a>
                    <?php
                    }
                    else {
                        ?>
                            <a href='?inv=<?php echo $_GET['inv']?>&add'><button type="button" class="btn btn-secondary">Add Asset</button></a>
                    <?php    
                    }
                    ?>
                   
                    <a href='?inv=<?php echo $_GET['inv']?>&new'><button type="button" class="btn btn-danger">Assign New</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action='../backend/_add_assetmain.php' method='POST'>
                <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                <input type='hidden' name='country' value='<?php echo $country?>'>

                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                    <tr>
                        <td style='text-align:right'><b>*Type : </b></td>
                        <td> <select name='type' required>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT main from tbl_type order by main");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['main']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                        <td style='text-align:right'><b>*Model : </b></td>
                        <td><input type='text' name='model' required></td>
                        <td style='text-align:right'><b>*Serial : </b></td>
                        <td><input type='text' name='serial' required>
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right'><b>*Computer Name : </b></td>
                        <td> <input type='text' name='computerName' required></td>
                        <td style='text-align:right'><b>OS :</b></td>
                        <td> 
                                <select name='os'>
                                    <option></option>
                                    <?php
                                        $query_os=mysqli_query($con,"SELECT * FROM tbl_os");
                                            while($row_os=mysqli_fetch_assoc($query_os))
                                            {
                                                echo "<option>".$row_os['os']."</option>";
                                            }
                                    ?>
                                </select>
                        </td>
                        <td style='text-align:right'><b>OS Version :</b></td>
                        <td> <input type='text' name='osVersion'></td>
                    </tr> 
                    <tr>
                        <td style='text-align:right'><b>MAC Address :</b></td>
                        <td> <input type='text' name='macAddress' ></td>
                        <td style='text-align:right'><b>Supplier :</b></td>
                        <td> <input type='text' name='supplier'></td>
                        <td style='text-align:right'><b>Disposal Date :</b></td>
                        <td> <input type='text' id='calendar4' name='disposalDate' autocomplete='off'></td>
                    </tr> 
                    <tr>
                        <td style='text-align:right'><b>*Asset Status :</b></td>
                        <td><select name='assetStatus' required>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT status from tbl_assetstatus WHERE status!='In Use' order by status");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['status']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                        <td style='text-align:right'><b>Asset Tag :</b></td>
                        <td> <input type='text' name='assetTag'></td>
                        <td style='text-align:right'><b>*Asset Condition :</b></td>
                        <td> <select name='assetCondition' required>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT type from tbl_condition order by type");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['type']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right'><b>Delivery Date : </b></td>
                        <td> <input type='text' name='deliveryDate' id='calendar' autocomplete='off'></td>
                        <td style='text-align:right'><b>Warranty :</b></td>
                        <td> <input type='text' name='warranty'></td>
                        <td style='text-align:right'><b>*Brand :</b></td>
                        <td> <input type='text' name='brand' required></td>
                    </tr>      
                    <tr>
                        <td style='text-align:right'><b>*Active Directory :</b></td>
                        <td>
                            <select name='activeDirectory' required>
                               
                                <option></option>
                                <?php
                                    $ad_query=mysqli_query($con,"SELECT status from tbl_adstatus order by status");
                                        while($row_ad=mysqli_fetch_assoc($ad_query))
                                        {
                                            echo "<option>".$row_ad['status']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                        <td style='text-align:right'><b>*Recovery Key :</b></td>
                        <td><input type='text' name='recoveryKey' required style='width:100%'></td>
                        <td style='text-align:right'><b>Asset Remarks : </b></td>
                        <td colspan='3'> <textarea style='width:100%;height:50px' name='assetRemarks'></textarea></td>
                    </tr> 
                    <tr>
                        <td style='text-align:center' colspan='6'><input type='submit' class='btn btn-danger' name='submit' value='Submit'></td>
                    </tr>                  
                </table>
            </form>
        </div>
    </div>
    <?php
}
elseif(isset($_GET['editasset']))
{
?>
    <!-- DataTales Example -->
    <div class= "card shadow mb-4">
        <div class="card-header py-3">
            <div class='row'>
                <div class='col'>
                    <h6 class="m-0 font-weight-bold text-danger">Edit Asset</h6>
                </div>
                <div class='col text-right'>
                    <a href='?inv=<?php echo $_GET['inv']?>'><button type="button" class="btn btn-dark">Back</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action='../backend/_update_assetmain.php' method='POST'>
                <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
                <input type='hidden' name='country' value='<?php echo $country?>'>

                <?php
                $query=mysqli_query($con,"SELECT * FROM tbl_assetmain where id='".$_GET['id']."'");
                $row=mysqli_fetch_assoc($query);
                ?>

                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                    <tr>
                        <td style='text-align:right'><b>*Type : </b></td>
                        <td> <select name='type' required>
                                <option><?php echo $row['type']?></option>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT main from tbl_type order by main");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['main']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                        <td style='text-align:right'><b>*Model : </b></td>
                        <td><input type='text' name='model' value='<?php echo $row['model']?>' required></td>
                        <td style='text-align:right'><b>*Serial : </b></td>
                        <td><input type='text' name='serial' value='<?php echo $row['serial']?>'  required>
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right'><b>*Computer Name : </b></td>
                        <td> <input type='text' name='computerName' value='<?php echo $row['computerName']?>' required></td>
                        <td style='text-align:right'><b>*OS :</b></td>
                        <td> 
                                <select name='os' required>
                                    <option><?php echo $row['os']?></option>
                                    <?php
                                        $query_os=mysqli_query($con,"SELECT * FROM tbl_os");
                                            while($row_os=mysqli_fetch_assoc($query_os))
                                            {
                                                echo "<option>".$row_os['os']."</option>";
                                            }
                                    ?>
                                </select>
                        </td>
                        <td style='text-align:right'><b>*OS Version :</b></td>
                        <td> <input type='text' name='osVersion' value='<?php echo $row['osVersion']?>' required></td>
                    </tr>  
                    <tr>
                        <td style='text-align:right'><b>MAC Address :</b></td>
                        <td> <input type='text' name='macAddress' value='<?php echo $row['macAddress']?>' ></td>
                        <td style='text-align:right'><b>*Supplier :</b></td>
                        <td> <input type='text' name='supplier' value='<?php echo $row['supplier']?>' required></td>
                        <td style='text-align:right'><b>Disposal Date :</b></td>
                        <td> <input type='text' id='calendar4' name='disposalDate' value="<?php if($row['disposalDate']=='0000-00-00 00:00:00') {echo '';} else{echo $row['disposalDate'];}?>" autocomplete='off'></td>
                    </tr>
                    <tr>
                        <td style='text-align:right'><b>*Asset Status :</b></td>
                        <td><?php
                                if($row['assetStatus']=='In Use')
                                {
                                    echo "<input type='hidden' name='assetStatus' value='".$row['assetStatus']."'>";
                                    echo $row['assetStatus'];
                                }
                                else {
                                    ?>
                                    <select name='assetStatus' required>
                                        <option><?php echo $row['assetStatus']?></option>
                                        <option></option>
                                        <?php
                                            $status_query=mysqli_query($con,"SELECT status from tbl_assetstatus order by status");
                                                while($row_status=mysqli_fetch_assoc($status_query))
                                                {
                                                    echo "<option>".$row_status['status']."</option>";
                                                }
                                        ?>
                                    </select>
                                    
                                <?php
                                }
                            ?>
                        </td>
                        <td style='text-align:right'><b>Asset Tag :</b></td>
                        <td> <input type='text' name='assetTag' value='<?php echo $row['assetTag']?>'></td>
                        <td style='text-align:right'><b>*Asset Condition :</b></td>
                        <td> 
                            <select name='assetCondition' required>
                                <option><?php echo $row['assetCondition']?></option>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT type from tbl_condition order by type");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['type']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style='text-align:right'><b>Delivery Date : </b></td>
                        <td> <input type='text' name='deliveryDate' value="<?php if($row['deliveryDate']=='0000-00-00') {echo '';} else{echo $row['deliveryDate'];}?>" id='calendar' autocomplete='off'></td>
                        <td style='text-align:right'><b>Warranty :</b></td>
                        <td> <input type='text' name='warranty' value='<?php echo $row['warranty']?>'></td>
                        <td style='text-align:right'><b>*Brand :</b></td>
                        <td> <input type='text' name='brand' value='<?php echo $row['brand']?>' required></td>
                    </tr>      
                    <tr>
                        <td style='text-align:right'><b>*Active Directory :</b></td>
                        <td> 
                            <?php
                            if($row['assetStatus']=='In Use')
                            {
                                echo "<input type='hidden' name='activeDirectory' value='".$row['activeDirectory']."'>";
                                echo $row['activeDirectory'];
                            }
                            else
                            {
                            ?>
                                 <select name='activeDirectory' required>
                                    <option><?php echo $row['activeDirectory']?></option>
                                    <option></option>
                                    <?php
                                        $ad_query=mysqli_query($con,"SELECT status from tbl_adstatus order by status");
                                            while($row_ad=mysqli_fetch_assoc($ad_query))
                                            {
                                                echo "<option>".$row_ad['status']."</option>";
                                            }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </td>
                        <td style='text-align:right'><b>*Recovery Key :</b></td>
                        <td><input type='text' name='recoveryKey' value='<?php echo $row['recoveryKey']?>' required style='width:100%'></td>
                    
                        <td style='text-align:right'><b>Asset Remarks : </b></td>
                        <td colspan='5'> <textarea style='width:100%;height:50px' name='assetRemarks'><?php echo $row['assetRemarks']?></textarea></td>
                    </tr> 
                    <tr>
                        <td style='text-align:center' colspan='6'><input type='submit' class='btn btn-danger' name='submit' value='Submit'></td>
                    </tr>                  
                </table>
            </form>
        </div>
    </div>
    <?php
}
else
{
?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class='row'>
                <div class='col'>
                    <h6 class="m-0 font-weight-bold text-danger">Asset Database</h6>
                </div>
                <div class='col text-right'>
                    <a href='?inv=<?php echo $_GET['inv']?>&add'><button type="button" class="btn btn-secondary">Add Asset</button></a>
                    <a href='?inv=<?php echo $_GET['inv']?>&new'><button type="button" class="btn btn-danger">Assign New</button></a>
                </div>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" style='font-size:13px;text-align:center' width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Model</th>
                <th>Computer Name</th>
                <th>Serial No.</th>
                <th>Assigned To</th>
                <th>IGG</th>
                <th>Status</th>
                <th style='width:100px'>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    //$query=mysqli_query($con,"SELECT * from tbl_assetmain where country='".$country."' and (assetCondition!='RETIRED' or assetCondition!='DEFECTIVE')");
                    $query=mysqli_query($con,"SELECT tbl_assetmain.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmainlogs.serial=tbl_assetmain.serial and (tbl_assetmain.assetCondition!='Disposed' OR tbl_assetmain.assetCondition!='Defective') and tbl_assetmain.country='".$country."' and tbl_assetmain.department!='Solar' group by serial");
                        while($row=mysqli_fetch_assoc($query))
                        {
                        ?>
                            <tr>
                                <td><a href='?inv=<?php echo $_GET['inv']?>&editasset&id=<?php echo $row['id']?>'><?php echo $row['id']?></a></td>
                                <td><?php echo $row['type']?></td>
                                <td><?php echo $row['model']?></td>
                                <td><?php echo $row['computerName']?></td>
                                <td><?php echo $row['serial']?></td>
                                <?php
                                if($row['assetStatus']=='In Use')
                                {
                                    $query2=mysqli_query($con,"SELECT tbl_assetmainlogs.id as 'logID' ,tbl_assetmainlogs.* from tbl_assetmainlogs where serial='".$row['serial']."' and country='".$country."' and status='active' order by id DESC LIMIT 1");
                                        $row2=mysqli_fetch_assoc($query2);
                                        if($numrow=mysqli_num_rows($query2)<>0)
                                        {
                                            echo  "<td>".$row2['assignedTo']."</td>
                                            <td>".$row2['igg']."</td>";
                                        }
                                        else
                                        {
                                            echo "<td></td>
                                            <td></td>";
                                        }
                                }
                                elseif($row['assetStatus']!='In Use') {
                                    echo "<td></td>
                                    <td></td>";
                                }
                                ?>
                               
                                <td><?php echo $row['assetStatus']?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    
                                    <?php
                                    if($row['assetStatus']=='In Use')
                                    {
                                    ?>
                                        <button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal<?php echo $row2['logID']?>"><i class="fas fa-eye fa-xs"></i></button>
                                        <a href='?inv=<?php echo $_GET['inv']?>&edit&id=<?php echo $row2['logID']?>'><button class='btn btn-success'><i class="fas fa-edit fa-xs"></i></button></a>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal<?php echo $row['id']?>"><i class="fas fa-eye fa-xs"></i></button>
                                    <?php
                                    }
                                    ?>
                                    
                                    <!-- Modal -->
                                    <?php
                                    if($row['assetStatus']=='In Use')
                                    {
                                    ?>
                                        <div class="modal  fade text-left" id="exampleModal<?php echo $row2['logID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                         <div class="modal  fade text-left" id="exampleModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php
                                    }
                                    ?>
                                   
                                        <div class="modal-dialog modal-xl  modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Desktop and Laptop Asset Information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class='container-fluid'>
                                                        <?php
                                                        if($row['assetStatus']=='In Use')
                                                        {
                                                            $fetch=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmainlogs.id='".$row2['logID']."' and tbl_assetmainlogs.country='".$country."' and tbl_assetmainlogs.status='active'");
                                                        }
                                                        else
                                                        {
                                                             $fetch=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmain.id='".$row['id']."' and tbl_assetmain.country='".$country."' ");
                                                       
                                                        }

                                                       
                                                            $row_fetch=mysqli_fetch_assoc($fetch);
                                                        ?>
                                                        <div class='row'>
                                                            <div class='col modal-content-title'><b>General Information</b></div>
                                                        </div>
                                                        <div class='row p-2' style='background:#f5f5f5'>
                                                            <div class='col'>
                                                                <b>ID</b> : <?php echo $row_fetch['id']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Status</b> : <?php echo $row_fetch['assetStatus']?>
                                                            </div>
                                                        </div>

                                                        <div class='row'>
                                                            <div class='col modal-content-title'><b>Asset Information</b></div>
                                                        </div>
                                                        <div class='row p-2' style='background:#f5f5f5'>
                                                            <div class='col'>
                                                                <b>Unit Type</b> : <?php echo $row_fetch['type']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Computer Name</b> : <?php echo $row_fetch['computerName']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Model</b> : <?php echo $row_fetch['model']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            <div class='col'>
                                                                <b>MAC Address</b> : <?php echo $row_fetch['macAddress']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Asset Tag</b> : <?php echo $row_fetch['assetTag']?>
                                                            </div>
                                                            
                                                            <div class='col'>
                                                                <b>Serial No.</b> : <?php echo $row_fetch['serial']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2' style='background:#f5f5f5'>
                                                            <div class='col'>
                                                                <b>Delivery Date</b> : <?php echo $row_fetch['deliveryDate']?>
                                                            </div>
                                                            
                                                            <div class='col'>
                                                                <b>Supplier</b> : <?php echo $row_fetch['supplier']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Warranty</b> : <?php echo $row_fetch['warranty']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            <div class='col'>
                                                                <b>Brand</b> : <?php echo $row_fetch['brand']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>OS</b> : <?php echo $row_fetch['os']?>
                                                            </div>
                                                            
                                                            <div class='col'>
                                                                <b>OS Version</b> : <?php echo $row_fetch['osVersion']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2' style='background:#f5f5f5'>
                                                            <div class='col'>
                                                                <b>Active Directory</b> : <?php echo $row_fetch['activeDirectory']?>
                                                            </div>
                                                            
                                                            <div class='col'>
                                                                <b>Disposal Date</b> : <?php echo $row_fetch['disposalDate']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Condition</b> : <?php echo $row_fetch['assetCondition']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            
                                                            <div class='col'>
                                                                <b>Recovery Key</b> : <?php echo $row_fetch['recoveryKey']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            
                                                            <div class='col'>
                                                                <b>Remarks</b> : <?php echo $row_fetch['assetRemarks']?>
                                                            </div>
                                                        </div>
                                                       


                                                        <?php
                                                        if($row_fetch['assetStatus']=='In Use')
                                                        {
                                                        ?>
                                                            <div class='row'>
                                                                <div class='col modal-content-title'><b>User Information</b></div>
                                                            </div>
                                                            <div class='row p-2' style='background:#f5f5f5'>
                                                                <div class='col'>
                                                                    <b>IGG</b> : <?php echo $row_fetch['igg']?>
                                                                </div>
                                                                <div class='col'>
                                                                    <b>Name</b> : <?php echo $row_fetch['assignedTo']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>Department</b> : <?php echo $row_fetch['department']?>
                                                                </div>
                                                                <div class='col'>
                                                                    <b>Location</b> : <?php echo $row_fetch['location']?>
                                                                </div>
                                                            </div>

                                                            <div class='row'>
                                                                <div class='col modal-content-title'><b>Accessories Details</b></div>
                                                            </div>
                                                            <div class='row p-2' style='background:#f5f5f5'>
                                                                <div class='col'>
                                                                    <b>Keyboard</b> : <?php echo $row_fetch['keyboard']?>
                                                                </div>
                                                                <div class='col'>
                                                                    <b>Mouse</b> : <?php echo $row_fetch['mouse']?>
                                                                </div>
                                                                <div class='col'>
                                                                    <b>Charger</b> : <?php echo $row_fetch['charger']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>Bag</b> : <?php echo $row_fetch['bag']?>
                                                                </div>
                                                                <div class='col'>
                                                                    <b>Docking Station</b> : <?php echo $row_fetch['dockingStation']?>
                                                                </div>
                                                                <div class='col'>
                                                                    <b>UPS</b> : <?php echo $row_fetch['ups']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2' style='background:#f5f5f5'>
                                                                <div class='col'>
                                                                    <b>Monito 1</b> : <?php echo $row_fetch['monitor1']?>
                                                                </div>
                                                                <div class='col'>
                                                                    <b>Monitor2</b> : <?php echo $row_fetch['monitor2']?>
                                                                </div>
                                                                <div class='col'>
                                                                
                                                                </div>
                                                            </div>

                                                            <div class='row'>
                                                                <div class='col modal-content-title'><b>Documents</b></div>
                                                            </div>
                                                            <div class='row p-2' style='background:#f5f5f5'>
                                                                <div class='col'>
                                                                    <b>Asset Form (PDF Only)</b> : 
                                                                    <?php
                                                                        if($row_fetch['permanentForms']!='')
                                                                        {
                                                                        ?>
                                                                            <a href='../pdf/<?php echo $row_fetch['permanentForms']?>' target='_blank'>View Attached Document</a>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            echo "Not Available";
                                                                        }
                                                                        ?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                        <div class='row'>
                                                            <div class='col modal-content-title'><b>Asset History</b></div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            <div class='col'>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" id="dataTable" style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>Start Date</th>
                                                                            <th>End Date</th>
                                                                            <th>Employee Name</th>
                                                                            <th>IGG</th>
                                                                            <th>Permanent Forms</th>
                                                                            <th>Return Forms</th>
                                                                            <th>Remarks</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                $history_query=mysqli_query($con,"SELECT * FROM tbl_assetmainlogs where serial='". $row_fetch['serial']."' and status='inactive' and country='".$country."' order by id DESC");
                                                                                if(($numrow=mysqli_num_rows($history_query))<>0)
                                                                                {
                                                                                    while($row_history=mysqli_fetch_assoc($history_query))
                                                                                    {
                                                                                        echo "<tr>
                                                                                                <td>".$row_history['startDate']."</td>
                                                                                                <td>".$row_history['endDate']."</td> 
                                                                                                <td>".$row_history['assignedTo']."</td>  
                                                                                                <td>".$row_history['igg']."</td>   
                                                                                                <td><a href='../pdf/".$row_history['permanentForms']."' target='_blank'>".$row_history['permanentForms']."</a></td>   
                                                                                                <td><a href='../pdf/".$row_history['returnForms']."' target='_blank'>".$row_history['returnForms']."</a></td> 
                                                                                                <td>".$row_history['remarks']."</td> 
                                                                                            </tr>";
                                                                                    } 
                                                                                }
                                                                                else {
                                                                                    echo "<tr>
                                                                                            <td colspan='7' class='text-center'>No history found!</td>
                                                                                            </tr>";
                                                                                }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <?php
                                                    if($row_fetch['assetStatus']=='In Use')
                                                    {
                                                    ?>
                                                        <a href='../forms/returnDesktop.php?id=<?php echo $row_fetch['id']?>' target='_blank'><input type=button class="btn btn-primary" value="Print Asset Return Form"></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
    <?php
}
?>
</div>
<!-- /.container-fluid -->