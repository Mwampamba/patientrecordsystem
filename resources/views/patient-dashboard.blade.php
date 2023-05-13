@include('includes.header')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper"> 
    @include('includes.patient.navbar')
    @include('includes.patient.sidebar') 
    <div class="content-wrapper"> 
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div> 
                </div> 
            </div> 
        </div> 
        <section class="content">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-lg-4 col-6"> 
                        <div class="small-box bg-info">
                            <div class="inner">
                            <p>My prescriptions</p>
                            </div>
                            <div class="icon">
                            <i class="fa fa-copy"></i>
                            </div>
                            <a href="{{ route('getPatientRecords') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-6"> 
                        <div class="small-box bg-success">
                            <div class="inner"> 
                                <p>My Profile</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-6"> 
                        <div class="small-box bg-danger">
                            <div class="inner"> 
                                <p>Update Profile</p>
                            </div>
                            <div class="icon">
                            <i class="fa fa-server"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> 
                </div> 
            </div> 
        </section> 
    </div> 
    @include('includes.footer')