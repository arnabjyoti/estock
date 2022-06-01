@extends('ItemRecieved')

@section('ReceivedReport')


<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<!-- Script for converting to excel -->
<script>
 function html_table_to_excel(type)
    {
        var data = document.getElementById('recReport');

        var file = XLSX.utils.table_to_book(data, {sheet: "ItemDetails"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'ReceivedReport.' + type);
    }
</script>


<div class="container">
<button id="btnExport" onclick="html_table_to_excel('xlsx')">Export To Excel</button>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" >
                    <h4 class="text-center">Item Received Details</h4>
                </div>
                @if($count > 0)
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="recReport">
                        <thead class="indigo white-text">
                            <tr> 
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Item Entered At</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php ($i = 0)
                            @foreach ($query as $item)
                            <tr>
                                <td>{{ $i=$i+1}}</td>
                                <td>{{ $item->itemnamme }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->receivedDate }}</td>
                                <td><a id="{{$item->id}}" onclick="deleteRecItem(this.id);" class="btn btn-danger">Delete</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                
                @else
                    <h2 class="bg-danger text-center">No Records Found</h2>
                
                @endif
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
            function deleteRecItem(id) {
                event.preventDefault();

                $.ajax({
                    url: '{{url("/deleteRecItem")}}',
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