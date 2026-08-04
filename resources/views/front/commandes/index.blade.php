
@extends('front.fixe')

@section('body')



<main>
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 --}}
<style>
    .thumbnail {
    position: relative;
    padding: 0px;
    margin-bottom: 20px;
    }
    .thumbnail img {
    width: 80%;
    }
    .thumbnail .caption{
    margin: 7px;
    }
    .main-section{
    background-color: #F8F8F8;
    }
    .dropdown{
    float:right;
    padding-right: 30px;
    }
    .btn{
    border:0px;
    margin:10px 0px;
    box-shadow:none !important;
    }
    .dropdown .dropdown-menu{
    padding:20px;
    top:30px !important;
    width:350px !important;
    left:-110px !important;
    box-shadow:0px 5px 30px black;
    }
    .total-header-section{
    border-bottom:1px solid #d2d2d2;
    }
    .total-section p{
    margin-bottom:20px;
    }
    .cart-detail{
    padding:15px 0px;
    }
    .cart-detail-img img{
    width:100%;
    height:100%;
    padding-left:15px;
    }
    .cart-detail-product p{
    margin:0px;
    color:#000;
    font-weight:500;
    }
    .cart-detail .price{
    font-size:12px;
    margin-right:10px;
    font-weight:500;
    }
    .cart-detail .count{
    color:#C2C2DC;
    }
    .checkout{
    border-top:1px solid #d2d2d2;
    padding-top: 15px;
    }
    .checkout .btn-primary{
    border-radius:50px;
    height:50px;
    }
    .dropdown-menu:before{
    content: " ";
    position:absolute;
    top:-20px;
    right:50px;
    border:10px solid transparent;
    border-bottom-color:#fff;
    }
</style>

<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
        @foreach(session('cart') as $id => $details)
        @php $total += $details['originalPrice'] * $details['quantity'] @endphp
        <tr data-id="{{ $id }}">
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100"
                            class="img-responsive" /></div>
                    <div class="col-sm-9">
                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                    </div>
                </div>
            </td>
            <td data-th="Price">${{ $details['originalPrice'] }}</td>
            <td data-th="Quantity">
                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
            </td>
            <td data-th="Subtotal" class="text-center">${{ $details['originalPrice'] * $details['quantity'] }}</td>
            <td class="actions" data-th="">
                <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-center">
                <h3><strong>Total ${{ $total }}</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-center">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button class="px-6 py-2 text-red-800 bg-red-300">Remove All Cart</button>
                </form>
                <a href="{{url('AllProducts')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success">Checkout</button>
                <a {{-- href="{{ route('commandes.create') }}" --}}class="btn btn-success">Commanderhh</a>
                <a href="{{ url('checkout') }}" class="btn btn-warning check-btn">Proceed Checkout</a>
            </td>
        </tr>

    </tfoot>
</table>


@section('scripts')
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>



  <script>

    document.addEventListener('DOMContentLoaded', () => {
      const quantities = document.querySelectorAll('input[name="quantity"]');
      quantities.forEach( input => {
        input.addEventListener('input', e => {
          if(e.target.value < 1) {
            e.target.value = 1;
          } else {
            e.target.parentNode.parentNode.submit();
            document.querySelector('#wrapper').classList.add('hide');
            document.querySelector('#action').classList.add('hide');
            document.querySelector('#loader').classList.remove('hide');
          }
        });
      });

      const deletes = document.querySelectorAll('.deleteItem');
      deletes.forEach( icon => {
        icon.addEventListener('click', e => {
          e.target.parentNode.parentNode.submit();
          document.querySelector('#wrapper').classList.add('hide');
          document.querySelector('#loader').classList.remove('hide');
        });
      });
    });

  </script>

</main>

@endsection
