@include('includes.header')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper"> 
    @include('includes.patient.navbar') 
    @include('includes.patient.sidebar') 
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
                                    <h3>Patient records 
                                        <a href="{{ route('patientProfile') }}" class="btn btn-danger float-right">BACK</a>
                                    </h3>
                                </div> 
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12"> 
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr> 
                                                        <th>Name</th> 
                                                        <th>Sex</th> 
                                                        <th>Email</th> 
                                                        <th>Registration date</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    <tr>
                                                        <td>{{ $patient->name }}</td>
                                                        <td>{{ $patient->sex == '1' ? 'Male' : 'Female' }}</td> 
                                                        <td>{{ $patient->email }} 
                                                        <td>{{ $patient->created_at }}
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12"> 
                                            <table id=myDataTable class="table table-bordered">
                                                <thead>
                                                    <tr> 
                                                        <th>#</th> 
                                                        <th>Doctor</th> 
                                                        <th>Symptoms</th> 
                                                        <th>Prescription drugs</th> 
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    @foreach($prescriptions as $index=> $prescription)
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{ $prescription->doctorName->name }}</td>
                                                        <td>{!! $prescription->doctor_comment !!}</td>
                                                        <td>{!! $prescription->pharmacist_comment !!} 
                                                        <td>{{ $prescription->created_at }}
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
                </div>
            </section>
    </div> 
    @include('includes.footer')