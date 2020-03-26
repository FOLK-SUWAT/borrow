<script>



        $('#email').keyup(function() {

            var email_response = $(this).val();
            $('#email_response').html("");
            $.post("check_email.php", {
                email_name: email_response
            }, function(data) {
                if (data.status == false) {
                    $('#email_response').parent('div').removeClass('has-error').addClass('has-success');

                } else {
                    $('#email_response').parent('div').removeClass('has-success').addClass('has-error');
                }
                $('#email_response').html(data.msg);
            }, 'json');
        });

        //ล้อกอินเข้าระบบ

       

    
            

        //ล้อกเอ้า
        $('#logout').click(function() {
            var action = "logout";
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    action: action
                },
                success: function() {
                    location.href = "index.php";
                }
            });
        });


  



    //sidebar show hide
    function myFunction() {
        var x = document.getElementById("sidebar");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>