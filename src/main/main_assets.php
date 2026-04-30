<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">DESKTOPS / LAPTOPS / MONITORS</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-danger">Asset Database</h6>
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
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $query=mysqli_query($con,"SELECT tbl_assetmain.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmainlogs.serial=tbl_assetmain.serial and tbl_assetmain.activeDirectory!='AD Removed' and tbl_assetmain.country='".$country."'  and tbl_assetmain.assetStatus='In Use' group by serial");
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
                                if($row['assetStatus']=='In Use')
                                {
                                    $query2=mysqli_query($con,"SELECT tbl_assetmainlogs.id as 'logID' ,tbl_assetmainlogs.* from tbl_assetmainlogs where serial='".$row['serial']."'  and status='active'  and country='".$country."' order by id DESC LIMIT 1");
                                        $row2=mysqli_fetch_assoc($query2);
                                        if($numrows=mysqli_num_rows($query2)<>0)
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
                                else {
                                    echo "<td></td>
                                    <td></td>";
                                }
                                ?>
                               
                            <td><?php echo $row['assetStatus']?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal<?php echo $row['id']?>"><i class="fas fa-eye fa-xs"></i></button>
                                                                <!-- Modal -->
                                <div class="modal  fade" id="exampleModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg  modal-dialog-scrollable">
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
                                                    $fetch=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmain.assetStatus='In Use' and tbl_assetmainlogs.status='active' and tbl_assetmain.id='".$row['id']."' and tbl_assetmain.country='".$country."'");
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
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a href='../forms/returnDesktop.php?id=<?php echo $row_fetch['id']?>' target='_blank'><input type=button class="btn btn-primary" value="Print Asset Return Form"></a>
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

</div>
<!-- /.container-fluid -->