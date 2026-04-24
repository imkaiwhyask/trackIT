<html>
<html>
<?php 

    session_start();
    include('../config/config.php');
?>
    <title>IT Asset - Assignment Form</title>
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
   body { margin: 1cm; } }
            
        }
        
        </style>
 
        <script type="text/javascript">
            
            window.print();
            //window.onfocus=function(){ window.close();}
            setTimeout(window.close, 3000);

        </script>

    </head>

    <body onload="window.print();" style='font-size:10px'>

        <table style="width:100%; text-align:center;">
                <tr>
                    <td rowspan=2 style='padding:5px'><img src="../assets/images/total2.png" style="margin-right:-70px;" width=200px>
                    <td rowspan=2 style="padding:5px;font-family:'Encode Sans Expanded'; font-weight:600; font-size:3vw;"> 
                    | &nbsp;&nbsp;&nbsp;&nbsp;IT Asset Assignment Form
                    </td>
                </tr>
        </table>

    <?php

    $query=mysqli_query($con,"SELECT tbl_assetmain.* FROM tbl_assetmain where serial='".$_GET['serial']."'");
    while($row = mysqli_fetch_assoc($query)) 
    {

    echo "
        <table width=100% style=\"margin-top:20px; margin-bottom:20px;\">
            <tr>
                <td width=100% colspan=4  style=\"padding-bottom:10px;\">
                    <b>Asset Owner Details</b>
                </td>
            </tr>   
            <tr>
                <td width=15% style=\"padding-bottom:3px;\">
                Name:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
               
                </td>
                <td width=15% style=\"padding-bottom:3px;\"> 
                IGG:
                </td>
                <td width=35% style=\"padding-bottom:3px;\">
                
                </td>
            </tr>
        </table>

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
                    
                    if($_GET["type"] == "Laptop"){
                        echo "Laptop Peripherals Assignment Details";
    
                    }else if($_GET["type"] == "Desktop"){
                        echo "Desktop Peripherals Assignment Details";
    
                    }else if($_GET["type"] == "Monitor"){
                        echo "Monitor Peripherals Assignment Details";
    
                    }else{
                        echo "Asset Peripherals Assignment Details";
                    }
                        
        echo"</b>
                </td>
            </tr>   
            <tr>
                <td style=\"padding-bottom:3px;\"><input type='checkbox'> Keyboard</td>
                <td style=\"padding-bottom:3px;\"> <input type='checkbox'> Mouse </td>
                <td style=\"padding-bottom:3px;\"> <input type='checkbox'> Charger</td>
                <td style=\"padding-bottom:3px;\"><input type='checkbox'> Laptop Bag</td>
                <td style=\"padding-bottom:3px;\"> <input type='checkbox'> Docking</td>
            </tr>
            
        </table>
        
        <table width=100% style=\"margin-top:20px;\">
        <tr>
            <td width=100% colspan=6 style=\"padding-bottom:10px;\">
                <b>IT Asset Accountability Details</b>
                <br>
                <p style='padding:10px;text-align:justify;font-size:14px'>
                As the designated custodian of the IT assets listed in this document, I am fully responsible and accountable to the Company in ensuring that :
                    <ul style='font-size:14px'>
                        <li> The asset/s will be used solely for the benefit of the Company. </li>
                        <li> All assets have been received to be in working order and without any notable physical and functional defects that can affect its use. </li>
                        <li> The loss or damage to the assets shall be immediately reported to the Information Systems Department within 24 hours and supported by an Incident Report. </li>
                        <li> In case of loss and/or damage of the property, corresponding company policies and procedures will be followed. </li>
                        <li> In case of loss and/or damage of the property, depending on the investigation, the IT Team will provide the cost and the user will shoulder the charges through HR. </li>
                        <li> Repair or replacement of lost or damaged assets do not consider the factor of age and condition of the property. The cost is based on the value of the repair or replacement unit. </li>
                        <li> I shall remain responsible to the Company as its designated property custodian until the termination/ transfer of my custodial responsibility. </li>
                    </u>    
                </p>
            </td>
        </tr>
        </table>

    ";
    }


    ?>
        <table width=100%>
                    <tr>
                        <td width=20% style="border: 1px solid;">Notes / Remarks:
                        </td>
                    </tr>   
                    <tr>
                        <td width=20% height=100px style="border: 1px solid;">
                        </td>
                    </tr>  
        </table>

    <br>
        <table width=100%>
                <tr style="font-size:14.5px;">
                    <td width=33%>Assigned To (Assignee)
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