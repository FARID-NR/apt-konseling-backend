<div class="modal fade" id="{{'ModalEdit'.$index}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Kuesioner</h1>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ '/kuesioner/edit/'.$item['id'] }}">
                    @csrf
                    <div class=" mb-3">
                    {{-- <label for="jenis-penyakit" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Jenis Kuesioner:</label>
                    <select class="form-select" name="{{'questionType'.$item['id']}}">
                        <option value="diabetes">Diabetes Melitus</option>
                        <option value="hipertensi">Hipertensi</option>
                    </select> --}}
            </div>
            <div class="mb-3">
                <label for="pertanyaan" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Pertanyaan:</label>
                <textarea class="form-control" name="{{'question'.$item['id']}}" rows="3">{{ $item['question'] }}</textarea>
            </div>
            <div class="mb-3">
                <label for="{{'optionCount'.$item['id']}}" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Jumlah Opsi:</label>
                @php
                    $jumlah = 0;
                    foreach ($item['opsi'] as $hitungopsi) {
                        $jumlah = $jumlah + 1;
                    }
                @endphp
                <input type="number" class="form-control" id="{{'optionCount'.$item['id']}}" name="{{'opsi'.$item['id']}}" placeholder="Masukkan jumlah opsi" oninput="{{'displayOptionsEdit'.$item['id'].'()'}}" value="{{$jumlah}}">
            </div>
            <div id="{{'optionsContainer'.$item['id']}}">
                <!-- Opsi akan ditambahkan secara dinamis di sini menggunakan JavaScript -->
            </div>
            <div class="modal-footer">
                <!-- <input type="submit" value="Submit"> -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" value="Submit" class="btn btn-primary mx-2" onclick="{{'submitForm'.$item['id'].'()'}}">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
    // function {{'displayOptionsEdit'.$item['id'].'()'}} {
    //     var {{'opsi'.$item['id']}} = document.getElementById("{{'optionCount'.$item['id']}}").value;
    //     var {{'html'.$item['id']}} = "";
    //     for (var i = 1; i <= {{'opsi'.$item['id']}}; i++) {
    //         {{'html'.$item['id']}} += '<label for="{{'opsi'.$item['id']}}' + i + '">Opsi ' + i + ':</label>';
    //         {{'html'.$item['id']}} += '<input type="text" name="{{'opsi'.$item['id']}}[]" id="{{'opsi'.$item['id']}}' + i + '" required><br><br>';
    //     }
    //     document.getElementById("{{'optionsContainer'.$item['id']}}").innerHTML = {{'html'.$item['id']}};
    // }

    // document.addEventListener('DOMContentLoaded', function() {
    //         displayOptionsEditH{{$item['id']}}(); // Panggil fungsi untuk menampilkan opsi secara otomatis saat halaman dimuat

    //         function displayOptionsEditH{{$item['id']}}() {
    //             var optionCount = document.getElementById("{{ 'optionCount'.$item['id'] }}").value;
    //             var optionsContainer = document.getElementById("{{ 'optionsContainer'.$item['id'] }}");
    //             optionsContainer.innerHTML = ""; // Kosongkan container opsi sebelum menambahkan opsi baru

    //             for (var i = 1; i <= optionCount; i++) {
    //                 var optionInput = document.createElement("input");
    //                 optionInput.setAttribute("type", "text");
    //                 optionInput.setAttribute("class", "form-control");
    //                 optionInput.setAttribute("name", "{{ 'opsi'.$item['id'] }}[]");
    //                 optionInput.setAttribute("placeholder", "Opsi " + i);


    //                 optionsContainer.appendChild(optionInput);
    //             }
    //             document.getElementById("{{'optionsContainer'.$item['id']}}").innerHTML = {{'html'.$item['id']}};
    //         }
    //     });

        function displayOptionsEdit{{$item['id']}}() {
            var optionCountInput = document.getElementById("{{ 'optionCount'.$item['id'] }}");
            var optionsContainer = document.getElementById("{{ 'optionsContainer'.$item['id'] }}");
            optionsContainer.innerHTML = ""; // Kosongkan container opsi sebelum menambahkan opsi baru

            var optionCount = parseInt(optionCountInput.value);
            if (isNaN(optionCount) || optionCount <= 0) {
                return; // Jika jumlah opsi tidak valid atau kurang dari atau sama dengan 0, hentikan fungsi
            }

            for (var i = 1; i <= optionCount; i++) {
                var label = document.createElement("label");
                label.setAttribute("for", "{{'opsi'.$item['id']}}" + i);
                label.innerText = "Opsi " + i + ":";

                var input = document.createElement("input");
                input.setAttribute("type", "text");
                input.setAttribute("name", "{{'opsi'.$item['id']}}[]");
                input.setAttribute("id", "{{'opsi'.$item['id']}}" + i);
                input.setAttribute("required", "required");

                var lineBreak = document.createElement("br");

                optionsContainer.appendChild(label);
                optionsContainer.appendChild(input);
                optionsContainer.appendChild(lineBreak);
            }
        }

    function {{'submitForm'.$item['id'].'()'}} {
        // Mengambil data dari formulir
    var {{'formData'.$item['id']}} = {
            {{'questionType'.$item['id']}}: $('select[name={{'questionType'.$item['id']}}]').val(),
            {{'question'.$item['id']}}: $('textarea[name={{'question'.$item['id']}}]').val(),
            {{'opsi'.$item['id']}}: $('input[name={{'opsi'.$item['id']}}]').val()
        };

        // Mengirim permintaan Ajax untuk mengirim data ke server
        $.ajax({
            url: "{{ '/edit/'.$item['id'] }}",
            type: "POST",
            data: {{'formData'.$item['id']}},
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

</script>
