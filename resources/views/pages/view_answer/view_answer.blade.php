@extends('template.app')

@section('content')
<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">Pra Test</h6>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <!-- <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Pertanyaan</h6> -->
                <form>
                    <div class="mb-3">
                        <label for="question" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Pertanyaan :</label>
                        <textarea class="form-control" id="question" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="option1" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Opsi 1:</label>
                        <input type="text" class="form-control" id="option1" placeholder="Masukkan opsi 1">
                    </div>
                    <div class="mb-3">
                        <label for="option2" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Opsi 2:</label>
                        <input type="text" class="form-control" id="option2" placeholder="Masukkan opsi 2">
                    </div>
                    <div class="mb-3">
                        <label for="option3" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Opsi 3:</label>
                        <input type="text" class="form-control" id="option3" placeholder="Masukkan opsi 3">
                    </div>
                    <div class="mb-3">
                        <label for="option4" class="form-label text-uppercase text-body text-xs font-weight-bolder mb-3">Opsi 4:</label>
                        <input type="text" class="form-control" id="option4" placeholder="Masukkan opsi 4">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Final Test</h6>
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
        <div class="col-md-7 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Billing Information</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Oliver Liam</h6>
                    <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                    <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Lucas Harper</h6>
                    <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Stone Tech Zone</span></span>
                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">lucas@stone-tech.com</span></span>
                    <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Ethan James</h6>
                    <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Fiber Notion</span></span>
                    <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">ethan@fiber.com</span></span>
                    <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
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
@endsection