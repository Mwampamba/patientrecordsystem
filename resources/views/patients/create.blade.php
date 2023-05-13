@include('includes.header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper"> 
    @include('includes.navbar') 
    @include('includes.sidebar') 
    <div class="content-wrapper"> 
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
        </div> 
        </div> 
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>New patient 
                                            <a href="{{ route('patients')}}" class="btn btn-danger float-right">BACK</a> 
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('saveNewPatient')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label>Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" />
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label>Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" />
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label>Sex<span class="text-danger">*</span></label>
                                                        <select name="sex" class="form-control form-control-lg"> 
                                                            <option value="">Patient sex</option> 
                                                            <option value="1">Male</option>
                                                            <option value="0">Female</option>
                                                        </select>
                                                    @error('sex')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                        </div>
                    </div>
                </div> 
        </section>
    </div> 
    @include('includes.footer')