<div class="row">
    <h2>Total Products: {{$total}}</h2>
</div>
@if($total)
<div class="row">
    <table class="table table-striped" style="width:100%">
        <tr>
            <th>Product name</th>
            <th>Quantity in stock</th>
            <th>Price per item</th>
            <th>Datetime</th>
            <th>Total value</th>
        </tr>
            <?php $totalValue = 0; ?>
        @foreach($dataArr as $data)
            <?php
            
            $totalValue += $data->total_value ; ?>
        <tr>
            <td>{{$data->product}}</td>
            <td>{{$data->qty}}</td>
            <td>{{$data->price}}</td>
            <td>{{$data->created_at}}</td>
            <td>{{$data->total_value}}</td>
        </tr>
        @endforeach
        <tr><td colspan="5" class="text-right">Total Value : {{$totalValue}}</td></tr>
    </table>
</div>
@endif