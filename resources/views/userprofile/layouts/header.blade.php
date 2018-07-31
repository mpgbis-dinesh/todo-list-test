<div class="row border-bottom white-bg">
<nav class="navbar navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
            <i class="fa fa-reorder"></i>
        </button>
        <a href="{{ URL::to('login') }}" class="navbar-brand">To-Do Management</a>
    </div>
    <div class="navbar-collapse collapse" id="navbar">
        <ul class="nav navbar-top-links navbar-right">
            <li>
                Welcome {{ Auth::user()->first_name }}
            </li>
            <li>
                <a href="{{ url('logout') }}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>
    </div>
</nav>
</div>