        $(document).ready(function(){
            
            $('#records').click(function(){
                  onProccess('Transaction is now proccessing. Please wait.');
                    $.ajax({
					type: "post",
					url:"../core/records.php",
                    data:{action:"getrecords"},
					success: function (returnData){
                       
						$('#main_panel').html(returnData);		
					},
               error: function() {
                   alert("SOMETHING WENT WRONG");
                    $('.notifier').html('<div class="alert alert-danger"><b>Something went wrong while getting records. </b></div>');     
               }
					
				    });        
             });
            $('#history').click(function(){
                   onProccess('Transaction is now proccessing. Please wait.');
                    $.ajax({
					type: "post",
					url:"../core/records.php",
                    data:{action:"gethistory"},
					success: function (returnData){
                      
						$('#main_panel').html(returnData);		
					},
               error: function() {
                   alert("SOMETHING WENT WRONG");
                    $('.notifier').html('<div class="alert alert-danger"><b>Something went wrong while proccessing history request. </b></div>');     
               }
					
				    });        
             });
            $('#topup').click(function(){
                  onProccess('Transaction is now proccessing. Please wait.');
                $('#topup').attr('disabled',true);
               var topupUser = $('#users').val();
                var topupAmount =$('#amount').val();
                $.ajax({
                    method:"post",
                    url:"../core/records.php",
                    data:{action:"topup",user:topupUser,amount:topupAmount},
					success: function (returnData){
                        $('#users').val('');
                        $('#amount').val('');
                        $('#main_panel').html(returnData);
                         $("#addcredit .close").click();
                        $('#topup').removeAttr('disabled');
					},
               error: function() {
                   alert("SOMETHING WENT WRONG");
                    $('.notifier').html('<div class="alert alert-danger"><b>Something went wrong while proccessing credit. </b></div>');     
                   $('#topup').removeAttr('disabled');
               }
                });                
            });
            
            $('#users').keyup(function(){              
                var userQuery = $('#users').val();
                if(userQuery != ''){
                     $('#userlist').html('getting available users..');
                    $.ajax({
                    method:"post",
                    url:"../core/searchuser.php",
                    data:{query:userQuery},
                    success: function(users){
                        $('#userlist').fadeIn("slow");
                         $('#userlist').html(users);
                    },
               error: function() {
                   alert("SOMETHING WENT WRONG while getting  users");
                   
               }
                    });
                }
            });
            
            $('#users_approval').click(function() {
                  onProccess('Transaction is now proccessing. Please wait.');
                  $.ajax({
                    method:"post",
                    url:"../core/account.php",
                    data:{action:"approval_list"},
                    success: function(response){
                  
                      $('#main_panel').html(response);
                    },
               error: function() {
                   alert("SOMETHING WENT WRONG");
                    $('.notifier').html('<div class="alert alert-danger"><b>Something went wrong while proccessing your approval  list. </b></div>');     
               }
                  });
            });
            
            $('#addcredit').on('shown.bs.modal', function () {
                $('#users').trigger('focus');
            });
            
            $('#users').focusout(function(){
                $('#userlist').hide("slow");          
            });
                   
        });   
       function thisFunction(e)
        {
            $('#users').val(e);
            $('#userlist').hide("slow");
        }
        function userApprove(e) 
        {
              onProccess('Transaction is now proccessing. Please wait.');
            var user = e;
           $.ajax({
               method:"POST",
               url:"../core/account.php",
               data:{action:"approve_user",userid:user},
               success : function(response) {
            
                    $('#main_panel').html(response);
                },
               error: function() {
                   alert("SOMETHING WENT WRONG");
                   $('.notifier').html('<div class="alert alert-danger"><b>Something went wrong while proccessing your approval request. </b></div>');        
               }
           });
        }
        function onProccess(e) 
            {
                var m=e;
                $('.notifier').show();
                 $('.notifier').html('<div class="alert alert-info">' + m + '</div>');             
                    $('.notifier').delay(4000).fadeOut();
            }