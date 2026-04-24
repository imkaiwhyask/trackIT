<?php
include('../config/config.php');

// Securely fetch asset and log data using Prepared Statements
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT m.*, l.assignedTo, l.igg, l.keyboard, l.mouse, l.charger, l.bag, l.ups, l.dockingStation, l.monitor1, l.monitor2, l.remarks 
        FROM tbl_assetmain m 
        JOIN tbl_assetmainlogs l ON m.serial = l.serial 
        WHERE l.id = ? AND l.status = 'active'";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IT Asset - Return Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:600&display=swap" rel="stylesheet">
    <style>
        @media print { 
            @page { margin: 0; } 
            body { margin: 1.2cm; } 
        }
        body { font-size: 11px; font-family: 'Helvetica', 'Arial', sans-serif; color: #333; }
        
        /* Header Styling */
        .header-table { width: 100%; border-bottom: 2px solid #333; margin-bottom: 20px; }
        .logo-img { width: 180px; height: auto; }
        .form-title { 
            font-family: 'Encode Sans Expanded'; 
            font-size: 26px; 
            font-weight: 600; 
            padding-left: 15px; 
        }

        /* Section Styling */
        .section-header { 
            background-color: #f9f9f9; 
            font-weight: bold; 
            padding: 6px 10px; 
            border: 1px solid #ccc;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Entry Lines for Name and Employee Number */
        .entry-label { padding: 12px 5px 5px 5px; font-weight: bold; width: 10%; }
        .entry-line { 
            padding: 5px; 
            border-bottom: 1px solid #000; 
            width: 40%; 
            font-size: 12px;
        }

        .data-table { width: 100%; margin-bottom: 10px; }
        .data-table td { padding: 8px 5px; }
        
        /* Signature Boxes */
        .sig-box { border: 1px solid #000; height: 80px; }
        .sig-label { font-weight: bold; padding-top: 10px; }
    </style>
    <script>
        window.onload = function() {
            window.print();
            setTimeout(window.close, 500);
        };
    </script>
</head>
<body>

    <table class="header-table">
        <tr>
            <td width="200"><img src="../assets/images/logo.png" class="logo-img"></td>
            <td class="form-title">IT Asset Return Form</td>
        </tr>
    </table>

    <?php if($row): ?>
        
        <div class="section-header">Asset Owner Details</div>
        <table class="data-table">
            <tr>
                <td class="entry-label">Name:</td>
                <td class="entry-line"><?php echo htmlspecialchars($row['assignedTo']); ?></td>
                <td class="entry-label" style="padding-left:20px;">Employee Number:</td>
                <td class="entry-line"><?php echo htmlspecialchars($row['igg']); ?></td>
            </tr>
        </table>

        <div class="section-header"><?php echo htmlspecialchars($row['type']); ?> Return Details</div>
        <table class="data-table">
            <tr>
                <td width="15%"><b>Type:</b></td>
                <td width="35%"><?php echo htmlspecialchars($row['type']); ?></td>
                <td width="15%"><b>Serial No.:</b></td>
                <td width="35%"><?php echo htmlspecialchars($row['serial']); ?></td>
            </tr>
            <tr>
                <td><b>Brand:</b></td>
                <td><?php echo htmlspecialchars($row['brand']); ?></td>
                <td><b>Asset Tag:</b></td>
                <td><?php echo htmlspecialchars($row['assetTag']); ?></td>
            </tr>
            <tr>
                <td><b>Model:</b></td>
                <td><?php echo htmlspecialchars($row['model']); ?></td>
                <td><b>MAC Address:</b></td>
                <td><?php echo htmlspecialchars($row['macAddress']); ?></td>
            </tr>
        </table>

        <div class="section-header">Peripherals Status</div>
        <table class="data-table">
            <tr>
                <td width="16%"><b>Keyboard:</b></td><td width="17%"><?php echo htmlspecialchars($row['keyboard']); ?></td>
                <td width="16%"><b>Mouse:</b></td><td width="17%"><?php echo htmlspecialchars($row['mouse']); ?></td>
                <td width="16%"><b>Charger:</b></td><td width="17%"><?php echo htmlspecialchars($row['charger']); ?></td>
            </tr>
            <tr>
                <td><b>Bag:</b></td><td><?php echo htmlspecialchars($row['bag']); ?></td>
                <td><b>UPS:</b></td><td><?php echo htmlspecialchars($row['ups']); ?></td>
                <td><b>Docking:</b></td><td><?php echo htmlspecialchars($row['dockingStation']); ?></td>
            </tr>
            <tr>
                <td><b>Monitor 1:</b></td><td><?php echo htmlspecialchars($row['monitor1']); ?></td>
                <td><b>Monitor 2:</b></td><td><?php echo htmlspecialchars($row['monitor2']); ?></td>
                <td><b>Others:</b></td><td></td>
            </tr>
        </table>

    <?php endif; ?>

    <div class="section-header" style="margin-top:20px;">Notes / Remarks:</div>
    <div style="border: 1px solid #ccc; min-height: 80px; width: 100%; padding: 10px;">
        <?php echo nl2br(htmlspecialchars($row['remarks'] ?? '')); ?>
    </div>

    <table width="100%" style="margin-top:30px; text-align: center;">
        <tr class="sig-label">
            <td width="33%">Returned By (Returnee)</td>
            <td width="33%">Checked By (IT Personnel)</td>
            <td width="33%">Approved By (IT Manager)</td>
        </tr>
        <tr>
            <td class="sig-box"></td>
            <td class="sig-box"></td>
            <td class="sig-box"></td>
        </tr>
        <tr>
            <td colspan="3" align="left" style="font-size: 9px; padding-top: 5px;">
                <i>** Signature over printed name and date</i>
            </td>
        </tr>
    </table>

</body>
</html>