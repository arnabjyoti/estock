@extends('home')
@section('content')

<script>
  $(function(){
  $('#datepicker').datepicker({ dateFormat: 'yyyy-mm-dd',todayHighlight: true});
  $('#datepicker').datepicker('setDate', 'today');
});
  </script>
<div class="container text-center">
      <form class="form-card" id="recForm" onsubmit="ItemReceivedEntry();return false" autocomplete="off">
      <h1 class="h3 mb-3 font-weight-normal heading">Enter Received Item Details</h1>
            <label for="Item">Select your Item:</label>
                <select name = "itemSelected"class="form-select" aria-label="Default select example" required autofocus>
                    <option selected>Select Item</option>
                    @foreach ($data as $item)                                  
                    <option value="{{$item->itemname}}">{{$item->itemname}}</option>
                    @endforeach  
                </select>
            <label for="quantity">Quantity</label>
            <input name="quantity" type="number" input class="form-control" v-model="Quantity" placeholder="Quantity" required autofocus>
            <label for="warranty">Warranty</label>
            <input name="warranty" type="number" input class="form-control" v-model="warranty" placeholder="Enter Number of days" required autofocus>
            <label for="quantity">Select Received Date</label>
           <input type="text" id="datepicker" data-date-format='yyyy-mm-dd' class="form-control" autocomplete="false" placeholder="yyyy/mm/dd" name="recDate" required autofocus/>
            </div>
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


function ItemReceivedEntry()
  {
    event.preventDefault();
    $.ajax({
        url: '{{url("/addReceivedItem")}}',
        type: "POST",
        data: $('#recForm').serialize(),
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
       
        success: function(data){
        console.log("Inside success");

          if(data == "ok")
          {
            document.getElementById("recForm").reset();
            document.getElementById("res").innerHTML="<h2 class='bg-success text-center text-white'>Inserted Successfully</h2>";
          
          }
          else
          {
            document.getElementById("recForm").reset();
            document.getElementById("res").innerHTML="<h2 class='bg-danger text-center text-white'>Unable to insert it. Please try again!!!</h2>";
          }
        }, 
        error: function(){
              document.getElementById("recForm").reset();
              alert("failure From php side!!! ");
              
         }

        }); 
  }



</script>



      @endsection