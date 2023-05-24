@extends('template.app')

@section('content')
<div class="container">
    <div class="col-md-10 mt-4">
        <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Buat Kuesioner</h6>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form method="POST" action="{{ route('kuesioner.store') }}"">
                    @csrf
                    <div class=" mb-3">
                    <label for="jenis-penyakit" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Jenis Kuesioner:</label>
                    <select class="form-select" name="questionType">
                        <option value="diabetes">Diabetes Melitus</option>
                        <option value="hipertensi">Hipertensi</option>
                    </select>
            </div>
            <div class="mb-3">
                <label for="pertanyaan" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Pertanyaan:</label>
                <textarea class="form-control" name="question" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="optionCount" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Jumlah Opsi:</label>
                <input type="number" class="form-control" id="optionCount" name="opsi" placeholder="Masukkan jumlah opsi" oninput="displayOptions()">
            </div>
            <div id="optionsContainer">
                <!-- Opsi akan ditambahkan secara dinamis di sini menggunakan JavaScript -->
            </div>
            <div class="d-flex justify-content-end mt-3">
                <!-- <input type="submit" value="Submit"> -->
                <button type="submit" value="Submit" class="btn btn-primary mx-2" onclick="submitForm()">Simpan</button>
                <!-- <button type="button" class="btn btn-primary mx-2" onclick="saveOptions()">Simpan</button> -->
                <!-- <button id="create" type="button" class="btn btn-secondary mx-2">Batal</button> -->
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    function displayOptions() {
        var opsi = document.getElementById("optionCount").value;
        var html = "";
        for (var i = 1; i <= opsi; i++) {
            html += '<label for="opsi' + i + '">Opsi ' + i + ':</label>';
            html += '<input type="text" name="opsi[]" id="opsi' + i + '" required><br><br>';
        }
        document.getElementById("optionsContainer").innerHTML = html;
    }

    // function submitForm() {
    //     // Mengambil data dari formulir
    //     var formData = {
    //         questionType: $('select[name=questionType]').val(),
    //         question: $('textarea[name=question]').val(),
    //         opsi: $('input[name=opsi]').val()
    //     };

    //     // Mengirim permintaan Ajax untuk mengirim data ke server
    //     $.ajax({
    //         url: "{{ route('kuesioner.store') }}",
    //         type: "POST",
    //         data: formData,
    //         success: function(response) {
    //             // Tanggapan sukses (response) dari server
    //             console.log(response);
    //             // Lakukan tindakan lain yang diperlukan setelah pengiriman sukses
    //         },
    //         error: function(xhr) {
    //             // Tanggapan gagal (error) dari server
    //             console.log(xhr.responseText);
    //             // Lakukan tindakan lain untuk menangani kesalahan

    //             // Mengosongkan formulir
    //             document.getElementById("kuesionerForm").reset();
    //         }
    //     });

    //     event.preventDefault(); // Mencegah tindakan bawaan formulir yang akan memicu pengalihan halaman
    // }


    function saveOptions() {
        var questionInput = document.getElementById('question');
        var optionCountInput = document.getElementById('optionCount');
        var optionsContainer = document.getElementById('optionsContainer');

        // Cek jika input soal atau jumlah opsi masih kosong
        if (questionInput.value.trim() === '' || optionCountInput.value.trim() === '') {
            alert('Mohon lengkapi soal dan jumlah opsi sebelum menyimpan.');
            return;
        }

        // Cek jika ada opsi yang masih kosong
        var optionInputs = optionsContainer.getElementsByTagName('input');
        for (var i = 0; i < optionInputs.length; i++) {
            if (optionInputs[i].value.trim() === '') {
                alert('Mohon lengkapi semua opsi sebelum menyimpan.');
                return;
            }
        }
    }
</script>

<div class="row justify-content-center">
    <div class="col-md-5 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3 text-center">
                <h6 class="mb-0">Informasi Kuesioner Diabetes Melitus</h6>
            </div>
            @if(session('successEdit'))
                        <div class="alert alert-success">
                            {{ session('successEdit') }}
                        </div>
                        @endif
            @if(session('successDeleteD'))
                        <div class="alert alert-success">
                            {{ session('successDeleteD') }}
                        </div>
                        @endif
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="row">
                            @foreach ($dataDiabetes as $index => $item)
                                <div class="card mt-3 w-100 mx-auto">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title" id="question-title">{{ $index + 1 }}. {{ $item['question'] }}</h5>
                                        @if (isset($item['opsi']) && is_array($item['opsi']))
                                            @foreach ($item['opsi'] as $opsiIndex => $opsi)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                                    <label class="form-check-label" for="option1" id="option1-label">Opsi {{ $opsiIndex + 1 }}: {{ $opsi }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div style="position: absolute; bottom: 0; right: 0;">
                                        <div class="d-inline-flex">
                                            <button class="btn btn-link text-dark px-3 mb-0 align-self-start" data-bs-toggle="modal" data-bs-target="{{'#ModalEdit'.$index}}"><i class="material-icons text-sm me-2">edit</i>Edit</button>
                                            <button class="btn btn-link text-danger text-gradient px-3 mb-0 align-self-end" onclick="window.location.href='{{ route('kuesioner.deletedD', ['id' => $item['id']]) }}'"><i class="material-icons text-sm me-2">delete</i>Delete</button>
                                        </div>
                                    </div>
                                </div>
                                @include('pages.kuesioner.modal.edit')
                            @endforeach
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-5 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3 text-center">
                <h6 class="mb-0">Informasi Kuesioner Hipertensi</h6>
            </div>
            @if(session('successEditH'))
                        <div class="alert alert-success">
                            {{ session('successEditH') }}
                        </div>
                        @endif
            @if(session('successDelete'))
                        <div class="alert alert-success">
                            {{ session('successDelete') }}
                        </div>
                        @endif

            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="row">
                            @foreach ($dataHipertensi as $index => $item)
                            <div class="card mt-3 w-100 mx-auto">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title" id="question-title">{{ $index + 1 }}. {{ $item['question'] }}</h5>
                                    @foreach ($item['opsi'] as $opsiIndex => $opsi)
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                        <label class="form-check-label" for="option1" id="option1-label">Opsi {{ $opsiIndex + 1 }}: {{ $opsi }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div style="position: absolute; bottom: 0; right: 0;">
                                    <div class="d-inline-flex">
                                        <button type="button" class="btn btn-link text-dark px-3 mb-0 align-self-start" data-bs-toggle="modal" data-bs-target="{{'#ModalEditH'.$index}}"><i class="material-icons text-sm me-2">edit</i>Edit</button>
                                        <button class="btn btn-link text-danger text-gradient px-3 mb-0 align-self-end" onclick="window.location.href='{{ route('kuesioner.deletedH', ['id' => $item['id']]) }}'"><i class="material-icons text-sm me-2">delete</i>Delete</button>
                                    </div>
                                </div>
                            </div>
                            @include('pages.kuesioner.modal.editH')
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    function openEditModal(element) {
        var index = element.getAttribute("data-index");

        // Dapatkan data yang sesuai berdasarkan index
        var data = dataHipertensi[index];

        // Tampilkan data dalam modal
        var modalTitle = document.getElementById("editModalLabel");
        var questionTitle = document.getElementById("modal-question-title");
        var optionsContainer = document.getElementById("modal-options-container");

        // Setel judul modal
        modalTitle.textContent = "Edit Question";

        // Setel judul pertanyaan
        questionTitle.textContent = (parseInt(index) + 1) + ". " + data.question;

        // Hapus semua opsi yang ada sebelumnya
        optionsContainer.innerHTML = "";

        // Tambahkan opsi ke dalam modal
        for (var i = 0; i < data.opsi.length; i++) {
            var optionLabel = document.createElement("label");
            optionLabel.setAttribute("for", "modal-option" + (i + 1));
            optionLabel.classList.add("form-check-label");
            optionLabel.textContent = "Opsi " + (i + 1) + ": " + data.opsi[i];

            var optionInput = document.createElement("input");
            optionInput.setAttribute("type", "hidden");
            optionInput.setAttribute("name", "modal-option");
            optionInput.setAttribute("id", "modal-option" + (i + 1));
            optionInput.setAttribute("value", "option" + (i + 1));
            optionInput.classList.add("form-check-input");

            var formCheck = document.createElement("div");
            formCheck.classList.add("form-check");
            formCheck.appendChild(optionInput);
            formCheck.appendChild(optionLabel);

            optionsContainer.appendChild(formCheck);
        }

        // Tampilkan modal
        var editModal = new bootstrap.Modal(document.getElementById("editModal"));
        editModal.show();
    }
</script> -->
@endsection
