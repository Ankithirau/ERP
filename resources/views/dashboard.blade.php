@extends('layouts.app')

@section('panel')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="me-md-3 me-xl-5 d-none">
              <h2>Welcome back,</h2>
              <p class="mb-md-0">Your analytics dashboard template.</p>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
              <p class="text-primary mb-0 hover-cursor">Analytics</p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap d-none">
            <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
              <i class="mdi mdi-download text-muted"></i>
            </button>
            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
              <i class="mdi mdi-clock-outline text-muted"></i>
            </button>
            <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
              <i class="mdi mdi-plus text-muted"></i>
            </button>
            <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body dashboard-tabs p-0">
            <ul class="nav nav-tabs px-4 d-none" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab"
                  aria-controls="overview" aria-selected="true">Overview</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales"
                  aria-selected="false">Sales</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab"
                  aria-controls="purchases" aria-selected="false">Purchases</a>
              </li>
            </ul>
            <div class="tab-content py-0 px-0">
              <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="d-flex flex-wrap justify-content-xl-between">
                  <div
                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-account-multiple icon-lg me-3 text-primary"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Reg'd Users</small>
                      <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggles p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                          href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <h5 class="mb-0 d-inline-block">{{ $usercount }}</h5>
                        </a>
                        <div class="dropdown-menu d-none" aria-labelledby="dropdownMenuLinkA">
                          <a class="dropdown-item" href="#">12 Aug 2018</a>
                          <a class="dropdown-item" href="#">22 Sep 2018</a>
                          <a class="dropdown-item" href="#">21 Oct 2018</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-book-multiple me-3 icon-lg text-danger"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Marks Management</small>
                      <h5 class="me-2 mb-0">{{ $marksheetcount }}</h5>        
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-chart-line me-3 icon-lg text-success"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Result</small>
                      <h5 class="me-2 mb-0">{{ $resultcount }}</h5>
                    </div>
                  </div>
                  <div class=" d-none d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Downloads</small>
                      <h5 class="me-2 mb-0">2233783</h5>
                    </div>
                  </div>
                  <div class="d-none d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Flagged</small>
                      <h5 class="me-2 mb-0">3497843</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                <div class="d-flex flex-wrap justify-content-xl-between">
                  <div
                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Start date</small>
                      <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                          href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                          <a class="dropdown-item" href="#">12 Aug 2018</a>
                          <a class="dropdown-item" href="#">22 Sep 2018</a>
                          <a class="dropdown-item" href="#">21 Oct 2018</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Downloads</small>
                      <h5 class="me-2 mb-0">2233783</h5>
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Total views</small>
                      <h5 class="me-2 mb-0">9833550</h5>
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Revenue</small>
                      <h5 class="me-2 mb-0">$577545</h5>
                    </div>
                  </div>
                  <div
                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Flagged</small>
                      <h5 class="me-2 mb-0">3497843</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                <div class="d-flex flex-wrap justify-content-xl-between">
                  <div
                    class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Start date</small>
                      <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium"
                          href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                          <a class="dropdown-item" href="#">12 Aug 2018</a>
                          <a class="dropdown-item" href="#">22 Sep 2018</a>
                          <a class="dropdown-item" href="#">21 Oct 2018</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Revenue</small>
                      <h5 class="me-2 mb-0">$577545</h5>
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Total views</small>
                      <h5 class="me-2 mb-0">9833550</h5>
                    </div>
                  </div>
                  <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Downloads</small>
                      <h5 class="me-2 mb-0">2233783</h5>
                    </div>
                  </div>
                  <div
                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                    <div class="d-flex flex-column justify-content-around">
                      <small class="mb-1 text-muted">Flagged</small>
                      <h5 class="me-2 mb-0">3497843</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
