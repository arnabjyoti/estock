@extends('home')
@section('content')

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
<!-- Script for converting to excel -->
<script>

 function html_table_to_excel(type)
    {
        var data = document.getElementById('disReport');

        var file = XLSX.utils.table_to_book(data, {sheet: "ItemDetails"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'DisbursedReport.' + type);
    }
</script>


<div class="container">
<button id="btnExport" onclick="html_table_to_excel('xlsx')">Export To Excel</button>
<!-- <input type="button" onclick="html_table_to_pdf()" value="Export To PDF" />    -->
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" >
                    <h4 class="text-center">Item Disbursed Details</h4>
                </div>
                @if($itemExpired->count() > 0)
                <div class="card-body">

                    <table class="table table-bordered table-striped" id="disReport">
                        <thead class="indigo white-text">
                            <tr> 
                                <th>SI No.</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php ($i = 0)
                            @foreach ($itemExpired as $item)
                            <tr>
                                <td>{{ $i+1}}</td>
                                <td>{{ $item->itemnamme }}</td>
                                <td>{{ $item->quantity }}</td>
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

@endsection