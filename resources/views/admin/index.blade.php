@extends('admin.fixe')
@section('titre', 'Accueil')
@section('body')
    @php
        $config = DB::table('configs')->select('*')->first();

    @endphp
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Hour chart  -->
        <div class="card bg-transparent shadow-none my-6 border-0">
            <div class="card-body row p-0 pb-6 g-6">
                <div class="col-12 col-lg-8 card-separator">
                    <h5 class="mb-2">Content de vous revoir,<span class="h4"> EWAY-ACADEMY 👋🏻</span></h5>
                    <div class="col-12 col-lg-5">

                    </div>
                    <div class="d-flex justify-content-between flex-wrap gap-4 me-12">


                      {{--   <div class="d-flex align-items-center gap-4">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <div>
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-clock ti-28px"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Sponsors</p>
                                <h4 class="text-warning mb-0">{{ $totalSponsors ?? '' }}</h4>
                            </div>
                        </div> --}}
                 {{--        <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <div>
                                        <img src="../../assets/svg/icons/laptop.svg" alt="paypal" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Total de tounoir</p>
                                <h4 class="text-primary mb-0">{{ $config->tounoir ?? ' ' }}</h4>
                            </div>
                        </div> --}}
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-info rounded">
                                    <div>
                                        {{-- <img src="../../assets/svg/icons/lightbulb.svg"
                                        alt="Lightbulb" class="img-fluid" /> --}}
                                        <i class="menu-icon tf-icons ti ti-users"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Utilisateurs</p>
                                <h4 class="text-info mb-0">{{ $totalUser ?? ' ' }}</h4>
                            </div>
                        </div>
                {{--         <div class="d-flex align-items-center gap-4">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <div>
                                        <img src="../../assets/svg/icons/check.svg" alt="Check" class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Total séances</p>
                                <h4 class="text-warning mb-0">{{ $config->seance ?? '' }}</h4>
                            </div>
                        </div> --}}

                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <div>

                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-video ti-lg"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Meets</p>
                                <h4 class="text-warning mb-0">{{ $totalMeet ?? '' }}</h4>
                            </div>
                        </div>


                       {{--  <div class="d-flex align-items-center gap-4">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <div>
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-clock ti-28px"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Evènements</p>
                                <h4 class="text-warning mb-0">{{ $totalEvents ?? ' ' }}</h4>
                            </div>
                        </div> --}}


                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <div>
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-clock ti-28px"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Formations</p>
                                <h4 class="text-warning mb-0">{{ $totalFormations ?? ' ' }}</h4>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <div>
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-clock ti-28px"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-0 fw-medium">Actualités</p>
                                <h4 class="text-warning mb-0">{{ $totalactualites ?? ' ' }}</h4>
                            </div>
                        </div>


                    </div>
                </div>
                {{--   <div class="col-12 col-lg-4 ps-md-4 ps-lg-6">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div>
                            <h5 class="mb-1">Time Spendings</h5>
                            <p class="mb-9">Weekly report</p>
                        </div>
                        <div class="time-spending-chart">
                            <h4 class="mb-2">231<span class="text-body">h</span> 14<span
                                    class="text-body">m</span></h4>
                            <span class="badge bg-label-success">+18.4%</span>
                        </div>
                    </div>
                    <div id="leadsReportChart"></div>
                </div>
            </div> --}}
                <div id="chart3" data-values="@json($inscriptionMonth)"></div>
            </div>
        </div>
        <!-- Hour chart End  -->

        <!-- Topic and Instructors -->
        <div class="row mb-6 g-6">
            <!-- Interested Topics -->

            <!--/ Interested Topics -->

            <!-- Popular Instructors -->

            <!--/ Popular Instructors -->

            <!-- Top Courses -->
            <div class="col-xxl-4 col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Les rescentes videos</h5>
                        <div class="dropdown">
                            {{-- <button
                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1"
                            type="button" id="topCourses" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-md text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="topCourses">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                        </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach ($latestVideos as $video)
                                <li class="d-flex mb-6 align-items-center">
                                    <div class="avatar flex-shrink-0 me-4">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="ti ti-video ti-lg"></i></span>
                                    </div>
                                    <div class="row w-100 align-items-center">
                                        <div class="col-sm-8 mb-1 mb-sm-0 mb-lg-1 mb-xxl-0">
                                            <h6 class="mb-0">{{ $video->titre ?? '' }}</h6>

                                            <p class="mb-0 text-truncate">Publiée par:{{ $video->user->nom ?? '' }}</p>

                                        </div>

                                        {{--   <div class="col-sm-4 d-flex justify-content-sm-end">
                                    <div class="badge bg-label-secondary">1.2k likes</div>
                                </div> --}}
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Top Courses -->

            <!-- Upcoming Webinar -->
            <div class="col-xxl-4 col-md-6">

                <div class="card h-100">
                    @foreach ($lastevent as $event)
                        @if ($lastevent)
                            <div class="card-body">
                                <div class="bg-label-primary rounded text-center mb-4 pt-4">
                                    <img class="img-fluid" src="{{ Storage::url($event->image ?? ' ') }}"
                                        alt="Card girl image" width="140" />
                                </div>
                                <h5 class="mb-2">{{ $event->titre }}</h5>
                                <p class="small">
                                    {{--   {{ $lastestVideo->created_at }} --}}

                                </p>
                                <div class="row mb-4 g-3">
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-primary"><i
                                                        class="ti ti-calendar-event ti-28px"></i></span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 text-nowrap"></h6>
                                                <small>{{ $event->created_at }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-primary"><i
                                                        class="ti ti-clock ti-28px"></i></span>
                                            </div>
                                            {{--  <div>
                                    <h6 class="mb-0 text-nowrap">32 minutes</h6>
                                    <small>Duration</small>
                                </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0);" class="btn btn-primary w-100">Evènement en cours
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>





            </div>
            <!--/ Upcoming Webinar -->


            <div class="col-xxl-4 col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Les derniers évènements </h5>
                        </div>
                        <div class="dropdown">

                        </div>
                    </div>
                    <div class="px-5 py-4 border border-start-0 border-end-0">
                        <div class="d-flex justify-content-between align-items-center">
                            {{--  <p class="mb-0 text-uppercase">Evènements</p> --}}
                            {{--  <p class="mb-0 text-uppercase">Videos</p> --}}
                        </div>
                    </div>
                    <div class="card-body">



                        @foreach ($lastevents as $event)
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar me-4">

                                        <img src="{{ Storage::url($event->image ?? ' ') }}" alt="Avatar"
                                            class="rounded-circle" />
                                    </div>
                                    <div>
                                        <div>
                                            <h6 class="mb-0 text-truncate">{{ $event->titre ?? ' ' }}</h6>
                                            {{-- <small class="text-truncate text-body">{{ $user->role ?? ' ' }}</small> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    {{--    <h6 class="mb-0">{{ $user->videos_count }}</h6> --}}
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
            <!--/ Assignment Progress -->
        </div>
        <!--  Topic and Instructors  End-->

        <!-- Course datatable -->


        <!-- Course datatable End -->
    </div>

@endsection
@push('scripts')
    <!-- Vector map JavaScript -->
    <script src="/admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="/admin/assets/js/index2.js"></script>
    <!-- App JS -->
@endpush
