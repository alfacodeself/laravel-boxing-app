
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', env('APP_NAME'))</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    @include('layouts.landingpage.style')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                    @include('layouts.admin.alert')
                    <div class="section-title contact-title">
                        <span>Sign Up Form</span>
                    </div>
                    <div class="leave-comment">
                        <form action="{{ route('registration') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="text" name="nama" placeholder="Nama">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="password" placeholder="pasword">
                            <input type="password" name="password_confirmation" placeholder="Password">
                            <select name="level" id="level" class="form-control">
                                <option value="member">Anggota</option>
                                <option value="trainer">Pelatih</option>
                            </select>
                            <br>
                            <button type="submit">Register</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
    <x-landingpage.contact></x-landingpage.contact>
    <a href="" on></a>
    @include('layouts.landingpage.footer')
    @include('layouts.landingpage.script')

</body>

</html>
