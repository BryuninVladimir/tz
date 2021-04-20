
@extends('layouts.app')

@section('content')

    <div class="chars-list">
        @if ($char)
            <h3>{{$char->name}}</h3>
            <table class="table table-striped">
            <thead>
            <th colspan="2">Attributes</th>
            </thead>
            <tr class="d-flex">
                <td class="col-6">Strength</td>
                <td class="col-6">{{$char->strength}}</td>
            </tr>

            <tr class="d-flex">
                <td class="col-6">Stamina</td>
                <td class="col-6">{{$char->stamina}}</td>
            </tr>
            </table>
            <table class="table table-striped">
                <thead class="d-flex">
                  <th  colspan="3">Equipment</th>
                </thead>
                @foreach($equippedItems as $type => $item)
                <tr class="d-flex">
                    <td class="col-4">{{ucfirst($type)}}</td>
                    @if ($item)
                        <td class="col-4">{{ $item->name}}</td>
                        <td class="col-4"><a href="{{url('inventory/unequip', [$char->id, $item->id])}}">Unequip</a></td>
                    @else
                        <td class="col-8">Empty</td><td></td>
                @endif
                </tr>
                @endforeach
            </table>
            <br><br>
           <table class="table table-striped">
                <tr class="d-flex">
                    <td class="col-8 font-weight-bold">Inventory</td>
                    <td class="col-2" >capacity {{$char->getCharMaxWeight()}}</td>
                    <td class="col-2" >freespace {{$char->getCharMaxWeight() - $char->getInventoryWeight()}}</td>
                </tr>
                @foreach($inventory as $item)
                    <tr class="d-flex">
                        <td class="col-4">{{$item->name}}</td>
                        <td class="col-2" title="Type">{{$item->type}}</td>
                        <td class="col-2" title="Weight">{{$item->weight}}</td>
                        <td class="col-2"><a href="{{url('inventory/remove', [$char->id, $item->id])}}">Move from inventory</a></td>
                        <td class="col-2">@if(in_array($item->type, ['weapon', 'helmet', 'chest']))<a href="{{url('inventory/equip', [$char->id, $item->id])}}">Equip</a>@endif</td>
                    </tr>
                @endforeach
            </table>
            <table class="table table-striped">
                <label class="font-weight-bold">Other items</label>
                @foreach($otherItems as $item)
                  <tr class="d-flex">
                      <td class="col-4">{{$item->name}}</td>
                      <td class="col-2"title="Type">{{$item->type}}</td>
                      <td class="col-2"title="Weight">{{$item->weight}}</td>
                      <td class="col-4"><a href="{{url('inventory/add', [$char->id, $item->id])}}">Move to inventory</a></td>
                  </tr>
                @endforeach
            </table>

            <br><br>
          @if($itemsJournal && count($itemsJournal) > 0)
            <table class="table table-striped">
                <label class="font-weight-bold">Items Journal</label>
                <thead>
                    <tr class="d-flex">
                        <th class="col-4">Name</th>
                        <th class="col-4">Status</th>
                        <th class="col-4">Date</th>
                    </tr>
                </thead>
                @foreach($itemsJournal as $item)
                    <tr class="d-flex">
                        <td class="col-4">{{$item->item->name}}</td>
                        <td class="col-4">{{$item->status}}</td>
                        <td class="col-4">{{$item->created_at}}</td>
                    </tr>
                @endforeach
            </table>
          @endif
        @endif

    </div>

    <!-- TODO: Текущие задачи -->
@endsection
