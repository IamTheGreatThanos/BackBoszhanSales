<h2>Торговый точка</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>название</th>
            <th>Телефон номер</th>
            <th>Адрес</th>
            <th>БИН</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$store->id}}</td>
            <td>{{$store->name}}</td>
            <td>{{$store->phone}}</td>
            <td>{{$store->address}}</td>
            <td>{{$store->bin}}</td>
        </tr>
    </tbody>
</table>
<h2>Заявка</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Торговый представитель</th>
            <th>Водитель</th>
            <th>Дата создание</th>
            <th>Дата</th>
            <th>Статус</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->salesrep->name}}</td>
            <td>{{$order->driver?->name}}</td>
            <td>{{$order->created_at}}</td>
            <td>{{$order->delivery_date}}</td>
            <td>{{$order->status->description}}</td>
        </tr>
    </tbody>
</table>
<h2>продажа</h2>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Продукт</th>
        <th>Артикул</th>
        <th>шт/кг</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>итог</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->baskets()->whereType(0)->get() as $basket)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$basket->product->name}}</td>
            <td>{{$basket->product->article}}</td>
            <td>{{$basket->product->measureDescription()}}</td>
            <td>{{$basket->price}}</td>
            <td>{{$basket->count}}</td>
            <td>{{$basket->all_price}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="7">{{$order->purchase_price}}</td>
    </tr>
    </tbody>
</table>
<h2>Возвраты</h2>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Продукт</th>
        <th>Артикул</th>
        <th>шт/кг</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>итог</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->baskets()->whereType(1)->get() as $basket)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$basket->product->name}}</td>
            <td>{{$basket->product->article}}</td>
            <td>{{$basket->product->measureDescription()}}</td>
            <td>{{$basket->price}}</td>
            <td>{{$basket->count}}</td>
            <td>{{$basket->all_price}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="7">{{$order->return_price}}</td>
    </tr>
    </tbody>
</table>
