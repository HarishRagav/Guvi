$(document).ready(function(){
    $("#email").blur(function(){
        var email=$(this).val();
        console.log(email);
        checkemail(email);
    });
    $('#psw').blur(function(){
        var password=$(this).val();
        var email=$("#email").val();
        checkpassword(password,email);
    });
    function checkemail(email){
        $.ajax({
            method:'POST',
            url:'./../php/login.php',
            data:'email='+email,
            success:function(data){
                $("#email-availability-status").html(data);
            }
        })
    }
    function checkpassword(password,email){
        $.ajax({
            method:'POST',
            url:'./../php/login.php',
            data:{'password':password,'email':email},
            success:function(data){
                $("#password-status").html(data);
            }
        })

    }
});
function login_status(){
    if($("#email-availability-status").text()=="Success" && $("#password-status").text()=="Success"){
        $("#response-message").html('<span class="text-success">Registered successfully</span>');
        window.location.href="./../profile.html";
    }
}
