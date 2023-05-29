@extends('template.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">User Dokter</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Username</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No. HP</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Specialist</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Registered</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctorUsers as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($item['photo'])
                                                            <img src="{{ $item['photo'] }}"
                                                                class="rounded ratio ratio-1x1 me-4"
                                                                style="border-radius: 40% object-fit: cover; width: 40px; height: 40px;">
                                                        @else
                                                            <img src="{{ asset('assets/img/person.png') }}"
                                                                class="rounded ratio ratio-1x1 me-4"
                                                                style="border-radius: 40% object-fit: cover; width: 40px; height: 40px;">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item['fullName'] }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item['email'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item['noTelpon'] }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item['spesialis'] }}</p>
                                                <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success user-status"
                                                    data-user-id="{{ $item['id'] }}" data-user-type="doctor">

                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ date('H:i | d M Y', strtotime($item['createAt'])) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">User Pasien</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Username</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No. HP</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Profession</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Registered</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientUsers as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($item['photo'])
                                                            <img src="{{ $item['photo'] }}"
                                                                class="rounded ratio ratio-1x1 me-4"
                                                                style="border-radius: 40% object-fit: cover; width: 40px; height: 40px;">
                                                        @else
                                                            <img src="{{ asset('assets/img/person.png') }}"
                                                                class="rounded ratio ratio-1x1 me-4"
                                                                style="border-radius: 40% object-fit: cover; width: 40px; height: 40px;">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item['fullName'] }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item['email'] }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $item['noTelpon'] }}</span>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $item['pekerjaan'] }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success user-status"
                                                    data-user-id="{{ $item['id'] }}" data-user-type="patient">

                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ date('H:i | d M Y', strtotime($item['createAt'])) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('user.export', ['userId' => $item['email']]) }}"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    Download
                                                </a>
                                            </td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            function updateUserStatus(userStatus) {
                updateStatusByType(userStatus.patient, 'patient');
                updateStatusByType(userStatus.doctor, 'doctor');
            }

            function updateStatusByType(userStatus, userType) {
                $('.user-status[data-user-type="' + userType + '"]').each(function() {
                    var userId = $(this).data('user-id');
                    var userStatusValue = userStatus[userId];
                    var userStatusText = userStatusValue ? 'Online' : 'Offline';
                    $(this).text(userStatusText);
                });
            }

            function fetchUserStatus() {
                $.ajax({
                    url: '{{ route('get.status') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var userStatus = response.userStatus;
                        updateUserStatus(userStatus);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }

            fetchUserStatus(); // Memuat status pengguna saat pertama kali halaman dimuat

            setInterval(fetchUserStatus, 2000); // Memuat status pengguna setiap 2 detik (2000 ms)
        });
    </script>

@endsection
