<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ASSET LOAN</h1>

<?php
                  if(isset($_GET['success']))
                  {
                  ?>
                      <div class="alert alert-success" role="alert">
                       Asset Loan request has been successfully sent!
                    </div>
                  <?php
                  }
                  ?>

  <?php
    if(isset($_GET['new']))
    {
    ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class='row'>
                    <div class='col'>
                        <h6 class="m-0 font-weight-bold text-danger">New Asset Loan Request</h6>
                    </div>
                    <div class='col text-right'>
                    <a href='?assetLoan'><button type="button" class="btn btn-dark">Back</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            
                <form action='../backend/_save_assetLoan.php' method='POST'>
                    <input type='hidden' name='byUser' value='<?php echo $byUser?>'>
                    <input type='hidden' name='country' value='<?php echo $country?>'>
                    <input type='hidden' name='uid' value='<?php echo $uid?>'>
                    
                    <table class="table table-striped" style='font-size:14px;' width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan='4'>APPLICANT DETAILS</th>
                            </tr>
                        </thead>
                        <tr>
                            <td style='text-align:right'><b>*Contact No. : </b></td>
                            <td><input type='text' name='contactNo' required></td>
                        </tr>
                    </table>

                    <table class="table table-striped" style='font-size:14px;' width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan='4'>ASSET DETAILS</th>
                        </tr>
                    </thead>
                    <tr>
                            <td style='text-align:right'><b>*Asset : </b></td>
                            <td> <select name='asset' required>
                                    <option></option>
                                    <?php
                                        $type_query=mysqli_query($con,"SELECT asset from tbl_assetloan_assets order by asset");
                                            while($row_type=mysqli_fetch_assoc($type_query))
                                            {
                                                echo "<option>".$row_type['asset']."</option>";
                                            }
                                    ?>
                                </select>
                            </td>
                            <td style='text-align:right'><b>*Quanity : </b></td>
                            <td><input type='text' name='qty' required></td>
                        </tr>

                        <tr>
                            <td style='text-align:right'><b>*From : </b></td>
                            <td><input type='text' name='startDate' id='calendar'  autocomplete='off' placeholder='yyyy-mm-dd' required></td>
                            <td style='text-align:right'><b>*To : </b></td>
                            <td><input type='text' name='endDate' id='calendar2'  autocomplete='off' placeholder='yyyy-mm-dd' required></td>
                        </tr>

                        <tr>
                            <td style='text-align:right'><b>Business Justification : </b></td>
                            <td colspan='5'> <textarea style='width:100%;height:50px' name='remarks'></textarea></td>
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
    else {
        ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class='row'>
                <div class='col'>
                    <h6 class="m-0 font-weight-bold text-danger">Asset Loan Database</h6>
                </div>
                <div class='col text-right'>
                   <a href='?assetLoan&new'><button type="button" class="btn btn-danger">New Loan Request </button></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" style='font-size:11px;text-align:center' width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Asset</th>
                    <th>QTY</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Loan Status</th>
                    <th>Date Requested</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $query=mysqli_query($con,"SELECT * from tbl_assetLoan where igg='".$igg."' and country='".$country."'");
                            while($row=mysqli_fetch_assoc($query))
                            {
                            ?>
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['asset']?></td>
                                    <td><?php echo $row['qty']?></td>
                                    <td><?php echo $row['startDate']?></td>
                                    <td><?php echo $row['endDate']?></td>
                                    <td><?php echo $row['remarks']?></td>
                                    <td><?php echo $row['status']?></td>
                                    <td><?php echo $row['loanStatus']?></td>
                                    <td><?php echo $row['datetime']?></td>
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