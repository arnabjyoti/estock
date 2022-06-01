@extends('home')

@section('content')
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>


<div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">All Items Detail</h4>
                        </div>
                        <div class="card-body">


                            @csrf
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."
                                title="Type in a name">
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead class="indigo white-text">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Item Quantity</th>
                                        <th>Added At</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php ($i = 0)
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $i=$i+1}}</td>
                                        <td>{{ $item->itemname }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td><a class="btn btn-danger" id="{{$item->itemname}}"
                                                onclick="deleteItem(this.id);">Delete </a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-lg-12 mt-4 d-flex justify-content-center">
                                <a href="/home"><button type="button" class="btn btn-danger pr-4">Close</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .table>thead {
                vertical-align: bottom;
                background-color: burlywood;
                color: brown;
            }

        </style>
        <script>
            function deleteItem(id) {
                event.preventDefault();

                $.ajax({
                    url: '{{url("/deleteItem")}}',
                    type: "POST",
                    data: {
                        itemToBeDeleted: id
                    },
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    success: function (data) {

                        if (data == "Ok") {
                            alert("Item Deleted Succesfully");
                            location.reload();
                        } else {
                            alert("Item Not Deleted Succesfully !!! Beacuse of an error");
                            location.reload();
                        }
                    },
                    error: function () {
                        alert("failure From php side!!! ");

                    }

                });
            }

        </script>

        @endsection
