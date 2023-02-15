@if (session('success') || isset($success))
    <div class="alert alert-primary" role="alert">
        <strong>Success!</strong> {{ session('success') ?? $success }}
    </div>
@elseif (session('warning') || isset($warning))
    <div class="alert alert-warning" role="alert">
        <strong>Warning!</strong> {{ session('warning') ?? $warning }}
    </div>
@elseif (session('error') || isset($error))
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> {{ session('error') ?? $error }}
    </div>
@endif