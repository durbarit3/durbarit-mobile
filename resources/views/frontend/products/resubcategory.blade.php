@extends('layouts.websiteapp')
@section('main_content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link id="color_scheme" href="{{asset('public/frontend/css/theme.css')}}" rel="stylesheet">

<!-- Main Container  -->
<div class="search-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-content">
                    <div class="row" id="search_result_product">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="main_content">
  @php
  $cateid=$resubcate->cate_id;
  $nbanimage=App\CategoryBanner::where('section',4)->where('category_id',$cateid)->orderBy('id','DESC')->first();

  @endphp
  @if($nbanimage)
    @php
      $site=$nbanimage->siteban_id;
      $maiimage=App\SiteBanner::where('id',$site)->where('is_deleted',0)->where('status',1)->first();
    @endphp
    @if($maiimage)
    <div class="breadcrumbs" style="background: url({{asset('public/uploads/sitebanner/'.$maiimage->image)}}) no-repeat center top;">
        <div class="container">
            <div class="title-breadcrumb">
            {{$resubcate->resubcate_name}}
            </div>
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="">{{$resubcate->resubcate_name}}</a></li>
            </ul>
        </div>
    </div>
    @else
    <div class="breadcrumbs" style="background: url({{asset('public/frontend/image/breadcrumbs.jpg')}}) no-repeat center top;">
        <div class="container">
            <div class="title-breadcrumb">
            {{$resubcate->resubcate_name}}
            </div>
            <ul class="breadcrumb-cate">
                <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="">{{$resubcate->resubcate_name}}</a></li>
            </ul>
        </div>
    </div>
    @endif
@else
<div class="breadcrumbs" style="background: url({{asset('public/frontend/image/breadcrumbs.jpg')}}) no-repeat center top;">
    <div class="container">
        <div class="title-breadcrumb">
        {{$resubcate->resubcate_name}}
        </div>
        <ul class="breadcrumb-cate">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="">{{$resubcate->resubcate_name}}</a></li>
        </ul>
    </div>
</div>
@endif
    <div class="container product-detail">
        <div class="row">


        {{-- Re-Sub-Category Page Sidebar --}}
        <aside class="col-md-3 col-sm-4 col-xs-12 content-aside left_column sidebar-offcanvas">
            <span id="close-sidebar" class="fa fa-times"></span>
            <div class="module so_filter_wrap filter-horizontal">
                <h3 class="modtitle"><span>SHOP BY</span></h3>
                <div class="modcontent">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <li class="so-filter-options" data-option="search">
                                <div class="so-filter-heading">
                                    <div class="so-filter-heading-text">
                                        <span>Search</span>
                                    </div>
                                    <i class="fa fa-chevron-down"></i>
                                </div>
                                <div class="so-filter-content-opts">
                                    <div class="so-filter-content-opts-container">
                                        <div class="so-filter-option" data-type="search">
                                            <div class="so-option-container">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        data-id="{{ $resubcate->id }}" name="search_field"
                                                        id="search_field">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default" type="button"
                                                            id="submit_text_search"><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>

                    <div class="clear_filter">
                        <a href="javascript:;" class="btn btn-default inverse" id="btn_resetAll">
                            <span class="hidden fa fa-times" aria-hidden="true"></span> Reset All
                        </a>
                    </div>
                </div>
            </div>

            <div class="moduletable module so-extraslider-ltr best-seller best-seller-custom">
                <h3 class="modtitle"><span>Best Sellers</span></h3>
                <div class="modcontent">
                    <div id="so_extra_slider"
                        class="so-extraslider buttom-type1 preset00-1 preset01-1 preset02-1 preset03-1 preset04-1 button-type1">
                        <div class="extraslider-inner owl2-carousel owl2-theme owl2-loaded extra-animate"
                            data-effect="none">
                            <div class="item ">




                                @php
                                $products =
                                App\Product::whereNotNull('number_of_sale')->orderBy('number_of_sale','desc')->limit(5)->get();
                                @endphp
                                <!-- End item-wrap -->
                                @foreach($products as $row)
                                <div class="item-wrap style1 ">
                                    <div class="item-wrap-inner">
                                        <div class="media-left">
                                            <div class="item-image">
                                                <div class="item-img-info product-image-container ">
                                                    <div class="box-label">
                                                    </div>
                                                    <a href="{{url('product/'.$row->slug.'/'.$row->id)}}" class="lt-image" target="_self"
                                                        title="Philipin Tour Group Manila/ Pattaya / Mactan ">
                                                        <img src="{{asset('public/uploads/products/thumbnail/productdetails/'.$row->thumbnail_img)}}"
                                                            alt="Philipin Tour Group Manila/ Pattaya / Mactan ">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="item-info">
                                                <!-- Begin title -->
                                                <div class="item-title">
                                                    <a href="{{url('product/'.$row->slug.'/'.$row->id)}}"
                                                        target="_self"
                                                        title="Philipin Tour Group Manila/ Pattaya / Mactan  ">
                                                        {{Str::limit($row->product_name,20)}}
                                                    </a>
                                                </div>
                                                <!-- Begin ratting -->
                                                <div class="rating">
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star fa-stack-2x"></i><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star fa-stack-2x"></i><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star fa-stack-2x"></i><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                </div>
                                                <!-- Begin item-content -->
                                                <div class="price">
                                                    <span
                                                        class="old-price product-price">${{$row->product_price}}</span>
                                                    <span class="price-old">$122.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End item-info -->
                                    </div>
                                    <!-- End item-wrap-inner -->
                                </div>
                                <!-- End item-wrap -->
                                @endforeach

                                <!-- End item-wrap -->
                            </div>


                            <div class="item ">

                                @php
                                $products =
                                App\Product::whereNotNull('number_of_sale')->orderBy('number_of_sale','desc')->offset(5)->limit(5)->get();
                                @endphp
                                <!-- End item-wrap -->
                                @foreach($products as $row)
                                <div class="item-wrap style1 ">
                                    <div class="item-wrap-inner">
                                        <div class="media-left">
                                            <div class="item-image">
                                                <div class="item-img-info product-image-container ">
                                                    <div class="box-label">
                                                    </div>
                                                    <a href="{{url('product/'.$row->slug.'/'.$row->id)}}" class="lt-image" target="_self"
                                                        title="{{$row->product_name}}">
                                                        <img src="{{asset('public/uploads/products/thumbnail/productdetails/'.$row->thumbnail_img)}}"
                                                            alt="Philipin Tour Group Manila/ Pattaya / Mactan ">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="item-info">
                                                <!-- Begin title -->
                                                <div class="item-title">
                                                    <a href="{{url('product/'.$row->slug.'/'.$row->id)}}"
                                                        target="_self"
                                                        title="Philipin Tour Group Manila/ Pattaya / Mactan  ">
                                                        {{Str::limit($row->product_name,40)}}
                                                    </a>
                                                </div>
                                                <!-- Begin ratting -->
                                                <div class="rating">
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star fa-stack-2x"></i><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star fa-stack-2x"></i><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star fa-stack-2x"></i><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                    <span class="fa fa-stack"><i
                                                            class="fa fa-star-o fa-stack-2x"></i></span>
                                                </div>
                                                <!-- Begin item-content -->
                                                <div class="price">
                                                    <span
                                                        class="old-price product-price">${{$row->product_price}}</span>
                                                    <span class="price-old">$122.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End item-info -->
                                    </div>
                                    <!-- End item-wrap-inner -->
                                </div>
                                <!-- End item-wrap -->
                                @endforeach

                                <!-- End item-wrap -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="module banner-left hidden-xs ">
                <div class="static-image-home-left banners">
                    <div>
                        @php
                        $img=App\SiteBanner::where('section',5)->orderBy('id','DESC')->limit(1)->inRandomOrder()->get();
                        @endphp

                        @foreach($img as $newimg)
                        <a title="Static Image" href="{{$newimg->link}}">
                            <img src="{{asset('public/uploads/sitebanner/'.$newimg->image)}}" alt="Static Image">
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>
        {{-- Re-Sub-Category Page Sidebar ended --}}

            <div id="content" class="col-md-9 col-sm-12 col-xs-12">
                <div class="module banners-effect-9 form-group">
                    <div class="banners">
                      @php
                        $subcaid=$resubcate->cate_id;
                        $nbnimage=App\CategoryBanner::where('section',2)->where('category_id',$subcaid)->orderBy('id','DESC')->first();
                      @endphp
                      @if($nbnimage)
                        @php
                          $ste=$nbnimage->siteban_id;
                          $maimage=App\SiteBanner::where('id',$ste)->where('is_deleted',0)->where('status',1)->first();
                        @endphp
                        @if($maimage)
                        <div>
                            <a href="#"><img src="{{asset('public/uploads/sitebanner/'.$maimage->image)}}"></a>
                        </div>
                        @else
                        <div>
                            <a href="#"><img src="{{asset('public/frontend/')}}/image/catalog/demo/category/men-cat.jpg"></a>
                        </div>
                        @endif
                      @else
                      <div>
                          <a href="#"><img src="{{asset('public/frontend/')}}/image/catalog/demo/category/men-cat.jpg"></a>
                      </div>
                      @endif
                    </div>
                </div>
                <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i
                        class="fa fa-bars"></i>Sidebar</a>

                <div class="products-category">
                    <div class="form-group clearfix">
                        <h3 class="title-category ">{{$resubcate->resubcate_name}}</h3>
                    </div>
                    <div class="search_category_product">

                    </div>
                    <div class="all_category_wise_product">
                        <div class="products-category">
                            <div class="product-filter filters-panel">
                                <div class="row">
                                    <div class="col-sm-2 view-mode hidden-sm hidden-xs">
                                        <div class="list-view">
                                            <button class="btn btn-default grid active" data-view="grid"
                                                data-toggle="tooltip" data-original-title="Grid"><i
                                                    class="fa fa-th"></i></button>
                                            <button class="btn btn-default list" data-view="list" data-toggle="tooltip"
                                                data-original-title="List"><i class="fa fa-th-list"></i></button>
                                        </div>
                                    </div>

                                    <div class="short-by-show form-inline text-right col-md-10 col-sm-12">
                                        <div class="form-group short-by">
                                            <label class="control-label" for="input-sort">Sort By:</label>
                                            <select id="input-sort" class="form-control"
                                                onchange="location = this.value;">
                                                <option value="" selected="selected">Default</option>
                                                <option value="">Name (A - Z)</option>
                                                <option value="">Name (Z - A)</option>
                                                <option value="">Price (Low &gt; High)</option>
                                                <option value="">Price (High &gt; Low)</option>
                                                <option value="">Rating (Highest)</option>
                                                <option value="">Rating (Lowest)</option>
                                                <option value="">Model (A - Z)</option>
                                                <option value="">Model (Z - A)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="input-limit">Show:</label>
                                            <select id="input-limit" class="form-control"
                                                onchange="location = this.value;">
                                                <option value="" selected="selected">12</option>
                                                <option value="">25</option>
                                                <option value="">50</option>
                                                <option value="">75</option>
                                                <option value="">100</option>
                                            </select>
                                        </div>
                                        <div class="form-group product-compare"><a id="compare-total"
                                                class="btn btn-default">Product Compare (0)</a></div>
                                    </div>

                                </div>
                            </div>
                            <div class="products-list grid row number-col-3 so-filter-gird" id="filter">
                                <!-- category product -->
                                @php
                                $products=App\Product::where('is_deleted',0)->where('resubcate_id',$resubcate->id)->orderBy('id','DESC')->paginate(6);
                                @endphp
                                @foreach($products as $product)
                                <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container  second_img  ">
                                                <a href="{{url('product/'.$product->slug.'/'.$product->id)}}" title="Lorem Ipsum dolor at vero eos et iusto odi  with Premium ">
                                                    <img src="{{asset('public/uploads/products/thumbnail/'.$product->thumbnail_img)}}"
                                                        alt="Lorem Ipsum dolor at vero eos et iusto odi  with Premium "
                                                        title="Lorem Ipsum dolor at vero eos et iusto odi  with Premium "
                                                        class="img-1 img-responsive">
                                                    <img src="{{asset('public/uploads/products/thumbnail/'.$product->thumbnail_img)}}"
                                                        alt="Lorem Ipsum dolor at vero eos et iusto odi  with Premium "
                                                        title="Lorem Ipsum dolor at vero eos et iusto odi  with Premium "
                                                        class="img-2 img-responsive">
                                                </a>
                                            </div>
                                            <!-- <div class="countdown_box">
                                                <div class="countdown_inner">
                                                </div>
                                            </div> -->
                                            <div class="box-label">
                                                <span class="label-product label-sale">
                                                    Sale
                                                </span>
                                            </div>
                                        </div>

                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="{{url('product/'.$product->slug.'/'.$product->id)}}">{{Str::limit($product->product_name,40)}}</a>
                                                </h4>
                                                <div class="total-price">
                                                @php
                                                    $flashdealdetail = App\FlashDealDetail::where('product_id',$product->id)->get();
                                                @endphp
                                                    <div class="price price-left">
                                                        @if(count($flashdealdetail) > 0)
                                                            @foreach($flashdealdetail as $row)
                                                            <?php    $productdiscount =($product->product_price * $row->discount)/100; ?>
                                                                @if($row ->discount_type == 1 )
                                                                    <span class="price-new">

                                                                    ৳ {{$product->product_price - $row->discount}} </span> <span class="price-old">৳ {{$product->product_price}}
                                                                    </span>
                                                                @else
                                                                    <span class="price-new">
                                                                    ৳ {{$product->product_price -$productdiscount}} </span> <span class="price-old">৳ {{$product->product_price}}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <span class="price-new">
                                                                ৳ {{$product->product_price}}
                                                            </span>

                                                        @endif

                                                    </div>
                                                    <div class="price-sale price-right">

                                                                @foreach($flashdealdetail as $row)
                                                                @if($row ->discount_type == 1 )
                                                                <span class="discount">

                                                                    - ৳ {{$row->discount}}
                                                                    <strong>OFF</strong>
                                                                </span>
                                                                @else
                                                                <span class="discount">
                                                                    -{{$row->discount}}%

                                                                    <strong>OFF</strong>
                                                                </span>
                                                                @endif
                                                                @endforeach
                                                    </div>
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>The 30-inch Apple Cinema HD Display delivers an amazing 2560 x
                                                        1600 pixel resolution. Designed specifically for the creative
                                                        professional, this display provides more space for easier access
                                                        to all the.. </p>
                                                </div>
                                                <div class="list-block hidden">


                                                                            <form class="option-choice-form" onclick="producttocart(this);">

                                                                                <input type="hidden" value="1" name="quantity">
                                                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                                                <input type="hidden" value="{{$product->product_price}}" name="product_price">

                                                    @if($product->product_type ==1)
                                                        <a class="addToCart btn-button btn-quickview quickview quickview_handler" href="{{url('details/'.$product->id)}}" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">
                                                            <button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('30 ', '1 ');" data-original-title="Add to Cart "><span>Add to Cart </span></button>
                                                        </a>


                                                        @else
                                                            <button class="addToCart" type="button" data-toggle="tooltip" title="" onclick="cart.add('30 ', '1 ');productaddtocart(this);" data-original-title="Add to Cart "><span>Add to Cart </span></button>
                                                        @endif

                                                    </form>
                                                    <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="" onclick="wishlist.add('30 ');" data-original-title="Add to Wish List "><i class="fa fa-heart-o"></i></button>
                                                    <button class="compare btn-button" type="button" data-toggle="tooltip" title="" onclick="compare.add('30 ');" data-original-title="Compare this Product "><i class="fa fa-retweet"></i></button>
                                                </div>
                                            </div>
                                            <div class="button-group">
                                                                        <div class="button-inner so-quickview">
                                                                            <a class="lt-image hidden" href="#" target="_self" title="Anantara Dhigu Resort &amp;amp; Spa, Maldives Hair Spa"></a>
                                                                            <a class="btn-button btn-quickview quickview quickview_handler" href="{{url('details/'.$product->id)}}" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>
                                                                            @if(Auth::guard('web')->check())
                                                                            <button class="mywishlist btn-button" type="button" data-toggle="tooltip" title="" data-original-title="add to Wish List" data-id="{{$product->id}}"> <i class="fa fa-heart"></i></button>
                                                                            @else
                                                                            <a href="{{route('login')}}" class="compare btn-button"><i class="fa fa-heart"></i></a>
                                                                            @endif

                                                                            <button class="compare btn-button compareproduct" type="button" id="compareproduct" value="{{$product->id }}"><i class="fa fa-exchange"></i></button>









                                                                            <form class="option-choice-form" onclick="resubadtocart(this);">

                                                                                <input type="hidden" value="1" name="quantity">
                                                                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                                                                <input type="hidden" value="{{$product->product_price}}" name="product_price">
                                                                                @if($product->product_type ==1)
                                                                                <a class="addToCart btn-button btn-quickview quickview quickview_handler" href="{{url('details/'.$product->id)}}" title="Quick View" data-title="Quick View" data-fancybox-type="iframe">
                                                                                    <i class="fa fa-search"></i>
                                                                                    <input type="hidden" name="combination">
                                                                                </a>
                                                                                @else
                                                                                <button class="addToCart btn-button" type="button" data-toggle="tooltip" title="" onclick="cart.add('114');" data-original-title="Add to cart">
                                                                                    <span class="hidden">Add to cart</span>
                                                                                </button>
                                                                                @endif
                                                                            </form>


                                                                        </div>
                                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- endcategory product -->

                            </div>

                            <div class="product-filter product-filter-bottom filters-panel">
                                <div class="col-sm-6 text-left">
                                    <ul class="pagination">
                                      {{ $products->links() }}
                                    </ul>
                                </div>
                                <div class="col-sm-6 text-right">Showing 1 to 9 of 9 (1 Pages)</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- //Main Container -->

@endsection
@push('js')
<script>
        function resubadtocart(el) {
            var product_id = el.product_id.value;
            var product_price = el.product_price.value;
            var quantity = el.quantity.value;
            if (!el.combination) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('product.add.cart') }}",
                    data: {
                        product_id: product_id,
                        product_price: product_price,
                        quantity: quantity,
                    },
                    success: function(data) {
                        console.log(data);
                        document.getElementById('cartdatacount').innerHTML = data.quantity;
                        document.getElementById('product_price').innerHTML = data.total;

                    }
                })
            }


        }
    </script>

<script>
    $(document).ready(function () {

        $(".fa-chevron-down").on('click', function () {
            $('.so-filter-content-opts').toggle();
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.search_category_product').hide();
        $('#search_field').on('keyup', function () {

            var product_name = $(this).val();
            var catId = $(this).attr('data-id');
            if (product_name === "") {
                $('.search_category_product').hide();
                $('.all_category_wise_product').show();
            } else {
                $('.all_category_wise_product').hide();
                $('.search_category_product').show();
            }
            $.ajax({
                url: "{{ url('search/product/by/re_sub/category') }}" + "/" + catId + "/" + product_name,
                type: 'get',
                success: function (data) {
                    if (!$.isEmptyObject(data)) {
                        $('.search_category_product').empty();
                        $('.search_category_product').append(data);
                    } else {
                        $('.search_category_product').empty();
                        $('.search_category_product').append("<h1>No Data Found</h1>");
                    }
                }
            });
        })
        $('#btn_resetAll').on('click', function(){
          $('#search_field').val('');
          $('.search_category_product').hide();
          $('.all_category_wise_product').show();
       });
    });
</script>
<style>
    /* .module.so_filter_wrap {
    box-shadow: 1px 1px 5px 0 rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    border-top: 2px solid #ff5e00;
    overflow: hidden;
}
.content-aside .module {
    margin-bottom: 30px;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
    border-top: 2px solid #ff5e00;
}

.module.so_filter_wrap .modcontent {
    border: none;
    background: #fff;
    border-radius: 0;
    margin: 0 20px;
}
.so_filter_wrap .modcontent ul {
    margin: 0;
    padding: 0;
}

.so_filter_wrap .modcontent .so-filter-heading {
    background: #f1f1f1;
    display: block;
    overflow: hidden;
    cursor: pointer;
}
.so_filter_wrap .modcontent .so-filter-heading {
    background: #f1f1f1;
    display: block;
    overflow: hidden;
    cursor: pointer;
} */
</style>
@endpush
