<?php // include'conf.php'
include('conf.php');
session_start(); ?>
<?php

$SQLcart = "SELECT * FROM borrow 
INNER JOIN item ON item.item_id=borrow.item_id
INNER JOIN mem_type ON item.department=mem_type.mem_id 
WHERE borrow.borrow_id='" . $_SESSION["borrow_bill"] . "' ";
//แสดงรายการอุปกรณ์
$itemlist = mysqli_query($conn, $SQLcart);
?>
<?php while ($rowitemlist = mysqli_fetch_array($itemlist)) {   @$num=$num+1;?>
          
    <tr>
        <td><?php echo $num; ?> </td>
        <td><?php echo $rowitemlist['item_id']; ?> </td>
        <td><?php echo $rowitemlist['item_name']; ?> </td>



        <?php if ($rowitemlist['status'] == 'อนุมัติเรียบร้อย') { ?>
            <form method="post" action="" name="formsendback" id="formsendback">
                <td style="color:#15A701"><?php echo $rowitemlist['status']; ?> </td>
                <td><?php echo $rowitemlist['amount']; ?> </td>
                <td>
                    <center> <input type="text" class="form-control" name="num_sendback" id="num_sendback" value="<?php echo $rowitemlist['num_sendback']; ?>" style="width: 80px "></center>
                    <input type="hidden" class="form-control" name="item_order" id="item_order" value="<?php echo $rowitemlist['item_order']; ?>">
                    <input type="hidden" class="form-control" name="amount" id="amount" value="<?php echo $rowitemlist['amount']; ?>">
                    <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $rowitemlist['item_id']; ?>">
                </td>
                <td>
                    <input type="submit" name="sendback" id="sendback" class="btn btn-success" value="คืนอุปกรณ์" style="margin-top:5px;width: 100px" />
                </td>
            </form>
        <?php } else if ($rowitemlist['status'] == 'คืนอุปกรณ์เรียบร้อย') { ?>
            <td style="color:#15A701"><?php echo $rowitemlist['status']; ?> </td>
            <td><?php echo $rowitemlist['amount']; ?> </td>
            <td>
                <center> <input type="text" disabled class="form-control" value="<?php echo $rowitemlist['num_sendback']; ?>" style="width: 80px "></center>
            </td>
            
            <td>
                <i class="fa fa-check" style="padding-top :15px;color:green"></i>
            </td>
            <td><?php
                $item_order=$rowitemlist['item_order'];
                $sqli="SELECT * FROM send_history WHERE item_order= $item_order";
                
                                $sqli = mysqli_query($conn, $sqli);
                                while ($rowsqli = mysqli_fetch_array($sqli)) {
                                    @$num1=$num1+1;
                                echo "คืนรอบที่ ".@$num1 . " "." จำนวน : ".$rowsqli['history']."</br> ";
                                }$num1='';
                                ?>
            </td>
        <?php } else if ($rowitemlist['status'] == 'คืนอุปกรณ์ไม่ครบ') { ?>
            <form method="post" action="" name="formsendback" id="formsendback">
                <td style="color:#FF0000"><?php echo $rowitemlist['status']; ?> </td>
                <td><?php echo $rowitemlist['amount']; ?> </td>
                <td>
                    <center> <input type="text" class="form-control" name="num_sendback" id="num_sendback" value="<?php echo $rowitemlist['num_sendback']; ?>" style="width: 80px "></center>
                    <input type="hidden" class="form-control" name="item_order" id="item_order" value="<?php echo $rowitemlist['item_order']; ?>">
                    <input type="hidden" class="form-control" name="amount" id="amount" value="<?php echo $rowitemlist['amount']; ?>">
                    <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $rowitemlist['item_id']; ?>">
                </td>
   
                <td>
                    <input type="submit" name="sendback" id="sendback" class="btn btn-success" value="คืนอุปกรณ์" style="margin-top:5px;width: 100px" />

                </td>

            </form>

            <td><?php
                $item_order=$rowitemlist['item_order'];
                $sqli="SELECT * FROM send_history WHERE item_order= $item_order";
                
                                $sqli = mysqli_query($conn, $sqli);
                                while ($rowsqli = mysqli_fetch_array($sqli)) {
                                    @$num1=$num1+1;
                                echo "คืนรอบที่ ".@$num1 . " "."จำนวน : ".$rowsqli['history']."</br> ";
                                }$num1='';
                                ?>
            </td>
        <?php } else if ($rowitemlist['status'] == 'ไม่อนุมัติ') { ?>
            <td style="color:#FF0000"><?php echo $rowitemlist['status']; ?> </td>
            <td><?php echo $rowitemlist['amount']; ?> </td>
            <td>
                <center> <input type="text" disabled class="form-control" value="<?php echo $rowitemlist['num_sendback']; ?>" style="width: 80px "></center>
            </td>
            <td>
                <i class="fa fa-minus" style="padding-top :15px;color:red"></i>
            </td>

        <?php } ?>
    </tr>
<?php } ?>

<script>
    $(window).scroll(function() {
        sessionStorage.scrollTop = $(this).scrollTop();
    });

    $(document).ready(function() {
        if (sessionStorage.scrollTop != "undefined") {
            $(window).scrollTop(sessionStorage.scrollTop);
        }
    });
</script>