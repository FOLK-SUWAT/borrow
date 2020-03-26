<?php // include'conf.php'
include('conf.php');
session_start(); ?>
<?php
$SQLcart = "SELECT * FROM borrow 
    INNER JOIN item ON item.item_id=borrow.item_id
    INNER JOIN mem_type ON item.department=mem_type.mem_id 
    WHERE borrow.borrow_id= '" . $_SESSION["borrow_bill"] . "'";
//แสดงรายการอุปกรณ์
$itemlist = mysqli_query($conn, $SQLcart);
?>

<?php while ($rowitemlist = mysqli_fetch_array($itemlist)) {  @$num=$num+1;?>

    <tr>
        <td><?php echo $num; ?> </td>
        <td><?php echo $rowitemlist['serail']; ?> </td>
        <td><?php echo $rowitemlist['item_name']; ?> </td>
        <?php if ($rowitemlist['status'] == 'รอการอนุมัติ') { ?>
            <form method="post" action="" name="formcomfilm" id="formcomfilm">
                <td style="color:#FFC300"><?php echo $rowitemlist['status']; ?> </td>
                <td><?php echo $rowitemlist['num_request']; ?> </td>
                <td>
                    <center> <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $rowitemlist['num_request']; ?>" style="width: 80px "></center>
                    <input type="hidden" name="item_order" id="item_order" class="form-control" value="<?php echo $rowitemlist['item_order']; ?>">
                    <input type="hidden" name="item_id" id="item_id" class="form-control" value="<?php echo $rowitemlist['item_id']; ?>">
                </td>
                <td>
                    <center> <input type="submit" name="comfilm" id="comfilm" class="btn btn-success" value="อนุมัติ" style="width: 80px" /></center>
                </td>
            </form>
            <form method="post" action="" name="formNot_allowed" id="formNot_allowed">
                <td>
                    <center> <input type="hidden" name="amount" id="amount" class="form-control" value="0" style="width: 80px "></center>
                    <input type="hidden" name="item_order" id="item_order" class="form-control" value="<?php echo $rowitemlist['item_order']; ?>">
                    <center> <input type="submit" name="Not_allowed" id="Not_allowed" class="btn btn-danger" value="ไม่อนุมัติ" style="width: 80px" /></center>
                </td>
            </form>

        <?php } else if ($rowitemlist['status'] == 'ไม่อนุมัติ') {  ?>
            <td style="color:#FF0000"><?php echo $rowitemlist['status']; ?> </td>
            <td><?php echo $rowitemlist['num_request']; ?> </td>
            <td>
                <center> <input disabled type="text" class="form-control" name="amount" id="amount" value="<?php echo $rowitemlist['amount']; ?>" style="width: 80px"></center>
            </td>
            <td colspan="2">
                <i class="fa fa-minus" style="padding-top :15px;color:red"></i>
            </td>

        <?php } else if ($rowitemlist['status'] == 'อนุมัติเรียบร้อย') { ?>
            <td style="color:#15A701"><?php echo $rowitemlist['status']; ?> </td>
            <td><?php echo $rowitemlist['num_request']; ?> </td>
            <td>
                <center> <input disabled type="text" class="form-control" name="amount" id="amount" value="<?php echo $rowitemlist['amount']; ?>" style="width: 80px"></center>
            </td>
            <td colspan="2">
                <i class="fa fa-check" style="padding-top :15px;color:green"></i>
            </td>


        <?php } ?>
    </tr>
    


<?php } ?>


<script>
    $('#formcomfilm').submit(function() {
        var item_order = $('#item_order').val();
        var amount = $('#amount').val();
        var x = 10;

        $.ajax({
            url: 'cutstock_fetch.php',
            method: "post",
            data: {
                item_order: item_order,
                amount: amount,


            },
            dataType: "text",
            success: function(data) {

            }

        });
    });
    $('#formNot_allowed').submit(function() {
        var item_order = $('#item_order').val();
        var amount = $('#amount').val();
        $.ajax({
            url: 'cutstock_fetch.php',
            method: "post",
            data: {
                item_order: item_order,
                amount: amount
            },
            dataType: "text",
            success: function(data) {

            }
        });
    });
</script>
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