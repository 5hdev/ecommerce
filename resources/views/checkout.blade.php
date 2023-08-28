@extends('layout')
  
@section('content')
    <section class="section-pagetop">
        <div class="container clearfix">
            <h2 class="title-page">Checkout</h2>
        </div>
    </section>
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                    <p class="cartMsg"></p>
                </div>
            </div>
            <form action="#" method="POST" role="form" id="myForm">
                @csrf
                <input type="hidden" name="user_id" value="2">
                @php $total = 0 @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <input type="hidden" name="product_id[]" value="{{$id}}">
                        <input type="hidden" name="quantity[]" value="{{$details['quantity']}}">
                        <input type="hidden" name="price[]" value="{{$details['price']}}">
                    @endforeach
                @endif
                @php $tax = $total * 0.14 @endphp

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <header class="card-header">
                                <h4 class="card-title mt-2">Billing Details</h4>
                            </header>
                            <article class="card-body">
                                <div class="form-row">
                                    <div class="col form-group">
                                        <label>First name</label>
                                        <input type="text" class="form-control" name="firstname">
                                    </div>
                                    <div class="col form-group">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" name="lastname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="line1">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" name="mobile">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" value="">
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <header class="card-header">
                                        <h4 class="card-title mt-2">Your Order</h4>
                                    </header>
                                    <article class="card-body">
                                        <dl class="dlist-align">
                                            <dt>Subtotal : </dt>
                                            <dd class="text-right h5 b"> {{$total}}</dd>
                                            <dt>Tax : </dt>
                                            <dd class="text-right h5 b"> {{$tax}}</dd>
                                            <dt>Total : </dt>
                                            <dd class="text-right h5 b"> {{$total + $tax}}</dd>
                                        </dl>
                                        <input type="hidden" name="subtotal" value="{{$total}}">
                                        <input type="hidden" name="tax" value="{{$tax}}">
                                        <input type="hidden" name="total" value="{{$total + $tax}}">
                                    </article>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block" onclick="submitCart(event)">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <script type="text/javascript">
        function submitCart(e) {
        e.preventDefault();
        var form = document.getElementById('myForm');
        var form_data = $('#myForm').serialize();;
        // var form_data = new FormData(form);
        

        console.log('form_data');
        console.log(form_data);

        $.ajax({
            url:'{{url("api/order_post")}}',
            type:'POST',
            dataType:'json',
            data:form_data,
            success:function(data)
            {
                $('#myForm').html(data.message);
                $('.cartMsg').html('');
                $.ajax({
                    url: '{{ route('empty.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                    },
                    success: function (response) {
                        // window.location.reload();
                    }
                });
            },
            error:function(res)
            {
                console.log('error');
                console.log(res.responseJSON.errors);
                if (res.responseJSON.errors) {
                    var errorString = '<ul>';
                    $.each(res.responseJSON.errors, function( key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul>';

                    $('.cartMsg').html('<span class="error">'+errorString+'<hr></span>');
                }
            }
        }); 
        return false;
    }
    </script>
@stop