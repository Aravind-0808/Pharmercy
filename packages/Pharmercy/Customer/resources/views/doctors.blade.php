@extends('Customer::layout.app')

@section('title', 'Doctors')

@section('content')
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="section-title">Available Doctors</h2>
                    <p class="section-subtitle">Book your appointment with our expert doctors</p>
                </div>
            </div>
            <div class="row">
                @forelse($doctors as $doctor)
                    <div class="col-6 col-md-4 col-lg-3 mb-4 doctor-card-col">
                        <div class="doctor-card">
                            <img src="{{ asset("/storage/{$doctor->logo}") }}" class="card-thumbnail" alt="{{ $doctor['name'] }}">

                            <div class="card-body">
                                <h3 class="card-title">{{ $doctor['name'] }}</h3>
                                <p class="card-specialty">{{ $doctor['specialization'] }}</p>
                                <p class="card-location text-muted">
                                    <i class="bi bi-geo-alt-fill"></i>{{ $doctor['address'] }} {{ $doctor['city'] }}, {{ $doctor['state'] }}
                                </p>
                                <div class="card-rating text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    <span class="text-muted">(4.0/5)</span>
                                </div>
                            </div>

                            <div class="card-footer d-none d-md-flex justify-content-between">
                                <a href="tel:{{ $doctor['phone'] }}" class="btn btn-call btn-primary">
                                    <i class="bi bi-telephone"></i> Call
                                </a>
                                <a href="https://wa.me/{{ ltrim($doctor['whatsapp'], '+') }}" target="_blank"
                                    class="btn btn-whatsapp btn-success">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center mt-5">
                        <p>No Doctors Available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <style>
        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 3rem;
        }

        .doctor-card {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-thumbnail {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .card-body {
            padding: 1.5rem 1rem 1rem;
            flex-grow: 1;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #343a40;
        }

        .card-specialty {
            font-size: 1rem;
            color: #495057;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .card-location {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .card-rating {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .card-rating .bi-star-fill {
            color: #ffc107;
        }

        .card-rating .text-muted {
            font-size: 0.9rem;
        }

        /* Modal styles */
        .doctor-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .doctor-modal.active {
            display: flex;
        }

        .doctor-modal-content {
            background: #fff;
            border-radius: 12px;
            padding: 2rem 1.5rem 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            text-align: center;
            min-width: 260px;
            max-width: 90vw;
        }

        .doctor-modal-close {
            position: absolute;
            top: 18px;
            right: 24px;
            font-size: 2rem;
            color: #888;
            cursor: pointer;
        }

        .doctor-modal-actions {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-top: 1.5rem;
        }

        .doctor-modal-actions a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #333;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .doctor-modal-actions .icon {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .doctor-modal-actions .icon-call {
            color: #1abc9c;
        }

        .doctor-modal-actions .icon-whatsapp {
            color: #25D366;
        }
        .btn-call {
            width: 120px !important;
        }

        @media (max-width: 767px) {
            .doctor-card {
                min-width: 0;
                width: 150px;
                margin: 0 auto;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
                padding: 0.5rem;
            }

            .section-title {
                font-size: 22px;
            }

            .section-subtitle {
                font-size: 15px;
                margin-bottom: 1rem;
            }

            .card-thumbnail {
                height: 100px;
            }

            .card-title {
                font-size: 0.85rem !important;
            }

            .card-specialty {
                font-size: 0.75rem !important;
                margin-bottom: 0.2rem !important;
            }

            .card-body {
                margin-top: 20px;
                padding: 5px;
                flex-grow: 1;
            }

            .card-location,
            .card-rating {
                font-size: 0.75rem !important;
            }

            .btn-call,
            .btn-whatsapp {
                font-size: 0.75rem !important;
                padding: 0.4rem;
            }
        }
    </style>
    <!-- Doctor Modal (only mobile) -->
    <div class="doctor-modal" id="doctorModal">
        <div class="doctor-modal-content" id="doctorModalContent">
            <span class="doctor-modal-close" id="doctorModalClose">&times;</span>
            <div id="doctorModalDetails"></div>
            <div class="doctor-modal-actions" id="doctorModalActions"></div>
        </div>
    </div>
    <script>
        // Modal logic only for mobile
        document.addEventListener('DOMContentLoaded', function () {
            function isMobile() {
                return window.innerWidth < 768;
            }
            const modal = document.getElementById('doctorModal');
            const modalClose = document.getElementById('doctorModalClose');
            const modalDetails = document.getElementById('doctorModalDetails');
            const modalActions = document.getElementById('doctorModalActions');
            let doctors = @json($doctors);
            document.querySelectorAll('.doctor-card').forEach(function (card, idx) {
                card.addEventListener('click', function () {
                    if (!isMobile()) return;
                    const doctor = doctors[idx];
                    modalDetails.innerHTML = `<h3 style='margin-bottom:0.5rem;font-size:22px;'>${doctor.name}</h3><div style='color:#888;font-size:15px;'>${doctor.specialization}</div>`;
                    modalActions.innerHTML = `
                            <a style='width: 120px !important;font-size: 15px;' href='tel:${doctor.phone}'><span class='icon icon-call'><i class='bi bi-telephone-fill'></i></span>Call</a>
                            <a style='width: 120px !important;font-size: 15px;' href='https://wa.me/${doctor.whatsapp.replace('+', '')}' target='_blank'><span class='icon icon-whatsapp'><i class='bi bi-whatsapp'></i></span>WhatsApp</a>
                        `;
                    modal.classList.add('active');
                });
            });
            modalClose.addEventListener('click', function () {
                modal.classList.remove('active');
            });
            modal.addEventListener('click', function (e) {
                if (e.target === modal) modal.classList.remove('active');
            });
        });
    </script>
@endsection