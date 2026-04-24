<?php
 include('../config/config.php');
?>
<html>
    <title>Desktop Asset Return Form</title>
    <!-- Meta Declaration 
    <meta http-equiv="refresh" content="1"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Import -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Font Import -->
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Condensed&display=swap" rel="stylesheet">

    <!-- -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <head>
 
        <style>
        
        @media print {
            @media print { @page { margin: 0; } 
   body { margin: 1.6cm; } }
        }
        
        </style>

        <script type="text/javascript">
            
            window.print();
            //window.onfocus=function(){ window.close();}
            setTimeout(window.close, 500);

        </script>

    </head>

    <body>

        <table style="width:100%; text-align:center;">
                <tr>
                    <td width=20% rowspan=2><img src="../assets/images/logo.png" style="margin-right:-70px;" width=auto height=60px>
                    <td width=50% rowspan=2 style="font-family:'Encode Sans Expanded'; font-weight:600; font-size:4vw;"> 
                    /&nbsp;&nbsp;IT Asset Return Form
                    </td>
                </tr>
        </table>

        <?php
        $query=mysqli_query($con,"SELECT tbl_assetmain.*,tbl_assetmainlogs.* from tbl_assetmain,tbl_assetmainlogs where tbl_assetmain.serial=tbl_assetmainlogs.serial and tbl_assetmain.assetStatus='In Use' and tbl_assetmainlogs.status='active' and tbl_assetmainlogs.id='".$_GET['id']."'");
            $row=mysqli_fetch_assoc($query);
        ?>
        <table width=100% style="margin-top:20px; margin-bottom:20px;">
            <tr>
                <td width=100% colspan=4  style="padding-bottom:10px;">
                    <b>Asset Owner Details</b>
                </td>
            </tr>   
            <tr>
                <td width=15% style="padding-bottom:3px;">
                Name:
                </td>
                <td width=35% style="padding-bottom:3px;">
                <?php echo $row["assignedTo"]; ?>
                </td>
                <td width=15% style="padding-bottom:3px;"> 
                IGG:
                </td>
                <td width=35% style="padding-bottom:3px;">
                <?php echo $row["igg"]; ?>
                </td>
            </tr>
        </table>

    <?php


    $Serial = $row['serial'];
    
    echo "
        <table width=100% style=\"margin-top:20px; margin-bottom:20px;\">
            <tr>
                <td width=100% colspan=4 style=\"padding-bottom:10px;\">
                    <b>";
                    
                if($row["type"] == "Laptop"){
                    echo "Laptop Assignment Details";

                }else if($row["type"] == "Desktop"){
                    echo "Desktop Assignment Details";

                }else if($row["type"] == "Monitor"){
                    echo "Monitor Assignment Details";

                }else{
                    echo "Asset Assignment Details";
                }
                    
    echo"</b>
                </td>
            </tr>   
            <tr>
                <td width=15% style=\"padding-bottom:3px;\">
                Type:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
                ";
                echo $row["type"];
                echo "
                </td>
                <td width=15% style=\"padding-bottom:3px;\"> 
                Serial No.:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
                ";
                echo $row["serial"];
                echo "
                </td>
            </tr>
            <tr>
                <td width=15% style=\"padding-bottom:3px;\">
                Brand:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
                ";
                echo $row["brand"];
                echo "
                </td>
                <td width=15% style=\"padding-bottom:3px;\"> 
                Asset Tag:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
                ";
                echo $row["assetTag"];
                echo "
                </td>
            </tr>
            <tr>
                <td width=15% style=\"padding-bottom:3px;\">
                Model:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
                ";
                echo $row["model"];
                echo "
                </td>
                <td width=15% style=\"padding-bottom:3px;\"> 
                Mac:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
                ";
                echo $row["macAddress"];
                echo "
                </td>
            </tr>
        </table>

        <table width=100% style=\"margin-top:20px; margin-bottom:20px;\">
            <tr>
                <td width=100% colspan=6 style=\"padding-bottom:10px;\">
                    <b>";
                    
                    if($row["type"] == "Laptop"){
                        echo "Laptop Peripherals Assignment Details";
    
                    }else if($row["type"] == "Desktop"){
                        echo "Desktop Peripherals Assignment Details";
    
                    }else if($row["type"] == "Monitor"){
                        echo "Monitor Peripherals Assignment Details";
    
                    }else{
                        echo "Asset Peripherals Assignment Details";
                    }
                        
        echo"</b>
                </td>
            </tr>   
            <tr>
                <td width=14% style=\"padding-bottom:3px;\">
                Keyboard:
                </td>
                <td width=19% style=\"padding-bottom:3px;\">
                ";
                echo $row["keyboard"];
                echo "
                </td>
                <td width=14%  style=\"padding-bottom:3px;\"> 
                Mouse:
                </td>
                <td width=19%  style=\"padding-bottom:3px;\">
                ";
                echo $row["mouse"];
                echo "
                </td>
                <td width=14%  style=\"padding-bottom:3px;\"> 
                Charger:
                </td>
                <td width=19% style=\"padding-bottom:3px;\">
                ";
                echo $row["charger"];
                echo "
                </td>
            </tr>
            <tr>
                <td style=\"padding-bottom:3px;\">
                Bag:
                </td>
                <td style=\"padding-bottom:3px;\">
                ";
                echo $row["bag"];
                echo "
                </td>
                <td style=\"padding-bottom:3px;\"> 
                UPS:
                </td>
                <td style=\"padding-bottom:3px;\">
                ";
                echo $row["ups"];
                echo "
                </td>
                <td  style=\"padding-bottom:3px;\"> 
                Docking:
                </td>
                <td style=\"padding-bottom:3px;\">
                ";
                echo $row["dockingStation"];
                echo "
                </td>
            </tr>
            <tr>
                <td style=\"padding-bottom:3px;\">
                Monitor 1:
                </td>
                <td style=\"padding-bottom:3px;\">
                ";
                echo $row["monitor1"];
                echo "
                </td>
                <td style=\"padding-bottom:3px;\"> 
                Monitor 2:
                </td>
                <td style=\"padding-bottom:3px;\">
                ";
                echo $row["monitor2"];
                echo "
                </td>
                <td style=\"padding-bottom:3px;\"> 
                Others:
                </td>
                <td style=\"padding-bottom:3px;\">
                
                </td>
            </tr>
        </table>


    ";


    ?>
    <br><br>
        <table width=100%>
                    <tr>
                        <td width=20% style="border: 1px solid;">Notes / Remarks:
                        </td>
                    </tr>   
                    <tr>
                        <td width=20% height=150px style="border: 1px solid;">
                        </td>
                    </tr>  
        </table>

    <br>
        <table width=100%>
                <tr style="font-size:14.5px;">
                    <td width=33%>Returned By (Returnee)
                    <td width=33%>Checked By (IT Personnel)
                    <td width=33%>Approved By (IT Manager)
                </tr>
                <tr>
                    <td style="border:1px solid" height=120px> 
                    <td style="border:1px solid">
                    <td style="border:1px solid">
                </tr>
                <tr style="font-size:16px;">
                    <td colspan=2><i>**Signature over printed name and date</i>
                    <td>
                </tr> 
        </table>

    </body>
</html>