@extends('home')
@section('content')
<script>
$(function(){
  $('#datepicker').datepicker({ dateFormat: 'yyyy-mm-dd', todayHighlight: true });
  $('#datepicker').datepicker('setDate', 'today');
});
</script>
<div class="container text-center">
      <form class="form-card" id="decForm" onsubmit="addDisbursedItem();return false">
      <h1 class="mb-3 font-weight-normal heading">Enter Disbursed Item Details</h1>
            <label for="Item">Select your Item:</label>
                <select class="form-select" name="itemSelected" required autofocus>
                    <option selected>Select Item</option>
                    @foreach ($data as $item)                                  
                    <option value="{{$item->itemname}}">{{$item->itemname}}</option>
                    @endforeach  
                </select>

                <label for="Item">Select your zone:</label>
                <select class="form-select" name="zone" required autofocus>
                    <option selected>Select Zone</option>
                    < @foreach ($zone ?? '' as $zonal)                                  
                    <option value="{{$zonal->zonename}}">{{$zonal->zonename}}</option>
                    @endforeach  
                </select>
                <label for="quantity">Road Name:</label>
            <input type="text" name="roadName" input class="form-control" v-model="roadname" placeholder="Road Name" required autofocus>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" input class="form-control" v-model="Quantity" placeholder="Quantity" required autofocus>
            <label for="quantity">Select Disbursed Date</label>
            <input type="text" id="datepicker" data-date-format='yyyy-mm-dd' class="form-control" autocomplete="false" placeholder="yyyy/mm/dd" name="decDate" required autofocus/>
            <div class="col-lg-12 mt-4 d-flex justify-content-center">
                    <a href="/home"><button type="button" class="btn btn-danger pr-4">Close</button></a>
                    &nbsp;
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
          </form>
          <div class="container mt-4" id="res"></div>
</div>


<style>

.input-group-append {
  cursor: pointer;
}
.heading {
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
<script>


function addDisbursedItem()
  {
    event.preventDefault();
    $.ajax({
        url: '{{url("/addDisbursedItem")}}',
        type: "POST",
        data: $('#decForm').serialize(),
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){

          if(data == "ok")
          {
            document.getElementById("decForm").reset();
            document.getElementById("res").innerHTML="<h2 class='bg-success text-center text-white'>Inserted Successfully</h2>";
          
          }
          else if (data == "QLTQ")
          {
            document.getElementById("decForm").reset();
            document.getElementById("res").innerHTML="<h2 class='bg-info text-center text-white'>Disbursed quantity is greater than Available Quantity</h2>";
          }
          else
          {
            document.getElementById("decForm").reset();
            document.getElementById("res").innerHTML="<h2 class='bg-danger text-center text-white'>Unable to insert it. Please try again!!!</h2>";
          }
        }, 
        error: function(){
              document.getElementById("decForm").reset();
              alert("failure From php side!!! ");
              
         }

        }); 
  }



</script>
@endsection