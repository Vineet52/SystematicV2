$(()=>{
  $.ajax({
    url:'pages/delivery_collection/PHPcode/calendar.php',
    type:'POST',
    data:{}
  })
  .done(data=>{
      if(data!="False")
      {
        let arr=JSON.parse(data);
        console.log(arr);
        let calArr=[];
        for(let k=0;k<arr.length;k++)
        {
          calArr[k]={title:'Delivery: '+arr[k]["DELIVERY_ID"],start:arr[k]["EXPECTED_DATE"]};
        }
        console.log(calArr);
        var calendarEl = document.getElementById('calender');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid','timeGrid','list','bootstrap' ],
          themeSystem:'bootstrap',
          defaultView: 'dayGridMonth',
          header: {
              left: 'prev,next',
              center: 'title',
              right: 'dayGridMonth,dayGridWeek,dayGridDay,listMonth'
          },
          events:calArr,
          eventClick: function(info) {
            info.jsEvent.preventDefault();
            window.open("assign-truck-view-delivery.php");
            // alert('Event: ' + info.event.title);
            // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            // alert('View: ' + info.view.type);

            // change the border color just for fun
            // info.el.style.borderColor = 'red';
          }
        });
        calendar.render();
      }
      else
      {
        alert("Error");
      }
  });
  
 });