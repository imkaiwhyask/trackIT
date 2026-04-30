<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ASSET LOAN</h1>
    <?php
    if(isset($_GET['edit']))
    {
    ?>
        <form action='../backend/_update_assetLoan.php' method='POST'>
            <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
            <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
            <input type='hidden' name='country' value='<?php echo $country?>'>
            
            <!-- Asset -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class='row'>
                        <div class='col'>
                            <h6 class="m-0 font-weight-bold text-danger">Edit Asset Loan Request</h6>
                        </div>
                        <div class='col text-right'>
                            <a href='?assetLoan'><button type="button" class="btn btn-dark">Back</button></a>
                        </div>
                    </div>
                </div>

                <?php
                    $query=mysqli_query($con,"SELECT * FROM tbl_assetLoan where id='".$_GET['id']."' and country='".$country."'");
                        $row=mysqli_fetch_assoc($query);
                ?>

                <div class="card-body">
                    <div class='row'>
                        <div class='col modal-content-title'>
                            <b>APPLICANT DETAILS</b>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>ID</b> :
                            <?php echo $row['id']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Employee Name</b> :
                            <?php echo $row['name']?>
                        </div>
                        <div class='col'>
                            <b>IGG</b> :
                            <?php echo $row['igg']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Email</b> :
                            <?php echo $row['email']?>
                            <input type='hidden' name='email' value='<?php echo $row['email']?>'>
                        </div>
                        <div class='col'>
                            <b>Contact Number</b> :
                            <?php echo $row['contactNo']?>
                        </div>
                    </div>

                       
                    
                    <div class='row mt-3'>
                        <div class='col modal-content-title'>
                            <b>ASSET DETAILS</b>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Asset</b> :
                            <?php echo $row['asset']?>
                        </div>
                        <div class='col'>
                            <b>Quantity</b> :
                            <?php echo $row['qty']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>From</b> :
                            <?php echo $row['startDate']?>
                        </div>
                        <div class='col'>
                            <b>To</b> :
                            <?php echo $row['endDate']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Business Justification</b> :
                            <?php echo $row['remarks']?>
                        </div>
                    </div>

                    <div class='row mt-3'>
                        <div class='col modal-content-title'>
                            <b>RESPONSE</b>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Status</b> :
                            <select name='status' required>
                                <option></option>
                                <option>APPROVED</option>
                                <option>DECLINED</option>
                            </select>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Comments</b> :
                            <textarea style='width:100%;height:50px;' name='comments'></textarea>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col text-center'>
                            <input type='submit' class='btn btn-danger' name='submit' value='Update'>
                        </div>
                    </div>
                </form>
    <?php
    }
    elseif(isset($_GET['editupdate']))
    {
    ?>
        <form action='../backend/_update_assetLoanStatus.php' method='POST'>
            <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
            <input type='hidden' name='id' value='<?php echo $_GET['id']?>'>
            <input type='hidden' name='country' value='<?php echo $country?>'>
            
            <!-- Asset -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class='row'>
                        <div class='col'>
                            <h6 class="m-0 font-weight-bold text-danger">Edit Asset Loan Status</h6>
                        </div>
                        <div class='col text-right'>
                            <a href='?assetLoan'><button type="button" class="btn btn-dark">Back</button></a>
                        </div>
                    </div>
                </div>

                <?php
                    $query=mysqli_query($con,"SELECT * FROM tbl_assetLoan where id='".$_GET['id']."' and country='".$country."'");
                        $row=mysqli_fetch_assoc($query);
                ?>

                <div class="card-body">
                    <div class='row'>
                        <div class='col modal-content-title'>
                            <b>APPLICANT DETAILS</b>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>ID</b> :
                            <?php echo $row['id']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Employee Name</b> :
                            <?php echo $row['name']?>
                        </div>
                        <div class='col'>
                            <b>IGG</b> :
                            <?php echo $row['igg']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Email</b> :
                            <?php echo $row['email']?>
                            <input type='hidden' name='email' value='<?php echo $row['email']?>'>
                        </div>
                        <div class='col'>
                            <b>Contact Number</b> :
                            <?php echo $row['contactNo']?>
                        </div>
                    </div>

                       
                    
                    <div class='row mt-3'>
                        <div class='col modal-content-title'>
                            <b>ASSET DETAILS</b>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Asset</b> :
                            <?php echo $row['asset']?>
                        </div>
                        <div class='col'>
                            <b>Quantity</b> :
                            <?php echo $row['qty']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>From</b> :
                            <?php echo $row['startDate']?>
                        </div>
                        <div class='col'>
                            <b>To</b> :
                            <?php echo $row['endDate']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Business Justification</b> :
                            <?php echo $row['remarks']?>
                        </div>
                    </div>

                    <div class='row mt-3'>
                        <div class='col modal-content-title'>
                            <b>RESPONSE</b>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Status</b> :
                            <?php echo $row['status']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Comments</b> :
                            <?php echo $row['comments']?>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Loan Status</b> :
                            <select name='status' required>
                                <option></option>
                                <option>Closed</option>
                            </select>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col'>
                            <b>Return Remarks</b> :
                            <textarea style='width:100%;height:50px;' name='returnRemarks'></textarea>
                        </div>
                    </div>
                    <div class='row mt-2'>
                        <div class='col text-center'>
                            <input type='submit' class='btn btn-danger' name='submit' value='Update'>
                        </div>
                    </div>
                </form>
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
                    <h6 class="m-0 font-weight-bold text-danger">Asset Loan Request</h6>
                </div>
                <div class='col text-right'>
                <!--   <a href='?assetLoan&new'><button type="button" class="btn btn-danger">New Loan Request </button></a>
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
                    <th>Name</th>
                    <th>IGG</th>
                    <th>Asset</th>
                    <th>QTY</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Loan Status</th>
                    <th>Date Requested</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $query=mysqli_query($con,"SELECT * from tbl_assetLoan where country='".$country."'");
                            while($row=mysqli_fetch_assoc($query))
                            {
                            ?>
                                <?php
                                    if($row['status']=='PENDING')
                                    {
                                        echo "<tr style='background:#ffc8c4'>";
                                    }
                                ?>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['igg']?></td>
                                    <td><?php echo $row['asset']?></td>
                                    <td><?php echo $row['qty']?></td>
                                    <td><?php echo $row['startDate']?></td>
                                    <td><?php echo $row['endDate']?></td>
                                    <td><?php echo $row['remarks']?></td>
                                    <td><?php echo $row['status']?></td>
                                    <td><?php echo $row['loanStatus']?></td>
                                    <td><?php echo $row['datetime']?></td>
                                    <td>
                                        <?php
                                        if($row['status']=='PENDING')
                                        {
                                        ?>
                                            <a href='?assetLoan&edit&id=<?php echo $row['id']?>'><button class='btn btn-success'><i class="fas fa-edit fa-xs"></i></button></a>
                                        <?php
                                        }
                                        ?>
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