<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body>
    <h1 class="text-center mt-5">{{ $judul }}</h1>
    {{-- <h3 class="text-center mt-5">Nilai Lingkaran : {{ $nilaiLingkaran }}</h3> --}}

    <form action="/generateVoucher" class="d-flex justify-content-center " method="POST">
        @csrf

        <div class="container w-100 mt-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-12 ">
                    <div class=" mt-2 w-100">
                        <label for="master_pelatihan" class="fs-6">Pilih Nama Pelatihan : </label>
                        <select class="master-pelatihan w-100 mt-2" name="master_pelatihan">
                            @foreach ($masterPelatihan as $d)
                                <option value="{{ $d->nama_pelatihan . ' - ' . $d->jadwal }}">
                                    {{ $d->nama_pelatihan . ' - ' . $d->jadwal }}
                                </option>
                                ...
                                {{-- <option value="WY">Wyoming</option> --}}
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-12">
                    <div class=" mt-2 w-100">
                        <label for="judul_voucher" class="fs-6 mt-2">Judul Voucher: </label>
                        <input type="text" class="form-control w-100" name="judul_voucher">
                    </div>
                </div>
                <div class="col-12">
                    <div class=" mt-2 w-100">
                        <label for="prefix" class="fs-6 mt-2">Prefix: </label>
                        <input type="text" class="form-control w-100" name="prefix">
                    </div>
                </div>
                <div class="col-12">
                    <div class=" mt-2 w-100">
                        <label for="nilai" class="fs-6 mt-2">Nilai: </label>
                        <input type="number" value="50000" class="form-control w-100" name="nilai">
                    </div>
                </div>
                <div class="col-12">
                    <div class=" mt-2 w-100">
                        <label for="jumlah" class="fs-6 mt-2">Jumlah: </label>
                        <input type="text" class="form-control w-100" name="jumlah">
                    </div>
                </div>
                <div class="col-12">
                    <div class=" mt-2 w-100">
                        <label for="tgl_expired" class="fs-6 mt-2">Tgl Expired: </label>
                        <input type="date" class="form-control w-100" name="tgl_expired">
                    </div>
                </div>
            </div>

            <button type="submit" class=" mt-5 btn btn-success">Generate</button>
            <a type="button" href="/voucher" class=" mt-5 btn btn-primary">Back</a>
        </div>

        <!-- Add some margin between the two divs -->
        <div class="mt-3"></div>



    </form>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.master-pelatihan').select2();
        });
    </script>
</body>

</html>
