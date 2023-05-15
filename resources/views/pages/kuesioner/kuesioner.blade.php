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

    function submitForm() {
        // Mengambil data dari formulir
        var formData = {
            questionType: $('select[name=questionType]').val(),
            question: $('textarea[name=question]').val(),
            opsi: $('input[name=opsi]').val()
        };

        // Mengirim permintaan Ajax untuk mengirim data ke server
        $.ajax({
            url: "{{ route('kuesioner.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                // Tanggapan sukses (response) dari server
                console.log(response);
                // Lakukan tindakan lain yang diperlukan setelah pengiriman sukses
            },
            error: function(xhr) {
                // Tanggapan gagal (error) dari server
                console.log(xhr.responseText);
                // Lakukan tindakan lain untuk menangani kesalahan

                // Mengosongkan formulir
                document.getElementById("kuesionerForm").reset();
            }
        });

        event.preventDefault(); // Mencegah tindakan bawaan formulir yang akan memicu pengalihan halaman
    }


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


<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Informasi Kuesioner Diabetes Melitus</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" id="question-title"></h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                        <label class="form-check-label" for="option1" id="option1-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option2" value="option2">
                                        <label class="form-check-label" for="option2" id="option2-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option3" value="option3">
                                        <label class="form-check-label" for="option3" id="option3-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option4" value="option4">
                                        <label class="form-check-label" for="option4" id="option4-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" id="question-title"></h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                    <label class="form-check-label" for="option1" id="option1-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option2" value="option2">
                                    <label class="form-check-label" for="option2" id="option2-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option3" value="option3">
                                    <label class="form-check-label" for="option3" id="option3-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option4" value="option4">
                                    <label class="form-check-label" for="option4" id="option4-label"></label>
                                </div>
                            </div>
                        </div>

                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" id="question-title"></h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                    <label class="form-check-label" for="option1" id="option1-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option2" value="option2">
                                    <label class="form-check-label" for="option2" id="option2-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option3" value="option3">
                                    <label class="form-check-label" for="option3" id="option3-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option4" value="option4">
                                    <label class="form-check-label" for="option4" id="option4-label"></label>
                                </div>
                            </div>
                        </div>

                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Informasi Kuesioner Hipertensi</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" id="question-title"></h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                        <label class="form-check-label" for="option1" id="option1-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option2" value="option2">
                                        <label class="form-check-label" for="option2" id="option2-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option3" value="option3">
                                        <label class="form-check-label" for="option3" id="option3-label"></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="hidden" name="option" id="option4" value="option4">
                                        <label class="form-check-label" for="option4" id="option4-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" id="question-title"></h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                    <label class="form-check-label" for="option1" id="option1-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option2" value="option2">
                                    <label class="form-check-label" for="option2" id="option2-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option3" value="option3">
                                    <label class="form-check-label" for="option3" id="option3-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option4" value="option4">
                                    <label class="form-check-label" for="option4" id="option4-label"></label>
                                </div>
                            </div>
                        </div>

                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" id="question-title"></h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option1" value="option1">
                                    <label class="form-check-label" for="option1" id="option1-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option2" value="option2">
                                    <label class="form-check-label" for="option2" id="option2-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option3" value="option3">
                                    <label class="form-check-label" for="option3" id="option3-label"></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" name="option" id="option4" value="option4">
                                    <label class="form-check-label" for="option4" id="option4-label"></label>
                                </div>
                            </div>
                        </div>

                        <div class="ms-auto text-end">
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
@endsection