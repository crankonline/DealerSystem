<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
//echo "<pre>";
////var_dump($this->_ci_cached_vars);
//print_r( $data );
//echo "</pre>";
////die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Print Pdf</title>

    <style type="text/css">

        ::selection { background-color: #E13300; color: white; }
        ::-moz-selection { background-color: #E13300; color: white; }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>

<div id="container">
    <h1>Pdf Print</h1>

    <div id="body">
        <p>Test - <a href="<?php echo base_url();?>index.php/pdfcreate/test/true">page</a> | <a href="<?php echo base_url();?>index.php/pdfcreate/test">print</a></p>

        <?php foreach ($data as $invoice) {?>
            <p>Invoice id <?php echo $invoice->invoice_serial_number;?>
                | <a href="<?php echo base_url();?>index.php/pdfcreate/invoice/<?php echo $invoice->invoice_serial_number;?>/bank/true">page bank</a>
                - <a href="<?php echo base_url();?>index.php/pdfcreate/invoice/<?php echo $invoice->invoice_serial_number;?>/terminal/true">page terminal</a>
                | <a href="<?php echo base_url();?>index.php/pdfcreate/invoice/<?php echo $invoice->invoice_serial_number;?>/bank">print bank</a>
                - <a href="<?php echo base_url();?>index.php/pdfcreate/invoice/<?php echo $invoice->invoice_serial_number;?>/terminal">print terminal</a>
            </p>
        <?php } ?>

        <?php foreach ($data_req as $req_invoice) {?>
            <p>Pay Invoice id <?php echo $req_invoice->invoice_serial_number; ?> - <a href="<?php echo base_url();?>index.php/pdfcreate/payInvoice/<?php echo $req_invoice->id_requisites; ?>/true">page</a> | <a href="<?php echo base_url();?>index.php/pdfcreate/payInvoice/<?php echo $req_invoice->id_requisites; ?>">print</a></p>
        <?php } ?>
    </div>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

    <p>test2 - <a href="<?php echo base_url();?>index.php/pdfcreate/test2">link</a></p>
</div>

</body>
</html>