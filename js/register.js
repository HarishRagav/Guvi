$(document).ready(function() {
    $("#username").blur(function() {
        var username = $(this).val();
        checkusername(username);
    });
    $("#email").blur(function() {
        var email = $(this).val();
        checkemail(email);
    });
    $('#ph').blur(function() {
        var phone = $(this).val();
        checkphone(phone);
    });
    $('#psw').blur(function() {
        var password = $(this).val();
        checkpassword(password);
    });
    $('#cpsw').blur(function() {
        var cpassword = $(this).val();
        var password = $("#psw").val();
        checkcpassword(password, cpassword);
    });

    function checkusername(username) {
        $.ajax({
            url: './../php/register.php',
            method: 'POST',
            data: 'username=' + username,
            success: function(data) {
                $("#username-availability-status").html(data);
            }
        })
    }

    function checkemail(email) {
        $.ajax({
            url: './../php/register.php',
            method: 'POST',
            data: 'email=' + email,
            success: function(data) {
                $("#email-availability-status").html(data);
            }
        })
    }

    function checkphone(phone) {
        $.ajax({
            url: './../php/register.php',
            method: 'POST',
            data: 'phone=' + phone,
            success: function(data) {
                $("#phone_validation").html(data);
            }
        })
    }

    function checkpassword(password) {
        $.ajax({
            url: './../php/register.php',
            method: 'POST',
            data: 'password=' + password,
            success: function(data) {
                $("#password_validation").html(data);
            }
        })
    }

    function checkcpassword(password, cpassword) {
        if (password != cpassword) {
            $('#cpassword_validation').html('<span class="text-danger">password should match</span>');
        } else {
            $("#cpassword_validation").html('<span class="text-success">matching</span>');
        }
    }
});

function registration_status() {
    if ($("#username-availability-status").text() == "Accepted" && $("#email-availability-status").text() == "Not registered" && $("#phone_validation").text() == "Valid" && $("#password_validation").text() == "Strong password" && $("#cpassword_validation").text() == "matching") {
        var username = $('#username').val();
        var email = $('#email').val();
        var phone = $('#ph').val();
        var password = $('#psw').val();

        $.ajax({
            url: './../php/register.php',
            method: 'POST',
            data: { 'username': username, 'email': email, 'phone': phone, 'password': password },
            success: function(data) {
                $("#username-availability-status").html(data);
            }
        })
        $("#response-message").html('<span class="text-success">Registered successfully</span>');
        window.location.href = "./../login.html";
    }
}