<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ARCHIVED</h1>

<?php
 if(isset($_GET['success']))
 {
     echo "<div class='msg-success p-1 m-3 text-center'>Data has been successfully saved!</div>";
 }
?>

<?php
if(isset($_GET['editasset']))
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
                    <a href='?archive'><button type="button" class="btn btn-dark">Back</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action='../backend/_update_assetmain.php' method='POST'>
                <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                <input type='hidden' name='archive'>
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
                        <td> <input type='text' name='computerName' value='<?php echo $row['model']?>' required></td>
                        <td style='text-align:right'><b>*OS :</b></td>
                        <td> <input type='text' name='os' value='<?php echo $row['os']?>'  required></td>
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
                                            $type_query=mysqli_query($con,"SELECT status from tbl_assetstatus order by status");
                                                while($row_type=mysqli_fetch_assoc($type_query))
                                                {
                                                    echo "<option>".$row_type['status']."</option>";
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
                    <tr>
                        <td style='text-align:right'><b>Delivery Date : </b></td>
                        <td> <input type='text' name='deliveryDate' value="<?php if($row['deliveryDate']=='0000-00-00') {echo '';} else{echo $row['deliveryDate'];}?>" id='calendar' autocomplete='off'></td>
                        <td style='text-align:right'><b>Warranty :</b></td>
                        <td> <input type='text' name='warranty' value='<?php echo $row['warranty']?>'></td>
                        <td style='text-align:right'><b>*Brand :</b></td>
                        <td> <input type='text' name='brand' value='<?php echo $row['brand']?>' required></td>
                    </tr>      
                    <tr>
                        <td style='text-align:right'><b>Active Directory :</b></td>
                        <td> 
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
                           
                        </td>
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
                <th>Asset Status</th>
                <th>Active Directory</th>
                <th style='width:100px'>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    //$query=mysqli_query($con,"SELECT * from tbl_assetmain where country='".$country."' and (assetCondition!='RETIRED' or assetCondition!='DEFECTIVE')");
                    $query=mysqli_query($con,"SELECT tbl_assetmain.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmainlogs.serial=tbl_assetmain.serial and tbl_assetmainlogs.status='inactive' and (tbl_assetmain.assetStatus='Missing' or tbl_assetmain.assetStatus='Retired' or tbl_assetmain.assetStatus='Disposed' and tbl_assetmain.country='".$country."') group by serial");
                        while($row=mysqli_fetch_assoc($query))
                        {
                        ?>
                            <tr>
                                <td><a href='?archive&editasset&id=<?php echo $row['id']?>'><?php echo $row['id']?></a></td>
                                <td><?php echo $row['type']?></td>
                                <td><?php echo $row['model']?></td>
                                <td><?php echo $row['computerName']?></td>
                                <td><?php echo $row['serial']?></td>
                                <?php
                               if($row['assetStatus']=='In Use')
                                {
                                    $query2=mysqli_query($con,"SELECT tbl_assetmainlogs.id as 'logID' ,tbl_assetmainlogs.* from tbl_assetmainlogs where serial='".$row['serial']."' and country='".$country."' order by id DESC LIMIT 1");
                                        $row2=mysqli_fetch_assoc($query2);
                                    echo  "<td>".$row2['assignedTo']."</td>
                                    <td>".$row2['igg']."</td>";
                                }
                                else {
                                    echo "<td></td>
                                    <td></td>";
                                }
                                ?>
                               
                                <td><?php echo $row['assetStatus']?></td>
                                <td><?php echo $row['activeDirectory']?></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    
                                    <?php
                                    if($row['assetStatus']=='In Use')
                                    {
                                    ?>
                                        <button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal<?php echo $row2['logID']?>"><i class="fas fa-eye fa-xs"></i></button>
                                        <a href='?archive&edit&id=<?php echo $row2['logID']?>'><button class='btn btn-success'><i class="fas fa-edit fa-xs"></i></button></a>
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