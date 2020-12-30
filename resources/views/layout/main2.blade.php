<!DOCTYPE html>
<html lang="en">
    @include('includes.manifest2')
<body>
    <div>
        @include('includes.header2')
        @yield('content')
        @include('includes.footer2')
    </div>
    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
    </div>
    @include('includes.js2')
    @yield('script')

    <script>
        $(document).ready(function(){
            // Cookies.remove('cart-products');
            // Cookies.remove('cart-quantities');
            getCart();
            @if (empty($active))
                $("#menu-item").addClass("active");
            @else
                $("#nav-{{$active}}").addClass("active");
            @endif
        });
        function getCart(){
            var products = JSON.parse(Cookies.get('cart-products') ?? "[]");
            var quantities = JSON.parse(Cookies.get('cart-quantities') ?? "[]");
            console.log(products);
            console.log(quantities);
            $('#span-cart').text(products.length);
        }
        function addToCart(product, quantity){

            var indexProduct = -1;

            var products = JSON.parse(Cookies.get('cart-products') ?? "[]");
            var quantities = JSON.parse(Cookies.get('cart-quantities') ?? "[]");

            products.forEach(function(value, index){
                if(value == product)
                    indexProduct = index;
            });

            if(indexProduct != -1){
                quantities[indexProduct] = quantities[indexProduct] + quantity;
            }else{
                products.push(product);
                quantities.push(quantity);
            }

            console.log(products);
            console.log(quantities);

            Cookies.set('cart-products', "[" + products + "]", { expires: 60});
            Cookies.set('cart-quantities', "[" + quantities + "]", { expires: 60});

            $('#span-cart').text(products.length);
            $('.js-gotop').click();
        }
    </script>
</body>
</html>