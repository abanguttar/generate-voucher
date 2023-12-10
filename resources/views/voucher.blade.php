<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>List Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<body>
    <h1 class="text-center mt-5">{{ $judul }}</h1>
    {{-- <h3 class="text-center mt-5">Nilai Lingkaran : {{ $nilaiLingkaran }}</h3> --}}


    <div class="container w-100 mt-5">
        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('messages') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('failstatus'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="/voucher" method="GET">
            <div class="">
                <label for="status" class="fs-5 bold">Status:</label>
                <select class="form-select w-100" id="status" name="status" aria-label="Default select example">
                    <option id="all" value="all">Semua Data</option>
                    <option id="issued" value="issued">Issued</option>
                    <option id="none" value="none">None</option>
                </select>
                <button type="submit" class=" mt-5 btn btn-primary">Cari</button>
            </div>
        </form>

        <a type="button" href="/generateVoucher" class=" mt-5 btn btn-success">Create Voucher</a>
        <a href="javascript:void(0);" class="mt-5 btn btn-danger" id="deleteButton">Delete</a>

        <table class="table table-sm table-striped mt-3 w-100">
            <th class="table-dark"><input type="checkbox" id="all_check" class="all_check" name="all_check" /></th>
            <th class="table-dark">No</th>
            <th class="table-dark">Nama Pelatihan</th>
            <th class="table-dark">Judul Voucher</th>
            <th class="table-dark">Voucher</th>
            <th class="table-dark">Nilai Diskon</th>
            <th class="table-dark">Tanggal Expired</th>
            <th class="table-dark">Status</th>
            @php
                @$i = 0;
            @endphp
            @foreach ($voucher as $d)
                @php
                    $i++;
                @endphp
                <tr>
                    <td><input type="checkbox" class="voucherCheckbox" value="{{ $d->voucher }}" /></td>
                    <td>{{ $i }}</td>
                    <td>{{ $d->nama_pelatihan }}</td>
                    <td>{{ $d->judul_voucher }}</td>
                    <td>{{ $d->voucher }}</td>
                    <td>{{ number_format($d->nilai_diskon) }}</td>
                    <td>{{ $d->tgl_expired }}</td>
                    <td>{{ $d->status }}</td>

                </tr>
            @endforeach

        </table>
        {{ $voucher->appends(request()->query())->links() }}
        {{-- {{ $voucher->links() }} --}}
    </div>

    <!-- Add some margin between the two divs -->
    <div class="mt-3"></div>




    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            const storageKey = "STORAGE_KEY";
            const selectKey = "SELECT_VALUE";


            function checkBoxState() {
                $('#all_check').prop('checked', true);
                $('.voucherCheckbox').prop('checked', true);
            }

            function checkBoxStateRemove() {
                $('#all_check').prop('checked', false);
                $('.voucherCheckbox').prop('checked', false);
            }

            $('#all_check').change(function() {
                if ($(this).prop('checked')) {
                    // console.log('Berhasil');
                    // alert('berhasil');
                    $('.voucherCheckbox').prop('checked', true);
                    localStorage.setItem(storageKey, JSON.stringify('true'));
                } else {
                    // $('.voucherCheckbox').prop('checked', false);
                    localStorage.setItem(storageKey, JSON.stringify('false'));
                    checkForStorage();
                    location.reload();
                }
            });


            $('#status').change(function() {
                var selectValue = $(this).val();
                localStorage.setItem(selectKey, selectValue);
                // checkSelectedValue(selectValue);
                //    console.log(selectValue);
            });

            function checkSelectedValue(selectedValue) {
                // selectedValue = 'none';
                // console.log(selectedValue);
                // const changeSelected = (e) => {
                const $select = document.querySelector('#status');
                $select.value = selectedValue;
                // };

            }



            $('#deleteButton').click(function() {

                var selectedIds = [];

                // Loop through each checked checkbox and store its value (voucher ID) in the array
                $('.voucherCheckbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                // Check if at least one checkbox is selected
                if (selectedIds.length > 0) {

                    if (confirm('Apakah anda yakin?')) {

                        // Include the CSRF token in the headers
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        // Make an AJAX request to the controller to handle the deletion
                        $.ajax({
                            url: '/deleteVoucher', // Update with your controller endpoint
                            type: 'POST',
                            data: {
                                ids: selectedIds
                            },
                            success: function(response) {
                                // Handle the response from the server if needed
                                console.log(response);
                            },
                            error: function(error) {
                                // Handle errors if the request fails
                                console.error(error);
                            }
                        });
                        // console.log(selectedIds);
                        // Refresh ulang halaman
                        location.reload();
                    }

                } else {
                    alert('Please select at least one voucher to delete.');
                }
            });

            function checkForStorage() {
                return typeof Storage !== "undefined";
            }

            window.addEventListener("load", function() {
                if (checkForStorage) {
                    var dataLocal = JSON.parse(localStorage.getItem(storageKey)) || [];
                    var dataSelected = localStorage.getItem(selectKey);
                    //    console.log(dataSelected);
                    if (dataLocal == 'true') {
                        console.log('berhasil jalan');
                        checkBoxState();
                        checkSelectedValue(dataSelected);

                    } else {
                        checkBoxStateRemove();
                        checkSelectedValue(dataSelected);
                    }
                }
            });


        });
    </script>


    {{-- <script>
        $(document).ready(function() {
           
        });
    </script> --}}




</body>

</html>
