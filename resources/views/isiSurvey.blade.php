@extends('layouts.master')

@section('button-link')
    <a href="{{ route('home') }}" type="button" class="btn bg-gradient-secondary btn-sm">Tamu</a>
@endsection

@section('content')
    <style>
        .card-clickable {
            cursor: pointer;
            border: 2px solid transparent;
        }

        .card-clickable:hover {
            background-color: #cccccc;
            border: #e9ecef;
            color: #e9ecef;
        }

        .card-clickable input[type="radio"] {
            display: none;
        }

        .card-clickable input[type="radio"]:checked+label {
            border-color: #007bff;
            background-color: #e9ecef;
        }

        .card-clickable label {
            cursor: pointer;
            display: block;
            height: 100%;
            width: 100%;
            padding: 10px;
            transition: background-color 0.3s ease;
        }
    </style>

    <main class="d-flex align-items-center justify-content-center">
        <article class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 d-flex py-3 align-item-center">
                    <div class="card justify-content-center px-5 text-center bg-glass" style="height: 100%; width: 100%">
                        <h4 style="color: #212529">Selamat Datang <span style="color: #009604">Buku Tamu</span></h4>
                        <p>Dinas Bina Marga dan Penataan Ruang Provinsi Jawa Barat</p>
                        <img src="{{ asset('assets/logo-min.png') }}" alt="Lambang Jawa Barat" width="200"
                            class="img-fluid mx-auto">
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 py-3">
                    <div class="card p-3 bg-glass" style="height: 80vh">
                        <div class="rounded label-wrapper">
                            <div class="text-light fw-bold label-half-out">INDEX KEPUASAN</div>
                        </div>
                        <div id="survey-container">
                            @foreach ($pertanyaans as $index => $pertanyaan)
                                <div class="survey-question" data-index="{{ $index }}"
                                    style="{{ $index === 0 ? '' : 'display: none;' }}">
                                    <p class="fs-5 text-center">-- {{ $tamu->nama }} --</p>
                                    <div class="mb-3">
                                        <label for="pertanyaan_{{ $pertanyaan->id }}"
                                            class="form-label fs-5">{{ $loop->iteration }}.
                                            {{ $pertanyaan->daftar_pertanyaan }}</label>
                                        <div class="row">
                                            @foreach (['Sangat Puas' => ['icon' => 'fa-grin', 'color' => 'green'], 'Puas' => ['icon' => 'fa-smile', 'color' => 'blue'], 'Cukup Puas' => ['icon' => 'fa-meh', 'color' => 'orange'], 'Tidak Puas' => ['icon' => 'fa-frown', 'color' => 'red']] as $jawaban => $data)
                                                <div class="col-lg-3 col-md-6 mt-3">
                                                    <div class="card text-center border-3 card-clickable shadow">
                                                        <div class="card-body">
                                                            <input type="radio" name="pertanyaan_{{ $pertanyaan->id }}"
                                                                id="{{ strtolower(str_replace(' ', '_', $jawaban)) }}_{{ $pertanyaan->id }}"
                                                                value="{{ $jawaban }}">
                                                            <label
                                                                for="{{ strtolower(str_replace(' ', '_', $jawaban)) }}_{{ $pertanyaan->id }}"
                                                                class="fs-6">
                                                                <i class="fa {{ $data['icon'] }} me-2 fs-3"
                                                                    style="color: {{ $data['color'] }}"></i><br>{{ $jawaban }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </main>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var totalQuestions = {{ $pertanyaans->count() }};
            var currentQuestion = 0;
            var answers = {};

            function showNextQuestion() {
                if (currentQuestion < totalQuestions - 1) {
                    currentQuestion++;
                    $('.survey-question').hide();
                    $('.survey-question[data-index="' + currentQuestion + '"]').show();
                } else {
                    submitSurvey();
                }
            }

            function submitSurvey() {
                $.ajax({
                    url: '{{ route('store_survey', ['id' => $tamu->id]) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        answers: answers
                    },
                    success: function(response) {
                        Swal.fire(
                            'Terima Kasih!',
                            'Terima kasih telah mengisi pertanyaan.',
                            'success'
                        );
                        window.location.href = '{{ route('survey') }}';
                    },
                    error: function(response) {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan, silakan coba lagi.',
                            'error'
                        );
                    }
                });
            }

            $('.card-clickable').on('click', function() {
                var $input = $(this).find('input[type="radio"]');
                if ($input.length) {
                    $input.prop('checked', true).trigger('change');
                    var questionId = $input.attr('name').split('_')[1];
                    answers[questionId] = $input.val();
                    showNextQuestion();
                }
            });

            $('input[type="radio"]').on('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
@endsection
