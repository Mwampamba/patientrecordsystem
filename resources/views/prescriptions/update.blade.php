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
                                        <h3>Phamacist prescription
                                            <a href="{{ route('prescriptions') }}" class="btn btn-danger float-right">BACK</a> 
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('updatePrescription', [$prescription->id] ) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row"> 
                                                <div class="col-md-12 mb-3">
                                                    <label for="">Patient name<span class="text-danger">*</span></label>
                                                    <select name="name" class="form-control form-control-lg selector">
                                                        <option value="">Select patient name</option>
                                                        @foreach($patients as $patient)
                                                            <option value="{{ $patient->id }}" {{ $patient->id == $prescription->patient_id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div> 
                                                @role(['admin', 'pharmacist']) 
                                                <div class="col-md-12 mb-3">
                                                    <label for="">Pharmacist description<span class="text-danger">*</span></label>
                                                    <textarea name="description" id="summernoteDescription" class="form-control form-control-lg" rows="5">{{ $prescription->pharmacist_comment }}</textarea>
                                                </div>
                                                @endrole
                                                @role(['admin', 'doctor']) 
                                                <div class="col-md-12 mb-3">
                                                    <label for="">Doctor description<span class="text-danger">*</span></label>
                                                    <textarea name="prescription" id="summernoteDescription" class="form-control form-control-lg" rows="5">{{ $prescription->doctor_comment }}</textarea>
                                                </div>
                                                @endrole
                                                <div class="col-md-12 mb-3">
                                                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
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