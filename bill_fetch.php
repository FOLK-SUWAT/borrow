<?php
include('conf.php');
session_start();
?>
<?php
if (@$_POST["load"] == 1 or $_POST["search"] == null) {
    $sqlbill = "SELECT * FROM borrow_bill
    INNER JOIN member ON member.member_id=borrow_bill.member_id
     INNER JOIN mem_type ON mem_type.mem_id=member.department
     WHERE  borrow_department ='" . $_SESSION["department"] . "'
     ORDER BY `borrow_bill`.`borrow_id`  DESC
     ";
    $result = mysqli_query($conn, $sqlbill);
    if (mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $row['borrow_bill']; ?> </td>
                <td><?php echo $row['borrow_topic']; ?></td>
                <td><?php echo $row['mem_name']; ?> </td>
                <td><?php echo $row['mem_type_department']; ?> </td>
                <td><?php echo $row['borrow_date']; ?> </td>
                <td><?php echo $row['return_date']; ?> </td>

                <?php if ($row['status_bill'] == 'รอการอนุมัติ') { ?>
                    <td style="color:#FFA200"><?php echo $row['status_bill']; ?> </td>
                    <td >
                        <form method="post" action="cutstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-info" value="ดำเนินการ" />
                        </form>
                    </td>
                    <td >
                    <form id="ins_del" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit"class="btn btn-danger" value="ลบรายการ" onclick="return confirm('กดปุ่ม OK เพื่อยืนยันการลบหมายเลขใบยืม <?php echo $row['borrow_bill']; ?> ')"/>
                        </form>
                    </td>

                <?php } else if ($row['status_bill'] == 'อนุมัติ') { ?>
                    <td style="color:#15A701"><?php echo $row['status_bill']; ?> </td>
                    <td>
                        <form method="post" action="addstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-success" value="คืนอุปกรณ์" />
                        </form>
                    </td>
                    <td>
                        <form id="ins_rec" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit"class="btn btn-warning" value="ยกเลิกอนุมัติ" />
                        </form>
                    </td>
                <?php } else if ($row['status_bill'] == 'คืนอุปกรณ์ไม่ครบ') { ?>
                    <td style="color:#F70505"><?php echo $row['status_bill']; ?> </td>
                    <td colspan="2">
                        <form method="post" action="addstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                                    <input type="submit" class="btn btn-info" value="ดำเนินการ" />
                        </form>
                    </td>
                <?php } else if ($row['status_bill'] == 'เลยกำหนดส่งคืน') { ?>
                    <td style="color:#F70505"><?php echo $row['status_bill']; ?> </td>
                    <td colspan="2">
                        <form method="post" action="addstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-info" value="ดำเนินการ" />
                        </form>
                    </td>
                <?php } else if ($row['status_bill'] == 'คืนอุปกรณ์เรียบร้อย') { ?>
                    <td style="color:#3CC401"><?php echo $row['status_bill']; ?> </td>
                    <td colspan="2">
                        <form method="post" action="addstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-success" value="ดูรายการ" />
                        </form>
                    </td>
                <?php } else if ($row['status_bill'] == 'ไม่อนุมัติ') { ?>
                    <td style="color:#F70505"><?php echo $row['status_bill']; ?> </td>
                    <td colspan="2">
                        <form method="post" action="cutstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-info" value="ดำเนินการ" />
                        </form>
                    </td>

                <?php } ?>

            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td class=" index_topic " colspan="8"><?php echo 'ไม่พบรายการ'; ?> </td>

        </tr>
    <?php   }
    } else if ($_POST["search"] != null) {
        $sqlbill = "SELECT * FROM borrow_bill
         INNER JOIN member ON member.member_id=borrow_bill.member_id
        
         WHERE borrow_bill  LIKE '" . $_POST["search"] . "%' AND borrow_department ='" . $_SESSION["department"] . "'";
        $result = mysqli_query($conn, $sqlbill);
        if (mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?php echo $row['borrow_bill']; ?> </td>
                <td><?php echo $row['borrow_topic']; ?></td>
                <td><?php echo $row['mem_name']; ?> </td>
                <td><?php echo $row['department']; ?> </td>
                <td><?php echo $row['borrow_date']; ?> </td>
                <td><?php echo $row['return_date']; ?> </td>

                <?php if ($row['status_bill'] == 'รอการอนุมัติ') { ?>
                    <td style="color:#FFA200"><?php echo $row['status_bill']; ?> </td>
                    <td colspan="2">
                        <form method="post" action="cutstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-info" value="ดำเนินการ" />
                        </form>
                    </td>
                    <td >
                    <form id="ins_del" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit"class="btn btn-danger" value="ลบรายการ" onclick="return confirm('กดปุ่ม OK เพื่อยืนยันการลบหมายเลขใบยืม <?php echo $row['borrow_bill']; ?> ')"/>
                        </form>
                    </td>

                <?php } else if ($row['status_bill'] == 'อนุมัติ') { ?>
                    <td style="color:#15A701"><?php echo $row['status_bill']; ?> </td>
                    <td>
                        <form method="post" action="addstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-success" value="คืนอุปกรณ์" />
                        </form>
                    </td>
                    <td>
                    <form id="ins_rec" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit"class="btn btn-danger" value="ยกเลิกอนุมัติ" />
                        </form>
                    </td>
                <?php } else if ($row['status_bill'] == 'คืนอุปกรณ์ไม่ครบ') { ?>
                    <td style="color:#F70505"><?php echo $row['status_bill']; ?> </td>
                    <td>
                        <form method="post" action="addstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-info" value="ดำเนินการ" />
                        </form>
                    </td>
                <?php } else if ($row['status_bill'] == 'คืนอุปกรณ์เรียบร้อย') { ?>
                    <td style="color:#3CC401"><?php echo $row['status_bill']; ?> </td>
                    <td>
                        <form method="post" action="addstock.php">
                            <input type="hidden" class="form-control" name="borrow_bill" id="borrow_bill" value="<?php echo $row['borrow_bill']; ?>">
                            <input type="submit" class="btn btn-success" value="ดูรายการ" />
                        </form>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>

            <td class=" index_topic " colspan="8"><?php echo 'ไม่พบรายการ'; ?> </td>

        </tr>
    <?php } ?>
<?php } ?>


<script type="text/javascript">

                $('#ins_rec').on("submit", function(e) {
                        e.preventDefault();
                        var borrow_bill = $('#borrow_bill').val();		
                                $.ajax({
                                    type: 'POST',
                                    url: 'bill_fetch_cancel.php',
                                    data: new FormData(this),
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success:function(msg){

                                    alert(msg)
                                    var timer = setInterval(function () {
						
							
                                            window.location.reload(); 
                                    
                                    }, 500);
                                    }
                                });
                
            });
        
            $('#ins_del').on("submit", function(e) {
                        e.preventDefault();
                        var borrow_bill = $('#borrow_bill').val();	
                     
                                $.ajax({
                                    type: 'POST',
                                    url: 'bill_fetch_del.php',
                                    data: new FormData(this),
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success:function(msg){

                                    alert(msg)
                                    var timer = setInterval(function () {
						
							
                                            window.location.reload(); 
                                    
                                    }, 500);
                                    }
                                });
                
            });
</script>