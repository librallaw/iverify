<div class="row">
<div class="col-md-12">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        @if(session()->has('message'))


            <div class="alert alert-{{ session()->get('type')}} alert-with-icon" data-notify="container">
                <i class="material-icons" data-notify="icon">notifications</i>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span data-notify="message">{{ session()->get('message') }}</span>
            </div>
        @endif

            @if(session()->has('errormsg'))

                @foreach( session()->get('errormsg') as $error)

                <div class="alert alert-danger alert-with-icon" data-notify="container">
                    <i class="material-icons" data-notify="icon">notifications</i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span data-notify="message">{{ $error }}</span>
                </div>
                @endforeach
        @endif
    </div>
</div>
</div>
