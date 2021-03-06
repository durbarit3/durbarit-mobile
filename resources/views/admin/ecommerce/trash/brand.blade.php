@extends('layouts.adminapp')
@section('admin_content')  
            <!-- content wrpper -->
			<div class="content_wrapper">
				<!--middle content wrapper-->
				<!-- page content -->
				<div class="middle_content_wrapper">
					<section class="page_content">
						<!-- panel -->
						<div class="panel mb-0">
							<div class="panel_header">
								<div class="row">
									<div class="col-md-6">
										<div class="panel_title">
											<span class="panel_icon"><i class="fas fa-border-all"></i></span><span>All Deleted Brand</span>
										</div>
									</div>
									<div class="col-md-6 text-right">
										
									</div>
								</div>
								
							</div>
							<form action="{{route('admin.trash.brand.delete')}}" method="post">
						     @csrf
							<button type="submit" style="margin: 5px;" name="submit" class="btn btn-danger" value="delete" ><i class="fa fa-trash"></i> Delete All</button>
				             <button type="submit" style="margin: 5px;" name="submit" class="btn btn-success" value="restore" ><i class="fas fa-trash-restore-alt"></i> Restore All</button>

				             <button type="button"  style="margin: 5px;" class="btn btn-info" ><i class="fas fa-undo"></i> <a href="{{route('admin.brand.all')}}" style="color: #fff;">Back</a></button>
							<div class="panel_body">
								<div class="table-responsive">
		                         <table id="dataTableExample1" class="table table-bordered table-striped table-hover mb-2">
		                              <thead>
		                                  <tr>
		                                      <th>
												<label class="chech_container mb-4">
													<input type="checkbox"  id="check_all">
													<span class="checkmark"></span>
												</label>
		                                      </th>
		                                      <th>Brand Name</th>
		                                      <th>Brand Logo</th>
		               
		                                      <th>manage</th>
		                                  </tr>
		                              </thead>
		                              <tbody>
		                       			@foreach($allbrand as $data)
		                                  <tr>
	                                  		  <td>
												<label class="chech_container mb-4">
													<input type="checkbox" name="delid[]" class="checkbox" value="{{$data->id}}">
													<span class="checkmark"></span>
												</label>
		                                      </td>
		                                      <td>{{$data->brand_name}}</td>
		                                      <td>
		                                      	<img src="{{asset('public/uploads/brand/'.$data->brand_logo)}}" height="45px">
		                                      </td>
		                                     
		                                       <td>
													<a  href="{{url('admin/brand/recover/'.$data->id)}}" class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-placement="right" title="active" data-original-title="Deactive"><i class="fas fa-recycle"></i></a>
													|
		                                            <a id="delete" href="{{url('admin/brand/delete/'.$data->id)}}" class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-placement="right" title="Delete" data-original-title="Delete"><i class="far fa-trash-alt"></i></a>
		                                       </td>
		                                  </tr>
		                             	@endforeach
		                              </tbody>
		                          </table>
		                      </div>
							</div>
						  </form>
						</div>
					</section>
				</div>
			</div>
<!-- modal start-->
  <!-- The Modal -->
  <div class="modal fade bd-example-modal-lg" id="myModal1">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Brand</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form class="form-horizontal" action="{{route('admin.brand.insert')}}" method="POST" enctype="multipart/form-data" >
          	@csrf
			 <div class="form-group row">
			    <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Brand Name:</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" name="brand_name" required>
			    </div>
			  </div>
			  <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label text-right">Brand Logo</label>
                <div class="col-sm-8">
                   <input  type="file" name="pic">
                </div>
               </div>
		    <div class="form-group text-right">
		    	<input type="reset" value="Reset" class="btn btn-warning">
		    	<button type="submit" class="btn btn-blue">Submit</button>
		    </div>
		  </form>
        </div>
        
        <!-- Modal footer -->
       <!--  <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>
<!-- modal end -->

<!-- edit modal -->

<!-- edit modal start-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form class="form-horizontal" action="{{route('admin.category.update')}}" method="POST" enctype="multipart/form-data" >

          	@csrf
			 <div class="form-group row">
			    <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Name:</label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control" name="cate_name" id="cate_name" required>
			      <input type="hidden" name="id" id="id">
			    </div>
			  </div>
			  <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label text-right">Slug</label>
                <div class="col-sm-8">
                   <input class="form-control" type="text" name="cate_slug" id="cate_slug">
                   <p style="font-size: 11px">(If you leave it blank, it will be generated automatically)</p>
                </div>
               </div>

			   <div class="form-group row">
			    <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Image:</label>
			    <div class="col-sm-4">
			      <input type="file" name="pic">
			      <p>(120px*120px)</p>
			    </div>
			    <div class="col-sm-4" id="store-img">
			      
			    </div>
			  </div>
			  <div class="form-group row">
			    
			    <div class="col-sm-3">
			 
			    </div>
			    <div class="col-sm-4" id="img">
			      
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Icon:</label>

			    <div class="col-sm-6">
			      <input type="file" name="icon">
			      <p style="margin-bottom: -10px">(32px*32px)</p>

			    </div>
			    <div class="col-sm-3" id="store-icon">
			    	
			    </div>
			  </div>

			  <div class="form-group row">
			    <div class="col-sm-3">
		
			    </div>
			    <div class="col-sm-4" id="icon">
		
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputEmail3" class="col-sm-3 col-form-label text-right">Meta Tag:</label>
			    <div class="col-sm-8">
			      <input type="text" name="cate_tag_edit" id="cate_tag_edit" class="form-control cate_tag_edit"> 
			    </div>
			  </div>
		    <div class="form-group text-right">
		    	<!-- <input type="" value="Reset" class="btn btn-warning"> -->
		    	<button type="button" class="btn btn-default" data-dismiss="modal" aria-label=""> Close</button>
		    	<button type="submit" class="btn btn-blue">Submit</button>
		    </div>
		  </form>
      </div>
    </div>
  </div>
</div>

<!-- edit modal end -->
<script type="text/javascript">

    $(document).ready(function () {

        $('#check_all').on('click', function(e) {

         if($(this).is(':checked',true))  

         {
            $(".checkbox").prop('checked', true);  

         } else {  

            $(".checkbox").prop('checked',false);  

         }  

        });

    });

</script>
<script type="text/javascript">
  
      $(document).ready(function() {
         $('.editcat').on('click', function(){
             var cate_id = $(this).data('id');
     		
             if(cate_id) {
                 $.ajax({
                     url: "{{ url('/get/category/edit/') }}/"+cate_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                      
                            $("#cate_name").val(data.cate_name);
                            $("#id").val(data.id);
                            $("#cate_slug").val(data.cate_slug);
                            $("#cate_tag_edit").val(data.cate_tag);

                            $("#img").html("<img src={{asset('')}}public/uploads/category/"+data.cate_image+" height='70px'/>");
                            $("#store-img").append("<input type='hidden' name='old_image' value='"+data.cate_image+"' />");
                            $("#icon").html("<img src={{asset('')}}public/uploads/category/"+data.cate_icon+" height='70px'/>");
                            $("#store-icon").append("<input type='hidden' name='old_icon' value='"+data.cate_icon+"' />");
                          
                        } 
                 });
             } else {
                 alert('danger');
             }

         });
     });
</script>
@endsection