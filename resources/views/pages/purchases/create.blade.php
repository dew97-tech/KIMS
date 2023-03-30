@extends('layouts.app')

@push('header-script')
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="{{ asset('js/handlebars.js') }}"></script>
@endpush

@section('content')
    <div class="page-container">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Purchase</h4><br><br>
                            <div class="row">
                                {{-- Data --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="date" class="pb-1 form-label">Select Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                {{-- Purchase No --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="purchase_no" class="pb-1 form-label">Purchase No</label>
                                        <input type="text" class="form-control" id="purchase_no" name="purchase_no"
                                            max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                {{-- Supplier ID --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="supplier_id" class="pb-1 form-label">Supplier Name</label>
                                        <select id='supplier_id' name='supplier_id' class='form-control' required>
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Category ID --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="category_id" class="pt-1 form-label">Category Name</label>
                                        <select id='category_id' name='category_id' class='form-control' required>
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Product ID --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="product_id" class="pt-1 form-label">Product Name</label>
                                        <select id='product_id' name='product_id' class='form-control' required>
                                            <option value="">Select Product</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Add More Button --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px"></label>
                                
                                
                                        <button class="btn btn-info addeventmore">Add More</button>
                                    </div>
                                </div>

                            </div>
                            {{-- Row End --}}
                        </div>
                        {{-- End Card Body --}}
{{-- ------------------------------------------------- --}}
                        <div class="card-body">
                            <form action="" method="">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Unit</th>
                                        <th>Per Unit Cost</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">

                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success mt-4" id="storeButton">Purchase Now</button>
                            </div>
                            </form>
                        </div>
                        {{-- End Card Body --}}


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]"  value="@{{ date }}">
            <input type="hidden" name="purchase_no[]"  value="@{{ purchase_no }}">
            <input type="hidden" name="supplier_id[]"  value="@{{ supplier_id }}">

            <td class="">
                <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">@{{ supplier_name }}
            </td>
    
            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">@{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">@{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control buying_quantity text-right" name="buying_quantity[]" value="">
            </td>
            <td>
                <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="">
            </td>
            <td>
                <input type="number" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly>
            </td>
            <td>
                <i class="btn btn-danger btn-sm fas fa-trash removeeventmore"></i>
            </td>
        </tr>
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- AddMore Button Event Trigger --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on("click",".addeventmore", function(){
                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
                var supplier_name = $('#supplier_id').find('option:selected').text();
                var category_id  = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();
                if(date == ''){
                    $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                      if(purchase_no == ''){
                    $.notify("Purchase No is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                      if(supplier_id == ''){
                    $.notify("Supplier is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                      if(category_id == ''){
                    $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                      if(product_id == ''){
                    $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                     }
                     var source = $("#document-template").html();
                     var tamplate = Handlebars.compile(source);
                     var data = {
                        date:date,
                        purchase_no:purchase_no,
                        supplier_id:supplier_id,
                        supplier_name:supplier_name,
                        category_id:category_id,
                        category_name:category_name,
                        product_id:product_id,
                        product_name:product_name
                     };
                     var html = tamplate(data);
                     $("#addRow").append(html); 
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });
            $(document).on('keyup click','.unit_price,.buying_quantity', function(){
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.buying_quantity").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            });
            // Calculate sum of amout in invoice 
            function totalAmountPrice(){
                var sum = 0;
                $(".buying_price").each(function(){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }  
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- For getting Categories -->
    <script type="text/javascript">
        $(function(){
            $(document).on('change','#supplier_id',function(){
                var supplier_id = $(this).val();
                $.ajax({
                    url:"{{ route('get-category') }}",
                    type: "GET",
                    data:{supplier_id:supplier_id},
                    success:function(data){
                        var html = '<option value="">Select Category</option>';
                        $.each(data,function(key,v){
                            html += '<option value=" '+v.category_id+' "> '+v.category.category_name+'</option>';
                        });
                        $('#category_id').html(html);
                    }
                })
            });
        });
    </script>

    {{-- For Getting Products --}}
    <script type="text/javascript">
        $(function(){
            $(document).on('change','#category_id',function(){
                var category_id = $(this).val();
                $.ajax({
                    url:"{{ route('get-product') }}",
                    type: "GET",
                    data:{category_id:category_id},
                    success:function(data){
                        var html = '<option value="">Select Product</option>';
                        $.each(data,function(key,v){
                            html += '<option value=" '+v.id+' "> '+v.product_name+'</option>';
                        });
                        $('#product_id').html(html);
                    }
                })
            });
        });
    </script>
@endsection

@push('plugin-scripts')
    <!-- Plugin js import here -->
    <script src="{{ asset('js/handlebars.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
@endpush
