<?php
    include('../config/config.php');
    if($_POST['btnExport']=='mainAssets') {
        $filename ="Main Asset Report.xls";
    }
    elseif($_POST['btnExport']=='mobileDevices') {
        $filename ="Mobile Devices Asset Report.xls";
    }
    elseif($_POST['btnExport']=='Applications') {
        $filename ="Applications.xls";
    }
    elseif($_POST['btnExport']=='OtherAssets') {
        $category=$_POST['category'];
        $filename ="Other Assets - $category.xls";
    }
    elseif($_POST['btnExport']=='cmdb') {
        $filename ="CMDB.xls";
    }
    elseif($_POST['btnExport']=='stationAssets') {
        $filename ="Station Assets.xls";
    }

       $date=date('n-d-Y');
      
         $contents = "\n \n \n testdata3 \t \n";
         header('Content-type: application/ms-excel');
         header('Content-Disposition: attachment; filename='.basename($filename));
     
?>
<html>
    <head>
    </head>
    <body>
        <?php
      
        if($_POST['btnExport']=='mainAssets')
        {
        ?>
            <table border='1'>
                <tr>
                    <td>ID</td>
                    <td>Unit Type</td>
                    <td>Computer Name</td>
                    <td>IGG</td>
                    <td>FullName</td>
                    <td>Brand</td>
                    <td>Warranty</td>
                    <td>OS</td>
                    <td>OS Version</td>
                    <td>Unit Status</td>
                    <td>Date Assigned</td>
                    <td>Department</td>
                    <td>Location</td>
                    <td>Bag</td>
                    <td>Keyboard</td>
                    <td>Mouse</td>
                    <td>UPS</td>
                    <td>Charger</td>
                    <td>Docking Station</td>
                    <td>Monitor 1</td>
                    <td>Monitor 2</td>
                    <td>Condition</td>
                    <td>Mac Address</td>
                    <td>Serial Number</td>
                    <td>Asset Tag</td>
                    <td>Asset Condition</td>
                    <td>Active Directory</td>
                    <td>Recovery Key</td>
                </tr>
                <?php
                    $status = $_POST['status'];
                  //  $department = $_POST['department'];
                    $type = $_POST['type'];
                    $model = $_POST['model'];
                    $country = $_POST['country'];

                    
                    $search_query = "SELECT * FROM tbl_assetmain";
                    

                    $query_cond = "";
                   
                    if($status !="ALL") {
                            $query_cond .= " tbl_assetmain.assetStatus='$status' and tbl_assetmain.department!='Solar' and tbl_assetmain.activeDirectory='Active'";
                        
                    }
                   /* if($department !="ALL") {
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_assetmainlogs.department='$department'";
                    }*/

                    if($type !="ALL") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_assetmain.type='$type'";
                        
                    }

                    if($model !="ALL") {

                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_assetmain.model like '%$model%'";
                      
                    }

                    if($country !="") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_assetmain.country='$country'";
                        
                    }

                    if(!empty($query_cond)){
                        $query_cond = " Where ".$query_cond;
                        $search_query=$search_query.$query_cond;
                    }
                  
                    $result = mysqli_query($con,$search_query);
                    
                    while($row=mysqli_fetch_assoc($result))
                    {
                        if($row['assetStatus']=='In Use')
                        {
                            $search_query2 = "SELECT * FROM tbl_assetmainlogs,tbl_assetmain where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmainlogs.status='active' and tbl_assetmain.assetStatus='".$row['assetStatus']."' and tbl_assetmain.id='".$row['id']."'";
                                $result2 = mysqli_query($con,$search_query2);
                                $row2=mysqli_fetch_assoc($result2);

                                $numrows=mysqli_num_rows($result2);
                                if($numrows<>0)
                                {
                                echo "<tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['type']."</td>
                                    <td>".$row2['computerName']." </td>
                                    <td>".$row2['igg']."</td>
                                    <td>".$row2['assignedTo']."</td>
                                    <td>".$row['model']."</td>
                                    <td>".$row['warranty']."</td>
                                    <td>".$row['os']."</td>
                                    <td>".$row['osVersion']."</td>
                                    <td>".$row['assetStatus']."</td>
                                    <td>".$row2['startDate']."</td>
                                    <td>".$row2['department']."</td>
                                    <td>".$row2['location']."</td>
                                    <td>".$row2['bag']."</td>
                                    <td>".$row2['keyboard']."</td>
                                    <td>".$row2['mouse']."</td>
                                    <td>".$row2['ups']."</td>
                                    <td>".$row2['charger']."</td>
                                    <td>".$row2['dockingStation']."</td>
                                    <td>".$row2['monitor1']."</td>
                                    <td>".$row2['monitor2']."</td>
                                    <td>".$row['assetCondition']."</td>
                                    <td>".$row['macAddress']."</td>
                                    <td>".$row['serial']."</td>
                                    <td>".$row['assetTag']."</td>
                                    <td>".$row['assetCondition']."</td>
                                    <td>".$row['activeDirectory']."</td>
                                    <td>".$row['recoveryKey']."</td>
                                </tr>";
                                }
                                else
                                {
                                    echo "<tr>
                                        <td>".$row['id']."</td>
                                        <td>".$row['type']."</td>
                                        <td>".$row['computerName']."</td>
                                        <td></td>
                                        <td></td>
                                        <td>".$row['model']."</td>
                                        <td>".$row['warranty']."</td>
                                        <td>".$row['os']."</td>
                                        <td>".$row['osVersion']."</td>
                                        <td>".$row['assetStatus']."</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>".$row['assetCondition']."</td>
                                        <td>".$row['macAddress']."</td>
                                        <td>".$row['serial']."</td>
                                        <td>".$row['assetTag']."</td>
                                        <td>".$row['activeDirectory']."</td>
                                        <td>".$row['recoveryKey']."</td>
                                    </tr>"; 
                                }
                        }
                        else
                        {
                            echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['type']."</td>
                            <td>".$row['computerName']."</td>
                            <td></td>
                            <td></td>
                            <td>".$row['model']."</td>
                            <td>".$row['warranty']."</td>
                            <td>".$row['os']."</td>
                            <td>".$row['osVersion']."</td>
                            <td>".$row['assetStatus']."</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>".$row['assetCondition']."</td>
                            <td>".$row['macAddress']."</td>
                            <td>".$row['serial']."</td>
                            <td>".$row['assetTag']."</td>
                            <td>".$row['activeDirectory']."</td>
                            <td>".$row['recoveryKey']."</td>
                        </tr>";
                        }
                    }
                    
                ?>
            </table>
        <?php
        }
        elseif($_POST['btnExport']=='mobileDevices')
        {
        ?>
            <table border='1'>
                <tr>
                    <td>ID</td>
                    <td>Type</td>
                    <td>Mobile Number</td>
                    <td>IGG</td>
                    <td>Full Name</td>
                    <td>Brand</td>
                    <td>Model</td>
                    <td>Unit Status</td>
                    <td>Date Assigned</td>
                    <td>Department</td>
                    <td>Earphones</td>
                    <td>Charger</td>
                    <td>OACondtion</td>
                    <td>Provider</td>
                    <td>Amount</td>
                    <td>IMEI</td>
                    <td>SerialNo</td>
                </tr>

                <?php
                $statusMobile = $_POST['statusMobile'];
                $modelMobile = $_POST['modelMobile'];
                $brandMobile = $_POST['brandMobile'];
                $country=$_POST['country'];
                
                $search_queryMob = "SELECT * FROM tbl_assetmobile";
                $query_condMob = "";

                if($statusMobile !="ALL") {
                    $query_condMob .= " tbl_assetmobile.assetStatus='$statusMobile'";
                }

                if($modelMobile !="ALL") {
                    if(!empty($query_condMob)){
                        $query_condMob .= " AND ";
                    }

                    $query_condMob .= " tbl_assetmobile.model='$modelMobile'";
                }

                if($brandMobile !="ALL") {
                
                    if(!empty($query_condMob)){
                        $query_condMob .= " AND ";
                    }

                    $query_condMob .= " tbl_assetmobile.brand='$brandMobile'";
                    
                }

                if($country !="") {
                       
                    if(!empty($query_condMob)){
                        $query_condMob .= " AND ";
                    }

                    $query_condMob .= " tbl_assetmobile.country='$country'";
                    
                }
               

                if(!empty($query_condMob)){
                    $query_condMob = " Where ".$query_condMob;
                    $search_queryMob=$search_queryMob.$query_condMob;
                }
                $resultMob = mysqli_query($con,$search_queryMob);

                while($row=mysqli_fetch_assoc($resultMob))
                {
                 
                    if($row['type']=='MOBILE')
                            {
                                $query2=mysqli_query($con,"SELECT * from tbl_assetmobilelogs where imei='".$row['imei']."' and status='active' and country='".$_POST['country']."'");
                            }
                            elseif($row['type']=='SIM ONLY')
                            {
                                $query2=mysqli_query($con,"SELECT * from tbl_assetmobilelogs where mobileNumber='".$row['mobileNumber']."' and status='active' and country='".$_POST['country']."'");
                            }
                            if(($numrows=mysqli_num_rows($query2))<>0)
                            {
                                $row2=mysqli_fetch_assoc($query2);

                                echo "<tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['type']."</td>
                                    <td>".$row['mobileNumber']."</td>
                                    <td>".$row2['igg']."</td>
                                    <td>".$row2['assignedTo']."</td>
                                    <td>".$row['brand']."</td>
                                    <td>".$row['model']."</td>
                                    <td>".$row['assetStatus']."</td>
                                    <td>".$row2['startDate']."</td>
                                    <td>".$row2['department']."</td>
                                    <td>".$row2['earphone']."</td>
                                    <td>".$row2['charger']."</td>
                                    <td>".$row['assetCondition']."</td>
                                    <td>".$row['provider']."</td>
                                    <td>".$row['amount']."</td>
                                    <td>".$row['imei']."</td>
                                    <td>".$row['serial']."</td>
                                </tr>";
                            }
                            else
                            {
                                echo "<tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['type']."</td>
                                    <td>".$row['mobileNumber']."</td>
                                    <td></td>
                                    <td></td>
                                    <td>".$row['brand']."</td>
                                    <td>".$row['model']."</td>
                                    <td>".$row['assetStatus']."</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>".$row['assetCondition']."</td>
                                    <td>".$row['provider']."</td>
                                    <td>".$row['amount']."</td>
                                    <td>".$row['imei']."</td>
                                    <td>".$row['serial']."</td>
                                </tr>";
                            }
                }
                ?>
            </table>
        <?php
        }
        elseif($_POST['btnExport']=='OtherAssets')
        {
        ?>
            <table border='1'>
            <?php
            if($_POST['category']=='External Storage' || $_POST['category']=='Others' || $_POST['category']=='Telephony')
            {
            ?>
                <tr>
                    <td>#</td>
                    <td>Asset Code</td>
                    <td>Category</td>
                    <td>Type</td>
                    <td>Model</td>
                    <td>Serial No.</td>
                    <td>Condition</td>
                    <td>Assigned To</td>
                    <td>IGG</td>
                    <td>Department</td>
                    <td>Location</td>
                    <td>Remarks</td>
                    <td>ByUser</td>
                    <td>LastChanged</td>
                </tr>
            <?php
            }
            elseif($_POST['category']=='Routers' || $_POST['category']=='Servers' || $_POST['category']=='Network Devices' || $_POST['category']=='Printers')
            {
            ?>
                <tr>
                    <td>#</td>
                    <td>Asset Code</td>
                    <td>Category</td>
                    <td>Type</td>
                    <td>Model</td>
                    <td>Serial No.</td>
                    <td>Condition</td>
                    <td>Assigned To</td>
                    <td>IGG</td>
                    <td>Department</td>
                    <td>Location</td>
                    <td>Remarks</td>

                    <td>Operating System</td>
                    <td>Name</td>
                    <td>Server Name</td>
                    <td>Domain Name</td>
                    <td>Location</td>
                    <td>Local Interface</td>
                    <td>DNS Suffix</td>
                    <td>ILO</td>
                    <td>Role</td>
                    <td>IP Address</td>
                    <td>MAC Address</td>
                    <td>Data Port Number</td>
                    <td>Brand</td>
                    <td>Vendor</td>
                    <td>Purchased Date</td>
                    <td>Warranty Start Date</td>
                    <td>Warranty End Date</td>
                    <td>Server Role</td>
                    <td>Database</td>
                    <td>Asset Type</td>
                    <td>Host Physical Server</td>
                    <td>ByUser</td>
                    <td>LastChanged</td>
                </tr>
            <?php
            }
            
                $status = $_POST['statusOtherAsset'];
                $category = $_POST['category'];
                 $country=$_POST['country'];

                $search_query = "SELECT tbl_assetothers.*,tbl_assetotherslogs.* FROM tbl_assetothers,tbl_assetotherslogs";
                $query_cond = "";

                if($status !="ALL") {
                    if(!empty($query_cond)){
                        $query_cond .= " AND ";
                    }
                    $query_cond .= " tbl_assetothers.assetStatus='$status'";
                }
              
                if($category !="ALL") {
                    if(!empty($query_cond)){
                        $query_cond .= " AND ";
                    }

                    $query_cond .= " tbl_assetothers.category='$category'";
                }

                if($country !="") {
                       
                    if(!empty($query_cond)){
                        $query_cond .= " AND ";
                    }

                    $query_cond .= " tbl_assetotherslogs.country='$country'";
                    
                }
               

                if(!empty($query_cond)){
                    $query_cond = " Where tbl_assetothers.assetCode=tbl_assetotherslogs.assetCode and ".$query_cond;
                    $search_query=$search_query.$query_cond;
                }
                $result = mysqli_query($con,$search_query);

                while($row=mysqli_fetch_assoc($result))
                {
                    if($_POST['category']=='External Storage' || $_POST['category']=='Others' || $_POST['category']=='Telephony')
                    {
                    
                        echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['assetCode']."</td>
                            <td>".$row['category']."</td>
                            <td>".$row['type']."</td>
                            <td>".$row['model']."</td>
                            <td>".$row['serial']."</td>
                            <td>".$row['assetCondition']."</td>
                            <td>".$row['assignedTo']."</td>
                            <td>".$row['igg']."</td>
                            <td>".$row['department']."</td>
                            <td>".$row['location']."</td>
                            <td>".$row['remarks']."</td>
                            <td>".$row['byUser']."</td>
                            <td>".$row['lastChanged']."</td>
                        </tr>";
                    }
                    elseif($_POST['category']=='Routers' || $_POST['category']=='Servers' || $_POST['category']=='Network Devices' || $_POST['category']=='Printers')
                    {
                   
                         echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['assetCode']."</td>
                            <td>".$row['category']."</td>
                            <td>".$row['type']."</td>
                            <td>".$row['model']."</td>
                            <td>".$row['serial']."</td>
                            <td>".$row['assetCondition']."</td>
                            <td>".$row['assignedTo']."</td>
                            <td>".$row['igg']."</td>
                            <td>".$row['department']."</td>
                            <td>".$row['location']."</td>
                            <td>".$row['remarks']."</td>
                    
                            <td>".$row['os']."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['serverName']."</td>
                            <td>".$row['domainName']."</td>
                            <td>".$row['location']."</td>
                            <td>".$row['localInterface']."</td>
                            <td>".$row['dnsSuffix']."</td>
                            <td>".$row['ilo']."</td>
                            <td>".$row['role']."</td>
                            <td>".$row['ipAddress']."</td>
                            <td>".$row['macAddress']."</td>
                            <td>".$row['dataPortNumber']."</td>
                            <td>".$row['brand']."</td>
                            <td>".$row['vendor']."</td>
                            <td>".$row['purchasedDate']."</td>
                            <td>".$row['warrantyStartDate']."</td>
                            <td>".$row['warrantyEndDate']."</td>
                            <td>".$row['serverRole']."</td>
                            <td>".$row['databaseName']."</td>
                            <td>".$row['assetType']."</td>
                            <td>".$row['hostPhysicalServer']."</td>
                            <td>".$row['byUser']."</td>
                            <td>".$row['lastChanged']."</td>
                        </tr>";
                    }
                }
                ?>
            </table>
        <?php
        }
        elseif($_POST['btnExport']=='Applications')
        {
        ?>
                <table border='1'>
                <tr>
                    <td>ID</td>
                    <td>Application Name</td>
                    <td>Name of the user</td>
                    <td>Username</td>
                    <td>Role</td>
                    <td>Start of Access</td>
                    <td>Last Update</td>
                    <td>Description</td>
                    <td>Status</td>
                </tr>
                <?php
                    $applicationName = $_POST['applicationName'];
                    $statusApplication = $_POST['statusApplication'];
                    $country = $_POST['country'];
                    //get application details
                    $get=mysqli_query($con,"SELECT * FROM tbl_applicationlist where application='".$applicationName."'");
                        $row_get=mysqli_fetch_assoc($get);

                        if($row_get['db']!='tisamidb')
                        {
                            $search_query = "SELECT * FROM ".$row_get['table']."";
                        }
                        else
                        {
                            $search_query = "SELECT * FROM tbl_application";
                        }


                    
                    $query_cond = "";
                   
                    if($statusApplication !="ALL") {
                        $query_cond .= " status='$statusApplication'";
                    }
                  
                  
                    if($country !="") {
                        if($row_get['db']=='tisamidb')
                        {
                            if(!empty($query_cond)){
                                $query_cond .= " AND ";
                            }

                            $query_cond .= " country='$country'";
                        }
                        
                    }

                   
                  
                    if($row_get['db']!='')
                    {
                        if(!empty($query_cond)){
                            $query_cond = " Where ".$query_cond;
                            $search_query=$search_query.$query_cond;
                        }

                        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                        $temp_conn = mysqli_connect("localhost", "root", "", $row_get['db']);

                        $result = mysqli_query($temp_conn,$search_query);
                    }
                    else
                    {
                        if(!empty($query_cond)){
                            $query_cond = " Where applicationName='$applicationName' AND ".$query_cond;
                            $search_query=$search_query.$query_cond;
                        }

                        $result = mysqli_query($con,$search_query);
                    }
                   
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$applicationName."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['login']."</td>
                            <td>".$row['role']."</td>
                            <td>".$row['datetime']."</td>
                            <td>".$row['lastChanged']."</td>
                            <td>".$row['remarks']."</td>
                            <td>".$row['status']."</td>
                        </tr>";

                    }
                    
                ?>
            </table>
        <?php
        }
        elseif($_POST['btnExport']=='stationAssets')
        {
            include_once('../config/config_stadadb.php');
        ?>
                <table border='1'>
                <tr>
                    <td>Account Code</td>
                    <td>Station Name</td>
                    <td>Item</td>
                    <td>Brand</td>
                    <td>Model</td>
                    <td>Serial Number</td>
                    <td>DSL</td>
                    <td>RAM</td>
                    <td>HDD</td>
                    <td>Remote App</td>
                    <td>OS</td>
                    <td>POS</td>
                    <td>LastChanged</td>
                    <td>ByUser</td>
                </tr>
                <?php
                    $accountCode = $_POST['accountCode'];
                    $item = $_POST['item'];
                    $brand = $_POST['brand'];
                    $model = $_POST['model'];
                    $os = $_POST['os'];
                    $pos = $_POST['pos'];
                    $country = $_POST['country'];

                    $search_query = "SELECT tbl_inventory_it.*,tbl_station.* FROM tbl_inventory_it,tbl_station";
                    $query_cond = "";
                   
                    if($accountCode !="ALL") {
                        $query_cond .= " tbl_inventory_it.accountCode='$accountCode'";
                    }
                  
                    if($item !="ALL") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_inventory_it.item='$item'";
                        
                    }

                    if($model !="ALL") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_inventory_it.model='$model'";
                        
                    }

                    if($os !="ALL") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_inventory_it.os='$os'";
                        
                    }

                    if($pos !="ALL") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_inventory_it.pos='$pos'";
                        
                    }

                    if($brand !="ALL") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_inventory_it.brand='$brand'";
                        
                    }
                   

                   

                    if(!empty($query_cond)){
                        $query_cond = " Where tbl_inventory_it.accountCode=tbl_station.accountCode and ".$query_cond;
                        $search_query=$search_query.$query_cond;
                    }
                    $result = mysqli_query($con,$search_query);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo "<tr>
                            <td>".$row['accountCode']."</td>
                            <td>".$row['stationName']."</td>
                            <td>".$row['item']."</td>
                            <td>".$row['brand']."</td>
                            <td>".$row['model']."</td>
                            <td>".$row['serialNumber']."</td>
                            <td>".$row['dsl']."</td>
                            <td>".$row['ram']."</td>
                            <td>".$row['hdd']."</td>
                            <td>".$row['remoteApp']."</td>
                            <td>".$row['os']."</td>
                            <td>".$row['pos']."</td>
                            <td>".$row['lastChanged']."</td>
                            <td>".$row['byUser']."</td>
                        </tr>";
                    }
                    
                ?>
            </table>
        <?php
        }
        elseif($_POST['btnExport']=='cmdb')
        {
        ?>
            <table border='1'>
                <tr>
                    <td>Unique ID</td>
                    <td>Original task</td>
                    <td>Name</td>
                    <td>Hardware model</td>
                    <td>Company</td>
                    <td>Category</td>
                    <td>Subcategory</td>
                    <td>Install status</td>
                    <td>Sub-Status</td>
                    <td>Location</td>
                    <td>Support group</td>
                    <td>Used by</td>
                    <td>Description</td>
                    <td>DNS Domain</td>
                    <td>Operating System</td>
                    <td>OS Version</td>
                    <td>OS Service Pack</td>
                    <td>Master</td>
                    <td>Disk space (GB)</td>
                    <td>Video card</td>
                    <td>Total physical memory</td>
                    <td>Memory Composition</td>
                    <td>Processor</td>
                    <td>CPU count</td>
                    <td>CPU type</td>
                    <td>CPU core count</td>
                    <td>CPU speed (MHz)</td>
                    <td>CPU manufacturer</td>
                    <td>Desk number</td>
                    <td>Project number</td>
                    <td>TAG Number</td>
                    <td>Supplier</td>
                    <td>Serial number</td>
                    <td>Remote Access</td>
                    <td>Budget Codes</td>
                    <td>Cost center</td>
                    <td>GL account</td>
                    <td>Invoice number</td>
                    <td>Order number</td>
                    <td>feature</td>
                    <td>Purchase cost</td>
                    <td>Install Date</td>
                    <td>Start date</td>
                    <td>Return Date</td>
                    <td>Disposal Date</td>
                    <td>Delivery Date</td>
                    <td>Contract start date</td>
                    <td>Contract end date</td>
                    <td>Inventory audit date</td>
                    <td>Warranty expiration</td>
                    <td>Purchased</td>
                    <td>CI Original Location</td>
                    <td>No SCCM update</td>
                    <td>Admin Exception</td>
                    <td>Local Account Exception</td>
                    <td>Hard Exception</td>
                    <td>Out Field Exception</td>
                    <td>Out Network Exception</td>
                    <td>Ip Fixed Exception</td>
                    <td>Installation Mode Exception</td>
                    <td>Noapp Exception</td>
                    <td>Exception No Ie Startup</td>
                    <td>Secure P4 Office Exception</td>
                    <td>Smartpass Exception</td>
                    <td>Soft Exception</td>
                    <td>Step2007 Groups Incoherence Exception</td>
                    <td>Usanep Exception</td>
                    <td>Standby User Exception</td>
                    <td>Owned by</td>
                    <td>Owned by department</td>
                    <td>Owned by group</td>
                    <td>Owned by user</td>
                </tr>
                <?php
                    $status = $_POST['status'];
                     $type = $_POST['type'];
                    $model = $_POST['model'];
                    $country = $_POST['country'];

                    $search_query = "SELECT tbl_assetmain.*,tbl_assetmainlogs.* FROM tbl_assetmain,tbl_assetmainlogs";
                    $query_cond = "";
                   
                    if($status !="ALL") {
                        $query_cond .= " tbl_assetmain.assetStatus='$status'";
                    }

                    if($type !="ALL") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_assetmain.type='$type'";
                        
                    }

                    if($model !="ALL") {

                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_assetmain.model='$model'";
                      
                    }

                   
                    if($country !="") {
                       
                        if(!empty($query_cond)){
                            $query_cond .= " AND ";
                        }

                        $query_cond .= " tbl_assetmain.country='$country'";
                        
                    }

                    if(!empty($query_cond)){
                        $query_cond = " Where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmain.activeDirectory='Active' and ".$query_cond." group by tbl_assetmain.serial";
                        $search_query=$search_query.$query_cond;

                    }
                  
                    $result = mysqli_query($con,$search_query);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo "<tr>
                            <td></td>
                            <td></td>
                            <td>".$row['computerName']."</td>
                            <td>".$row['model']."</td>
                            <td>MS</td>
                            <td></td>
                            <td></td>
                            <td>".$row['assetStatus']."</td>
                            <td>".$row['assetCondition']."</td>
                            <td>TAGUIG CITY-11TH CORPORATE CTR(PHL)</td>
                            <td>LOCAL_BON.APAC_MS</td>
                            <td>".$row['assignedTo']."</td>
                            <td>".$row['remarks']."</td>
                            <td>main.glb.corp.local</td>
                            <td>".$row['os']."</td>
                            <td>".$row['osVersion']."</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>".$row['supplier']."</td>
                            <td>".$row['serial']."</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>".$row['startDate']."</td>
                            <td>".$row['endDate']."</td>
                            <td>".$row['disposalDate']."</td>
                            <td>".$row['deliveryDate']."</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>".$row['department']."</td>
                            <td></td>
                            <td>".$row['assignedTo']."</td>
                        </tr>";
                    }
                    
                ?>
            </table>
        <?php
        }
        ?>
    </body>
</html>