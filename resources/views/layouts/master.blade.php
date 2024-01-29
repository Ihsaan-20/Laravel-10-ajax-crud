<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}">
    <script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/jquery-3.7.1.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{asset('assets/computer_ajax.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1bce5715d780dc556393', {
        cluster: 'ap2'
        });

        var channel = pusher.subscribe('create-post-channel');
        channel.bind('CreatePostEvent', function(data) {
            toastr.success(JSON.stringify(data.name) + ' Created successfully!');
        // alert(JSON.stringify(data));
        });
    </script>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <a class="navbar-brand" href="{{url('get/files')}}">Navbar 2</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" aria-current="page">Home <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('create/file')}}" aria-current="page">Create <span class="visually-hidden">(current)</span></a>
                    </li>

                </ul>
                <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
      </header>

    <div class="container">
            @yield('content')
    </div>

    @stack('customJS')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>
