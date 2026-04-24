<?php 
session_start();
include('../config/config.php');

// Securely fetch asset data
$serial = isset($_GET['serial']) ? $_GET['serial'] : '';
$stmt = $con->prepare("SELECT * FROM tbl_assetmain WHERE serial = ?");
$stmt->bind_param("s", $serial);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IT Asset - Assignment Form</title>
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

        /* The Entry Lines (Fix for Name and Employee Number) */
        .entry-label { padding: 12px 5px 5px 5px; font-weight: bold; width: 10%; }
        .entry-line { 
            padding: 5px; 
            border-bottom: 1px solid #000; 
            width: 40%; 
            position: relative;
        }

        .data-table { width: 100%; margin-bottom: 10px; }
        .data-table td { padding: 8px 5px; }

        /* Accountability Box */
        .accountability-box { 
            border: 1px solid #ccc; 
            padding: 15px; 
            margin-top: 15px; 
            text-align: justify;
        }
        
        /* Signature Boxes */
        .sig-box { border: 1px solid #000; height: 80px; }
        .sig-label { font-weight: bold; padding-top: 10px; }
    </style>
    <script>
        window.onload = function() {
            window.print();
            setTimeout(window.close, 3000);
        };
    </script>
</head>
<body>

    <table class="header-table">
        <tr>
            <td width="200"><img src="../assets/images/total2.png" class="logo-img"></td>
            <td class="form-title">IT Asset Assignment Form</td>
        </tr>
    </table>

    <?php if($row = $result->fetch_assoc()): ?>
        
        <div class="section-header">Asset Owner Details</div>
        <table class="data-table">
            <tr>
                <td class="entry-label">Name:</td>
                <td class="entry-line"></td> <td class="entry-label" style="padding-left:30px;">Employee Number:</td>
                <td class="entry-line"></td> </tr>
        </table>

        <div class="section-header"><?php echo htmlspecialchars($row['type']); ?> Assignment Details</div>
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

        <div class="section-header">Peripherals Assignment Details</div>
        <table width="100%" style="margin: 15px 0;">
            <tr align="center">
                <td><input type="checkbox"> Keyboard</td>
                <td><input type="checkbox"> Mouse</td>
                <td><input type="checkbox"> Monitor 1</td>
                <td><input type="checkbox"> Monitor 2</td>
                <td><input type="checkbox"> Charger/Adapter</td>
                <td><input type="checkbox"> Laptop Bag</td>
                <td><input type="checkbox"> Docking Station</td>
            </tr>
        </table>

        <div class="accountability-box">
            <p><b>IT ASSET ACCOUNTABILITY DETAILS:</b></p>
            <p style="font-size: 10.5px;">As the designated property custodian of the above-mentioned asset, I hereby acknowledge my responsibilities:</p>
            <ul style="font-size: 10.5px; padding-left: 20px;">
                <li>I shall ensure that the asset is used solely for company benefit and business purposes.</li>
                <li>I shall take all necessary precautions to prevent loss, damage, or unauthorized use of the equipment.</li>
                <li>In the event of loss or theft, I will report the incident to the IT Department and HR within 24 hours.</li>
                <li>I understand that I am liable for any damage or loss resulting from negligence or violation of company policy.</li>
                <li>I shall remain responsible to the Company until the formal transfer or return of my custodial responsibility.</li>
            </ul>
        </div>

    <?php endif; ?>

    <div class="section-header" style="margin-top:20px;">Notes / Remarks:</div>
    <div style="border: 1px solid #ccc; height: 60px; width: 100%;"></div>

    <table width="100%" style="margin-top:30px; text-align: center;">
        <tr class="sig-label">
            <td width="33%">Assigned To (Assignee)</td>
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