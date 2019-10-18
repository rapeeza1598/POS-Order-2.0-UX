<?php
$data = $this->receipt_model->get_receipt_master_id($receipt_master_id_pri)->row();
$data_detail = $this->receipt_model->get_receipt_detail(null,$receipt_master_id_pri,$limit,$start);
$shop = $this->receipt_model->get_shop($data->shop_id_pri)->row();
$image = $this->receipt_model->get_image($shop->image_id)->row()->image_name;
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">   
        <style>
            @page  {
                /*margin: 0.25in 0.25in 0.5in 0.25in;*/
            }
            td{                  
                /*border: 1px solid black;*/
                /*vertical-align: central;*/
                padding: 0mm 0mm 0mm 0mm;
            }
            th{
                border: 1px solid black;
                padding: 0mm 0mm 0mm 0mm;
            }
            p{
                font-size: 13pt;
            }
        </style>
    </head>   
    <body>
        <table height="" width="190mm" style="width: 100%; margin-bottom: 0.05in; border: 1px solid black; border-collapse: collapse;"> 
            <tr>
                <th height="5mm" width="28mm" style="vertical-align: bottom"> 
                    <p><?php echo 'รหัสสินค้า' ?></p>
                </th>
                <th width="60mm">
                    <p><?php echo 'รายการ' ?></p>
                </th>
                <th width="16mm">
                    <p><?php echo 'จำนวน' ?></p>
                </th>
                <th width="20mm">
                    <p><?php echo 'หน่วย' ?></p>
                </th>
                <th width="22mm">
                    <p><?php echo 'ราคา/หน่วย' ?></p>
                </th>
                <th width="22mm">
                    <p><?php echo 'ส่วนลด' ?></p>
                </th>
                <th width="22mm">
                    <p><?php echo 'จำนวนเงิน' ?></p>
                </th>
            </tr>
            <?php  $num_detail = $data_detail->num_rows();
            if($num_detail > 0){
                $num = $limit - $num_detail;
                foreach ($data_detail->result() as $datas){ ?>
                    <tr>
                    <td style="padding-left:10px;" height="5mm">
                        <p><?php echo $datas->product_id ?></p>
                    </td>
                    <td style="padding-left:10px;">
                        <p><?php echo $this->mics->ShortenTitle($datas->product_name,30) ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo $datas->product_amount ?></p>
                    </td>
                    <td style="text-align: center">
                        <p><?php echo $datas->product_unit ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo $datas->product_price ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo $datas->product_save ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo $datas->product_price_sum ?></p>
                    </td>
                </tr>
                <?php }
            }else{
                $num = $limit;
            }
            for($i = 1; $i <= $num; $i++){ ?>
                <tr>
                    <td style="padding-left:10px;" height="5mm">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-left:10px;">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="text-align: center">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right:10px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <table style="width: 100%; margin-bottom: 0.05in; border: 1px solid black; border-collapse: collapse;">
            <tr style="border: 0">
                <td style="padding-left:10px; font-weight: bold;" height="5mm">
                    <p><?php echo 'รวมเงิน' ?></p>
                </td>
                <td style="padding-right:10px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_product_sum,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
                <td style="padding-left:10px; font-weight: bold;">
                    <p><?php echo 'ส่วนลดการค้า' ?></p>
                </td>
                <td style="padding-right:10px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo $data->save; ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
                <td style="padding-left:10px; font-weight: bold;">
                    <p><?php echo 'เงินหลังหักส่วนลด' ?></p>
                </td>
                <td style="padding-right:10px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_befor_tax,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
                <td style="padding-left:10px; font-weight: bold;">
                    <p><?php echo 'ภาษีมูลค่าเพิ่ม 7%' ?></p>
                </td>
                <td style="padding-right:10px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_tax,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 0">
                <td style="padding-left:10px; font-weight: bold;" height="5mm">
                    <p><?php echo 'มูลค่ารวม' ?></p>
                </td>
                <td style="padding-right:10px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
                <td style="padding-left:10px; font-weight: bold;">
                    <p><?php echo 'ค่าขนส่ง' ?></p>
                </td>
                <td style="padding-right:10px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->transport_price,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
                <td style="padding-left:10px; font-weight: bold;">
                    <p><?php echo 'ภาษีหัก ณ ที่จ่าย' ?></p>
                </td>
                <td style="padding-right:10px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo $data->withholding_tax; ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
                <td rowspan="2" style="padding-left:10px; font-weight: bold; vertical-align: bottom">
                    <p><?php echo 'จำนวนเงินชำระสุทธิ' ?></p>
                </td>
                <td rowspan="2" style="padding-right:10px; font-weight: bold; vertical-align: bottom; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_sum_pay,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 0">
                <td height="5mm" colspan="6" style="font-weight: bold; text-align: center;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo '('.$this->mics->ThaiBahtConversion($data->price_sum_pay).')'; ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </body>
</html>