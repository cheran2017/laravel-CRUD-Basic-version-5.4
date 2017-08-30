<!DOCTYPE html>
<html>
<head>
	<title>Basic CRUD</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style type="text/css">
	.container{
		margin-top: 20px;
	}
</style>
<body>
	<div class="container">
		<div class="flash-message" class="mydiv">
		  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
		    @if(Session::has('alert-' . $msg))
		    <div class="row">
		      <div class="col-md-12">
		        <div id="errorAlert" >
		          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		         </div>    
		      </div>
		    </div>
		    @endif
		  @endforeach
		</div> 
		<div class="panel panel-primary">
			<div class="panel-heading">
				Add Customers
			</div>
			<form action="" method="POST">
				{{ csrf_field() }}
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Name :</label>
								<input type="text" name="name" placeholder="Enter name" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email :</label>
								<input type="email" name="email" placeholder="Enter name" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone number :</label>
								<input type="text" name="phone_number" placeholder="Enter name" class="form-control">
							</div>
						</div>
					</div>
					<input type="submit" name="submit" value="Add Customer" class="btn btn-success ">				
				</div>
			</form>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Customers List</div>
			<div class="panel-body">
                <div class="col-xs-12 table-responsive">
                  <table class="table table-striped table-bordered" id="datatable">
                    <thead>
                      <tr>
                        <th>S no</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@if (count($customers) > 0)
                    		<p style="display: none;">{{ $i = 1}}</p>
                    		@foreach($customers as $customer)
                    		<tr>
                    			<td>{{ $i++}}</td>
                    			<td>{{ $customer->name}}</td>
                    			<td>{{ $customer->email}}</td>
                    			<td>{{ $customer->phone_number}}</td>
                    			<td>
                    				<a onclick='edit({{$customer}})' class="btn btn-sm btn-warning" title="Edit" style="float: left;">
                                      <i class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#edit"></i>
                                    </a>
                                    <form method="POST" action="/customers/{{$customer->id}}">
                                    	{{ method_field('DELETE') }}
                                      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    	<button type="submit" class="btn btn-sm btn-danger" style="margin-left: 5px;">
                                    		<i class="glyphicon glyphicon-trash" ></i>
                                    	</button>
                                    </form>
                    			</td>
                    		</tr>
                    		@endforeach
                    	@else
                    		<tr><td colspan="5"><center>No Customer Records Found!</center></td></tr>
                    	@endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <!-- model start -->
	    <div class="modal fade" id="edit">
	          <div class="modal-dialog">
	              <div class="modal-content">
	                  <div class="modal-header">
	                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span></button>
	                      <h4 class="modal-title">Edit Customers</h4>
	                  </div>
	                  <div class="modal-body">
	                      <!-- wizard -->
	                      <section>
	                        @if(isset($customer))
	                        <form method="POST" action="/customers/{{$customer->id}}">
	                        @endif
	                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                            <input type="hidden" name="_method" value="PUT">
	                            <input type="hidden" name="id" id="updateId">
	                            <div class="row">
	                                <div class="col-md-6">
	                                  <div class="form-group">
	                                      <label>CUSTOMER NAME</label>
	                                      <input type="text" class="form-control my-colorpicker1 colorpicker-element" name="name" id="updateCustomerName">
	                                  </div>
	                                </div>
	                                <div class="col-md-6">
	                                  <div class="form-group">
	                                      <label>Email</label>
	                                      <input type="text" class="form-control my-colorpicker1 colorpicker-element" name="email" id="updateMailID">
	                                  </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                              <div class="col-md-6">
	                                <div class="form-group">
	                                    <label>Phone Number</label>
	                                    <input type="text" class="form-control my-colorpicker1 colorpicker-element" name="phone_number" id="updatePhone">
	                                </div>
	                              </div>
	                            </div>
	                            <div class="pull-right">
	                                <input type="submit" class="btn btn-success">
	                            </div>
	                            <div class="clearfix"></div>
	                            </div>
	                        </form>
	                      </section>
	                      <!--end wizard -->
	                  </div>
	              </div>
	          </div>
	    </div>
	    </form>
        <!-- /end .modal -->	
	</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$('#errorAlert').hide(4000);
$(document).ready(function() {
    $('#datatable').DataTable();
} );
function edit(customer){
     $("#updateId").val(customer.id);
     $("#updateCustomerName").val(customer.name);
     $("#updatePhone").val(customer.phone_number);
     $("#updateMailID").val(customer.email);
     
  }
</script>