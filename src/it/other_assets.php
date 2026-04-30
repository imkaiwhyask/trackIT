<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?php echo $_GET['inv']?> Asset Inventory</h1>

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
                                <span class="input-group-text" id="inputGroup-sizing-default">*Asset Code</span>
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
        $search=mysqli_query($con,"SELECT * FROM tbl_assetothers where assetCode='".$_GET['txtSearch']."' and country='".$country."'");
            $row_search=mysqli_fetch_assoc($search);
        if(($numrow=mysqli_num_rows($search))<>0)
        {
            if($row_search['assetStatus']=='In Stock')
            {
            ?>
                <form action='../backend/_save_new_assetothers.php' method='POST'>
                    <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                    <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                    <input type='hidden' name='assetCode' value='<?php echo $_GET['txtSearch']?>'>
                    <input type='hidden' name='country' value='<?php echo $country?>'>

                    <!-- Asset -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class='row'>
                                    <h6 class="m-0 font-weight-bold text-danger">Asset and Emplyee Details</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-center" style='overflow-y:hidden;'>
                                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                                    <tr><td colspan='6' class='modal-content-title'>ASSET DETAILS</td></tr> 
                                    <tr>
                                        <td style='text-align:right'><b>Asset Code :</b></td>
                                        <td>  <?php echo $row_search['assetCode']?></td>
                                        <td style='text-align:right'><b>Category :</b></td>
                                        <td> <?php echo $row_search['category']?></td>
                                        <td style='text-align:right'><b>Type :</b></td>
                                        <td> <?php echo $row_search['type']?></td>
                                    </tr>  
                                    <tr>
                                        <td style='text-align:right'><b>Model :</b></td>
                                        <td> <?php echo $row_search['model']?></td>
                                        <td style='text-align:right'><b>Condition :</b></td>
                                        <td><?php echo $row_search['assetCondition']?></td>
                                        <td style='text-align:right'><b>Serial :</b></td>
                                        <td> <?php echo $row_search['serial']?></td>
                                    </tr>  

                                    <tr><td colspan='6' class='modal-content-title'>EMPLOYEE DETAILS</td></tr> 
                                    <tr>
                                        <td style='text-align:right'><b>*Employee Name :</b></td>
                                        <td>   <input type="text" name='employeeName' class="input-text" required></td>
                                        <td style='text-align:right'><b>*IGG :</b></td>
                                        <td> <input type="text" name='igg' class="input-text" required></td>
                                        <td style='text-align:right'><b>*Department :</b></td>
                                        <td> <input type="text" name='department' class="input-text" required></td>
                                    </tr> 
                                    <tr>
                                        <td style='text-align:right'><b>*Location :</b></td>
                                        <td>
                                            <select class="custom-select" id="inputGroupSelect01" name='location' required>
                                                <option selected>Choose...</option>
                                                    <?php
                                                    $location_query=mysqli_query($con,"SELECT office from tbl_office where country='".$country."' group by office order by office");
                                                        while($row=mysqli_fetch_assoc($location_query))
                                                        {
                                                            echo " 
                                                            <option value='".$row['office']."'>".$row['office']."</option>";
                                                        }   
                                                
                                                    ?>
                                            </select>
                                        </td>
                                        <td style='text-align:right'><b>*Remarks :</b></td>
                                        <td colspan='3'><textarea class="form-control" name='remarks'></textarea></td>
                                    </tr> 
                                    <tr>
                                        <td colspan='6' style='text-align:center'><input type='submit' name='submit' class='btn btn-danger' value='Submit'></td>
                                </table>
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
                                        <th>Employee Name</th>
                                        <th>IGG</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Remarks</th>
                                        <th>LastChanged</th>
                                        <th>By User</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $history_query=mysqli_query($con,"SELECT * FROM tbl_assetotherslogs where assetCode='".$_GET['txtSearch']."' and status='inactive' and country='".$country."' order by id DESC");
                                               while($row_history=mysqli_fetch_assoc($history_query))
                                               {
                                                   echo "<tr>
                                                        <td>".$row_history['assignedTo']."</td>  
                                                        <td>".$row_history['igg']."</td>   
                                                        <td>".$row_history['department']."</td>   
                                                        <td>".$row_history['location']."</td>   
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
   
    
    $query=mysqli_query($con,"SELECT tbl_assetothers.*,tbl_assetotherslogs.* FROM tbl_assetothers,tbl_assetotherslogs where  tbl_assetothers.assetCode=tbl_assetotherslogs.assetCode and tbl_assetotherslogs.id='".$_GET['id']."' and tbl_assetotherslogs.country='".$country."'");
        $row_search=mysqli_fetch_assoc($query);
        if(($numrow=mysqli_num_rows($query))<>0)
        {
        ?>
                <form action='../backend/_update_assetOthers.php' method='POST' enctype="multipart/form-data">
                    <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                    <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                    <input type='hidden' name='assetCode' value='<?php echo $row_search['assetCode']?>'>
                    <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
                    <input type='hidden' name='country' value='<?php echo $country?>'>
                    <!-- Asset -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class='row'>
                                <div class='col'>
                                    <h6 class="m-0 font-weight-bold text-danger">Asset and Employee Details</h6>
                                </div>
                                <div class='col text-right'>
                                    <a href='?inv=<?php echo $_GET['inv']?>'><button type="button" class="btn btn-dark">Back</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-center" style='overflow-y:hidden;'>
                                <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                                    <tr><td colspan='6' class='modal-content-title'>ASSET DETAILS</td></tr> 
                                    <tr>
                                        <td style='text-align:right'><b>Asset Code :</b></td>
                                        <td>  <?php echo $row_search['assetCode']?></td>
                                        <td style='text-align:right'><b>Category :</b></td>
                                        <td> <?php echo $row_search['category']?></td>
                                        <td style='text-align:right'><b>Type :</b></td>
                                        <td> <?php echo $row_search['type']?></td>
                                    </tr>  
                                    <tr>
                                        <td style='text-align:right'><b>Model :</b></td>
                                        <td> <?php echo $row_search['model']?></td>
                                        <td style='text-align:right'><b>Condition :</b></td>
                                        <td><?php echo $row_search['assetCondition']?></td>
                                        <td style='text-align:right'><b>Serial :</b></td>
                                        <td> <?php echo $row_search['serial']?></td>
                                    </tr>  

                                    
                                    <?php
                                    //additional info for server,network and printer devices
                                    if($_GET['inv']=='Servers' || $_GET['inv']=='Printers' || $_GET['inv']=='Network Devices')
                                    {
                                    ?>
                                             <tr><td colspan='6' class='modal-content-title'>ADDITIONAL ASSET DETAILS</td></tr> 
                                            <tr>
                                                <td style='text-align:right'><b>Operating System : </b></td>
                                                <td> <?php echo $row_search['os']?></td>
                                                <td style='text-align:right'><b>Server Name : </b></td>
                                                <td><?php echo $row_search['serverName']?></td>
                                                <td style='text-align:right'> <b>Domain Name : </b></td>
                                                <td><?php echo $row_search['domainName']?></td>
                                            </tr>
                                            <tr>
                                                <td style='text-align:right'><b>DNS Suffix : </b></td>
                                                <td> <?php echo $row_search['dnsSuffix']?></td>
                                                <td style='text-align:right'><b>ILO : </b></td>
                                                <td><?php echo $row_search['ilo']?> </td>
                                                <td style='text-align:right'> <b>Role : </b></td>
                                                <td><?php echo $row_search['role']?></td>
                                            </tr>
                                            <tr>
                                                <td style='text-align:right'><b>IP Address : </b></td>
                                                <td> <?php echo $row_search['ipAddress']?></td>
                                                <td style='text-align:right'><b>MAC Address : </b></td>
                                                <td><?php echo $row_search['macAddress']?> </td>
                                                <td style='text-align:right'> <b>Data Port Number : </b></td>
                                                <td><?php echo $row_search['dataPortNumber']?></td>
                                            </tr>
                                            <tr>
                                                <td style='text-align:right'><b>Brand : </b></td>
                                                <td> <?php echo $row_search['brand']?></td>
                                                <td style='text-align:right'><b>Vendor : </b></td>
                                                <td><?php echo $row_search['vendor']?> </td>
                                                <td style='text-align:right'> <b>Purchased Date : </b></td>
                                                <td><?php echo $row_search['purchasedDate']?></td>
                                            </tr>
                                            <tr>
                                                <td style='text-align:right'><b>Warranty Start Date : </b></td>
                                                <td> <?php echo $row_search['warrantyStartDate']?></td>
                                                <td style='text-align:right'><b>Warranty End Date : </b></td>
                                                <td><?php echo $row_search['warrantyEndDate']?> </td>
                                                <td style='text-align:right'> <b>Server Role : </b></td>
                                                <td><?php echo $row_search['serverRole']?></td>
                                            </tr>
                                            <tr>
                                                <td style='text-align:right'><b>Database : </b></td>
                                                <td> <?php echo $row_search['databaseName']?></td>
                                                <td style='text-align:right'><b>Asset Type : </b></td>
                                                <td><?php echo $row_search['assetType']?> </td>
                                                <td style='text-align:right'> <b>Host Physical Server : </b></td>
                                                <td><?php echo $row_search['hostPhysicalServer']?></td>
                                            </tr>
                                            <tr>
                                                <td style='text-align:right'><b>Attachment 1 : </b></td>
                                                <td>
                                                    <?php
                                                    if($row_search['attachment1']!='')
                                                    {
                                                    ?>
                                                        <a href='../pdf_otherAssets/<?php echo $row_search['attachment1']?>' target='_blank'><?php echo $row_search['attachment1']?></a></label>
                                                    <?php
                                                    }
                                                    else {
                                                        echo "Not Available<bR>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style='text-align:right'><b>Attachment 2 : </b></td>
                                                <td>
                                                    <?php
                                                        if($row_search['attachment2']!='')
                                                        {
                                                        ?>
                                                            <a href='../pdf_otherAssets/<?php echo $row_search['attachment2']?>' target='_blank'><?php echo $row_search['attachment2']?></a></label>
                                                        <?php
                                                        }
                                                        else {
                                                            echo "Not Available<bR>";
                                                        }
                                                        ?>
                                                </td>
                                                <td style='text-align:right'><b>Attachment 3 : </b></td>
                                                <td>
                                                    <?php
                                                    if($row_search['attachment3']!='')
                                                    {
                                                    ?>
                                                        <a href='../pdf_otherAssets/<?php echo $row_search['attachment3']?>' target='_blank'><?php echo $row_search['attachment3']?></a></label>
                                                    <?php
                                                    }
                                                    else {
                                                        echo "Not Available<bR>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>

                                    <?php
                                    }
                                    ?>

                                    <tr><td colspan='6' class='modal-content-title'>EMPLOYEE DETAILS</td></tr> 
                                    <tr>
                                        <td style='text-align:right'><b>*Employee Name :</b></td>
                                        <td>   <input type="text" name='employeeName' value='<?php echo $row_search['assignedTo']?>' class="input-text" required></td>
                                        <td style='text-align:right'><b>*IGG :</b></td>
                                        <td> <input type="text" name='igg' value='<?php echo $row_search['igg']?>' class="input-text" required></td>
                                        <td style='text-align:right'><b>*Department :</b></td>
                                        <td> <input type="text" name='department' value='<?php echo $row_search['department']?>' class="input-text" required></td>
                                    </tr> 
                                    <tr>
                                        <td style='text-align:right'><b>*Location :</b></td>
                                        <td>
                                            <select class="custom-select" id="inputGroupSelect01" name='location' required>
                                                <option><?php echo $row_search['location']?></option>
                                                <option></option>
                                                    <?php
                                                    $location_query=mysqli_query($con,"SELECT office from tbl_office where country='".$country."' group by office order by office");
                                                        while($row=mysqli_fetch_assoc($location_query))
                                                        {
                                                            echo " 
                                                            <option value='".$row['office']."'>".$row['office']."</option>";
                                                        }   
                                                
                                                    ?>
                                            </select>
                                        </td>
                                        <td style='text-align:right'><b>*Remarks :</b></td>
                                        <td colspan='3'><textarea class="form-control" name='remarks'><?php echo $row_search['remarks']?></textarea></td>
                                    </tr> 
                                    <tr>
                                        <td style='text-align:right'><b>*Status :</b></td>
                                        <td> <?php
                                            if($row_search['status']=='active')
                                            {
                                            ?>
                                                <select name='status' class='input-text'>
                                                    <option>active</option>
                                                    <option>inactive</option>
                                                </select>
                                            <?php
                                            }
                                            else
                                            {
                                                echo $row_search['status'];
                                            }?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan='6' style='text-align:center'><input type='submit' name='submit' class='btn btn-danger' value='Submit'></td>
                                </table>
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
                                        <th>Employee Name</th>
                                        <th>IGG</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Remarks</th>
                                        <th>LastChanged</th>
                                        <th>By User</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $history_query=mysqli_query($con,"SELECT * FROM tbl_assetotherslogs where assetCode='".$row_search['assetCode']."' and status='inactive' and country='".$country."' order by id DESC");
                                               while($row_history=mysqli_fetch_assoc($history_query))
                                               {
                                                   echo "<tr>
                                                        <td>".$row_history['assignedTo']."</td>  
                                                        <td>".$row_history['igg']."</td>   
                                                        <td>".$row_history['department']."</td> 
                                                        <td>".$row_history['location']."</td> 
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
elseif(isset($_GET['editasset']))
{
    ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
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
            <form action='../backend/_update_assetOthers2.php' method='POST' enctype="multipart/form-data">
                <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
                <input type='hidden' name='country' value='<?php echo $country?>'>

                <?php
                    $query=mysqli_query($con,"SELECT * FROM tbl_assetothers where id='".$_GET['id']."'");
                    $row=mysqli_fetch_assoc($query);
                ?>
                <table class="table" style='font-size:14px;' width="100%" cellspacing="0">
                <tr>
                        <td style='text-align:right'><b>*Category : </b></td>
                        <td> <select name='category' required>
                                <option><?php echo $row['category']?></option>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT category from tbl_category order by category");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['category']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                        <td style='text-align:right'><b>*Type : </b></td>
                        <td> <select name='type' required>
                                <option><?php echo $row['type']?></option>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT type from tbl_assettype order by type");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['type']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                        <td style='text-align:right'><b>Serial : </b></td>
                        <td><input type='text' name='serial' value='<?php echo $row['serial']?>'></td>
                    </tr>
                    <tr>
                                <td style='text-align:right'><b>Name : </b></td>
                                <td> <input type='text' class='input-text' name='name' value='<?php echo $row['name']?>'></td>
                                <td style='text-align:right'><b>Location : </b></td>
                                <td><input type='text' class='input-text' name='location' value='<?php echo $row['location']?>'> </td>
                                <td style='text-align:right'> <b>Local Interface : </b></td>
                                <td><input type='text' class='input-text' name='localInterface' value='<?php echo $row['localInterface']?>'></td>
                            </tr>
                    <tr>
                        <td style='text-align:right'><b>*Model : </b></td>
                        <td> <input type='text' name='model' value='<?php echo $row['model']?>' required></td>
                        <td style='text-align:right'><b>*Asset Status : </b></td>
                            <td><select name='assetStatus' required>
                                <option><?php echo $row['assetStatus']?></option>
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT status from tbl_assetstatus order by status");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['status']."</option>";
                                        }
                                ?>
                            </select>
                            </td>
                       
                        <td style='text-align:right'> <b>*Asset Condition : </b></td>
                            <td> <select name='assetCondition' required>
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
                   
                    <?php
                    //additional info for server,network and printer devices
                    if($_GET['inv']=='Servers' || $_GET['inv']=='Printers' || $_GET['inv']=='Network Devices')
                    {
                    ?>
                            <tr>
                                <td style='text-align:right'><b>Operating System : </b></td>
                                <td> <input type='text' class='input-text' name='os' value='<?php echo $row['os']?>'></td>
                                <td style='text-align:right'><b>Server Name : </b></td>
                                <td><input type='text' class='input-text' name='serverName' value='<?php echo $row['serverName']?>'> </td>
                                <td style='text-align:right'> <b>Domain Name : </b></td>
                                <td><input type='text' class='input-text' name='domainName' value='<?php echo $row['domainName']?>'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>DNS Suffix : </b></td>
                                <td> <input type='text' class='input-text' name='dnsSuffix' value='<?php echo $row['dnsSuffix']?>'></td>
                                <td style='text-align:right'><b>ILO : </b></td>
                                <td><input type='text' class='input-text' name='ilo' value='<?php echo $row['ilo']?>'> </td>
                                <td style='text-align:right'> <b>Role : </b></td>
                                <td><input type='text' class='input-text' name='role' value='<?php echo $row['role']?>'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>IP Address : </b></td>
                                <td> <input type='text' class='input-text' name='ipAddress' value='<?php echo $row['ipAddress']?>'></td>
                                <td style='text-align:right'><b>MAC Address : </b></td>
                                <td><input type='text' class='input-text' name='macAddress' value='<?php echo $row['macAddress']?>'> </td>
                                <td style='text-align:right'> <b>Data Port Number : </b></td>
                                <td><input type='text' class='input-text' name='dataPortNumber' value='<?php echo $row['dataPortNumber']?>'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>Brand : </b></td>
                                <td> <input type='text' class='input-text' name='brand' value='<?php echo $row['brand']?>'></td>
                                <td style='text-align:right'><b>Vendor : </b></td>
                                <td><input type='text' class='input-text' name='vendor' value='<?php echo $row['vendor']?>'> </td>
                                <td style='text-align:right'> <b>Purchased Date : </b></td>
                                <td><input type='text' class='input-text' id='calendar' name='purchasedDate' autocomplete='off' value='<?php echo $row['purchasedDate']?>'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>Warranty Start Date : </b></td>
                                <td> <input type='text' class='input-text' id='calendar4' autocomplete='off' name='warrantyStartDate' value='<?php echo $row['warrantyStartDate']?>'></td>
                                <td style='text-align:right'><b>Warranty End Date : </b></td>
                                <td><input type='text' class='input-text' id='calendar3' autocomplete='off' name='warrantyEndDate' value='<?php echo $row['warrantyEndDate']?>'> </td>
                                <td style='text-align:right'> <b>Server Role : </b></td>
                                <td><input type='text' class='input-text' name='serverRole' value='<?php echo $row['serverRole']?>'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>Database : </b></td>
                                <td> <input type='text' class='input-text' name='databaseName' value='<?php echo $row['databaseName']?>'></td>
                                <td style='text-align:right'><b>Asset Type : </b></td>
                                <td><input type='text' class='input-text' name='assetType' value='<?php echo $row['assetType']?>'> </td>
                                <td style='text-align:right'> <b>Host Physical Server : </b></td>
                                <td><input type='text' class='input-text' name='hostPhysicalServer' value='<?php echo $row['hostPhysicalServer']?>'></td>
                            </tr>
                          
                            <tr>
                                <td style='text-align:right'><b>Attachment 1 : </b></td>
                                <td>
                                    <?php
                                    if($row['attachment1']!='')
                                    {
                                    ?>
                                        <a href='../pdf_otherAssets/<?php echo $row['attachment1']?>' target='_blank'><?php echo $row['attachment1']?></a></label>
                                    <?php
                                    }
                                    else {
                                        echo "Not Available<bR>";
                                        echo "<input type='file'  class='input-text' name='attachment1' id='fileSelect'>";
                                    }
                                    ?>
                                </td>
                                <td style='text-align:right'><b>Attachment 2 : </b></td>
                                <td>
                                    <?php
                                        if($row['attachment2']!='')
                                        {
                                        ?>
                                            <a href='../pdf_otherAssets/<?php echo $row['attachment2']?>' target='_blank'><?php echo $row['attachment2']?></a></label>
                                        <?php
                                        }
                                        else {
                                            echo "Not Available<bR>";
                                            echo "<input type='file'  class='input-text' name='attachment2' id='fileSelect'>";
                                        }
                                        ?>
                                </td>
                                <td style='text-align:right'><b>Attachment 3 : </b></td>
                                <td>
                                    <?php
                                    if($row['attachment3']!='')
                                    {
                                    ?>
                                        <a href='../pdf_otherAssets/<?php echo $row['attachment3']?>' target='_blank'><?php echo $row['attachment3']?></a></label>
                                    <?php
                                    }
                                    else {
                                        echo "Not Available<bR>";
                                        echo "<input type='file'  class='input-text' name='attachment3' id='fileSelect'>";
                                    }
                                    ?>
                                </td>
                            </tr>

                    <?php
                    }
                    ?>
                    <tr>
                        <td style='text-align:right'><b>Asset Remarks : </b></td>
                        <td colspan='5'> <textarea style='width:100%;height:50px' name='assetRemarks'><?php echo $row['assetRemarks']?></textarea></td>
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
            <form action='../backend/_add_assetOthers.php' method='POST' enctype="multipart/form-data">
                <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                <input type='hidden' name='country' value='<?php echo $country?>'>

                <table class="table" style='font-size:14px;' width="100%" cellspacing="0">
                <tr>
                        <td style='text-align:right'><b>*Category : </b></td>
                        <td> <?php echo $_GET['inv']?>
                            <input type='hidden' name='category' value='<?php echo $_GET['inv']?>'>
                        </td>
                        <td style='text-align:right'><b>*Type : </b></td>
                        <td> <select name='type' required>
                               
                                <option></option>
                                <?php
                                    $type_query=mysqli_query($con,"SELECT type from tbl_assettype order by type");
                                        while($row_type=mysqli_fetch_assoc($type_query))
                                        {
                                            echo "<option>".$row_type['type']."</option>";
                                        }
                                ?>
                            </select>
                        </td>
                        <td style='text-align:right'><b>Serial : </b></td>
                        <td><input type='text' name='serial' ></td>
                    </tr>

                    <tr>
                        <td style='text-align:right'><b>*Model : </b></td>
                        <td> <input type='text' name='model' required></td>
                        <td style='text-align:right'><b>*Asset Status : </b></td>
                        <td><select name='assetStatus' required>
                            <option></option>
                            <?php
                                $type_query=mysqli_query($con,"SELECT status from tbl_assetstatus where status!='In Use' order by status");
                                    while($row_type=mysqli_fetch_assoc($type_query))
                                    {
                                        echo "<option>".$row_type['status']."</option>";
                                    }
                            ?>
                        </select>
                        </td>
                       
                        <td style='text-align:right'> <b>*Asset Condition : </b></td>
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

                    <?php
                    //additional info for server,network and printer devices
                    if($_GET['inv']=='Servers' || $_GET['inv']=='Printers' || $_GET['inv']=='Network Devices')
                    {
                    ?>
                            <tr>
                                <td style='text-align:right'><b>Operating System : </b></td>
                                <td> <input type='text' class='input-text' name='os'></td>
                                <td style='text-align:right'><b>Server Name : </b></td>
                                <td><input type='text' class='input-text' name='serverName'> </td>
                                <td style='text-align:right'> <b>Domain Name : </b></td>
                                <td><input type='text' class='input-text' name='domainName'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>DNS Suffix : </b></td>
                                <td> <input type='text' class='input-text' name='dnsSuffix'></td>
                                <td style='text-align:right'><b>ILO : </b></td>
                                <td><input type='text' class='input-text' name='ilo'> </td>
                                <td style='text-align:right'> <b>Role : </b></td>
                                <td><input type='text' class='input-text' name='role'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>IP Address : </b></td>
                                <td> <input type='text' class='input-text' name='ipAddress'></td>
                                <td style='text-align:right'><b>MAC Address : </b></td>
                                <td><input type='text' class='input-text' name='macAddress'> </td>
                                <td style='text-align:right'> <b>Data Port Number : </b></td>
                                <td><input type='text' class='input-text' name='dataPortNumber'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>Brand : </b></td>
                                <td> <input type='text' class='input-text' name='brand'></td>
                                <td style='text-align:right'><b>Vendor : </b></td>
                                <td><input type='text' class='input-text' name='vendor'> </td>
                                <td style='text-align:right'> <b>Purchased Date : </b></td>
                                <td><input type='text' class='input-text' id='calendar' name='purchasedDate' autocomplete='off'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>Warranty Start Date : </b></td>
                                <td> <input type='text' class='input-text' id='calendar4' autocomplete='off' name='warrantyStartDate'></td>
                                <td style='text-align:right'><b>Warranty End Date : </b></td>
                                <td><input type='text' class='input-text' id='calendar3' autocomplete='off' name='warrantyEndDate'> </td>
                                <td style='text-align:right'> <b>Server Role : </b></td>
                                <td><input type='text' class='input-text' name='serverRole'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>Database : </b></td>
                                <td> <input type='text' class='input-text' name='databaseName'></td>
                                <td style='text-align:right'><b>Asset Type : </b></td>
                                <td><input type='text' class='input-text' name='assetType'> </td>
                                <td style='text-align:right'> <b>Host Physical Server : </b></td>
                                <td><input type='text' class='input-text' name='hostPhysicalServer'></td>
                            </tr>
                            <tr>
                                <td style='text-align:right'><b>Attachment 1 : </b></td>
                                <td>   <input type="file"  class='input-text' name="attachment1" id="fileSelect"></td>
                                <td style='text-align:right'><b>Attachment 2 : </b></td>
                                <td><input type="file"  class='input-text' name="attachment2" id="fileSelect"></td>
                                <td style='text-align:right'><b>Attachment 3 : </b></td>
                                <td><input type="file"  class='input-text' name="attachment3" id="fileSelect"></td>
                            </tr>

                    <?php
                    }
                    ?>
                   
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
                <th>Asset Code</th>
                <th>Type</th>
                <th>Model</th>
                <th>Serial No.</th>
                <th>Assigned To</th>
                <th>IGG</th>
                <th>Status</th>
                <th style='width:100px'>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $query=mysqli_query($con,"SELECT * from tbl_assetothers where category='".$_GET['inv']."' and country='".$country."'");
                        while($row=mysqli_fetch_assoc($query))
                        {
                        ?>
                            <tr>
                            <td><a href='?inv=<?php echo $_GET['inv']?>&editasset&id=<?php echo $row['id']?>'><?php echo $row['id']?></a></td>
                                <td><?php echo $row['assetCode']?></td>
                                <td><?php echo $row['type']?></td>
                                <td><?php echo $row['model']?></td>
                                <td><?php echo $row['serial']?></td>
                                <?php
                                if($row['assetStatus']=='In Stock')
                                {
                                    echo "<td></td>";
                                    echo "<td></td>";
                                }
                                elseif($row['assetStatus']=='In Use')
                                {
                                    $query2=mysqli_query($con,"SELECT tbl_assetotherslogs.id as 'logID' ,tbl_assetotherslogs.* from tbl_assetotherslogs where assetCode='".$row['assetCode']."' and country='".$country."' order by id DESC LIMIT 1");
                                        $row2=mysqli_fetch_assoc($query2);
                                      
                                    echo  "<td>".$row2['assignedTo']."</td>
                                    <td>".$row2['igg']."</td>";
                                }
                                else
                                {
                                    echo  "<td></td>
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
                                                            $fetch=mysqli_query($con,"SELECT tbl_assetothers.*,tbl_assetotherslogs.* from tbl_assetothers,tbl_assetotherslogs where tbl_assetothers.assetCode=tbl_assetotherslogs.assetCode and tbl_assetotherslogs.id='".$row2['logID']."' and tbl_assetotherslogs.country='".$country."'");
                                                        }
                                                        else
                                                        {
                                                             $fetch=mysqli_query($con,"SELECT tbl_assetothers.*,tbl_assetotherslogs.* from tbl_assetothers,tbl_assetotherslogs where tbl_assetothers.assetCode=tbl_assetotherslogs.assetCode and tbl_assetothers.id='".$row['id']."' and tbl_assetothers.country='".$country."'");
                                                       
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
                                                                <b>Category</b> : <?php echo $row_fetch['category']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Type</b> : <?php echo $row_fetch['type']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            <div class='col'>
                                                                <b>Name</b> : <?php echo $row_fetch['name']?>
                                                            </div>
                                                            <div class='col'>
                                                                <b>Location</b> : <?php echo $row_fetch['location']?>
                                                            </div>
                                                        </div>
                                                        <div class='row p-2'>
                                                            <div class='col'>
                                                                <b>Model</b> : <?php echo $row_fetch['model']?>
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
                                                        //additional info for server,network and printer devices
                                                        if($row_fetch['category']=='Servers' || $row_fetch['category']=='Printers' || $row_fetch['category']=='Network Devices')
                                                        {
                                                        ?>
                                                            <div class='row'>
                                                                <div class='col modal-content-title'><b>Additional Asset Information</b></div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>Operating System</b> : <?php echo $row_fetch['os']?>
                                                                </div>
                                                                
                                                                <div class='col'>
                                                                    <b>Server Name</b> : <?php echo $row_fetch['serverName']?>
                                                                </div>

                                                                <div class='col'>
                                                                    <b>Domain Name</b> : <?php echo $row_fetch['domainName']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>DNS Suffix</b> : <?php echo $row_fetch['dnsSuffix']?>
                                                                </div>
                                                                
                                                                <div class='col'>
                                                                    <b>ILO</b> : <?php echo $row_fetch['ilo']?>
                                                                </div>

                                                                <div class='col'>
                                                                    <b>Role</b> : <?php echo $row_fetch['role']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>IP Address</b> : <?php echo $row_fetch['ipAddress']?>
                                                                </div>
                                                                
                                                                <div class='col'>
                                                                    <b>MAC Address</b> : <?php echo $row_fetch['macAddress']?>
                                                                </div>

                                                                <div class='col'>
                                                                    <b>Data Port Number</b> : <?php echo $row_fetch['dataPortNumber']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>Brand</b> : <?php echo $row_fetch['brand']?>
                                                                </div>
                                                                
                                                                <div class='col'>
                                                                    <b>Vendor</b> : <?php echo $row_fetch['vendor']?>
                                                                </div>

                                                                <div class='col'>
                                                                    <b>Purchased Date</b> : <?php echo $row_fetch['purchasedDate']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>Warranty Start Date</b> : <?php echo $row_fetch['warrantyStartDate']?>
                                                                </div>
                                                                
                                                                <div class='col'>
                                                                    <b>Warranty End Date</b> : <?php echo $row_fetch['warrantyEndDate']?>
                                                                </div>

                                                                <div class='col'>
                                                                    <b>Server Role</b> : <?php echo $row_fetch['serverRole']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>Database</b> : <?php echo $row_fetch['databaseName']?>
                                                                </div>
                                                                
                                                                <div class='col'>
                                                                    <b>Asset Type</b> : <?php echo $row_fetch['assetType']?>
                                                                </div>

                                                                <div class='col'>
                                                                    <b>Host Physical Server</b> : <?php echo $row_fetch['hostPhysicalServer']?>
                                                                </div>
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col' colspan='6'>
                                                                    <b>Local Interface</b> : <?php echo $row_fetch['localInterface']?>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                            <div class='row p-2'>
                                                                <div class='col'>
                                                                    <b>Attachment 1</b> : <?php echo $row_fetch['attachment1']?>
                                                                </div>
                                                                
                                                                <div class='col'>
                                                                    <b>Attachment 2</b> : <?php echo $row_fetch['attachment2']?>
                                                                </div>

                                                                <div class='col'>
                                                                    <b>Attachment 3</b> : <?php echo $row_fetch['attachment3']?>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

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
                                                                            <th>Employee Name</th>
                                                                            <th>IGG</th>
                                                                            <th>Department</th>
                                                                            <th>Location</th>
                                                                            <th>Remarks</th>
                                                                            <th>Date</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                $history_query=mysqli_query($con,"SELECT * FROM tbl_assetotherslogs where assetCode='". $row_fetch['assetCode']."' and status='inactive' and country='".$country."' order by id DESC");
                                                                                if(($numrow=mysqli_num_rows($history_query))<>0)
                                                                                {
                                                                                    while($row_history=mysqli_fetch_assoc($history_query))
                                                                                    {
                                                                                        echo "<tr>
                                                                                                <td>".$row_history['assignedTo']."</td>  
                                                                                                <td>".$row_history['igg']."</td>   
                                                                                                <td>".$row_history['department']."</td>
                                                                                                <td>".$row_history['location']."</td>      
                                                                                                <td>".$row_history['remarks']."</td> 
                                                                                                <td>".$row_history['lastChanged']."</td>   
                                                                                            </tr>";
                                                                                    } 
                                                                                }
                                                                                else {
                                                                                    echo "<tr>
                                                                                            <td colspan='6' class='text-center'>No history found!</td>
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