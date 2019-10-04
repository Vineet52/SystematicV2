$(()=>{
    
        var salePeriod = $('#salePeriod').text().trim();
        //var dateTo = $('#dateTo').text().trim();
        let tableHeader;
        console.log(salePeriod);
        if(salePeriod=="Weekly")
        {
            $("#PeriodAttr").text("DAYS OF THE WEEK");
                tableHeader = "SALES FOR A WEEK";
        }   
        if(salePeriod=="Monthly")
        {
            $("#PeriodAttr").text("DAYS OF THE MONTH");
            tableHeader = "SALES FOR A MONTH";
        
        }   
        if(salePeriod=="Daily")
        {
            $("#PeriodAttr").text("DAY");
            tableHeader = "SALES FOR A DAY";
    
        }  
        //console.log(dateTo);
    
        $.ajax({
            url: 'PHPcode/salesGraphDashboard.php',
            type: 'POST',
            data: {SALEPERIOD:salePeriod} 
        })
        .done(data=>{
            
            if(data!="False")
            {
                console.log(data);
                let arr=JSON.parse(data);
                console.log(arr);


                console.log(arr[0]["SALE_DATE"]);
                console.log( moment(arr[0]["SALE_DATE"]).format('dddd'));
                let tableEntries="";
                let formView="";
                let totalSales = 0;
                //[1, 2, 3, 4].reduce((a, b) => a + b, 0)
                let saleTotalArray=[];
                let daysOfTheWeek;
                let previousDay;
                let staticTotalSales = 0;
                let futureDay;
                let arrLength = arr.length;
                console.log(arrLength);

                let saleGraphDays = [];


               if(arr != "Empty")
               {
                for(let k=0;k<arr.length;k++)
                {
                    let day = toString(arr[k]["SALE_DATE"]);
                    daysOfTheWeek = arr[k]["SALE_DATE"].split(" ");
                    if(k < arrLength-1)
                    {
                        futureDay = arr[k+1]["SALE_DATE"].split(" ");
                        console.log(futureDay[0]);
                    }
                    
                    var formattedTime = moment(daysOfTheWeek[0]).format('dddd');
                    ++totalSales;
                    
                    
                        staticTotalSales += parseFloat(arr[k]["SALE_AMOUNT"]);
                        saleTotalArray.push(parseFloat(arr[k]["SALE_AMOUNT"]).toFixed(2));
                       

                        if(previousDay == futureDay[0])
                        {
                            if(salePeriod=="Weekly")
                            {
                                //saleTotalArray.push(arr[k]["SALE_AMOUNT"]);
                                previousDay = daysOfTheWeek[0];
                                console.log("1");
                            }
                            else if(salePeriod=="Monthly")
                            {
                                //saleTotalArray.push(arr[k]["SALE_AMOUNT"]);
                                previousDay = daysOfTheWeek[0];
                            }
                            else
                            {
                               
                                previousDay = daysOfTheWeek[0];
                            }
                        }
                        else if(daysOfTheWeek[0] == previousDay)
                        {
                            
                            
                            if(salePeriod=="Weekly")
                            {
                                //saleTotalArray.push(arr[k]["SALE_AMOUNT"]);
                                previousDay = daysOfTheWeek[0];
                                console.log("1");
                            }
                            else if(salePeriod=="Monthly")
                            {
                                //saleTotalArray.push(arr[k]["SALE_AMOUNT"]);
                                previousDay = daysOfTheWeek[0];
                            }
                            else
                            {
                                
                                previousDay = daysOfTheWeek[0];
                            }
                            
    
                          
                            
                        }
                        if(previousDay != futureDay[0] && daysOfTheWeek[0] != futureDay[0])
                        {
                      

                               
                                
                                    //saleTotalArray.push(arr[k]["SALE_AMOUNT"]);
                                    //formView="<form action='view-order.php' method='POST'><input type='hidden' name='ORDER_ID' value='"+ordersArray[k]["ORDER_ID"]+"'>"+"<button class='btn btn-icon btn-2 btn-success btn-sm' type='submit'><span class='btn-inner--icon'><i class='fas fa-eye'></i></span><span class='btn-inner--text'>View</span></button>"+"</form>";
                                    tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='TotalSales'>"+totalSales +"</td><td class='unit-right' id='SaleTotal'>"+staticTotalSales.toFixed(2)+"</td></tr>";
                                    previousDay = daysOfTheWeek[0];

                                    saleTotalArray.push("date");
                                    saleGraphDays.push(daysOfTheWeek[0]);
                                    //console.log("1");
                                    //console.log(totalSales);
                                    totalSales = 0;
                                    staticTotalSales = 0;

                                    
                        }
                    if(k == arrLength-1 && previousDay==daysOfTheWeek[0])
                    {
                       
                        tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='TotalSales'>"+totalSales +"</td><td class='unit-right' id='SaleTotal'>"+staticTotalSales.toFixed(2)+"</td></tr>";
                        previousDay = daysOfTheWeek[0];
                        saleTotalArray.push("date");
                        saleGraphDays.push(daysOfTheWeek[0]);

                    }
                    else
                    {
                        
                        previousDay = daysOfTheWeek[0];
                    }

                    
                   
                }
               

            
                
                $("#tBody").append(tableEntries);
                /*if(salePeriod == "Daily")
                {
                    $("#TotalSales").text(totalSales);
                    console.log(saleTotalArray);
                    let sumOfTotals = saleTotalArray.reduce((a, b) => parseInt(a) + parseInt(b), 0);
                    $("#SaleTotal").text(sumOfTotals);
                }*/



               //Display Graph
                console.log(saleGraphDays);
                saleTotalArray.reverse();
                console.log(saleTotalArray);
                /*for(int i = 0;i<saleGraphDays.length;i++)
                {

                }*/
                //have while loop that starts from the back to put the specefic values of a specefic day onto the graph.
                let tempSaleArray = [];
                for(let i=0;i<saleGraphDays.length;i++)
                {
                    for(let a=saleTotalArray.length-1;a>=0;a--)
                    {
                        if(saleTotalArray[a] != "date" )
                        {
                            tempSaleArray.push(saleTotalArray[a]);
                         
                        }
                        else
                        {
                           
                        }
                    }

                   
                }
                console.log(tempSaleArray);
                new Chart(document.getElementById("line-chart"), {
                    type: 'line',
                    data: {
                      labels: saleGraphDays,
                      datasets: [{ 
                          data: tempSaleArray,
                          label: "Sales",
                          borderColor: "#3e95cd",
                          fill: false
                        }
                      ]
                    },
                    options: {
                      title: {
                        display: true,
                        text: tableHeader
                      }
                    }
                  });




                /*, { 
                    data: [454,786,675,786,635,809,655],
                    label: "2018",
                    borderColor: "#8e5ea2",
                    fill: false
                  }, { 
                    data: [678,787,745,876,956,1046,986],
                    label: "2019",
                    borderColor: "#7cbf56",
                    fill: false
                  }*/
               }
               else
               {
                   
                   if(salePeriod=="Weekly")
                   {
                    new Chart(document.getElementById("line-chart"), {
                        type: 'line',
                        data: {
                          labels: ["DAYS"],
                          datasets: [{ 
                              data: [0],
                              label: "Sales",
                              borderColor: "#3e95cd",
                              fill: false
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: tableHeader
                          }
                        }
                      });

                    salePeriod = salePeriod.toUpperCase();
                    $("#tBody").append("<tr></tr>").text(`NO SALES HAVE BEEN MADE ,IN THE LAST WEEK,IN ORDER TO MAKE A ${salePeriod} SALES REPORT`);
                   }
                   else if(salePeriod=="Monthly")
                   {
                    new Chart(document.getElementById("line-chart"), {
                        type: 'line',
                        data: {
                          labels: ["DAYS"],
                          datasets: [{ 
                              data: [0],
                              label: "Sales",
                              borderColor: "#3e95cd",
                              fill: false
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: tableHeader
                          }
                        }
                      });

                    salePeriod = salePeriod.toUpperCase();
                    $("#tBody").append("<tr></tr>").text(`NO SALES HAVE BEEN MADE ,IN THE LAST MONTH, IN ORDER TO MAKE A ${salePeriod} SALES REPORT`);
                   }
                   else
                   {

                    new Chart(document.getElementById("line-chart"), {
                        type: 'line',
                        data: {
                          labels: ["DAYS"],
                          datasets: [{ 
                              data: [0],
                              label: "Sales",
                              borderColor: "#3e95cd",
                              fill: false
                            }
                          ]
                        },
                        options: {
                          title: {
                            display: true,
                            text: tableHeader
                          }
                        }
                      });
                      
                    salePeriod = salePeriod.toUpperCase();
                    $("#tBody").append("<tr></tr>").text(`NO SALES HAVE BEEN MADE TODAY IN ORDER TO MAKE A ${salePeriod} SALES REPORT`);
                   }
               
               } 
               

            }
            else
            {
                alert("Error");
            }
        });
    });
   