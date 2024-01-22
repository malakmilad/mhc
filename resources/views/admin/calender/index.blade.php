
@extends('admin.layouts.master')
@section('pagetitle') العملاء المهتمين @endsection
@section('contentheader') 
 <section class="content-header text-right">
	  <h1>
	    العملاء المهتمين
	    <small>يمكنك اضافة و تعديل و حذف العملاء المهتمين من هنا</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> لوحة التحكم </a>
      </li>
	    <li class="active">العملاء المهتمين</li>
	  </ol>
 </section>
@endsection
@section('main-content')
 <section class="content">
<link rel='stylesheet' href="{{ asset('adminstyle/calender/fullcalendar.min.css')}}"/>

<h3>Calendar</h3>

<div id='calendar'></div>
<!--<script src="{{ asset('adminstyle/calender/jquery-1.11.3.min.js') }}"></script>-->
<script src="{{ asset('adminstyle/calender/moment.min.js') }}"></script>
<script src="{{ asset('adminstyle/calender/fullcalendar.min.js') }}"></script>


<script>
      $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($tasks as $task)
                {     
                    title :'{{$task->name}}',
                   // start : 'if(isset($task->dydate))(Date.parse({{ $task->dydate}})).addDays(1)'
             //  start:'if(isset($task->dydate))(new Date({{ $task->dydate}})).setDate(new Date({{ $task->dydate}})+1))'
             start:'if(isset($task->dydate)){{ $task->dydate}}'
                 
            },
                @endforeach
                     ]
                   
        })
          
                  //   console.log(('28/12/2021').getDate()+1);
                  console.log((new Date('28/12/2021')).setDate(new Date('28/12/2021')+1));
          });
</script>
@endsection
 {{--// 'if(isset($task->dydate))(new Date({{ $task->dydate}})).addDays(1)'
    --}} 