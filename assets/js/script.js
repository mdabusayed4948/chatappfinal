
$(document).ready(function(){

    

    $('#message_form').on('submit', function(event){
        event.preventDefault();
        
        if($('#uName').val() !=''){

            var formData = $(this).serialize();

            $.ajax({
                url: 'registerUser.php',
                method: 'POST',                
                cache: false,
                processData: false,
                data: formData,
                success: function(data){

                    $("#message_form")[0].reset("");
                }
            });

        }else{
            alert('Please Type User Name.');
        }
    });

    

    setInterval(function() {
        $.ajax({
            url: "fetch.php",
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "html",
            success:function(data)
            {
                $("#userData").html(data);
            }
        });
    },700);


    $("#send").on("click", function(){

        if($('#message').val() !=''){
            $.ajax({
                url:"insertMessage.php",
                method:"POST",
                data:{
                    fromUser: $("#fromUser").val(),
                    toUser: $("#toUser").val(),
                    message: $("#message").val()
                },
                dataType:"text",
                success:function(data)
                {
                    $("#message").val("");
                    
                }
            });
        }else{
            alert('Please Type Message.');
        }
    });

    

    setInterval(function(){

        $.ajax({
            url: "realTimeChat.php",
            method: "POST",
            data:{
                fromUser:$("#fromUser").val(),
                toUser:$("#toUser").val()
            },
            dataType:"text",
            success:function(data)
            {
                $("#msgBody").html(data);
            }
        });

    }, 700);

    $(document).on('click','.dropdown-toggle',function(){
                
        $('.count').html('');
        showUnreadNotifications(1);
    });

    

    function showUnreadNotifications(option = '') {
        $.ajax({
            url: 'notify.php',
            method: 'POST',
            data: {
                fromUser:$("#fromUser").val(),
                toUser:$("#toUser").val(),
                option: option
            },
            dataType:'json',
            success: function(data){

                //console.log(data);
                
                $('.dropdown-menu').html(data.notification);
                

                if(data.unreadNotification > 0)
                {
                    $('.count').html(data.unreadNotification);
                    
                    
                }

                
            }
        });
    }

    showUnreadNotifications();

    

    setInterval(function(){
        showUnreadNotifications(); 
        
    },500);




});


