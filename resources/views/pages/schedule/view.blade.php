@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style_link')
    <link rel="stylesheet" href="{{asset('css/fullcalendar/main.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">You Schedule List</h4>
                    </div>
                    <div class="card-body">
                        <!-- the events -->
                        <div id="external-events">
                            @php
                                $color_array=['bg-success','bg-info','bg-warning','bg-danger','bg-primary'];
                            @endphp
                            @foreach($schedules as $schedule)
                                <div class="external-event {{$color_array[rand(0,4)]}}">
                                    <p style="margin: 0">{{$schedule->title}}</p>
                                    <span style="font-size: .8rem">{{$schedule->date."-".$schedule->month."-".$schedule->year." (".$schedule->time.")"}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
        <!-- /.card -->
        </div>
    <!-- /.col -->
  </div>
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Make you schedule</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="schedule_title" name="schedule_title" placeholder="Schedule Title"/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="total_days" name="total_days" placeholder="Total Day/Days"/>
                </div>
                <div class="form-group">
                    <input type="time" class="form-control" id="schedule_time" name="time" placeholder="Time"/>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save_changes">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@stop
@section('script')
    function getEvents()
    {
        let events_data=[];
        $.ajax({
            type:'GET',
            url:'/schedule/calender-schedules',
            dataType: 'json',
            success:function(data)
            {
                for(let i=0;i<data.length;i++)
                {
                    {{-- console.log(JSON.parse(data[i])) --}}
                    events_data.push(data[i])
                }
            }
        })
        return events_data;
    }
    
    $(function () {

        {{-- let events = []; --}}
        /* initialize the external events
        -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {
            // create an Event Object (https://fullcalendar.io/docs/event-object)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            }
    
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)
            // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex        : 1070,
                    revert        : true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })
            })
        }
    
        ini_events($('#external-events div.external-event'))
        /* initialize the calendar
        -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
    
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;
    
        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');
        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                
                events: function(){
                    let events_data=[];
                    $.ajax({
                        type:'GET',
                        url:'/schedule/calender-schedules',
                        dataType: 'json',
                        success:function(data)
                        {
                            for(let i=0;i<data.length;i++)
                            {
                                {{-- console.log(JSON.parse(data[i])) --}}
                                events_data.push(data[i])
                            }
                        }
                    })
                },
                  
                

                editable  : true,
                droppable : true, // this allows things to be dropped onto the calendar !!!
                drop      : function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
            dateClick: function(dateClickInfo) {
                let event;
                $('#modal-default').modal('show');
                $('#save_changes').one('click',function(){
                    let schedule_title=$('#schedule_title').val()
                    let total_days=$('#total_days').val()
                    let schedule_time=$('#schedule_time').val()
                    event=createEvent(dateClickInfo.dateStr, schedule_title,parseInt(total_days));
                    let date=new Date(dateClickInfo.dateStr).getDate()
                    let month=new Date(dateClickInfo.dateStr).getMonth()+1
                    let year=new Date(dateClickInfo.dateStr).getFullYear()
                    calendar.addEvent(
                        event
                    )
                    $.ajax({
                        url: "/schedule/book",
                        type: "post",
                        dataType: "json",
                        data: {
                            "_token":"{{csrf_token()}}",
                            "title":schedule_title,
                            "date":date,
                            "month":month,
                            "year":year,
                            "time":schedule_time,
                            "object_data":event,
                            "number_of_day":total_days,
                        },
                        success: function(data) {
                            alert(data.message)
                        }
                    })
                   $('#modal-default').modal('hide');
                })
            }
        });
        calendar.render();
        // $('#calendar').fullCalendar()
        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#add-new-event').css({
            'background-color': currColor,
            'border-color'    : currColor
            })
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }
    
            // Create events
            var event = $('<div />')
            event.css({
            'background-color': currColor,
            'border-color'    : currColor,
            'color'           : '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)
    
            // Add draggable funtionality
            ini_events(event)
    
            // Remove event from text input
            $('#new-event').val('')
        })
    })
    function createEvent(startDate, title, no_of_days) {
        let currColor = '#3c8dbc'
        let date=new Date(startDate);
        let event = {
                id: 1, // You must use a custom id generator
                title: title,
                start: startDate,
                end: new Date(date.setDate(date.getDate()+no_of_days)),
                allDay:  true,
                background: '#3c8dbc',
            }
            {{-- console.log(no_of_days) --}}
        return event;
        
    }
@stop

@section('script_link')
    <script src="{{asset('js/fullcalendar/main.js')}}"></script>
@stop