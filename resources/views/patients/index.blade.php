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
                                    <h3>Patients
                                        @role(['admin','receptionist']) 
                                            <a href="{{ route('addNewPatient') }}" class="btn btn-success float-right">New patient</a>
                                        @endrole
                                    </h3>
                                </div> 
                                    <div class="card-body">
                                        <div class="card">
                                            <table id="myDataTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>  
                                                        <th>Sex</th>  
                                                        <th>Action</th>  
                                                        @role('receptionist') 
                                                        <th>Action</th>
                                                        <th>Action</th> 
                                                        @endrole
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($patients as $index=> $patient)
                                                        <tr>  
                                                            <td>{{ $index+1 }}</td>
                                                            <td>{{ $patient->name }}</td> 
                                                            <td>{{ $patient->sex == '1' ? 'Male' : 'Female'}}</td>
                                                            @role(['admin', 'doctor'])   
                                                            <td><a href="{{ route('patientRecords', [$patient->id]) }}" class="btn btn-warning">Medical records</a></td> 
                                                            @endrole
                                                            @role('receptionist')  
                                                            <td><a href="{{ route('editPatient', [$patient->id]) }}" class="btn btn-secondary">Update</a></td>                                       
                                                            <td><a href="#" onclick="return confirm('Are you sure you want to delete this patient?')" class="btn btn-danger">Delete</a></td> 
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