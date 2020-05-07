$(document).ready(function(){

    $('#episode-filter option').mousedown(function(e) {
        e.preventDefault();
        $(this).prop('selected', !$(this).prop('selected'));
        return false;
    });

    $("form#filter").hide();

    $("button#toggle").click(function(){
        $("#filter").slideToggle();
    });

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
            url: '/login',
            data: {
                _token: $('#_login').val(),
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
            url: '/signup',
            data: {
                _token: $('[name=_token]').val(),
                username: $("#signup-username").val(),
                password: $("#signup-password").val(),
                email: $("#signup-email").val(),
                action: 'signup'
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

    $('.search input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).parent().siblings(".result");
        if(inputVal.length){
            $.get("/api/api.php", {action: 'liveSearch', query: inputVal})
                .done(function (data) {
                    resultDropdown.html(data);
            }).fail(function (jqXHR, textStatus, errorThrown) { alert(errorThrown); });
        } else{
            resultDropdown.empty();
        }
    });

    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});

function filter(className, obj) {
    if (obj.selected || obj.checked) {
        $(className).hide();
    }
    else {
        $(className).show();
    }
};

function signOut(){
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: '/signout',
        data: {
            _token: $('#_logout').val(),
            action: 'signout',
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
};
