@extends('layouts.app')

@push('header-script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
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
                            </div>
                            {{-- Row End --}}
                        </div>
                        {{-- End Card Body --}}
                        {{-- ------------------------------------------------- --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Dyanmic Table Row --}}
    <div class="card border rounded-lg shadow-lg py-2 mx-3">
        <div class="card-body">
            <h6 class="card-title">Product List</h6><br>
            <form action="{{ route('purchases.store') }}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="table-responsive">
                    <table class="table-sm table-bordered" width="100%" style="border-color: #dddddd">
                        <thead>
                            <tr>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Per Unit Cost</th>
                                <th class="text-center">Cost</th>
                                <th class="text-center">Add</th>
                            </tr>
                        </thead>
                        <tbody id="addRow" class="addRow">
                            <tr>
                                {{-- Product --}}
                                <td class="dropdown">
                                    <select id='product_id' name='product_id' class='form-control mdb-select'>
                                        <option value="">Select Products</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                {{-- Unit --}}
                                <td class="text-center">
                                    <input id="buying_quantity" type="number"
                                        class="form-control buying_quantity text-right" name="buying_quantity[]">
                                </td>
                                {{-- Per Unit Cost --}}
                                <td class="text-center">
                                    <input id="unit_price" type="number" class="form-control unit_price text-right"
                                        name="unit_price[]">
                                </td>
                                {{-- Buying Price/Cost --}}
                                <td class="text-center">
                                    <input type="number" class="form-control buying_price" id="buying_price"
                                        placeholder="0.00" name="buying_price[]" value="@{{ buying_price }}" readonly>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-md btn-primary addeventmore rounded-pill"
                                        id="addeventmore">
                                        <i class="fa-solid fa-circle-plus fa-xl mb-0 mt-0 pt-1"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="p-3 text-right font-weight-bold">Total Cost:</td>
                                <td class="p-3 text-left">
                                    <input type="text" name="estimated_amount" value="0.00" id="estimated_amount"
                                        class="form-control estimated_amount bg-light" readonly>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-success mt-4" id="storeButton">Purchase Now</button>
                </div>
            </form>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.mdb-select').materialSelect({
                search: true
            });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]"  value="@{{ date }}">
            <input type="hidden" name="purchase_no[]"  value="@{{ purchase_no }}">
            <input type="hidden" name="supplier_id[]"  value="@{{ supplier_id }}">
            <td class="text-center font-bold">
                <input type="hidden" name="product_id_val[]" value="@{{ product_id_val }}">@{{ product_name }}
            </td>
            <td class="text-center">
                <input type="number" min="1" class="form-control form-control text-center buying_quantity"
                    name="buying_quantity_val[]" value="@{{ buying_quantity_val }}" readonly>
            </td>
            <td class="text-center">
                <input type="number" min="1" class="form-control form-control text-center unit_price" name="unit_price_val[]"
                    value="@{{ unit_price_val }}" readonly>
            </td>
            <td class="text-center">
                <input type="number" class="form-control text-center buying_price" id="buying_price" name="buying_price_val[]" value="@{{ buying_price_val }}" readonly>
            </td>
            <td class="text-center" colspan="2">
                <button type="button" class="btn btn-md btn-danger removeeventmore py-2" id="removeeventmore"><i class="fa-regular fa-trash-can fa-xl mt-0 mb-0 pt-1"></i></button>
            </td>
        </tr>
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- AddMore Button Event Trigger --}}
    <script type="text/javascript">
        $(document).ready(function() {
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

                // Store the values of input fields in separate variables
                var unit_price_val = unit_price;
                var buying_quantity_val = buying_quantity;
                var buying_price_val = buying_price;
                var product_id_val = product_id;
                console.log(buying_quantity_val);
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
                    $.notify("Buying Quantity Field is Required", {
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
                    product_id_val: product_id_val,
                    product_name: product_name,
                    unit_price_val: unit_price_val,
                    buying_quantity_val: buying_quantity_val,
                    buying_price_val: buying_price_val
                };
                var html = tamplate(data);
                console.log(data);
                $("#addRow").append(html);
                $('#unit_price').val('');
                $('#buying_quantity').val('');
                $('#buying_price').val('');
                $('#product_id').val('');

            });

            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });
            $(document).on("keyup click", '.unit_price,.buying_quantity', function() {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();

                var qty = $(this).closest("tr").find("input.buying_quantity").val();
                buying_price = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(buying_price.toFixed(2));
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
@endsection

@push('plugin-scripts')
    <!-- Plugin js import here -->
    <script src="{{ asset('js/handlebars.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
@endpush
