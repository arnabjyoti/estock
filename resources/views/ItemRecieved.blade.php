@extends('home')

@section('content')
<script>
  $(function(){
  $('.datepicker').datepicker({ dateFormat: 'yyyy-mm-dd',todayHighlight: true});
  $('.datepicker').datepicker('setDate', 'today');
});
</script>
<div class="panel panel-default">
    <div class="panel-heading pl-3">Item Received Reports</div>
    <div class="panel-body">

        <form name="operatorRpt" method="GET" action="/receivedReport">
            <div class="row" style="padding:40px;">
                <div class="form-group col-lg-12">
                    <label class="h4">Item Name:<span class="required">*</span> </label>
                    <select name="rptType" class="form-control" >
                        <option value="">Select</option>
                        @foreach ($data ?? '' as $item)
                        <option value="{{$item->itemname}}">{{$item->itemname}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group col-lg-3 mt-4">
                    <label class="h4">From Date : <span class="required">*</span></label>
                    <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' name="fromDate" placeholder="From Date" >
                </div>
                <div class="form-group col-lg-3 mt-4">
                    <label class="h4">To Date : <span class="required">*</span></label>

                    <input type="text" data-date-format='yyyy-mm-dd' class="form-control datepicker" name="toDate" placeholder="To Date" >

                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 mt-4 d-flex justify-content-center">
                    <a href="/home"><button type="button" class="btn btn-danger pr-4">Close</button></a>
                    &nbsp;
                    <button class="btn btn-primary" type="submit">Generate Report</button>
                </div>
            </div>
        </form>


    </div>
</div>
<main>
    @yield('ReceivedReport')
</main>
</div>

<style>
    .panel-default>.panel-heading {
        color: brown;
        border-color: #FFF;
        font-weight: bold;
        background: burlywood;
        font-size: 26px;
        text-shadow: none;
        display: block;
        box-sizing: border-box;
        height: 50px;
        padding: 7px 20px;
    }

</style>

@endsection
