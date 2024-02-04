<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Aloha Bank</title>
    @vite('resources/css/app.css')
</head>
<body>

    <p class="mt-10 text-gray-400 text-2xl font-semibold text-center">Ambil Antrian</p>


    <div class="flex justify-around">
        @foreach ($loket as $i)

        <button class="bg-blue-600 px-10 py-10 rounded-lg text-white mt-10">
            <div class="flex flex-col">
                <p class="text-2xl">{{  $i->nomor_loket  }}</p>
                <p class="text-3xl">{{ $i->nama_loket }}</p>
            </div>
        </button>
            
        @endforeach
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>