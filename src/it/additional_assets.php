<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">LAPTOP/DESKTOP ASSET INVENTORY</h1>

<?php
 if(isset($_GET['success']))
 {
     echo "<div class='msg-success p-1 m-3 text-center'>Data has been successfully saved!</div>";
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
                                <span class="input-group-text" id="inputGroup-sizing-default">Serial Number</span>
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
        $search=mysqli_query($con,"SELECT * FROM tbl_assetmain where serial='".$_GET['txtSearch']."' and country='".$country."'");
            $row_search=mysqli_fetch_assoc($search);
        if(($numrow=mysqli_num_rows($search))<>0)
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
                                    <h6 class="m-0 font-weight-bold text-danger">Asset Details</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class='row mb-2'>
                                <div class='col'>
                                    <b>Type</b> : <?php echo $row_search['type']?>
                                </div>
                                <div class='col'>
                                    <b>Model</b> : <?php echo $row_search['model']?>
                                </div>
                                <div class='col'>
                                    <b>Condition</b> : <?php echo $row_search['assetCondition']?>
                                </div>
                            </div>
                            <div class='row mb-2'>
                                <div class='col'>
                                    <b>MAC Address</b> : <?php echo $row_search['macAddress']?>
                                </div>
                                <div class='col'>
                                    <b>Serial</b> : <?php echo $row_search['serial']?>
                                </div>
                                <div class='col'>
                                    <b>Asset Tag</b> : <?php echo $row_search['assetTag']?>
                                </div>
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
                            <div class='row'>
                                <div class='col'>
                                    <b>EMPLOYEE DETAILS</b>
                                </div>
                            </div>
                            <div class='row mt-2'>
                                <div class='col'>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">*Employee Name</span>
                                        </div>
                                        <input type="text" name='employeeName' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                                <div class='col'>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">IGG</span>
                                        </div>
                                        <input type="text" name='igg' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Department</span>
                                        </div>
                                        <input type="text" name='department' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                                <div class='col'>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">*Location</span>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name='location' required>
                                            <option selected>Choose...</option>
                                                <?php
                                                $location_query=mysqli_query($con_total,"SELECT location from tbl_location where  country='".$country."' group by location order by location");
                                                    while($row=mysqli_fetch_assoc($location_query))
                                                    {
                                                        echo " 
                                                        <option value='".$row['location']."'>".$row['location']."</option>";
                                                    }   
                                            
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='col'>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Start Date</span>
                                        </div>
                                        <input type="text" name='startDate' placeholder='yyyy-mm-dd' id='calendar' autocomplete='off' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                    </div>
                                </div>
                            </div>

                            <div class='row mt-3'>
                                <div class='col'>
                                    <b>ACCESSORIES DETAILS</b>
                                </div>
                            </div>
                            <div class='row mt-2'>
                                <div class='col'>
                                    <?php
                                        $query_accessories=mysqli_query($con,"SELECT * FROM tbl_accessories where type='main' and country='".$country."' group by asset order by asset");
                                        while($row_accessories=mysqli_fetch_assoc($query_accessories))
                                        {
                                                if($row_accessories['asset']=='Monitor')
                                                {
                                                  
                                                    $x='1';
                                                    while($x<=2)
                                                    {
                                                        echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."".$x."' class='ml-5'> ".$row_accessories['asset']." ".$x."";
                                                        $x++;
                                                    }
                                                   
                                                }
                                                else {
                                                    echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."' class='ml-5'> ".$row_accessories['asset']."";
                                                }
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class='row mt-3'>
                                <div class='col'>
                                    <b>OTHER DETAILS</b>
                                </div>
                            </div>
                            <div class='row mt-2 mb-2'>
                                <div class='col'>
                                    <label for="fileSelect">Permanent Form :</label>
                                    <input type="file" name="permanentForm" id="fileSelect">
                                </div>
                               
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    <div class="mb-3">
                                        <textarea class="form-control" name='remarks' placeholder="Remarks"></textarea>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col text-center'>
                                        <input type='submit' name='submit' class='btn btn-danger' value='Submit'>
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
                                            $history_query=mysqli_query($con,"SELECT * FROM tbl_assetmainlogs where serial='".$_GET['txtSearch']."' and status='inactive' and country='".$country."' order by id DESC");
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
            elseif($row_search['assetStatus']=='In Use') 
            {
                echo "<div class='msg-error p-1 m-3 text-center'>Asset is <b>In Use</b><div>";
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
   
    
    $query=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* FROM tbl_assetmain,tbl_assetmainlogs where  tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmainlogs.id='".$_GET['id']."' and tbl_assetmainlogs.country='".$country."'");
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
                            <div class='row mb-2'>
                                <div class='col'>
                                    <b>Type</b> : <?php echo $row['type']?>
                                </div>
                                <div class='col'>
                                    <b>Model</b> : <?php echo $row['model']?>
                                </div>
                                <div class='col'>
                                    <b>Condition</b> : <?php echo $row['assetCondition']?>
                                </div>
                            </div>
                            <div class='row mb-2'>
                                <div class='col'>
                                    <b>MAC Address</b> : <?php echo $row['macAddress']?>
                                </div>
                                <div class='col'>
                                    <b>Serial</b> : <?php echo $row['serial']?>
                                </div>
                                <div class='col'>
                                    <b>Asset Tag</b> : <?php echo $row['assetTag']?>
                                </div>
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
                            <div class='row'>
                                <div class='col modal-content-title'>
                                    <b>EMPLOYEE DETAILS</b>
                                </div>
                            </div>
                            <div class='row mt-2 p-2'>
                                <div class='col'>
                                    <b>Employee Name</b> :
                                    <?php echo $row['assignedTo']?>
                                </div>
                                <div class='col'>
                                    <b>IGG</b> :
                                    <?php echo $row['igg']?>
                                </div>
                                <div class='col'>
                                    <b>Department</b> :
                                    <?php echo $row['department']?>
                                </div>
                            </div>
                            <div class='row p-2'>
                                <div class='col'>
                                    <b>Location</b> :
                                    <?php echo $row['location']?>
                                </div>
                                <div class='col'>
                                    <b>Start Date</b> :
                                        <?php echo $row['startDate']?>
                                </div>
                                <div class='col'>
                                    <?php
                                    if($row['endDate']!='' && $row['endDate']!='0000-00-00')
                                    {
                                    ?>
                                        <b>End Date</b> :
                                        <?php echo $row['endDate']?>
                                    <?php
                                    }
                                    else {
                                        ?>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default">End Date</span>
                                            </div>
                                            <input type="text" name='endDate' placeholder='yyyy-mm-dd' id='calendar' autocomplete='off' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                                        </div>
                                      <?php  
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                            
                            <div class='row mt-3'>
                                <div class='col modal-content-title'>
                                    <b>ACCESSORIES DETAILS</b>
                                </div>
                            </div>
                            <div class='row mt-2'>
                                    <?php
                                        
                                        $query_accessories=mysqli_query($con,"SELECT * FROM tbl_accessories where type='main' and country='".$country."' group by asset order by asset");
                                        while($row_accessories=mysqli_fetch_assoc($query_accessories))
                                        {
                                            
                                               
                                                if($row_accessories['asset']=='Monitor')
                                                {
                                                    $x='1';
                                                    while($x<=2)
                                                    {
                                                        $check_status=mysqli_query($con,"SELECT * from tbl_assetmainlogs where ".$row_accessories['colname']."".$x."='YES' and id='".$_GET['id']."'  and country='".$country."'");
                                                            if(($numrows=mysqli_num_rows($check_status))<>0)
                                                            {
                                                                echo "<div class='col'><b>".$row_accessories['asset']." ".$x."</b>: YES</div>";
                                                                //echo "<input type='checkbox' checked name='asset[]' value='".$row_accessories['colname']."".$x."' class='ml-5'> ".$row_accessories['asset']." ".$x."";
                                                            }
                                                            else {
                                                                echo "<div class='col'><b>".$row_accessories['asset']." ".$x."</b>: NO</div>";
                                                                //echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."".$x."' class='ml-5'> ".$row_accessories['asset']." ".$x."";
                                                            
                                                            }
                                                        
                                                        $x++;
                                                    }
                                                   
                                                }
                                                elseif($row_accessories['asset']!='Desktop' && $row_accessories['asset']!='Laptop') {
                                                    $check_status=mysqli_query($con,"SELECT * from tbl_assetmainlogs where ".$row_accessories['colname']."='YES' and id='".$_GET['id']."' and country='".$country."'");
                                                            if(($numrows=mysqli_num_rows($check_status))<>0)
                                                            {
                                                                echo "<div class='col'><b>".$row_accessories['asset']."</b>: YES</div>";
                                                                //echo "<input type='checkbox' checked name='asset[]' value='".$row_accessories['colname']."' class='ml-5'> ".$row_accessories['asset']."";
                                                               
                                                            }
                                                            else {
                                                                echo "<div class='col'><b>".$row_accessories['asset']."</b>: NO</div>";
                                                                //echo "<input type='checkbox' name='asset[]' value='".$row_accessories['colname']."' class='ml-5'> ".$row_accessories['asset']."";
                                                            }
                                                 }
                                                 
                                        }
                                    ?>
                            </div>

                            <div class='row mt-3'>
                                <div class='col modal-content-title'>
                                    <b>OTHER DETAILS</b>
                                </div>
                            </div>
                            <div class='row mt-2 mb-2'>
                                <div class='col'>
                                    <label for="fileSelect"><b>Permanent Form</b> : 
                                        <?php
                                        if($row['permanentForms']!='')
                                        {
                                        ?>
                                            <a href='../pdf/<?php echo $row['permanentForms']?>' target='_blank'><?php echo $row['permanentForms']?></a></label>
                                        <?php
                                        }
                                        else {
                                            echo "Not Available";
                                        }
                                        ?>

                                    <bR>
                                   
                                </div>
                                <div class='col'>
                                    <label for="fileSelect"><b>Return Form</b> : 
                                        <?php
                                        if($row['returnForms']!='')
                                        {
                                        ?>
                                            <a href='../pdf/<?php echo $row['returnForms']?>' target='_blank'><?php echo $row['returnForms']?></a></label>
                                        <?php
                                        }
                                        else {
                                            ?>
                                             <bR>
                                            <input type="file" name="returnForm" id="fileSelect">
                                        <?php    
                                        }
                                        ?>

                                   
                                </div>
                               
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    <div class="mb-3">
                                        <b>Remarks</b> : <?php echo $row['remarks']?>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col text-center'>
                                        <?php
                                        if(!isset($_GET['success']))
                                        {
                                        ?>
                                        <input type='submit' name='submit' class='btn btn-danger' value='Update'>
                                        <?php
                                        }
                                        ?>
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
                                            $history_query=mysqli_query($con,"SELECT * FROM tbl_assetmainlogs where serial='".$row['serial']."' and status='inactive' and country='".$country."' order by id DESC");
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

                <table class="table table-striped" style='font-size:14px;' width="100%" cellspacing="0">
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
                        <td><input type='text' name='serial' required></td>
                    </tr>

                    <tr>
                        <td style='text-align:right'><b>*Computer Name : </b></td>
                        <td> <input type='text' name='computerName' required></td>
                        <td style='text-align:right'><b>OS : </b></td>
                        <td><input type='text' name='os'></td>
                        <td style='text-align:right'> <b>MAC Address : </b></td>
                        <td><input type='text' name='macAddress'></td>
                    </tr>

                    <tr>
                        <td style='text-align:right'><b>Asset Status : </b></td>
                        <td><input type='hidden' name='assetStatus' value='In Stock'>
                            In Stock
                           
                        </td>
                        <td style='text-align:right'><b>Asset Tag : </b></td>
                        <td><input type='text' name='assetTag'></td>
                        <td style='text-align:right'> <b>Asset Condition : </b></td>
                        <td><input type='hidden' name='assetCondition' value='WORKING'>
                            WORKING
                            
                        </td>
                    </tr>

                    <tr>
                        <td style='text-align:right'><b>Delivery Date : </b></td>
                        <td> <input type='text' name='deliveryDate' id='calendar' autocomplete='off'></td>
                        <td style='text-align:right'><b>Warranty : </b></td>
                        <td><input type='text' name='warranty'></td>
                        <td style='text-align:right'> <b>*Brand : </b></td>
                        <td><input type='text' name='brand' required></td>
                    </tr>

                    <tr>
                        <td style='text-align:right'><b>Asset Remarks : </b></td>
                        <td colspan='5'> <textarea style='width:100%;height:50px' name='assetRemarks'></textarea></td>
                    </tr>
                </table>

                <div class='row'>
                    <div class='col text-center'>
                        <input type='submit' class='btn btn-danger' name='submit' value='Submit'>
                    </div>
                </div>
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
        <table class="table table-bordered" id="dataTable" style='font-size:11px;text-align:center' width="100%" cellspacing="0">
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
                    $query=mysqli_query($con,"SELECT * from tbl_assetmain  where country='".$country."'");
                        while($row=mysqli_fetch_assoc($query))
                        {
                        ?>
                            <tr>
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['type']?></td>
                                <td><?php echo $row['model']?></td>
                                <td><?php echo $row['computerName']?></td>
                                <td><?php echo $row['serial']?></td>
                                <?php
                                if($row['assetStatus']=='In Stock')
                                {
                                    echo "<td></td>";
                                    echo "<td></td>";
                                }
                                elseif($row['assetStatus']=='In Use')
                                {
                                    $query2=mysqli_query($con,"SELECT tbl_assetmainlogs.id as 'logID' ,tbl_assetmainlogs.* from tbl_assetmainlogs where serial='".$row['serial']."'  and country='".$country."' order by id DESC LIMIT 1");
                                        $row2=mysqli_fetch_assoc($query2);
                                    echo  "<td>".$row2['assignedTo']."</td>
                                    <td>".$row2['igg']."</td>";
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
                                        <div class="modal  fade" id="exampleModal<?php echo $row2['logID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                         <div class="modal  fade" id="exampleModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            $fetch=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmainlogs.id='".$row2['logID']."' and tbl_assetmainlogs.country='".$country."'");
                                                        }
                                                        else
                                                        {
                                                             $fetch=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmain.id='".$row['id']."' and tbl_assetmain.country='".$country."'");
                                                       
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
                                                        </div>
                                                        <div class='row p-2'>
                                                            <div class='col'>
                                                                <b>Model</b> : <?php echo $row_fetch['model']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>MAC Address</b> : <?php echo $row_fetch['macAddress']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2' style='background:#f5f5f5'>
                                                            <div class='col'>
                                                                <b>Asset Tag</b> : <?php echo $row_fetch['assetTag']?>
                                                            </div>
                                                            
                                                            <div class='col'>
                                                                <b>Serial No.</b> : <?php echo $row_fetch['serial']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            <div class='col'>
                                                                <b>Condition</b> : <?php echo $row_fetch['assetCondition']?>
                                                            </div>
                                                            
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
                                                                                $history_query=mysqli_query($con,"SELECT * FROM tbl_assetmainlogs where serial='". $row_fetch['serial']."' and status='inactive'  and country='".$country."' order by id DESC");
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