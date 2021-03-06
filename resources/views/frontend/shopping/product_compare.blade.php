@extends('layouts.websiteapp')
@section('main_content')
<div class="modal fade in" id="so_sociallogin" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-dialog block-popup-login">
                <a href="javascript:void(0)" title="Close" class="close close-login fa fa-times-circle" data-dismiss="modal"></a>
                <div class="tt_popup_login"><strong>Sign in Or Register</strong></div>
                <div class="block-content">
                    <div class=" col-reg registered-account">
                        <div class="block-content">
                            <form class="form form-login" action="#" method="post" id="login-form">
                                <fieldset class="fieldset login" data-hasrequired="* Required Fields">
                                    <div class="field email required email-input">
                                        <div class="control">
                                            <input name="email" value="" autocomplete="off" id="email" type="email" class="input-text" title="Email" placeholder="E-Mail Address">
                                        </div>
                                    </div>
                                    <div class="field password required pass-input">
                                        <div class="control">
                                            <input name="password" type="password" autocomplete="off" class="input-text" id="pass" title="Password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class=" form-group">
                                        <label class="control-label">Login with your social account</label>
                                        <div>

                                            <a href="#" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>

                                            <a href="#" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>

                                            <a href="#" class="btn btn-social-icon btn-sm btn-twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></a>

                                            <a href="#" class="btn btn-social-icon btn-sm btn-linkdin"><i class="fa fa-linkedin fa-fw" aria-hidden="true"></i></a>

                                        </div>
                                    </div>

                                    <div class="secondary ft-link-p"><a class="action remind" href="#"><span>Forgot Your Password?</span></a></div>
                                    <div class="actions-toolbar">
                                        <div class="primary">
                                            <button type="submit" class="action login primary" name="send" id="send2"><span>Login</span></button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="col-reg login-customer">

                        <h2>NEW HERE?</h2>
                        <p class="note-reg">Registration is free and easy!</p>
                        <ul class="list-log">
                            <li>Faster checkout</li>
                            <li>Save multiple shipping addresses</li>
                            <li>View and track orders and more</li>
                        </ul>
                        <a class="btn-reg-popup" title="Register" href="#">Create an account</a>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
         </div>

		<div class="breadcrumbs">
			<div class="container">
				<div class="title-breadcrumb">
					PRODUCT COMPARISON
				</div>
				<ul class="breadcrumb-cate">
					<li><a href="index.html"><i class="fa fa-home"></i></a></li>
					<li><a href="#">Product Comparison</a></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div id="content" class="col-sm-12">
					<h1>Product Comparison</h1>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<td colspan="4"><strong>Product Details</strong></td>
								</tr>
							</thead>
              @php
                $userid =  \Request::getClientIp(true);
                $com=App\CompareProduct::where('ip_address',$userid)->orderBy('id','DESC')->limit(3)->get();
              @endphp
							<tbody>
								<tr>
									<td>Product</td>
                  @foreach($com as $data)
									<td><a href="#"><strong>{{$data->product->product_name}}</strong></a></td>
                  @endforeach
								</tr>
								<tr>
									<td>Image</td>
                  @foreach($com as $data)
									<td class="text-center"> <img src="{{asset('public/uploads/products/thumbnail/smallthum/'.$data->product->thumbnail_img)}}"class="img-thumbnail" /> </td>
                  @endforeach
                </tr>
								<tr>
									<td>Price</td>
                  @foreach($com as $data)
									<td> {{$data->product->product_price}}</td>
                  @endforeach
								</tr>
								<tr>
									<td>SKU</td>
                  @foreach($com as $data)
									<td>{{$data->product->product_sku}}</td>
                  @endforeach
								</tr>
								<tr>
									<td>Brand</td>
                  @foreach($com as $data)
									<td>New</td>
                  @endforeach
								</tr>
								<tr>
									<td>Availability</td>
                  @foreach($com as $data)
									<td>{{$data->product->product_qty}}</td>
                  @endforeach
								</tr>
								<tr>
									<td>Rating</td>
                    @foreach($com as $data)
									<td class="rating">
										<span class="fa fa-stack">
											<i class="fa fa-star fa-stack-2x"></i>
											<i class="fa fa-star-o fa-stack-2x"></i>
											</span>

										<br /> Based on 1 reviews.
                  </td>
                  @endforeach
								</tr>
							</tbody>

							<tr>
								<td></td>
                @foreach($com as $data)
								<td>
									<input type="button" value="Add to Cart" class="btn btn-primary btn-block" onclick="cart.add('30', '1');" />
									<a href="{{url('/compare/delete/'.$data->id)}}" class="btn btn-danger btn-block">Remove</a></td>
                  @endforeach

							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
    @endsection
