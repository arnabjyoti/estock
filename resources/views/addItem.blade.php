@extends('home')
@section('content')
<div class="container text-center ">
<form class="form-signin" onsubmit="addNewItem();return false">
<img class="mt-2" src="https://img.icons8.com/doodle/50/000000/new--v1.png" width="72" height="72"/>
      <h1 class="h3 mb-3 font-weight-normal heading">Add New Item</h1>
      
      <input type="text" name="newItem" id="newItem" class="form-control" placeholder="Enter name of item" required autofocus>
     
      <div class="col-lg-12 mt-4 d-flex justify-content-center">
                    <a href="/home"><button type="button" class="btn btn-danger pr-4">Close</button></a>
                    &nbsp;
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
    </form>
    <h1 class="mt-4" id="res"></h1>
</div>

<style>
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
  function addNewItem()
  {
   
    $.ajax({
        url: '{{url("/addItem")}}',
        data: {newItem: $("#newItem").val()},
        type: "POST",
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        success: function(data){
          if(data=="ok")
          {
            document.getElementById("newItem").value="";
            // alert("Item Added Successfully")
            document.getElementById("res").innerHTML="Inserted Successfully";
          
          }
          else
          {
            document.getElementById("newItem").value="";
            document.getElementById("res").innerHTML="Item Already Exist";
            // alert("Item Already Exist")
          }
        }, 
        error: function(){
              alert("failure From php side!!! ");
         }

        }); 
  }
  
  
</script>

@endsection