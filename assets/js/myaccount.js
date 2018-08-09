    $(document).ready(function(){
            var username = "<?php echo $_SESSION['username']?>";
            $.ajax({
                    type:"post",
                    url:"core/mycredits.php",
                    data:{action:"getcredits",user:username},
                    success: function(response)  {
                        $('#main_').html(response);
                        getmyHistory(username);
                    },
                 error: function(){
                        $('#notifier').removeClass('d-none');
                 }
            });
            
            Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
            $.ajax({
                  url:"core/chart.php",
                    method:"POST",
                    data:{action:"mychart",username:"<?php echo  $_SESSION['username']?>"},
                    success: function(data){
                        var dateAdd= [];
			             var credit = [];
                        var e = $.parseJSON(data);
                        for(var i = 0; i < e.length; i++) {       
                            console.log(e[i].username);
                           dateAdd.push(e[i].date);
                            credit.push(e[i].amount);
                        }
                    
                      var ctx = document.getElementById("myAreaChart");
                        var myLineChart = new Chart(ctx, {
                          type: 'line',
                          data: {
                            labels: dateAdd,
                            datasets: [{
                              label: "Amount",
                              lineTension: 0.3,
                              backgroundColor: "rgba(2,117,216,0.2)",
                              borderColor: "rgba(2,117,216,1)",
                              pointRadius: 5,
                              pointBackgroundColor: "rgba(2,117,216,1)",
                              pointBorderColor: "rgba(255,255,255,0.8)",
                              pointHoverRadius: 5,
                              pointHoverBackgroundColor: "rgba(2,117,216,1)",
                              pointHitRadius: 50,
                              pointBorderWidth: 2,
                              data:credit,
                            }],
                          },
                          options: {
                            scales: {
                              xAxes: [{
                                time: {
                                  unit: 'date'
                                },
                                gridLines: {
                                  display: false
                                },
                                ticks: {
                                  maxTicksLimit: 10
                                }
                              }],
                              yAxes: [{
                                ticks: {
                                  min: 0,
                                  max: 100,
                                  maxTicksLimit: 10
                                },
                                gridLines: {
                                  color: "rgba(0, 0, 0, .125)",
                                }
                              }],
                            },
                            legend: {
                              display: false
                            }
                          }
                        });
                            $('#chartnoti').fadeOut('slow');
                    } //success end
                
            });
            
            
            
        });
    
        function getmyHistory(e)
        {
            var username = e;
                 $.ajax({
                    type:"post",
                    url:"core/mycredits.php",
                    data:{action:"gethistory",user:username},
                    success: function(response)  {
                        $('#history').html(response);   
                    },
                     error: function(){
                        $('#notifier').removeClass('d-none');
                 }
                     
            });
        }