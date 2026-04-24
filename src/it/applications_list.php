<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Applications List</h1>

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
                    <h6 class="m-0 font-weight-bold text-danger">User Details</h6>
                </div>
                <div class='col text-right'>
                    <a href='?inv=<?php echo $_GET['inv']?>'><button type="button" class="btn btn-dark">Back</button></a>
                </div>
            </div>
        </div>
        <form action='../backend/_new_userApplication.php' method='POST'>
            <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
            <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
            <input type='hidden' name='country' value='<?php echo $country?>'>

            
                <div class="card-body">
                    <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                        <tr>
                            <td style='text-align:right'><b>*Application Name: </b></td>
                            <td>
                                <select name='application' onChange="window.open(this.options[this.selectedIndex].value,'_self')" required>
                                    <?php
                                    if(isset($_GET['application']))
                                    {
                                        echo "<option>".$_GET['application']."</option>";
                                    }
                                    ?>
                                    <option></option>
                                    <?php
                                    $query_application=mysqli_query($con,"SELECT * FROM tbl_applicationlist group by application order by application");
                                        while($row_application=mysqli_fetch_assoc($query_application))
                                        {
                                            echo "<option value='?inv=".$_GET['inv']."&new&application=".$row_application['application']."'>".$row_application['application']."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                            <td style='text-align:right'><b>*Name of the user :</b></td>
                            <td> <input type='text' name='name' required></td>
                            <td style='text-align:right'><b>*Role: </b></td>
                            <td>
                                
                                    <?php
                                    if(isset($_GET['application']))
                                        {
                                            //get details
                                            $query=mysqli_query($con,"SELECT * FROM tbl_applicationList where application='".$_GET['application']."'");
                                                $row=mysqli_fetch_assoc($query);
                                                
                                                echo "<input type='hidden' name='dt' value='".$row['db']."'>";
                                                echo "<input type='hidden' name='apn' value='".$row['application']."'>";
                                                echo "<input type='hidden' name='pref' value='".$row['db']."'>";
                                                echo "<input type='hidden' name='tbl_prefix' value='".$row['tbl_prefix']."'>";

                                                if($row['db']=='tisamidb')
                                                {
                                                    $query_role=mysqli_query($con,"SELECT * FROM tbl_role group by role order by role");
                                                }
                                                else
                                                {
                                                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                                                    $temp_conn = mysqli_connect("localhost", "root", "", $row['db']);

                                                    $query_role=mysqli_query($temp_conn,"SELECT * FROM ".$row['tbl_prefix']."_user group by role order by role");
                                                }
                                                ?>
                                                
                                                <select name='role' required>
                                                    <option></option>
                                                    <?php
                                                    while($row_role=mysqli_fetch_assoc($query_role))
                                                    {
                                                        echo "<option>".$row_role['role']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                        <?php
                                        }
                                    ?>
                            </td>
                        </tr> 
                        <?php
                        if(isset($_GET['application']))
                        {
                            //get details
                            $query=mysqli_query($con,"SELECT * FROM tbl_applicationList where application='".$_GET['application']."'");
                            $row=mysqli_fetch_assoc($query);

                            if($row['db']=='tisamidb')
                            {
                                if($row['platform']=='PHP, MySQLi')
                                {
                                ?>
                                    <tr>
                                        <td style='text-align:right'><b>*IGG :</b></td>
                                        <td> <input type='text' name='login' required></td>
                                        <td style='text-align:right'><b>Password :</b></td>
                                        <td colspan='3'> <input type='password' name='pw' required></td>
                                        
                                    </tr>  
                                <?php
                                }
                                else
                                {
                                ?>
                                    <tr>
                                        <td style='text-align:right'><b>*Username :</b></td>
                                        <td> <input type='text' name='login' required></td>
                                    </tr>  
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td style='text-align:right'><b>*IGG :</b></td>
                                    <td> <input type='text' name='igg' required></td>
                                    <td style='text-align:right'><b>*Username :</b></td>
                                    <td> <input type='text' name='login' required></td>
                                    <td style='text-align:right'><b>Password :</b></td>
                                    <td colspan='3'> <input type='password' name='pw' ></td>
                                    
                                </tr>  
                            <?php 
                            }

                        }
                        ?>
                      
                        
                        <tr>
                            <td style='text-align:right'><b>Description :</b></td>
                            <td colspan='5'> <textarea name='remarks' class='input-text'></textarea></td>
                        </tr> 
                        <tr>
                            <td colspan='6' style='text-align:center'><input type='submit' name='submit' class='btn btn-danger' value='Submit'></td>
                    </table> 
                </div>      
        </form>
    </div>    
<?php    
}
elseif(isset($_GET['edit']))
{
   $query=mysqli_query($con,"SELECT * FROM tbl_applicationlist where id='".$_GET['id']."'");
        $row=mysqli_fetch_assoc($query);
        ?>
                <form action='../backend/_update_applicationList.php' method='POST'>
                    <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                    <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                    <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
                    <input type='hidden' name='country' value='<?php echo $country?>'>
                    <input type='hidden' name='apn' value='<?php echo $apn?>'>
                    <input type='hidden' name='dt' value='<?php echo $dt?>'>
                    <input type='hidden' name='pref' value='<?php echo $pref?>'>
                    <!-- Asset -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class='row'>
                                <div class='col'>
                                    <h6 class="m-0 font-weight-bold text-danger">Account Details</h6>
                                </div>
                                <div class='col text-right'>
                                    <a href='?inv=<?php echo $_GET['inv']?>'><button type="button" class="btn btn-dark">Back</button></a>
                                </div>
                            </div>
                        </div>
                
                        <div class="card-body">
                            <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                                <tr>
                                    <td style='text-align:right'><b>*Application Name: </b></td>
                                    <td><?php echo $apn?></td>
                                    <td style='text-align:right'><b>*Name of the user :</b></td>
                                    <td> <input type='text' name='name' value='<?php echo $row['name']?>' required></td>
                                    <td style='text-align:right'><b>*Username :</b></td>
                                    <td> <input type='text' name='login' value='<?php echo $row['login']?>' required></td>
                                </tr>  
                                <tr>
                                    <td style='text-align:right'><b>*Role: </b></td>
                                    <td>
                                        <select name='role' required>
                                            <option><?php echo $row['role']?></option>
                                            <option></option>
                                            <?php
                                            if($dt='tisamidb')
                                            {
                                                $query_role=mysqli_query($con,"SELECT * FROM tbl_role group by role order by role");
                                            }
                                            else
                                            {
                                                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                                                $temp_conn = mysqli_connect("localhost", "root", "", $row['db']);
                                        
                                                $query_role=mysqli_query($con,"SELECT * FROM ".$pref."_role group by role order by role");
                                            }

                                          
                                                while($row_role=mysqli_fetch_assoc($query_role))
                                                {
                                                    echo "<option>".$row_role['role']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td style='text-align:right'><b>Start of Access :</b></td>
                                    <td colspan='3'> <input type='text' name='datetime'  value='<?php if($row['datetime']=='0000-00-00') { echo "";} elseif($row['datetime']==null) { echo "";} else{ echo $row['datetime'];}?>' id='calendar' autocomplete='off'></td>
                                </tr> 
                                <tr>
                                    <td style='text-align:right'><b>Remarks :</b></td>
                                    <td colspan='5'> <textarea name='remarks' class='input-text'><?php echo $row['remarks']?></textarea></td>
                                </tr> 
                                <tr>
                                    <td style='text-align:right'><b>*Status :</b></td>
                                    <td colspan='5'>
                                        <select name='status' required>
                                            <option><?php echo $row['status']?></option>
                                            <option></option>
                                            <option>active</option>
                                            <option>inactive</option>
                                            </select>
                                    </td>
                                </tr> 
                                <tr>
                                    <td colspan='6' style='text-align:center'><input type='submit' name='submit' class='btn btn-danger' value='Submit'></td>
                            </table> 
                        </div>      
                    </div>
                </form>
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
                    <h6 class="m-0 font-weight-bold text-danger">Add New Application</h6>
                </div>
                <div class='col text-right'>
                    <a href='?inv=<?php echo $_GET['inv']?>&all_application'><button type="button" class="btn btn-dark">Back</button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-center" style='overflow-y:hidden;'>
                <form action='../backend/_save_applications.php' method='POST'>
                    <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                    <input type='hidden' name='inv' value='<?php echo $_GET['inv']?>'>
                    <input type='hidden' name='country' value='<?php echo $country?>'>

                    <table class='table' id='dynamic_row' style='width:100%;font-size:12px;text-align:left'>
                        <tr>
                            <td style='text-align:right;width:150px'><b>*Application Name : </b></td>
                            <td> 
                                <textarea class='input-text' name='application'></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style='text-align:right'><b>*Description : </b></td>
                            <td><input type='text' class='input-text' name='description' required></td>
                        </tr>
                            <td style='text-align:right'><b>*Platform : </b></td>
                            <td><input type='text' class='input-text' name='platform' required></td>
                        </tr>
                        <tr>
                            <td colspan='6' style='text-align:center'><input type='submit' name='submit' class='btn btn-danger' value='Save'></td>
                        </tr>
                    </table>
                </form>
            </div>
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
                    <h6 class="m-0 font-weight-bold text-danger">List of Applicatoon/Services</h6>
                </div>
                <div class='col text-right'>
                    <!--<a href='?inv=<?php echo $_GET['inv']?>&all_application'><button type="button" class="btn btn-secondary">Application Details</button></a>
                    <a href='?inv=<?php echo $_GET['inv']?>&new'><button type="button" class="btn btn-danger">Assign User</button></a>
                        -->
                </div>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" style='font-size:11px;text-align:center' width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>#</th>
                <th>Application Name</th>
                <th>Short Description</th>
                <th>Managed By</th>
                <th>Link</th>
                <th>Users</th>
                <th>Operation Group</th>
                <th>Application Type</th>
                <th>Hosting</th>
                <th style='width:100px'>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $query=mysqli_query($con,"SELECT * from tbl_applicationservice");
                        $x=1;
                        while($row=mysqli_fetch_assoc($query))
                        {
                            echo "<tr>";
                            ?>
                                    <td><?php echo $x?></td>
                                    <td><?php echo $row['applicationName']?></td>
                                    <td><?php echo $row['shortDescription']?></td>
                                    <td><?php echo $row['managedBy']?></td>
                                    <td><?php echo $row['link']?></td>
                                    <td><?php echo $row['numberUsers']?></td>
                                    <td><?php echo $row['operationGroup']?></td>
                                    <td><?php echo $row['applicationType']?></td>
                                    <td><?php echo $row['hosting']?></td>
                                    <td>
                                        <a href='?inv=<?php echo $_GET['inv']?>&edit&id=<?php echo $row['id']?>'><button class='btn btn-success'><i class="fas fa-edit fa-xs"></i></button></a>
                                    </td>
                                </tr>
                            <?php
                            $x=$x+1;
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