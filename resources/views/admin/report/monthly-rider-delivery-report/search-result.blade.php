<div class="card">
    <div class="card-header">
        <form action="{{route('admin.monthly-rider-delivery-report.pdf')}}" method="post" target="_blank">
            @csrf
            <input type="hidden" name="days" value="{{$days}}">
            <input type="hidden" name="year" value="{{$year}}">
            <input type="hidden" name="month" value="{{$month}}">
            <button type="submit" class="btn btn-primary">Print now</button>
        </form>
    </div>
   <div class="card-body table-responsive">
       <table class="table table-bordered table-secondary table-striped">
           <thead>
           <tr>
               <th></th>
               @for($i= 1; $i<=$days; $i++)
                   <th>{{$i}} - {{date('M', mktime(0, 0, 0,$month))}}</th>
               @endfor
               <th>Total</th>
           </tr>
           </thead>
           <tbody>
           @foreach($deliveryData as $rider)
               @php
               $total = 0;
               @endphp
               <tr>
                   <th>{{$rider['rider_name']}}</th>
                   @foreach($rider['rider_data'] as $riderData)
                       <td>
                           {{$riderData['delivery']}}
                           @php
                           $total +=$riderData['delivery'];
                           @endphp
                       </td>
                   @endforeach
                   <th class="bg-primary text-white">
                       {{$total}}
                   </th>
               </tr>
           @endforeach
           <tr>
               <th>Total</th>
               @php
               $i = 0;
               @endphp
               @foreach($total_daily_delivery as $totalDelivery)
                    <td>{{number_format($totalDelivery['totalDelivery'])}}</td>
                   @php
                    $i = $i+$totalDelivery['totalDelivery'];
                   @endphp
               @endforeach
               <td>{{number_format($i)}}</td>
           </tr>
           </tbody>
       </table>
   </div>
</div>

