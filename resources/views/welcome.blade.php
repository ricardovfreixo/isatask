@extends('master')


@section('content')

<div class="container">
    <div class="columns">
        <div class="column is-one-third">
            <strong class="title is-3">Color</strong>
            <li><a href="/">All</a></li>
            @foreach ($colors as $color => $amount)
                <li>
                <a href="javascript:setColor('{{$color}}')">{{$color}}({{$amount}})</a>
                </li>
            @endforeach
            <strong class="title is-3">Brand</strong>
            @foreach ($brands as $brand => $amount)
                <li>{{$brand}}({{$amount}})</li>
            @endforeach
        </div>
        <div class="column is-two-thirds">
            Price: <a href="javascript:setPriceSorting('asc')">Ascending</a>
            | <a href="javascript:setPriceSorting('desc')">Descending</a>
            @foreach($products as $product)
            <div class="card">
                <div class="card-content">
                  <div class="media">
                    <div class="media-left">
                      <figure class="image is-48x48">
                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                      </figure>
                    </div>
                    <div class="media-content">
                      <p class="title is-4">{{$product->name}}</p>
                      <p class="subtitle is-6">
                          <em>{{$product->brand}}</em> <br>

                          @if(isset($p->special_price))
                            Price: <span style="text-decoration: line-through">{{$product->price}}</span> <br>
                            Special Price: <strong>{{$product->special_price}}</strong>
                          @else
                            Price: <strong>{{$product->price}}</strong>
                          @endif
                        </p>
                    </div>
                  </div>

                  <div class="content">
                    {{$product->description}}
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    let colorCriteria = urlParams.get('color');
    let brandCriteria = urlParams.get('brand');
    let priceCriteria = urlParams.get('price');

    function setColor(color) {
        colorCriteria = color;
        applyFilter();
    }

    function setBrand(brand) {
        brandCriteria = brand;
        applyFilter();
    }

    function setPriceSorting(direction) {
        priceCriteria = direction;
        applyFilter();
    }
    function applyFilter() {
        let querystring = '?';
        if(colorCriteria != null)
        {
            querystring +='color='+colorCriteria
        }

        if(priceCriteria != null)
        {
            if(querystring.length > 0) querystring += '&';
            querystring +='price='+priceCriteria
        }

        if(brandCriteria != null)
        {
            if(querystring.length > 0) querystring += '&';
            querystring +='brand='+brandCriteria
        }

        window.location.href = '/' + querystring;
    }
</script>
@endsection
