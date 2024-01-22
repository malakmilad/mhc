{{--@extends('admin.layouts.master')
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
--}}
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

<h3>Calendar</h3>


<script src="{{ asset('adminstyle/calender/jquery-1.11.3.min.js') }}"></script>
<script src="{{ asset('adminstyle/calender/moment.min.js') }}"></script>
<script src="{{ asset('adminstyle/calender/fullcalendar.min.js') }}"></script>
<div id='calendar'></div>
{{--{{ route('timetable.edit',$task->id , $menuid) }}--}}
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($allActivites as $task)
                {
                    title :'test0',// '{{ $task->taskType }}',
                    start : '{{ $task->dydate }}',
                    url : ''
                },
                @endforeach
            ]
        })
    });
</script>
{{--@endsection--}}