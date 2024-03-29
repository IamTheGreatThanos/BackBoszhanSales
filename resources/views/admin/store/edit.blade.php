@extends('admin.layouts.index')
@section('content')
    <form class="store-edit" action="{{route('admin.store.update',$store->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">название</label>
                    <input type="text" class="form-control" name="name"  value="{{$store->name}}" required>
                </div>
                <div class="form-group">
                    <label for="">Телефон номер</label>
                    <input type="text" class="form-control" name="phone"  value="{{$store->phone}}">
                </div>
                <div class="form-group">
                    <label for="">id_1c</label>
                    <input type="text" class="form-control" name="id_1c"  value="{{$store->id_1c}}">
                </div>
                <div class="form-group">
                    <label for="">БИН</label>
                    <input type="text" class="form-control" name="bin" value="{{$store->bin}}">
                </div>
                <div class="form-group">
                    <label for="">Адрес</label>
                    <input type="text" class="form-control" name="address" value="{{$store->address}}">
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label for="">lat</label>
                        <input type="text" class="form-control" name="lat" value="{{$store->lat}}">
                    </div>
                    <div class="col form-group">
                        <label for="">lng</label>
                        <input type="text" class="form-control" name="lng" value="{{$store->lng}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Скидка %</label>
                    <input type="text" class="form-control" name="discount" value="{{$store->discount}}">
                </div>
                <div class="form-group">
                    <label for="">Контрагент</label>
                    <select name="counteragent_id" class="form-control">
                        <option value="">---</option>

                    @foreach($counteragents as $counteragent)
                            <option {{$store->counteragent_id == $counteragent->id ? 'selected':""}} value="{{$counteragent->id}}">{{$counteragent->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Торговый</label>
                    <select name="salesrep_id" class="form-control">
                        @foreach($salesreps as $salesrep)
                            <option {{$store->salesrep_id == $salesrep->id ? 'selected':""}} value="{{$salesrep->id}}">{{$salesrep->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Водитель</label>
                    <select name="driver_id" class="form-control">
                        <option value="">----</option>
                        @foreach($drivers as $driver)
                            <option {{$store->driver_id == $driver->id ? 'selected':""}} value="{{$driver->id}}">{{$driver->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="mt-5 mb-10 btn btn-primary col-3 ">Сохранить</button>
    </form>
@endsection
