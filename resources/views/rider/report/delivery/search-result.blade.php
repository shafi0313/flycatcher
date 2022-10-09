<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Full Delivery</th>
            <th>Partial Delivery</th>
            <th>Exchange Delivery</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalFullDelivery = 0;
        $totalPartialDelivery = 0;
        $totalExchangeDelivery = 0;
        @endphp
        @foreach($deliveryData as $delivery)
        <tr>
            <td>{{$delivery['date']}}</td>
            <td>{{$delivery['fullDelivery']}}</td>
            <td>{{$delivery['partialDelivery']}}</td>
            <td>{{$delivery['exchangeDelivery']}}</td>
        </tr>
        @php
        $totalFullDelivery = $totalFullDelivery + $delivery['fullDelivery'];
        $totalPartialDelivery = $totalPartialDelivery + $delivery['partialDelivery'];
        $totalExchangeDelivery = $totalExchangeDelivery + $delivery['exchangeDelivery'];
        @endphp
        @endforeach
        <tr>
            <th colspan="2">Total: </th>
            <th colspan="2">
                <P>Full: {{$totalFullDelivery}}</P>
                <P>Partial: {{$totalPartialDelivery}}</P>
                <P>Exchange: {{$totalExchangeDelivery}}</P>
                <P>Total: {{$totalFullDelivery + $totalPartialDelivery +$totalExchangeDelivery}}</P>
            </th>
        </tr>
    </tbody>
</table>