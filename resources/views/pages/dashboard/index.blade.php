@extends('template.app')

@section('content')
<div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Doctor User</p>
                                <h4 class="mb-0">{{$doctorCount}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"># </span>Current number of doctor users.</p>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1" id="userList">
                                <p class="text-sm mb-0 text-capitalize">User Online</p>
                                <h4 class="mb-0" id="userOnline">{{$statusTrue}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"># </span>Number of pre-test respondents.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Patient User</p>
                                    <h4 class="mb-0">{{$patientCount}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"># </span>Current number of patient users.</p>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">User Offline</p>
                                <h4 class="mb-0" id="userOffline">{{$statusFalse}}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder"># </span>Number of post-test respondents.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>New Users</h6>
                        </div>
                        <div class="card-body p-3" id="userList">
                            <div class="timeline timeline-one-side col">
                                @foreach (collect($dataUsers)->sortByDesc('createAt')->take(10) as $item)
                                <div class="timeline-block mb-3 d-flex align-items-center">
                                    <div class="timeline-step">
                                        @if ($item['photo'])
                                            <img src="{{ $item['photo'] }}" class="rounded-circle ratio ratio-1x1" style="object-fit: cover; width: 100%; height: 100%;">
                                        @else
                                            <img src="{{ asset('assets/img/person.png') }}" class="rounded-circle ratio ratio-1x1" style="object-fit: cover; width: 100%; height: 100%;">
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $item['fullName'] }}</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ date('H:i, d M Y', strtotime($item['createAt'])) }}</p>
                                        {{-- <span class="text-secondary text-xs font-weight-bold">{{$item['createAt']}}</span> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                setInterval(function() {
                    $.ajax({
                        url: '{{ route("get.data") }}',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            // Memperbarui jumlah pengguna online
                            var userOnline = response.statusTrue;
                            $('#userOnline').text(userOnline);

                            // Memperbarui jumlah pengguna offline
                            var userOffline = response.statusFalse;
                            $('#userOffline').text(userOffline);

                            console.log(userOnline);
                            console.log(userOffline);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }, 3000); // Memuat data setiap 3 detik (3000 ms)
            });
        </script>



        {{-- <script>
            setTimeout(function() {
                location.reload();
            }, 5000);
        </script> --}}
@endsection
