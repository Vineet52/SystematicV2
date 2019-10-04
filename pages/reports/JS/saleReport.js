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
            url: 'PHPcode/saleReport.php',
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
                let showTime = [];
                let timeArray = [];
                console.log(arrLength);

                let saleGraphDays = [];


               if(arr != "Empty")
               {
                for(let k=0;k<arr.length;k++)
                {
                    let day = toString(arr[k]["SALE_DATE"]);
                    daysOfTheWeek = arr[k]["SALE_DATE"].split(" ");
                    showTime = daysOfTheWeek[1];
                    console.log(showTime);
                    if(k < arrLength-1)
                    {
                        futureDay = arr[k+1]["SALE_DATE"].split(" ");
                        console.log(futureDay[0]);
                    }
                    else
                    {
                        futureDay = arr[k]["SALE_DATE"].split(" ");
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
                                    timeArray.push(showTime);
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
                        timeArray.push(showTime);
                        totalSales = 0;
                        staticTotalSales = 0;

                    }
                    else if(arrLength==1)
                    {
                        tableEntries+="<tr><td class='no'>"+formattedTime+"</td><td class='desc' id='TotalSales'>"+totalSales +"</td><td class='unit-right' id='SaleTotal'>"+staticTotalSales.toFixed(2)+"</td></tr>";
                        previousDay = daysOfTheWeek[0];
                        timeArray.push(showTime);
                        saleTotalArray.push("date");
                        saleGraphDays.push(daysOfTheWeek[0]);
                        //console.log("1");
                        //console.log(totalSales);
                        totalSales = 0;
                        staticTotalSales = 0;
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
                for(let i=0;i<timeArray.length;i++)
                {
                    
                }
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
    /* let redCount=0;
                let greenCount=0;
                let arrayOfProdNames = [];
                let arrayOfProdTotals = [];
                let arrayOfProdTypes = [];
                let arrayOfProdTypesTotal = [];
                let arrayOfIDs = [];
                let prodTypeNamesArray = [];                
                let idCount =0;

                //Group same IDs
            function groupProductTypes(array)
                    {
                        for(let i=0;i<array.length;i++)
                        {

                            for(let b=0;b<array.length;b++)
                            {
                                if(array[i] == array[b])
                                {
                                    arrayOfIDs.push(array[b]);
                                
                                }
                            

                            }
                        }
                    }
                

                //Sort occurance of IDs from High to Low
                

               


                function sortProductTypes(array) {
                    var howMany = {};
                
                    array.forEach(function(value) { howMany[value] = 0; });
                
                    var uniques = array.filter(function(value) {
                        return ++howMany[value] == 1;
                    });
                
                    return uniques.sort(function(a, b) {
                        return howMany[b] - howMany[a];
                    });
                }
                    console.log(arr[0].PRODUCT_SIZE_TYPE);
               

                

              for(let k=0;k<arr.length;k++)
                {	
                   if(k<5)
                   {
                   
                        let pType="Individual";
                        let pNumber= 1;
                        if(arr[k].PRODUCT_SIZE_TYPE==2)
                        {
                            pType="Case";
                            pNumber=arr[k].UNITS_PER_CASE;
                        }
                        else if(arr[k].PRODUCT_SIZE_TYPE==3)
                        {
                            pType="Pallet";
                            pNumber=arr[k].CASES_PER_PALLET;
                        }
    
                        let theProductName = arr[k].NAME+" ("+pNumber+" x "+arr[k].PRODUCT_MEASUREMENT+arr[k].PRODUCT_MEASUREMENT_UNIT+")"+" "+pType;
                        arrayOfProdNames.push(theProductName);
                        arrayOfProdTotals.push(arr[k].TOTAL_PRODUCT_QUANTITY);
                        arrayOfProdTypes.push(arr[k].PRODUCT_TYPE_ID);
                        
                        //let theUnitPrice = productsArray[productIndex].SELLING_PRICE;
                    }
                    
                   
                    
                    
                }

                groupProductTypes(arrayOfProdTypes); // Group product types
                let sortedProductTypesArray=sortProductTypes(arrayOfIDs); //sortedProductTypes
                console.log(sortedProductTypesArray);
                
                let countOfProdTypes = 0;
                //Loop for second graph
                for(let k=0;k<arr.length;k++)
                {	
                   if(k<5)
                   {
                    if(sortedProductTypesArray[k]==arr[k].PRODUCT_TYPE_ID)
                    {
                       
                        if(!prodTypeNamesArray.includes(arr[k].TYPE_NAME))
                        {
                            prodTypeNamesArray.push(arr[k].TYPE_NAME);

                        }
                    }
                   }
                }


                //Get the quantity of product types
                for(let k=0;k<prodTypeNamesArray.length;k++)
                {	
                   
                        for(let t=0;t<arr.length;t++)
                        {
                        
                            if(prodTypeNamesArray[k] ==arr[t].TYPE_NAME )
                            {
                                countOfProdTypes += parseInt(arr[t].TOTAL_PRODUCT_QUANTITY);
                                console.log(arr[t].TOTAL_PRODUCT_QUANTITY);

                            }
                        }
                        arrayOfProdTypesTotal.push(countOfProdTypes);
                }
              console.log(arrayOfProdTypesTotal);
              console.log(prodTypeNamesArray);

                let newLabels =  ["All Gold Tomato Sauce (6x700ml) Case", "Coca Cola (6x2l) Case", "Kingsley Ginger Bear (6x2l) Case", "Dragon Energy Drink (24x500ml) Case", "Monster Energy Drink (24x500ml) Case"];

               new Chart(document.getElementById("pie-chart"), {
                    type: 'pie',
                    data: {
                      labels:arrayOfProdNames,
                      datasets: [{
                        label: "No Of Sales",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: arrayOfProdTotals
                      }]
                    },
                    options: {
                      title: {
                        display: true,
                        text: 'TOP 5 MOST SOLD PRODUCTS'
                      }
                    }
                });
          
                new Chart(document.getElementById("pie-chart2"), {
                    type: 'pie',
                    data: {
                      labels: prodTypeNamesArray,
                      datasets: [{
                        label: "No Of Sales",
                        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                        data: arrayOfProdTypesTotal
                      }]
                    },
                    options: {
                      title: {
                        display: true,
                        text: 'TOP 5 MOST SOLD PRODUCT TYPES'
                      }
                    }
                });


                //Get Max
                let maxQuantity = Math.max(...arrayOfProdTotals);
                let MaxProductName = "";
                for(var i=0;i<arrayOfProdTotals.length;i++)
                {
                    if(arrayOfProdTotals[i] == maxQuantity )
                    {
                         MaxProductName = arrayOfProdNames[i];
                      
                    }
                }
              
             
                 console.log(MaxProductName);
             

                let MaxQuantityTypeSold = Math.max(...arrayOfProdTypesTotal);
            
                let MaxProductType= prodTypeNamesArray[arrayOfProdTypesTotal.indexOf(MaxQuantityTypeSold)];
                $("#MaxProductName").text(MaxProductName);
                $("#MaxQuantitySold").text(`${maxQuantity} Sold.`);
                $("#MaxProductType").text(MaxProductType);
                $("#MaxQuantityTypeSold").text(`${MaxQuantityTypeSold} Sold.`);

                //Get Min

                let minQuantity = Math.min(...arrayOfProdTotals);
                let MinProductName = "";
                for(var i=0;i<arrayOfProdTotals.length;i++)
                {
                    if(arrayOfProdTotals[i] == minQuantity )
                    {
                        MinProductName = arrayOfProdNames[i];
                      
                    }
                }

                let MinQuantityTypeSold = Math.min(...arrayOfProdTypesTotal);
                let MinProductType= prodTypeNamesArray[arrayOfProdTypesTotal.indexOf(MinQuantityTypeSold)];

                $("#MinProductName").text(MinProductName);
                $("#MinQuantitySold").text(`${minQuantity} Sold.`);
                $("#MinProductType").text(MinProductType);
                $("#MinQuantityTypeSold").text(`${MinQuantityTypeSold} Sold.`);
                

  <tr>
            <td class="no">January 2019</td>
            <td class="desc">678</td>
            <td class="unit-right">R123 567.00</td>
          </tr>
 */