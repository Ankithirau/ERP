@extends('../layouts.app')

@push('style')
    <style>
        .card-header {
            background-color: #f1f2f3;
            color: rgb(15, 15, 15);
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .breadcrumb-container {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
        }

        .breadcrumb-container i {
            font-size: 18px;
            color: rgb(15, 15, 15);
        }

        .breadcrumb-container p {
            margin: 0;
            font-size: 14px;
        }

        .breadcrumb-container a {
            text-decoration: none;
            color: #151616;
            transition: color 0.3s ease-in-out;
        }

        .breadcrumb-container a:hover {
            color: #007bff;
        }

        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px;
        }

        .section-header {
            font-size: 16px;
            font-weight: bold;
            background-color: #e3f2fd;
            padding: 10px;
            border-left: 5px solid #2196f3;
            margin-bottom: 15px;
            border-radius: 4px;
            color: #0d47a1;
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
        }

        .school-header {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
        }

        .school-subtitle {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
@endpush

@section('panel')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <div class="breadcrumb-container">
                        <i class="mdi mdi-home"></i>
                        <p><a href="{{ route('home') }}">Dashboard</a> / </p>
                        <p class="text-dark">Get Result</p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-container">
                        <h4 class="school-header">Sunny's Spring Dale School</h4>
                        <div class="school-subtitle">Excellence in Education</div>

                        <form action="{{ route('generate-result') }}" method="POST">
                            @csrf
                        
                            <div class="section-header">Search Student Result</div>
                        
                            <div class="mb-3">
                                <label for="year" class="form-label">Select Year:</label>
                                <select class="form-select @error('year') is-invalid @enderror" name="year" id="year">
                                    <option value="">Select Year</option>
                                    @for($i = now()->year; $i >= 2015; $i--)
                                        <option value="{{ $i }}" @selected(old('year') == $i)>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label for="term" class="form-label">Select Term:</label>
                                <select class="form-select @error('term') is-invalid @enderror" name="term" id="term">
                                    <option value="">Select Term</option>
                                    <option value="Term 1" @selected(old('term') == 'Term 1')>Term 1</option>
                                    <option value="Term 2" @selected(old('term') == 'Term 2')>Term 2</option>
                                    <option value="Term1+Term2" @selected(old('term') == 'Term1+Term2')>Term1+Term2</option>
                                </select>
                                @error('term')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label for="roll_no" class="form-label">Enter Roll No:</label>
                                <input type="text" class="form-control @error('roll_no') is-invalid @enderror" 
                                       name="roll_no" id="roll_no" placeholder="Enter Roll No" value="{{ old('roll_no') }}">
                                @error('roll_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="mb-4">
                                <label for="mother_name" class="form-label">Enter Mother's Name:</label>
                                <input type="text" class="form-control @error('mother_name') is-invalid @enderror" 
                                       name="mother_name" id="mother_name" placeholder="Enter Mother's Name" value="{{ old('mother_name') }}">
                                @error('mother_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Get Result</button>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
