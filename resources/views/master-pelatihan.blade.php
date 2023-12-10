<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Pelatihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


</head>

<body>
    <h1 class="text-center mt-5">{{ $judul }}</h1>
    {{-- <h3 class="text-center mt-5">Nilai Lingkaran : {{ $nilaiLingkaran }}</h3> --}}

    <form action="/createPelatihan" class="d-flex justify-content-center " method="POST">
        @csrf
        <div  class="text-center mt-5 border w-50">
            <label for="master_pelatihan" class="fs-5">Pilih Nama Pelatihan : </label>
            <select class="master-pelatihan w-50" name="master_pelatihan">
                @foreach ($masterPelatihan as $d)
                    <option value="{{ $d->nama_pelatihan . ' - ' . $d->jadwal }}">
                        {{ $d->nama_pelatihan . ' - ' . $d->jadwal }}
                    </option>
                    ...
                    {{-- <option value="WY">Wyoming</option> --}}
                @endforeach
            </select>
         
        </div>

        <div  class="text-center mt-5 border w-50">
            <label for="master_pelatihan" class="fs-5">Pilih Nama Pelatihan : </label>

           
        </div>

        <button type="submit" class="btn btn-success">Generate</button>
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
