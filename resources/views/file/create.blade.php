<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div>
                            <form action="{{route('file.store')}}" enctype="multipart/form-data" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="">Program Name</label>
                                    <input type="text" name="program_name" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="">Program Name</label>
                                    <input type="file" name="program_file" class="form-control">
                                </div>
                                {{-- workout 1 --}}
                                <div>
                                    <div class="mb-3">
                                        <label for="">Workout Name</label>
                                        <input type="text" name="workouts[0][name]"  class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Workout Name</label>
                                        <input type="file" name="workouts[0][file]" class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Set Name</label>
                                        <input type="text" name="workouts[0][sets][0][name]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Set Video</label>
                                        <input type="file" name="workouts[0][sets][0][file]"  class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Exercise Name</label>
                                        <input type="text" name="workouts[0][sets][0][exercises][0][name]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Exercise Video</label>
                                        <input type="file" name="workouts[0][sets][0][exercises][0][file]"  class="form-control">
                                    </div>
                                </div>
                                {{-- workout 2 --}}
                                <div>
                                    <div class="mb-3">
                                        <label for="">Workout Name</label>
                                        <input type="text" name="workouts[1][name]"  class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Workout Name</label>
                                        <input type="file" name="workouts[1][file]" class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Set Name</label>
                                        <input type="text" name="workouts[1][sets][0][name]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Set Video</label>
                                        <input type="file" name="workouts[1][sets][0][file]"  class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Exercise Name</label>
                                        <input type="text" name="workouts[1][sets][0][exercises][0][name]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Exercise Video</label>
                                        <input type="file" name="workouts[1][sets][0][exercises][0][file]"  class="form-control">
                                    </div>
                                </div>
                                {{-- workout 3 --}}
                                <div>
                                    <div class="mb-3">
                                        <label for="">Workout Name</label>
                                        <input type="text" name="workouts[3][name]"  class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Workout Name</label>
                                        <input type="file" name="workouts[3][file]" class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Set Name</label>
                                        <input type="text" name="workouts[3][sets][0][name]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Set Video</label>
                                        <input type="file" name="workouts[3][sets][0][file]"  class="form-control">
                                    </div>
    
                                    <div class="mb-3">
                                        <label for="">Exercise Name</label>
                                        <input type="text" name="workouts[3][sets][0][exercises][0][name]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Exercise Video</label>
                                        <input type="file" name="workouts[3][sets][0][exercises][0][file]"  class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                               
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
