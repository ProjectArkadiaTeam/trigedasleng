$(document).ready(function(){
    //Login dropdown
    $('#login-trigger').click(function(){
        $(this).next('#login-content').slideToggle();
        $(this).toggleClass('active');

        if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
        else $(this).find('span').html('&#x25BC;')
    })

    //Login
    $('#loginbtn').click(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: 'backend/auth.php',
            data: {
                username: $("#username").val(),
                password: $("#password").val(),
                action: 'login'
            },
            success: function(data)
            {
                if (data === 'Success') {
                    window.location.reload();
                }
                else {
                    alert(data);
                }
            }
        });
    });

    //Signup
    $('#signupbtn').click(function() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: 'backend/auth.php',
            data: {
                username: $("#signup-username").val(),
                password: $("#signup-password").val(),
                email: $("#signup-email").val(),
                action: 'signup'
            },
            success: function(data)
            {
                if (data === 'Success') {
                    window.location.set("index.php");
                }
                else {
                    alert(data);
                }
            }
        });
    });
});

function signOut(){
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: 'backend/auth.php',
        data: {
            action: 'signout'
        },
        success: function(data)
        {
            if (data === 'Success') {
                window.location.set("index.php");
            }
            else {
                alert(data);
            }
        }
    });
}