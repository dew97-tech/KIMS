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
                                {{-- Date --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="date" class="pb-1 form-label font-weight-bold">Select Date</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                {{-- Purchase No --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="purchase_no" class="pb-1 form-label font-weight-bold">Purchase
                                            No</label>
                                        <input type="text" class="form-control" id="purchase_no" name="purchase_no"
                                            value="{{ $purchase_no }}">
                                    </div>
                                </div>
                                {{-- Supplier ID --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="supplier_id" class="pb-1 form-label font-weight-bold">Supplier
                                            Name</label>
                                        <select id='supplier_id' name='supplier_id' class='form-control' required>
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- Product ID --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="product_id" class="pt-1 form-label font-weight-bold">Product
                                            Name</label>
                                        <select id='product_id' name='product_id' class='form-control' required>
                                            <option value="">Select Product</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Unit  --}}
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="buying_quantity" class="pt-1 form-label font-weight-bold">Unit (Kg/Pcs/Box)</label>
                                        <input id="buying_quantity" type="number" min="1"
                                            class="form-control buying_quantity text-right" name="buying_quantity[]" value="">
                                    </div>
                                </div>

                                {{-- Per Unit Cost  --}}
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="unit_price" class="pt-1 form-label font-weight-bold">Cost per
                                            Unit</label>
                                        <input id="unit_price" type="number" min="1"
                                            class="form-control unit_price text-right" name="unit_price[]" value="">
                                    </div>
                                </div>

                                {{-- Add More Button --}}
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px"></label>


                                        <button class="btn btn-info addeventmore" id="addeventmore">Add More</button>
                                    </div>
                                </div>

                            </div>
                            {{-- Row End --}}
                        </div>
                        {{-- End Card Body --}}
                        {{-- ------------------------------------------------- --}}
                        <div class="card-body">
                            <form action="{{ route('purchases.store') }}" method="post">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #dddddd">
                                    <thead>
                                        <tr>
                                            <th>Supplier</th>
                                            <th>Product Name</th>
                                            <th>Unit</th>
                                            <th>Per Unit Cost</th>
                                            <th>Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow">
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0.00"
                                                    id="estimated_amount" class="form-control estimated_amount" readonly
                                                    style="background-color: #e0fcac;">
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
              
            <td>
                <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">@{{ supplier_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">@{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right buying_quantity"
                    name="buying_quantity[]" value="@{{ buying_quantity }}">
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right unit_price" name="unit_price[]"
                    value="@{{ unit_price }}">
            </td>
            <td>
                <input type="number" class="form-control buying_price" id="buying_price" name="buying_price[]" value="@{{ buying_price }}" readonly>
            </td>
            <td>
                <i class="btn btn-danger far fa-trash-alt removeeventmore"></i>
                
            </td>
        </tr>
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- AddMore Button Event Trigger --}}
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
                var supplier_name = $('#supplier_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();
                var unit_price = $('#unit_price').val();
                var buying_quantity = $('#buying_quantity').val();
                var buying_price = (unit_price * buying_quantity).toFixed(2);
                counter++;
                if (date == '') {
                    $.notify("Date is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (purchase_no == '') {
                    $.notify("Purchase No is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (supplier_id == '') {
                    $.notify("Supplier is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (product_id == '') {
                    $.notify("Product Field is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (buying_quantity == '') {
                    $.notify("Unit Field is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (unit_price == '') {
                    $.notify("Cost Field is Required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                var source = $("#document-template").html();
                var tamplate = Handlebars.compile(source);
                var data = {
                    date: date,
                    purchase_no: purchase_no,
                    supplier_id: supplier_id,
                    supplier_name: supplier_name,
                    product_id: product_id,
                    product_name: product_name,
                    unit_price: unit_price,
                    buying_quantity: buying_quantity,
                    buying_price: buying_price
                };
                var html = tamplate(data);
                $("#addRow").append(html);
                $('#unit_price').val('');
                $('#buying_quantity').val('');
            });

            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });
            $(document).ready(function() {
                let totalPrice = 0;

                $('#addeventmore').click(function() {
                    var unitPrice = parseFloat($('#unit_price').val());
                    var quantity = parseInt($('#buying_quantity').val());
                    var buyingPrice = (unitPrice * quantity);
                    totalPrice += buyingPrice;
                    console.log('buyingPrice:', buyingPrice);
                    console.log('EstimatedPrice:', totalPrice);
                    $('#estimated_amount').val(totalPrice.toFixed(2));
                });
            });


            $(document).on("keyup click", '.unit_price,.buying_quantity', function() {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.buying_quantity").val();
                buying_price = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(buying_price.toFixed(2));
                totalAmountPrice();
            });


            function totalAmountPrice() {
                var sum = 0;
                $(".buying_price").each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum.toFixed(2));
            }
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- For Getting Products --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#supplier_id', function() {
                var supplier_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-product') }}",
                    type: "GET",
                    data: {supplier_id: supplier_id},
                    success: function(data) {
                        var html = '<option value="">Select Product</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.id + ' "> ' + v.product_name + '</option>';
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
