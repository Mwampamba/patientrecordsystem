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
        </div> 
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card"> 
                                <div class="card-header">
                                    <h3>Patient prescriptions
                                        @role(['admin','doctor']) 
                                            <a href="{{ route('addNewPrescription') }}" class="btn btn-success float-right">New prescription</a>
                                        @endrole
                                    </h3>
                                </div> 
                                    <div class="card-body">
                                        <div class="card">
                                            <table id="myDataTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Patient</th>  
                                                        <th>Doctor prescription</th> 
                                                        <th>Pharmacist description</th> 
                                                        <th>Submitted</th>  
                                                        @role(['admin', 'pharmacist']) 
                                                        <th>Action</th> 
                                                        @endrole 
                                                        @role(['admin', 'doctor']) 
                                                        <th>Action</th> 
                                                        @endrole 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($prescriptions as $index=> $prescription)
                                                        <tr>  
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{ $prescription->patientName->name }}</td> 
                                                            <td>{!! $prescription->doctor_comment !!}</td>  
                                                            <td>{!! $prescription->pharmacist_comment !!}</td> 
                                                            <td>{{ $prescription->updated_at }}</td>  
                                                            @role(['admin', 'pharmacist'])                                         
                                                            <td><a href="{{ route('editPrescription', [$prescription->id] ) }}" class="btn btn-primary">Prescribe a drug(s) </a></td> 
                                                            @endrole
                                                            @role(['admin', 'doctor'])                                         
                                                            <td><a href="{{ route('editPrescription', [$prescription->id] ) }}" class="btn btn-secondary">Update </a></td> 
                                                            @endrole
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </section>
    </div> 
    @include('includes.footer')