@extends('front.fixe')
@section('title', 'Exams')
@section('body')
    <style type="text/css">
        .question_options>li {
            list-style: none;
            height: 40px;
            line-height: 40px;
        }
    </style>
    <!-- /.content-header -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Exams</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Exam</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h3 class="text-center">Time : {{ $exam->exam_duration }} min</h3>
                                        </div>
                                        <div class="col-sm-3">
                                            <h3><b>Timer</b> : <span class="js-timeout"
                                                    id="timer">{{ $exam['exam_duration'] }}:00</span></h3>
                                        </div>

                                      
                                         <div class="col-sm-2">
            <h3> Points : <span id="totalPoints">{{ $totalPoints }}</span></h3>
        </div>
                                        <div class="col-sm-3">
                                            <h3 class="text-right"><b>Status</b> :Running</h3>
                                        </div>

                                       

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card-body">
                                <form id="examForm" action="{{ url('submit_questions') }}" method="POST">
                                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                                    {{-- <input type="hidden" name="index" value="{{ count($question) }}"> --}}


                                    {{ csrf_field() }}
                                    <div id="questionsContainer">
                                        @foreach ($question as $key => $q)
                                            <div class="question-item" data-index="{{ $key }}"
                                                style="{{ $key > 0 ? 'display:none' : '' }}">
                                                <input type="hidden" name="index" value="{{ count($question) }}">
                                                 <input type="hidden" name="points{{ $key }}" value="{{ $q->points }}"> {{-- Ajout du champ points --}}


                                                <p>{{ $key + 1 }}. {{ $q->questions }} ({{ $q->points }} pts)</p>
                                                <input type="hidden" name="question{{ $key }}"
                                                    value="{{ $q->id }}">
                                                @php
                                                    $options = json_decode($q->options, true);
                                                @endphp
                                                <ul class="question_options">
                                                    <li><input type="radio" value="{{ $options['option1'] }}"
                                                            name="ans{{ $key }}"> {{ $options['option1'] }}</li>
                                                    <li><input type="radio" value="{{ $options['option2'] }}"
                                                            name="ans{{ $key }}"> {{ $options['option2'] }}</li>
                                                    <li><input type="radio" value="{{ $options['option3'] }}"
                                                            name="ans{{ $key }}"> {{ $options['option3'] }}</li>
                                                    <li><input type="radio" value="{{ $options['option4'] }}"
                                                            name="ans{{ $key }}"> {{ $options['option4'] }}</li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-3">
                                        <button type="button" id="prevBtn" class="btn btn-secondary">Previous</button>
                                        <button type="button" id="nextBtn" class="btn btn-primary">Next</button>
                                        <button type="submit" id="submitBtn" class="btn btn-success"
                                            style="display:none">Submit</button>
                                    </div>

                                    <div class="question-index mb-3">
                                        @foreach ($question as $key => $q)
                                            <button type="button" class="btn btn-sm btn-outline-secondary question-nav"
                                                data-index="{{ $key }}">
                                                {{ $key + 1 }}
                                            </button>
                                        @endforeach
                                    </div>

                                </form>
                            </div>
                            -

                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    <!-- /.content-header -->


    <script>
        let currentQuestion = 0;
        const questions = document.querySelectorAll('.question-item');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const questionNavBtns = document.querySelectorAll('.question-nav');

        function showQuestion(index) {
            currentQuestion = index;
            questions.forEach((q, i) => {
                q.style.display = i === index ? 'block' : 'none';
            });

            prevBtn.style.display = index === 0 ? 'none' : 'inline-block';
            nextBtn.style.display = index === questions.length - 1 ? 'none' : 'inline-block';
            submitBtn.style.display = index === questions.length - 1 ? 'inline-block' : 'none';

            updateNavButtons();
        }

        // Mise à jour visuelle des boutons (réponse cochée ou non)
        function updateNavButtons() {
            questionNavBtns.forEach((btn, i) => {
                const answered = document.querySelector(`input[name="ans${i}"]:checked`);
                btn.classList.remove('btn-success', 'btn-warning');
                if (answered) {
                    btn.classList.add('btn-success'); // question répondue
                } else if (i < currentQuestion) {
                    btn.classList.add('btn-warning'); // question précédente non répondue
                }
            });
        }

        // Navigation précédente / suivante
        prevBtn.addEventListener('click', () => {
            if (currentQuestion > 0) showQuestion(currentQuestion - 1);
        });
        nextBtn.addEventListener('click', () => {
            if (currentQuestion < questions.length - 1) showQuestion(currentQuestion + 1);
        });

        // Navigation par index cliquable
        questionNavBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.getAttribute('data-index'));
                showQuestion(index);
            });
        });

        // Mise à jour en temps réel quand une réponse est cochée
        questions.forEach((q, i) => {
            q.querySelectorAll('input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', updateNavButtons);
            });
        });

        // initial display
        showQuestion(currentQuestion);
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const examId = '{{ $exam->id }}'; // unique pour chaque examen
            const timerEl = document.getElementById('timer');

            // Durée initiale en secondes
            const initialMinutes = parseInt('{{ $exam['exam_duration'] }}');
            let totalSeconds;

            // Vérifier si un temps restant est déjà sauvegardé
            if (localStorage.getItem('exam_timer_' + examId)) {
                totalSeconds = parseInt(localStorage.getItem('exam_timer_' + examId));
            } else {
                totalSeconds = initialMinutes * 60;
            }

            function updateTimer() {
                let mins = Math.floor(totalSeconds / 60);
                let secs = totalSeconds % 60;
                timerEl.innerText = mins + ':' + (secs < 10 ? '0' : '') + secs;

                if (totalSeconds <= 0) {
                    clearInterval(timerInterval);
                    localStorage.removeItem('exam_timer_' + examId);
                    // alert('Le temps est écoulé !');
                    Swal.fire({
                        title: 'Temps écoulé !',
                        text: 'Votre examen est automatiquement soumis.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        document.getElementById('examForm').submit();
                    });
                } else {
                    totalSeconds--;
                    localStorage.setItem('exam_timer_' + examId, totalSeconds);
                }
            }

            const timerInterval = setInterval(updateTimer, 1000);
        });
    </script>


    <script>
        // Fonction pour sauvegarder toutes les réponses dans localStorage
        function saveAnswers() {
            const answers = {};
            document.querySelectorAll('.question_options input[type="radio"]').forEach(function(radio) {
                if (radio.checked) {
                    answers[radio.name] = radio.value;
                }
            });
            localStorage.setItem('exam_answers', JSON.stringify(answers));
        }

        // Sauvegarder à chaque changement
        document.querySelectorAll('.question_options input[type="radio"]').forEach(function(radio) {
            radio.addEventListener('change', saveAnswers);
        });

        window.addEventListener('load', function() {
            const savedAnswers = JSON.parse(localStorage.getItem('exam_answers')) || {};
            document.querySelectorAll('.question_options input[type="radio"]').forEach(function(radio) {
                if (savedAnswers[radio.name] && radio.value === savedAnswers[radio.name]) {
                    radio.checked = true;
                }
            });
        });
    </script>

    <script>
        document.getElementById('examForm').addEventListener('submit', function(e) {
            e.preventDefault(); // empêcher soumission immédiate
            Swal.fire({
                title: "Confirmer la soumission ?",
                text: "Une fois soumis, vous ne pourrez plus modifier vos réponses.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Oui, soumettre",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.isConfirmed) {
                    const examId = '{{ $exam->id }}';

                    // ✅ Effacer le timer et les réponses sauvegardées
                    localStorage.removeItem('exam_timer_' + examId);
                    localStorage.removeItem('exam_answers');

                    // soumettre le formulaire après nettoyage
                    e.target.submit();
                }
            });
        });
    </script>

@endsection
