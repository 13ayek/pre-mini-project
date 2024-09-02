@extends('layouts.base')

@section('content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <style>
            body {
                background-color: #add8e6; /* Biru muda */
            }
            /* CSS untuk menyamakan ukuran gambar dalam card */
            .card-img-top {
                width: 100%;
                height: 200px; /* Anda bisa menyesuaikan tinggi sesuai keinginan */
                object-fit: cover; /* Mengatur agar gambar memenuhi ruang tanpa distorsi */
            }
        </style>
    </head>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Page Content-->
            <section class="py-5">
                <div class="container px-5">
                    <div class="card border-0 shadow rounded-3 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row gx-0">
                                <div class="col-lg-6 col-xl-5 py-lg-5">
                                    <div class="p-4 p-md-5">
                                        <div class="h2 fw-bolder">Welcome to CleanDream!</div>
                                        <p>Make your clothes clean like a dream...</p>
                                        <a class="stretched-link text-decoration-none" href="{{ route('customers.index') }}">
                                            Read more
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-7">
                                    <div class="bg-featured-blog" style="background-image: url('/path/to/image/A_cartoon_illustration_of_a_washing_machine,_desig.png'); background-size: cover; background-position: center;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5">
                    <h2 class="fw-bolder fs-5 mb-4">Service </h2>
                    <div class="row gx-5">
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="foto/Rincian-Modal-Usaha-Laundry-dan-Estimasi-Profitnya.avif" alt="foto1" />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">Clean</div>
                                    <a class="text-decoration-none link-dark stretched-link"><div class="h5 card-title mb-3">100% Clean</div></a>
                                    <p class="card-text mb-0">make your clothes clean like new</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="foto/modal-usaha-laundry-2023.jpeg" alt="foto2" />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">Facilities</div>
                                    <a class="text-decoration-none link-dark stretched-link"><div class="h5 card-title mb-3">Advanced Facilities</div></a>
                                    <p class="card-text mb-0">equipped with complete state-of-the-art facilities</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="foto/WhatsApp-Image-2023-07-16-at-2.03.40-PM-1.jpeg" alt="foto3" />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2">Employee</div>
                                    <a class="text-decoration-none link-dark stretched-link"><div class="h5 card-title mb-3">active employees</div></a>
                                    <p class="card-text mb-0">Employees are active and work fast</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; CleanDream</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

@endsection
