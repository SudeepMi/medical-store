<!DOCTYPE html>
<html>
<head>

    <style type="text/css">
        div, p, a, li, td {
        -webkit-text-size-adjust:none;
        }
        body {
        margin:0;
        padding:0;
        }
        @media screen and (max-width: 480px) {
            table[class="tmp--container"] {
            width:360px !important;
            }
            table[class="tmp--container-padding"] {
            width:360px !important;
            padding:20px !important;
            }
            table[class="tmp--container-padding-top"] {
            width:360px !important;
            padding:20px 0 0 0 !important;
            }
            table[class="tmp--container-padding-bottom"] {
            width:360px !important;
            padding:0 0 20px 0 !important;
            }
            table[class="hero"] {
            width:100% !important;
            }
            table[class="tmp--full-width"] {
            width:100% !important;
            float:left !important;
            padding:0 !important;
            }
            td[class="tmp--full-width"] {
            width:100% !important;
            float:left !important;
            padding:0 !important;
            }
            td[class="tmp--full-width-padding-bottom"] {
            width:100% !important;
            float:left !important;
            padding:0 0 25px 0 !important;
            }
            td[class="tmp--full-width-center"] {
            width:100% !important;
            float:left !important;
            padding:10px 0 10px 0 !important;
            text-align:center !important;
            }
            table[class="wrapper-padding"] {
            padding:20px !important;
            }
            tr[class="wrapper-padding"] {
            padding:20px !important;
            }
            td[class="wrapper-padding"] {
            padding:20px !important;
            }
            td[class="col-padding-bottom"] {
            padding:0 0 25px 0 !important;
            }
            img[class="photo"] {
            width:100% !important;
            height:auto !important;
            }
            td[class="row"]{
            width:100% !important;
            }
            td[class="tmp--hide"] {
            display:none !important;
            }
        }
    </style>
    <title></title>
</head>
  
<!-- background color -->
<body bgcolor="#F3F3F4">    
    <!-- background color -->
    <table bgcolor="#F3F3F4" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <!-- preheader -->
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='tmp--container' width='600'>
                    <tr>
                        <td align='center' class='full-width-center' style='color:#4f4f4f;background-color:#ffffff;font-family:Arial, sans-serif;font-size:11px;font-style:normal;font-weight:normal;padding:10px 20px 10px 20px; padding:10px 20px 10px 20px;'
                        width='100%'>Happy Birthday {{$name}} ... </td>
                    </tr>
                </table>
              <!-- end preheader -->
            </td>
        </tr>
        <tr>
            <td>
                <!-- header -->
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='tmp--container' style='background-color:#ffffff;' width='600'>
                    <tr>
                        <td style='padding:10px 20px 10px 20px;' width='100%'>
                            <center>
                                <img src="http://truffle.local/assets/media/logo.png">
                            </center>
                        </td>
                    </tr>
                </table>
              <!-- header -->
            </td>
        </tr>
        <tr>
            <td>              
                <!-- content area: primary headline and text -->
                <table align='center' border='0' cellpadding='0' cellspacing='0' class='tmp--container' style='background-color:#ffffff;' width='600'>
                    <tr>
                        <td align='left' style='color:#4f4f4f;font-family:Arial,sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:20px;padding:20px;text-align:center;vertical-align:top;' width='100%'>
                            <span style='color:#4f4f4f;display:inline-block;font-family:Arial, sans-serif;font-size:20px;font-style:normal;font-weight:bold;padding:5px 0 10px 0;'>
                            Hello {{$name}},</span><br>
                            {{$messages}}
                            <!-- ============================== -->
                            <!-- button -->
                            <!-- ============================== -->
                            <table align='center' class='full-width' width='100%'>
                                <tr>
                                    <td align='center' style=
                                    'padding:20px 0 10px 0;'>
                                        <a href="http://truffle.ks/" style='border-radius:25px;background-color:#52aef4;border-top:12px solid #52aef4;border-bottom:12px solid #52aef4;border-right:18px solid #52aef4;border-left:18px solid #52aef4;color:#ffffff;display:inline-block;font-family:Arial, sans-serif;font-size:16px;font-style:normal;font-weight:normal;line-height:16px;text-align:center;text-decoration:none;'
                                        target='_blank'>Visit Us</a>
                                    </td>
                                </tr>
                            </table>
                          <!-- end button -->
                        </td>
                    </tr>
                </table>
                <!-- end content area: primary headline and text -->
            </td>
        </tr>
    </table>
</body>
</html>
              